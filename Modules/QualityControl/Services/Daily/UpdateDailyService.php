<?php

namespace Modules\QualityControl\Services\Daily;


use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\DTO\Daily\CreateDailyDto;
use Modules\QualityControl\Entities\Daily;
use Modules\QualityControl\Observers\Daily\DailyObserver;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;

class UpdateDailyService
{
    private mixed $config;

    /**
     * @param DailyInterface $dailyInterface
     * @param ProductRepository $products
     * @param MachineRepository $machines
     */
    public function __construct(
        private DailyInterface    $dailyInterface,
        private ProductRepository $products,
        private MachineRepository $machines

    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateDailyDto $dailyDto
     * @param Daily $daily
     * @return RedirectResponse
     */
    public function handle(CreateDailyDto $dailyDto, Daily $daily): RedirectResponse
    {
        // Update main attributes
        $this->dailyInterface->update([
            'code' => $dailyDto->getCode(),
            'shift' => $dailyDto->getShift(),
            'period' => $dailyDto->getPeriod(),
            'head_shift_name' => $dailyDto->getHeadShift(),
            'head_noonday' => $dailyDto->getHeadNoonday(),
            'created_at' => $dailyDto->getCreatedAt(),
        ], $daily['id']);

        // Update values
        $this->dailyInterface->updateValues($dailyDto->getValues(), $daily['id']);

        // Calculate weights
        $deliveryWeight = $acceptWeight = $rejectWeight = $boxNumbers = 0;
        foreach ($daily->values as $value) {
            $rejectWeight += $value['reject_weight'];
            $acceptWeight += $value['accept_weight'];
            $deliveryWeight += $value['delivery_weight'];
            $boxNumbers += $value['box_numbers'];
        }

        // Update weights in the Daily model
        $daily->update([
            'reject_weight' => $rejectWeight,
            'accept_weight' => $acceptWeight,
            'delivery_weight' => $deliveryWeight,
            'box_numbers' => $boxNumbers,
        ]);
        return redirect()->back()->with(['message' => 'ماشین آلات با موفقیت بروزرسانی شد']);
    }

    /**
     * @param Daily $daily
     * @return mixed
     */
    public function prepareFormData(Daily $daily): array
    {
        return [
            'periods' => $this->config['periods'],
            'shifts' => $this->config['type_periods'],
            'products' => $this->products->all(),
            'machines' => $this->machines->all(),
            'daily' => $this->dailyInterface->getById($daily['id']),
        ];
    }
}
