<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;

/**
 * @extends ModelResource<Comment>
 */
class CommentResource extends ModelResource
{
    protected string $model = Comment::class;

    protected string $title = 'Комментарии';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Пост', 'post', resource: new PostResource())->searchable()->hideOnIndex(),
                BelongsTo::make('Родитель', 'parent', resource: new CommentResource())->searchable()->nullable()->hideOnIndex(),
                Text::make('Автор', 'author')->sortable()->required(),
                Textarea::make('Текст комментария', 'content')->required()->hideOnIndex(),
                Date::make('Время создания', 'created_at')->hideOnIndex(),
            ]),
        ];
    }

    /**
     * @param Comment $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
