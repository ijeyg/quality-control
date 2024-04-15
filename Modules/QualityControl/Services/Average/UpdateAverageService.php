<?php

namespace Modules\QualityControl\Services\Average;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Builder\Average\AverageBuilder;
use Modules\QualityControl\DTO\Average\CreateAverageDto;
use Modules\QualityControl\Entities\Average;
use Modules\QualityControl\Repository\Average\AverageRepository;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;

class UpdateAverageService
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
        private AverageRepository $averageRepository
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateAverageDto $createAverageDto
     * @return RedirectResponse
     */
    public function handle(CreateAverageDto $createAverageDto, $id): RedirectResponse
    {
        $this->averageRepository->update([
            'period' => $createAverageDto->getPeriod(),
            'shift' => $createAverageDto->getShift(),
            'time' => $createAverageDto->getTime(),
            'created_at' => $createAverageDto->getCreatedAt()
        ], $id);
        $this->averageRepository->updateValues($createAverageDto->getValues(), $id);
        $design = $average = 0;
        foreach ($this->averageRepository->getById($id)->values as $value) {
            $design += $value['design'];
            $average += $value['average'];
        }
        $this->averageRepository->update([
            'design' => $design,
            'average' => $average
        ], $id);
        return redirect()->back()->with(['message' => 'با موفقیت بروزرسانی شد.']);
    }


    /**
     * @return array
     */
    public function prepareFormData(Average $average): array
    {
        return [
            'periods' => $this->config['periods'],
            'type_periods' => $this->config['type_periods'],
            'shifts' => $this->config['type_periods'],
            'machines' => $this->machineRepository->all(),
            'products' => $this->productRepository->all(),
            'average' => $this->averageRepository->getById($average['id'])
        ];
    }

}
