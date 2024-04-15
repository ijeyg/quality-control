<?php

namespace Modules\QualityControl\Http\Requests\Testing;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\Daily\CreateDailyDto;
use Modules\QualityControl\DTO\Reject\CreateRejectDto;
use Modules\QualityControl\DTO\Testing\CreateTestingDto;

class CreateTestingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => "nullable",
            'morning' => "nullable",
            'night' => "nullable",
            'period' => "nullable",
            'description' => "nullable",
            'head' => "nullable",
            'created_at' => "nullable",
            'values' => 'nullable|array', // Ensure 'values' is an array

//            // Set rules for the individual elements within the 'values' array
//            'values.*.parent_id' => 'required|numeric',
//            'values.*.machine_id' => 'required|numeric',
//            'values.*.hour_time_work' => 'required|numeric',
//            'values.*.time' => 'required|string',
//            'values.*.water' => 'required|numeric',
//            'values.*.oil' => 'required|numeric',
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
     * @return CreateTestingDto
     */
    public function getDto(): CreateTestingDto
    {
        return CreateTestingDto::fromArray($this->validated());
    }

    public function attributes()
    {
        return [
            'code' => "کد",
            'morning' => "شیفت صبح کار",
            'night' => "شیفت شب کار",
            'period' => "نوبت کاری",
            'description' => "توصیحات",
            'head' => "سرپرست",
            'values' => 'مقادیر', // Ensure 'values' is an array
        ];
    }


}
