<?php

namespace Modules\QualityControl\Services\UnitInspection;


use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Contracts\UnitInspection\UnitInspectionInterface;
use Modules\QualityControl\DTO\UnitInspection\CreateUnitInspectionDto;
use Modules\QualityControl\Entities\UnitInspection;
use Modules\QualityControl\Repository\Machine\MachineRepository;

class UpdateUnitInspectionService
{
    private mixed $config;

    /**
     * @param null|UnitInspectionInterface $unitInspectionInterface
     * @param ProductInterface $product
     * @param MachineRepository $machines
     */
    public function __construct(
        private ?UnitInspectionInterface $unitInspectionInterface,
        private ProductInterface         $product,
        private MachineRepository        $machines
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateUnitInspectionDto $createUnitInspectionDto
     * @param  $id
     * @return RedirectResponse
     */
    public function handle(CreateUnitInspectionDto $createUnitInspectionDto, $id): RedirectResponse
    {
        $this->unitInspectionInterface->update([
            'code' => $createUnitInspectionDto->getCode(),
            'shift' => $createUnitInspectionDto->getShift(),
            'period' => $createUnitInspectionDto->getPeriod(),
            'place' => $createUnitInspectionDto->getPlace(),
            'head_shift_name' => $createUnitInspectionDto->getHeadShiftName(),
            'head_noonday' => $createUnitInspectionDto->getHeadNoonday(),
            'created_at' => $createUnitInspectionDto->getCreatedAt(),
        ], $id);
        $this->unitInspectionInterface->updateValues($createUnitInspectionDto->getValues(), $id);
        $water = $oil = $pollution = $membrane = $rupture = $humidity = $burn = $wrinkles = $weight = $number = $total = 0;
        foreach ($this->unitInspectionInterface->getById($id)->values as $value) {
            $water += $value['water'];
            $oil += $value['oil'];
            $pollution += $value['pollution'];
            $membrane += $value['membrane'];
            $rupture += $value['rupture'];
            $humidity += $value['humidity'];
            $burn += $value['burn'];
            $wrinkles += $value['wrinkles'];
            $weight += $value['weight'];
            $total += $value['total'];
        }
        $this->unitInspectionInterface->update([
            'water' => $water,
            'oil' => $oil,
            'pollution' => $pollution,
            'membrane' => $membrane,
            'rupture' => $rupture,
            'humidity' => $humidity,
            'burn' => $burn,
            'wrinkles' => $wrinkles,
            'weight' => $weight,
            'total_of_total' => $total,
        ], $id);
        return redirect()->back()->with(['message' => 'با موفقیت بروزرسانی شد.']);
    }


    /**
     * @param $unitInspection
     * @return array
     */
    public function prepareFormData($unitInspection): array
    {
        return [
            'periods' => $this->config['periods'],
            'shifts' => $this->config['type_periods'],
            'places' => $this->config['3_work_places'],
            'statuses' => $this->config['status_packaging'],
            'products' => $this->product->all(),
            'machines' => $this->machines->all(),
            'unitInspection' => $this->unitInspectionInterface->getById($unitInspection),
        ];
    }
}
