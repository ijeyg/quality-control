<?php

namespace Modules\QualityControl\Services\Daily;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Builder\Daily\DailyBuilder;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\DTO\Daily\CreateDailyDto;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;

class CreateDailyService
{
    private mixed $config;

    public function __construct(
        private ?DailyBuilder     $dailyBuilder,
        private ProductRepository $products,
        private MachineRepository $machines
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateDailyDto $dailyDto
     * @return RedirectResponse
     */
    public function handle(CreateDailyDto $dailyDto): RedirectResponse
    {
        $daily = $this->dailyBuilder->setAttributes($dailyDto->toArray())->getResult();
        $daily->save();

        $deliveryWeight = 0;
        $acceptWeight = 0;
        $rejectWeight = 0;
        $boxNumbers = 0;

        foreach ($dailyDto->getValues() as $value) {
            $this->dailyBuilder->addValue($value + ['parent_id' => $daily->id]);
            $rejectWeight += $value['reject_weight'];
            $acceptWeight += $value['accept_weight'];
            $deliveryWeight += $value['delivery_weight'];
            $boxNumbers += $value['box_numbers'];
        }

        $daily->setDeliveryWeight($deliveryWeight);
        $daily->setAcceptWeight($acceptWeight);
        $daily->setRejectWeight($rejectWeight);
        $daily->setBoxNumbers($boxNumbers);
        $daily->save();

        return redirect()->back()->with(['message' => 'با موفقیت ثبت شد.']);
    }


    public function prepareFormData(): array
    {
        return [
            'periods' => $this->config['periods'],
            'shifts' => $this->config['type_periods'],
            'products' => $this->products->all(),
            'machines' => $this->machines->all(),
        ];
    }
}
