<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;

/**
 * @extends BaseModelResource<Project>
 */
class ProjectResource extends BaseModelResource
{
    protected string $model = Project::class;

    protected string $title = 'Проекты';

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
            Box::make('Основная информация', [
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')->sortable()->required(),
                Url::make('Ссылка на проект', 'url')->required(),
                Textarea::make('Контент предпросмотра', 'preview_content')->required(),
                Image::make('Изображение предпросмотра', 'preview_image')->disk('public')->dir('projects'),
                BelongsToMany::make('Тэги', 'tags')->selectMode(),
                Date::make('Время создания', 'created_at'),
                Switcher::make('Опубликовано', 'is_published')->sortable(),
            ]),
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
     * @param Project $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function validationRules(Model $item): array
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
