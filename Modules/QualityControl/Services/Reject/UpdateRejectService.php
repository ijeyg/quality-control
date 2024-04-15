<?php

namespace Modules\QualityControl\Services\Reject;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Contracts\Reject\RejectInterface;
use Modules\QualityControl\DTO\Reject\CreateRejectDto;
use Modules\QualityControl\Repository\Machine\MachineRepository;

class UpdateRejectService
{
    /**
     * @var mixed|Repository|Application
     */
    private mixed $config;

    /**
     * @param RejectInterface $rejectRepository
     * @param ProductInterface $products
     * @param MachineRepository $machines
     */
    public function __construct(
        private RejectInterface   $rejectRepository,
        private ProductInterface  $products,
        private MachineRepository $machines
    )
    {
        $this->config = config('qualitycontrol.statics');

    }

    /**
     * @param CreateRejectDto $createRejectDto
     * @param $id
     * @return RedirectResponse
     */
    public function handle(CreateRejectDto $createRejectDto, $id): RedirectResponse
    {
        $this->rejectRepository->update([
            'code' => $createRejectDto->getCode(),
            'shift' => $createRejectDto->getShift(),
            'period' => $createRejectDto->getPeriod(),
            'head_shift_name' => $createRejectDto->getHeadShiftName(),
            'head_noonday' => $createRejectDto->getHeadNoonday(),
            'created_at' => $createRejectDto->getCreatedAt(),
        ], $id);
        $this->rejectRepository->updateValues($createRejectDto->getValues(), $id);
        $run_weight = $accept_weight = $technical_weight = $quality_weight = $line_weight = $total = 0;
        foreach ($this->rejectRepository->getById($id)->values as $value) {
            $run_weight += $value['run_weight'];
            $technical_weight += $value['technical_weight'];
            $quality_weight += $value['quality_weight'];
            $accept_weight += $value['accept_weight'];
            $line_weight += $value['line_weight'];
            $total += $value['total'];
        }
        $this->rejectRepository->update([
            'run_weight' => $run_weight,
            'technical_weight' => $technical_weight,
            'quality_weight' => $quality_weight,
            'accept_weight' => $accept_weight,
            'line_weight' => $line_weight,
            'total' => $total,
        ], $id);

        return redirect()->back()->with(['message' => 'با موفقیت بروزرسانی شد.']);
    }

    /**
     * @param $id
     * @return array
     */
    public function prepareFormData($id): array
    {
        return [
            'periods' => $this->config['periods'],
            'shifts' => $this->config['type_periods'],
            'products' => $this->products->all(),
            'machines' => $this->machines->all(),
            'reject' => $this->rejectRepository->getById($id)
        ];
    }
}
