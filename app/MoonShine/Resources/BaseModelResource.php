<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\MoonShine\Pages\Crud\FormPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Crud\Contracts\Page\DetailPageContract;
use MoonShine\Crud\Contracts\Page\IndexPageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @template TData of Model
 *
 * @extends ModelResource<TData>
 */
abstract class BaseModelResource extends ModelResource
{
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            IndexPageContract::class,
            FormPage::class,
            DetailPageContract::class,
        ];
    }

    /**
     * @return array<string, string[]|string>
     */
    public function validationRules(Model $item): array
    {
        return [];
    }
}
