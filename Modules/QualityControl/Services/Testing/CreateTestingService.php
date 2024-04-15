<?php

namespace Modules\QualityControl\Services\Testing;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Builder\Testing\TestingBuilder;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\DTO\Testing\CreateTestingDto;
use Modules\QualityControl\Repository\Product\ProductRepository;
use Modules\QualityControl\Services\Strategies\PrepareArrayTestingValuesStrategy;

class CreateTestingService
{
    private mixed $config;

    /**
     * @param MachineInterface $machines
     * @param ProductRepository $products
     * @param TestingBuilder $testingBuilder
     * @param PrepareArrayTestingValuesStrategy $arrayTestingValuesStrategy
     */
    public function __construct(
        private MachineInterface                  $machines,
        private ProductRepository                 $products,
        private TestingBuilder                    $testingBuilder,
        private PrepareArrayTestingValuesStrategy $arrayTestingValuesStrategy
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateTestingDto $dto
     * @return RedirectResponse
     */
    public function handle(CreateTestingDto $dto): RedirectResponse
    {
        $testing = $this->testingBuilder->setAttributes($dto->toArray())->getResult();
        $testing->save();
        foreach ($this->arrayTestingValuesStrategy->calculate($dto->toArray()['values']) as $newValue) {
            $this->testingBuilder->addValue($newValue + ['parent_id' => $testing['id']]);
        }
        return redirect()->back()->with(['message' => 'با موفقیت ثبت شد.']);
    }

    /**
     * @return array
     */
    public function prepareFormData(): array
    {
        return [
            'periods' => $this->config['periods'],
            '12_hours_time_work' => $this->config['12_hours_time_work'],
            'type_periods' => $this->config['type_periods'],
            'status_devices' => $this->config['status_devices'],
            'shifts' => $this->config['type_periods'],
            'type_devices' => $this->config['type_devices'],
            'machines' => $this->machines->all(),
            'products' => $this->products->all()
        ];
    }
}
