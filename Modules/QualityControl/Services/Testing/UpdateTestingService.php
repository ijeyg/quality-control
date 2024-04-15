<?php

namespace Modules\QualityControl\Services\Testing;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\DTO\Testing\CreateTestingDto;
use Modules\QualityControl\Repository\Product\ProductRepository;
use Modules\QualityControl\Repository\Testing\TestingRepository;
use Modules\QualityControl\Services\Strategies\PrepareArrayTestingValuesStrategy;

class UpdateTestingService
{
    private mixed $config;

    /**
     * @param MachineInterface $machines
     * @param ProductRepository $products
     * @param TestingRepository $testingRepository
     * @param PrepareArrayTestingValuesStrategy $arrayTestingValuesStrategy
     */
    public function __construct(
        private MachineInterface                  $machines,
        private ProductRepository                 $products,
        private TestingRepository                 $testingRepository,
        private PrepareArrayTestingValuesStrategy $arrayTestingValuesStrategy
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param  $id
     * @param CreateTestingDto $dto
     * @return RedirectResponse
     */
    public function handle(CreateTestingDto $dto, $id): RedirectResponse
    {
        $this->testingRepository->update([
            'code' => $dto->getCode(),
            'morning' => $dto->getMorning(),
            'night' => $dto->getNight(),
            'period' => $dto->getPeriod(),
            'description' => $dto->getDescription(),
            'head' => $dto->getHead(),
            'created_at' => $dto->getCreatedAt(),
        ], $id);
        $this->testingRepository->updateValues($this->arrayTestingValuesStrategy->calculate($dto->toArray()['values']), $id);

        return redirect()->back()->with(['message' => 'با موفقیت بروزرسانی شد.']);
    }

    /**
     * @return array
     */
    public function prepareFormData($id): array
    {
        return [
            'periods' => $this->config['periods'],
            '12_hours_time_work' => $this->config['12_hours_time_work'],
            'type_periods' => $this->config['type_periods'],
            'status_devices' => $this->config['status_devices'],
            'type_devices' => $this->config['type_devices'],
            'shifts' => $this->config['type_periods'],
            'machines' => $this->machines->all(),
            'products' => $this->products->all(),
            'testing' => $this->testingRepository->getById($id)
        ];
    }
}
