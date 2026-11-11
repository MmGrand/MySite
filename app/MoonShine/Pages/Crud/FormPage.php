<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Crud;

use App\MoonShine\Resources\BaseModelResource;
use LogicException;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage as MoonShineFormPage;

class FormPage extends MoonShineFormPage
{
    protected function rules(DataWrapperContract $item): array
    {
        $resource = $this->getResource();

        if (! $resource instanceof BaseModelResource) {
            throw new LogicException('MoonShine form page requires a BaseModelResource.');
        }

        return $resource->validationRules($item->getOriginal());
    }
}
