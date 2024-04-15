<?php

namespace Modules\QualityControl\Http\Requests\Machine;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\Machine\CreateMachineDto;

class CreateMachineRequest extends FormRequest
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
     * @return CreateMachineDto
     */
    public function getDto(): CreateMachineDto
    {
        return CreateMachineDto::fromArray($this->validated());
    }
}
