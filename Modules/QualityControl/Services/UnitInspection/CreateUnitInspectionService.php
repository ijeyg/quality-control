<?php

namespace Modules\QualityControl\Services\UnitInspection;


use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Builder\UnitInspection\UnitInspectionBuilder;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\DTO\UnitInspection\CreateUnitInspectionDto;
use Modules\QualityControl\Repository\Machine\MachineRepository;

class CreateUnitInspectionService
{
    private mixed $config;

    /**
     * @param null|UnitInspectionBuilder $unitInspectionBuilder
     * @param ProductInterface $product
     * @param MachineRepository $machines
     */
    public function __construct(
        private ?UnitInspectionBuilder $unitInspectionBuilder,
        private ProductInterface       $product,
        private MachineRepository       $machines,
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateUnitInspectionDto $createUnitInspectionDto
     * @return RedirectResponse
     */
    public function handle(CreateUnitInspectionDto $createUnitInspectionDto): RedirectResponse
    {
        $unitInspection = $this->unitInspectionBuilder->setAttributes($createUnitInspectionDto->toArray())->getResult();
        $unitInspection->save();

        $water = $oil = $pollution = $membrane = $rupture = $humidity = $burn = $wrinkles = $weight = $number = $total = 0;

        foreach ($createUnitInspectionDto->getValues() as $value) {
            $valueBuilder = $this->unitInspectionBuilder->addValue($value + ['parent_id' => $unitInspection['id']]);
            $water += $value['water'];
            $oil += $value['oil'];
            $pollution += $value['pollution'];
            $membrane += $value['membrane'];
            $rupture += $value['rupture'];
            $humidity += $value['humidity'];
            $burn += $value['burn'];
            $wrinkles += $value['wrinkles'];
            $weight += $value['weight'];
            $total += $valueBuilder['total'];
        }

        $this->unitInspectionBuilder->setWater($water);
        $this->unitInspectionBuilder->setOil($oil);
        $this->unitInspectionBuilder->setPollution($pollution);
        $this->unitInspectionBuilder->setMembrane($membrane);
        $this->unitInspectionBuilder->setRupture($rupture);
        $this->unitInspectionBuilder->setHumidity($humidity);
        $this->unitInspectionBuilder->setBurn($burn);
        $this->unitInspectionBuilder->setWrinkles($wrinkles);
        $this->unitInspectionBuilder->setWeight($weight);
        $this->unitInspectionBuilder->setTotalOfTotal($total);
        $unitInspection = $this->unitInspectionBuilder->getResult();
        $unitInspection->save();

        return redirect()->back()->with(['message' => 'با موفقیت ثبت شد.']);
    }


    /**
     * @return array
     */
    public function prepareFormData(): array
    {
        return [
            'periods' => $this->config['periods'],
            'shifts' => $this->config['type_periods'],
            'places' => $this->config['3_work_places'],
            'statuses' => $this->config['status_packaging'],
            'products' => $this->product->all(),
            'machines' => $this->machines->all(),
        ];
    }
}
