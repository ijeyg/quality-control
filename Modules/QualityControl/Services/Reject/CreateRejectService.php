<?php

namespace Modules\QualityControl\Services\Reject;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Builder\Reject\RejectBuilder;
use Modules\QualityControl\DTO\Reject\CreateRejectDto;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;

class CreateRejectService
{
    private mixed $config;

    /**
     * @param RejectBuilder|null $rejectBuilder
     * @param ProductRepository $products
     * @param MachineRepository $machines
     */
    public function __construct(
        private ?RejectBuilder    $rejectBuilder,
        private ProductRepository $products,
        private MachineRepository $machines
    )
    {
        $this->config = config('qualitycontrol.statics');
    }

    /**
     * @param CreateRejectDto $createRejectDto
     * @return RedirectResponse
     */
    public function handle(CreateRejectDto $createRejectDto): RedirectResponse
    {
        $rejectBuilder = $this->rejectBuilder->setAttributes($createRejectDto->toArray())->getResult();
        $rejectBuilder->save();

        $run_weight = $technical_weight = $quality_weight = $accept_weight = $line_weight = $total = 0;

        foreach ($createRejectDto->getValues() as $value) {
            $valueBuilder = $this->rejectBuilder->addValue($value + ['parent_id' => $rejectBuilder->id]);
            $run_weight += $value['run_weight'];
            $technical_weight += $value['technical_weight'];
            $quality_weight += $value['quality_weight'];
            $accept_weight += $value['accept_weight'];
            $line_weight += $value['line_weight'];
            $total += $valueBuilder['total'];
        }

        $rejectBuilder->setRunWeight($run_weight);
        $rejectBuilder->setTechnicalWeight($technical_weight);
        $rejectBuilder->setQualityWeight($quality_weight);
        $rejectBuilder->setLineWeight($line_weight);
        $rejectBuilder->setAcceptWeight($accept_weight);
        $rejectBuilder->setTotal($total);
        $rejectBuilder->save();

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
