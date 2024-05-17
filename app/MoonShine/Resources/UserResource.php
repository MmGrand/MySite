<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Пользователи';

    public string $column = 'name';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Имя', 'name')->sortable()->required(),
                Email::make('Почта', 'email')->hideOnIndex()->required(),
                Password::make('Пароль', 'password')->hideOnIndex()->required(),
                PasswordRepeat::make('Подтверждение пароля', 'password_repeat')->hideOnIndex()->required(),
                Date::make('Время создания', 'created_at')->hideOnIndex(),
            ]),
        ];
    }

    public function search(): array
    {
        return ['id', 'name'];
    }

    public function filters(): array
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
    public function rules(Model $item): array
    {
        return [];
    }
}
