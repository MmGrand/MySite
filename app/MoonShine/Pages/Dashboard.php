<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;

class Dashboard extends Page
{

    protected string $title = 'АдминПанель';
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make([
                        ValueMetric::make('Количество проектов')->value(Project::query()->count())->icon('heroicons.briefcase'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        ValueMetric::make('Количество постов')->value(Post::query()->count())->icon('heroicons.book-open'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        ValueMetric::make('Количество категорий')->value(Category::query()->count())->icon('heroicons.view-columns'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        ValueMetric::make('Количество тэгов')->value(Tag::query()->count())->icon('heroicons.tag'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        ValueMetric::make('Количество комментариев')->value(Comment::query()->count())->icon('heroicons.chat-bubble-left-ellipsis'),
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        ValueMetric::make('Количество пользователей')->value(User::query()->count())->icon('heroicons.users'),
                    ])
                ])->columnSpan(6),
            ])
        ];
	}
}
