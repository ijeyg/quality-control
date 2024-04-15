<?php

namespace Modules\QualityControl\Services\Average;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Builder\Average\AverageBuilder;
use Modules\QualityControl\DTO\Average\CreateAverageDto;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;

class CreateAverageService
{
    private mixed $config;

    /**
     * @param MachineRepository $machineRepository
     * @param ProductRepository $productRepository
     * @param AverageBuilder $averageBuilder
     */
    public function __construct(
        private MachineRepository $machineRepository,
        private ProductRepository $productRepository,
        private AverageBuilder    $averageBuilder
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateAverageDto $createAverageDto
     * @return RedirectResponse
     */
    public function handle(CreateAverageDto $createAverageDto): RedirectResponse
    {
        $averageBuild = $this->averageBuilder->setAttributes($createAverageDto->toArray())->getResult();
        $averageBuild->save();
        $design = $average = 0;
        foreach ($createAverageDto->toArray()['values'] as $value) {
            $this->averageBuilder->addValue($value + ['parent_id' => $averageBuild['id']]);
            $design += $value['design'];
            $average += $value['average'];
        }
        $averageBuild->setAverage($average);
        $averageBuild->setDesign($design);
        $averageBuild->save();
        return redirect()->back()->with(['message' => 'با موفقیت ثبت شد.']);
    }


    /**
     * @return array
     */
    public function prepareFormData(): array
    {
        return [
            'periods' => $this->config['periods'],
            'type_periods' => $this->config['type_periods'],
            'shifts' => $this->config['type_periods'],
            'machines' => $this->machineRepository->all(),
            'products' => $this->productRepository->all()
        ];
    }

}
