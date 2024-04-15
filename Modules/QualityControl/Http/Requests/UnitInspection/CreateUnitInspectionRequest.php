<?php

namespace Modules\QualityControl\Http\Requests\UnitInspection;

use Illuminate\Foundation\Http\FormRequest;
use Modules\QualityControl\DTO\UnitInspection\CreateUnitInspectionDto;

class CreateUnitInspectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => "nullable",
            'period' => "nullable",
            'shift' => "nullable",
            'place' => "nullable",
            'head_shift_name' => "nullable",
            'head_noonday' => "nullable",
            'total' => "nullable",
            'created_at' => "nullable",
            'values' => 'nullable|array', // Ensure 'values' is an array

            // Set rules for the individual elements within the 'values' array
            'values.*.product_id' => 'required|numeric',
            'values.*.machine_id' => 'required|numeric',
            'values.*.count' => 'required|numeric',
            'values.*.status_packaging' => 'required',
            'values.*.water' => 'nullable|numeric',
            'values.*.oil' => 'nullable|numeric',
            'values.*.pollution' => 'nullable|numeric',
            'values.*.membrane' => 'nullable|numeric',
            'values.*.rupture' => 'nullable|numeric',
            'values.*.humidity' => 'nullable|numeric',
            'values.*.burn' => 'nullable|numeric',
            'values.*.wrinkles' => 'nullable|numeric',
            'values.*.weight' => 'nullable|numeric',
            'values.*.number' => 'nullable|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return CreateUnitInspectionDto
     */
    public function getDto(): CreateUnitInspectionDto
    {
        return CreateUnitInspectionDto::fromArray($this->validated());
    }

    public function attributes()
    {
        return [
            'code' => 'کد',
            'period' => 'نوبت کاری',
            'shift' => 'شیفت',
            'place' => 'محل بازرسی',
            'head_shift_name' => 'سرپرست شیفت',
            'head_noonday' => 'سرپرست روز کار',
            'total' => 'جمع',
            'values' => 'مقادیر', // Ensure 'values' is an array

            // Set rules for the individual elements within the 'values' array
            'values.*.product_id' => 'محصول',
            'values.*.machine_id' => 'ماشین آلات',
            'values.*.count' => 'تعداد مجاز',
            'values.*.status_packaging' => 'وضعیت بسته بندی',
            'values.*.water' => 'آب',
            'values.*.oil' => 'روغن',
            'values.*.pollution' => 'آلودگی',
            'values.*.membrane' => 'غشاء',
            'values.*.rupture' => 'پارگی',
            'values.*.humidity' => 'رطوبت',
            'values.*.burn' => 'سوختگی',
            'values.*.wrinkles' => 'چروک',
            'values.*.weight' => 'وزن',
            'values.*.number' => 'تعداد محصول',
        ];
    }
}
