<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    private function image(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return preg_match('~^https?://~i', $path) || str_starts_with($path, '/')
            ? $path
            : Storage::url($path);
    }

    private function postData(Post $post, bool $detail = false): array
    {
        $data = [
            'id' => $post->id,
            'slug' => $post->slug,
            'title' => $post->title,
            'preview_content' => $post->preview_content,
            'preview_image' => $this->image($post->preview_image),
            'views_count' => $post->views_count,
            'category' => $post->category?->only('name', 'slug'),
            'tags' => $post->tags->map->only('name', 'slug'),
            'created_at' => $post->created_at,
        ];

        if ($detail) {
            $data['main_content'] = $post->main_content;
            $data['main_image'] = $this->image($post->main_image);
            $data['comments'] = $post->comments->map(fn ($comment) => $this->commentData($comment));
        }

        return $data;
    }

    public function commentData($comment): array
    {
        $data = [
            'id' => $comment->id,
            'content' => $comment->content,
            'created_at' => $comment->created_at,
            'author' => [
                'name' => $comment->author?->name ?? 'Пользователь',
                'avatar' => $this->image($comment->author?->avatar),
            ],
        ];

        if ($comment->relationLoaded('children')) {
            $data['children'] = $comment->children->map(fn ($child) => $this->commentData($child));
        }

        return $data;
    }

    private function projectData(Project $project): array
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'url' => $project->url,
            'preview_content' => $project->preview_content,
            'preview_image' => $this->image($project->preview_image),
            'tags' => $project->tags->map->only('name', 'slug'),
        ];
    }

    private function pagination($paginator, callable $transform): array
    {
        return [
            'data' => $paginator->getCollection()->map($transform)->values(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'total' => $paginator->total(),
            ],
        ];
    }

    public function home(): array
    {
        return [
            'posts' => Post::with(['category', 'tags'])->where('is_published', true)->latest()->take(6)->get()->map(fn ($post) => $this->postData($post)),
            'projects' => Project::with('tags')->where('is_published', true)->latest()->take(6)->get()->map(fn ($project) => $this->projectData($project)),
        ];
    }

    public function posts(Request $request): array
    {
        $query = Post::with(['category', 'tags'])->where('is_published', true);
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->query('category'))->firstOrFail();
            $query->where('category_id', $category->id);
        }
        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($query) => $query->where('slug', $request->query('tag')));
        }

        return $this->pagination($query->latest()->paginate(12), fn ($post) => $this->postData($post)) + [
            'tags' => Tag::all(['name', 'slug']),
            'categories' => Category::all(['name', 'slug']),
        ];
    }

    public function post(string $slug): array
    {
        $post = Post::with(['category', 'tags', 'comments.author', 'comments.children.author'])
            ->where('is_published', true)->where('slug', $slug)->firstOrFail();
        $post->incrementViewsCount();

        return $this->postData($post, true);
    }

    public function projects(Request $request): array
    {
        $query = Project::with('tags')->where('is_published', true);
        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($query) => $query->where('slug', $request->query('tag')));
        }

        return $this->pagination($query->latest()->paginate(12), fn ($project) => $this->projectData($project)) + [
            'tags' => Tag::all(['name', 'slug']),
        ];
    }
}
