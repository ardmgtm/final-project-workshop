<?php

namespace App\Domains\Products\Requests;

class StoreCategoryRequest extends ApiFormRequest
{
    public function getName(): string
    {
        return $this->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:categories,name',
        ];
    }
}
