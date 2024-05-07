<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'url' => fake()->url,
            'preview_content' => fake()->text(200),
            'preview_image' => fake()->imageUrl(),
            'is_published' =>fake()->boolean(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $project->tags()->attach($tags);
        });
    }
}
