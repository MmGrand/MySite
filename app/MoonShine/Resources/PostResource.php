<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\Date;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Switcher;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Посты';

    public string $column = 'title';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Tabs::make([
                Tab::make('Основная информация',[
                    Block::make('Основная информация', [
                        ID::make()->sortable(),
                        Text::make('Заголовок', 'title')->sortable()->required(),
                        Slug::make('Slug')->from('title')->unique()->locked()->hideOnIndex(),
                        BelongsTo::make('Автор', 'user', resource: new UserResource())->searchable()->hideOnIndex(),
                        Textarea::make('Основной контент', 'main_content')->required()->hideOnIndex(),
                        Image::make('Основное изображение', 'main_image')->disk('public')->dir('posts')->hideOnIndex(),
                        Date::make('Время создания', 'created_at')->hideOnIndex(),
                        Switcher::make('Опубликовано', 'is_published')->sortable(),
                    ]),
                ]),
                Tab::make('Побочная информация',[
                    Block::make('Побочная информация', [
                        Textarea::make('Контент предпросмотра', 'preview_content')->required()->hideOnIndex(),
                        Image::make('Изображение предпросмотра', 'preview_image')->disk('public')->dir('posts')->hideOnIndex(),
                        BelongsTo::make('Категория', 'category', resource: new CategoryResource())->searchable()->hideOnIndex(),
                        BelongsToMany::make('Тэги', 'tags')->hideOnIndex()->selectMode(),
                        HasMany::make('Комментарии', 'comments')->creatable()->hideOnIndex(),
                        Number::make('Количество просмотров', 'views_count')->hideOnIndex(),
                    ]),
                ]),
            ])
        ];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
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
    public function rules(Model $item): array
    {
        return [
            'title' => 'required|string|max:50',
            'slug' => 'nullable|string|max:50',
            'user' => 'nullable|integer|exists:users,name',
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
