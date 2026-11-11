<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends BaseModelResource<Post>
 */
class PostResource extends BaseModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Посты';

    public string $column = 'title';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title')->sortable()->required(),
            Switcher::make('Опубликовано', 'is_published')->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Tabs::make([
                Tab::make('Основная информация',[
                    Box::make('Основная информация', [
                        ID::make()->sortable(),
                        Text::make('Заголовок', 'title')->sortable()->required(),
                        Slug::make('Slug')->from('title')->unique()->locked(),
                        BelongsTo::make('Автор', 'user', resource: UserResource::class)->searchable(),
                        Textarea::make('Основной контент', 'main_content')->required(),
                        Image::make('Основное изображение', 'main_image')->disk('public')->dir('posts'),
                        Date::make('Время создания', 'created_at'),
                        Switcher::make('Опубликовано', 'is_published')->sortable(),
                    ]),
                ]),
                Tab::make('Побочная информация',[
                    Box::make('Побочная информация', [
                        Textarea::make('Контент предпросмотра', 'preview_content')->required(),
                        Image::make('Изображение предпросмотра', 'preview_image')->disk('public')->dir('posts'),
                        BelongsTo::make('Категория', 'category', resource: CategoryResource::class)->searchable(),
                        BelongsToMany::make('Тэги', 'tags')->selectMode(),
                        HasMany::make('Комментарии', 'comments', resource: CommentResource::class)->creatable(),
                        Number::make('Количество просмотров', 'views_count')->default(0),
                    ]),
                ]),
            ])
        ];
    }

    protected function search(): array
    {
        return ['id', 'title'];
    }

    protected function filters(): array
    {
        return [
            Text::make('Заголовок', 'title'),
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function validationRules(Model $item): array
    {
        return [
            'title' => 'required|string|max:50',
            'slug' => 'nullable|string|max:50',
            'user_id' => 'nullable|integer|exists:users,id',
            'main_content' => 'required|string|max:500',
            'main_image' => 'nullable|file|image|max:2048',
            'preview_content' => 'required|string|max:250',
            'preview_image' => 'nullable|file|image|max:2048',
            'category' => 'nullable|integer|exists:categories,name',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'comments' => 'nullable|array',
            'comments.*' => 'integer|exists:comments,id',
            'views_count' => 'nullable|integer',
            'is_published' => 'boolean',
        ];
    }
}
