<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Text;

/**
 * @extends BaseModelResource<User>
 */
class UserResource extends BaseModelResource
{
    protected string $model = User::class;

    protected string $title = 'Пользователи';

    public string $column = 'name';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Имя', 'name')->sortable()->required(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->sortable(),
                Text::make('Имя', 'name')->sortable()->required(),
                Email::make('Почта', 'email')->required(),
                Password::make('Пароль', 'password')->required(),
                PasswordRepeat::make('Подтвердите пароль', 'password_confirmation')->required(),
                Date::make('Время создания', 'created_at'),
                HasMany::make('Посты', 'posts', resource: PostResource::class)->creatable(),
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
            Text::make('Имя', 'name'),
            Email::make('Почта', 'email')
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function validationRules(Model $item): array
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:7|confirmed',
            'posts' => 'nullable|array',
            'posts.*' => 'integer|exists:post,id',
        ];
    }
}
