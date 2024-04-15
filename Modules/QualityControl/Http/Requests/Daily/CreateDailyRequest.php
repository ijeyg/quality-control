<?php

namespace Modules\QualityControl\Http\Requests\Daily;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\Daily\CreateDailyDto;

class CreateDailyRequest extends FormRequest
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
            'delivery_weight' => "nullable",
            'accept_weight' => "nullable",
            'reject_weight' => "nullable",
            'head_shift_name' => "nullable",
            'created_at' => "nullable",
            'head_noonday' => "nullable",
            'values' => 'nullable|array', // Ensure 'values' is an array

            // Set rules for the individual elements within the 'values' array
            'values.*.product_id' => 'nullable|numeric',
            'values.*.machine_id' => 'nullable|numeric',
            'values.*.box_numbers' => 'nullable|numeric',
            'values.*.accept_weight' => 'nullable|numeric',
            'values.*.delivery_weight' => 'nullable|numeric',
            'values.*.reject_weight' => 'nullable|numeric',
            'values.*.description' => 'nullable',
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
     * @return CreateDailyDto
     */
    public function getDto(): CreateDailyDto
    {
        return CreateDailyDto::fromArray($this->validated());
    }

    public function attributes()
    {
        return [
            'code' => "کد",
            'period' => "نوبت کاری",
            'shift' => "شیفت",
            'delivery_weight' => "وزن تحویلی",
            'accept_weight' => "وزن اکسپت",
            'reject_weight' => "وزن ریجکت",
            'created_at' => "تاریخ ثبت",
            'head_shift_name' => "سرپرست شیفت کنترل کیفی",
            'head_noonday' => "سرپرست روز کار کنترل کیفی",
            'values' => '', // Ensure 'values' is an array

            // Set rules for the individual elements within the 'values' array
            'values.*.product_id' => 'محصول',
            'values.*.machine_id' => 'ماشین آلات',
            'values.*.box_numbers' => 'تعداد باکس',
            'values.*.accept_weight' => 'وزن اکسپت',
            'values.*.delivery_weight' => 'وزن تحویلی',
            'values.*.reject_weight' => 'وزن ریجکت',
            'values.*.description' => 'توضیحات',
        ];
    }
}
