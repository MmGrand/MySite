<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

/**
 * @extends BaseModelResource<Category>
 */
class CategoryResource extends BaseModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Категории';

    public string $column = 'name';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'name')->sortable()->required(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->sortable(),
                Text::make('Заголовок', 'name')->sortable()->required(),
                Slug::make('Slug')->from('name')->unique()->locked(),
                Date::make('Время создания', 'created_at'),
            ]),
        ];
    }

    protected function search(): array
    {
        return ['id', 'name'];
    }

    protected function filters(): array
    {
        return [
            Text::make('Заголовок', 'name'),
        ];
    }

    /**
     * @param Category $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function validationRules(Model $item): array
    {
        return [
            'name' => 'required|string|max:50',
            'slug' => 'string|max:50',
        ];
    }
}
