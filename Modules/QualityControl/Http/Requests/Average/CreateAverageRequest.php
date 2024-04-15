<?php

namespace Modules\QualityControl\Http\Requests\Average;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\Average\CreateAverageDto;
use Modules\QualityControl\DTO\Daily\CreateDailyDto;
use Modules\QualityControl\DTO\Reject\CreateRejectDto;
use Modules\QualityControl\DTO\Testing\CreateTestingDto;

class CreateAverageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'period' => "nullable",
            'shift' => "nullable",
            'time' => "nullable",
            'created_at' => "nullable",
            'values' => 'nullable|array',

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
     * @return CreateAverageDto
     */
    public function getDto(): CreateAverageDto
    {
        return CreateAverageDto::fromArray($this->validated());
    }

    public function attributes()
    {
        return [
            'period' => "نوبت کاری",
            'shift' => "شیفت ",
            'time' => "ساعت",
            'created_at' => "تاریخ",
            'values' => 'مقادیر', // Ensure 'values' is an array
        ];
    }


}
