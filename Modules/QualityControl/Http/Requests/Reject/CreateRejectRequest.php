<?php

namespace Modules\QualityControl\Http\Requests\Reject;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\Daily\CreateDailyDto;
use Modules\QualityControl\DTO\Reject\CreateRejectDto;

class CreateRejectRequest extends FormRequest
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
            'period' => "nullable",
            'shift' => "nullable",
            'head_shift_name' => "nullable",
            'head_noonday' => "nullable",
            'created_at' => "nullable",
            'values' => 'nullable|array', // Ensure 'values' is an array

            // Set rules for the individual elements within the 'values' array
            'values.*.product_id' => 'nullable|numeric',
            'values.*.machine_id' => 'nullable|numeric',
            'values.*.line_weight' => 'nullable|numeric',
            'values.*.run_weight' => 'nullable|numeric',
            'values.*.accept_weight' => 'nullable|numeric',
            'values.*.technical_weight' => 'nullable|numeric',
            'values.*.quality_weight' => 'nullable|numeric',
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
     * @return CreateRejectDto
     */
    public function getDto(): CreateRejectDto
    {
        return CreateRejectDto::fromArray($this->validated());
    }

    public function attributes()
    {
        return [
            'code' => "کد",
            'period' => "نوبت کاری",
            'shift' => "شیفت",
            'head_shift_name' => "سرپرست شیفت",
            'head_noonday' => "سرپرست روز کار",
            'values' => 'مقادیر', // Ensure 'values' is an array

            // Set rules for the individual elements within the 'values' array
            'values.*.product_id' => 'محصول',
            'values.*.machine_id' => 'ماشین آلات',
            'values.*.line_weight' => 'وزن خط',
            'values.*.run_weight' => 'وزن راه اندازی',
            'values.*.accept_weight' => 'وزن راه اندازی',
            'values.*.technical_weight' => 'وزن فنی ',
            'values.*.quality_weight' => 'وزن کیفی',
        ];
    }
}
