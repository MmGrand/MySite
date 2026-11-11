<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends BaseModelResource<Comment>
 */
class CommentResource extends BaseModelResource
{
    protected string $model = Comment::class;

    protected string $title = 'Комментарии';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->sortable(),
                BelongsTo::make('Пост', 'post', resource: PostResource::class)->searchable(),
                BelongsTo::make('Родитель', 'parent', resource: self::class)->searchable()->nullable(),
                BelongsTo::make('Автор', 'author', resource: UserResource::class)->searchable(),
                Textarea::make('Текст комментария', 'content')->required(),
                Date::make('Время создания', 'created_at'),
            ]),
        ];
    }

    /**
     * @param Comment $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function validationRules(Model $item): array
    {
        return [
            'content' => 'required|string|max:250',
            'author_id' => 'nullable|integer|exists:users,id',
            'post' => 'nullable|integer|exists:posts,id',
            'parent' => 'nullable|integer|exists:comments,id',
        ];
    }
}
