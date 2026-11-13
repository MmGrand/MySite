<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SpaApiTest extends TestCase
{
    use RefreshDatabase;

    private function createPost(User $author, Category $category, string $slug, bool $published = true): Post
    {
        return Post::create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'title' => $slug,
            'slug' => $slug,
            'preview_content' => 'Preview',
            'main_content' => '<p>Content</p>',
            'is_published' => $published,
            'views_count' => 0,
        ]);
    }

    public function test_content_api_filters_and_hides_unpublished_items(): void
    {
        $author = User::factory()->create();
        $category = Category::create(['name' => 'PHP', 'slug' => 'php']);
        $other = Category::create(['name' => 'Vue', 'slug' => 'vue']);
        $tag = Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);
        $post = $this->createPost($author, $category, 'visible');
        $post->tags()->attach($tag);
        $this->createPost($author, $category, 'hidden', false)->tags()->attach($tag);
        $this->createPost($author, $other, 'other');
        Project::create(['title' => 'Draft', 'url' => 'https://example.test', 'preview_content' => 'Draft', 'is_published' => false]);

        $this->getJson('/api/posts?category=php&tag=laravel')
            ->assertOk()->assertJsonCount(1, 'data')->assertJsonPath('data.0.slug', 'visible')
            ->assertJsonMissingPath('data.0.user_id');
        $this->getJson('/api/posts?category=missing')->assertNotFound();
        $this->getJson('/api/posts/hidden')->assertNotFound();
        $this->getJson('/api/posts/visible')->assertOk()->assertJsonPath('views_count', 1);
        $this->getJson('/api/home')->assertJsonCount(0, 'projects')->assertJsonCount(2, 'posts');
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'views_count' => 1]);
    }

    public function test_pagination_limits_results(): void
    {
        $author = User::factory()->create();
        $category = Category::create(['name' => 'PHP', 'slug' => 'php']);
        for ($i = 0; $i < 13; $i++) {
            $this->createPost($author, $category, 'post-'.$i);
        }
        $this->getJson('/api/posts?page=2')->assertOk()->assertJsonCount(1, 'data')
            ->assertJsonPath('meta.current_page', 2)->assertJsonPath('meta.last_page', 2);
    }

    public function test_login_comments_profile_and_logout(): void
    {
        Storage::fake('public');
        $user = User::factory()->create(['email' => 'user@example.test', 'password' => Hash::make('password123')]);
        $category = Category::create(['name' => 'PHP', 'slug' => 'php']);
        $post = $this->createPost($user, $category, 'first');
        $other = $this->createPost($user, $category, 'second');
        $draft = $this->createPost($user, $category, 'draft', false);
        $parent = Comment::create(['post_id' => $other->id, 'author_id' => $user->id, 'content' => 'Parent']);

        $this->withHeader('Referer', 'http://localhost/');
        $this->postJson('/api/comments', ['post_id' => $post->id, 'content' => 'Hello'])->assertUnauthorized();
        $this->postJson('/api/login', ['email' => $user->email, 'password' => 'wrong'])->assertUnprocessable();
        $this->postJson('/api/login', ['email' => $user->email, 'password' => 'password123'])->assertOk()->assertJsonPath('id', $user->id);
        $this->getJson('/api/user')->assertOk()->assertJsonMissingPath('password');
        $this->postJson('/api/comments', ['post_id' => $post->id, 'parent_id' => $parent->id, 'content' => 'Wrong post'])->assertUnprocessable();
        $this->postJson('/api/comments', ['post_id' => $draft->id, 'content' => 'Draft'])->assertUnprocessable();
        $this->postJson('/api/comments', ['post_id' => $post->id, 'content' => '<script>text</script>'])->assertCreated()
            ->assertJsonPath('author.name', $user->name)->assertJsonMissingPath('author.email');
        $this->postJson('/api/comments', ['post_id' => $other->id, 'parent_id' => $parent->id, 'content' => 'Reply'])->assertCreated();
        $this->getJson('/api/posts/second')->assertJsonPath('comments.0.children.0.content', 'Reply')
            ->assertJsonMissingPath('comments.0.author.email');
        $this->getJson('/api/profile/comments')->assertOk()->assertJsonCount(3, 'data');
        $this->postJson('/api/profile/avatar', ['avatar' => UploadedFile::fake()->image('avatar.png')])->assertOk();
        $this->postJson('/api/logout')->assertNoContent();
        $this->app['auth']->forgetGuards();
        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_registration_and_password_reset_require_a_valid_token(): void
    {
        Notification::fake();
        $this->withHeader('Referer', 'http://localhost/');
        $this->postJson('/api/register', [
            'name' => 'Test', 'email' => 'test@example.test',
            'password' => 'password123', 'password_confirmation' => 'password123',
        ])->assertCreated();
        $user = User::where('email', 'test@example.test')->firstOrFail();
        $this->postJson('/api/logout')->assertNoContent();
        $this->post('/reset-password', ['email' => $user->email, 'password' => 'changed123', 'password_confirmation' => 'changed123'])->assertNotFound();
        $this->assertTrue(Hash::check('password123', $user->fresh()->password));

        $this->postJson('/api/forgot-password', ['email' => $user->email])->assertOk();
        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $this->postJson('/api/reset-password', [
                'email' => $user->email, 'token' => 'invalid',
                'password' => 'changed123', 'password_confirmation' => 'changed123',
            ])->assertUnprocessable();
            $this->postJson('/api/reset-password', [
                'email' => $user->email, 'token' => $notification->token,
                'password' => 'changed123', 'password_confirmation' => 'changed123',
            ])->assertOk();
            $this->postJson('/api/reset-password', [
                'email' => $user->email, 'token' => $notification->token,
                'password' => 'changed123', 'password_confirmation' => 'changed123',
            ])->assertUnprocessable();
            return true;
        });
        $this->assertTrue(Hash::check('changed123', $user->fresh()->password));
    }
}
