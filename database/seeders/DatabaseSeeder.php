<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tag::factory(20)->create();
        Category::factory(5)->create();
        User::factory(10)->create();
        Post::factory(50)->create()->each(function ($post) {
            // Создание комментариев для постов
            Comment::factory(rand(5, 10))->create([
                'post_id' => $post->id,
            ])->each(function ($comment) use ($post) {
                // 50% вероятность создания ответов на комментарии
                if (rand(0, 1)) {
                    Comment::factory(rand(1, 3))->create([
                        'post_id' => $post->id,
                        'parent_id' => $comment->id,
                    ]);
                }
            });
        });
        Project::factory(15)->create();
    }
}
