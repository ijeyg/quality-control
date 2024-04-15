<?php

namespace Modules\QualityControl\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\Product\CreateProductDto;

class CreateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:191',
            'weight' => 'nullable',
            'description' => 'nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return CreateProductDto
     */
    public function getDto(): CreateProductDto
    {
        return CreateProductDto::fromArray($this->validated());
    }
}
