<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Url;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Switcher;

/**
 * @extends ModelResource<Project>
 */
class ProjectResource extends ModelResource
{
    protected string $model = Project::class;

    protected string $title = 'Проекты';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make('Основная информация', [
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')->sortable()->required(),
                Url::make('Ссылка на проект', 'url')->required()->hideOnIndex(),
                Textarea::make('Контент предпросмотра', 'preview_content')->required()->hideOnIndex(),
                Image::make('Изображение предпросмотра', 'preview_image')->disk('public')->dir('projects')->hideOnIndex(),
                BelongsToMany::make('Тэги', 'tags')->hideOnIndex()->selectMode(),
                Date::make('Время создания', 'created_at')->hideOnIndex(),
                Switcher::make('Опубликовано', 'is_published')->sortable(),
            ]),
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
     * @param Project $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'title' => 'required|string|max:50',
            'url' => 'required|string|url',
            'preview_content' => 'required|string|max:250',
            'preview_image' => 'file|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'is_published' => 'boolean',
        ];
    }
}
