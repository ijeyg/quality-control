<?php

namespace Modules\QualityControl\Report\Reject;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Contracts\Factories\ReportGeneratorInterface;
use Modules\QualityControl\Report\UnitInception\HtmlAverageReportGenerator;
use Modules\QualityControl\Repository\Reject\RejectRepository;
use Modules\QualityControl\Services\Strategies\DateModifier;
use Modules\QualityControl\Services\Strategies\EndDateModificationStrategy;
use Modules\QualityControl\Services\Strategies\StartDateModificationStrategy;

class RejectReportGeneratorFactory extends ReportGeneratorFactoryInterface
{

    /**
     * @param RejectRepository $rejectRepository
     */
    public function __construct(private RejectRepository $rejectRepository)
    {
        //
    }

    /**
     * @param $generatorType
     * @param $query
     * @return mixed
     */
    protected function makeReportGenerator($generatorType, $query): mixed
    {
        return match ($generatorType) {
            'html' => (new HtmlRejectReportGenerator())->generateReport($query),
            default => throw new \InvalidArgumentException("Invalid generator"),
        };
    }

    protected function getQuery()
    {
        return $this->rejectRepository->getQuery()
            ->when(request()->filled('start_date'), function ($q) {
                $q->whereDate('created_at', '>=', request()->input('start_date'));
            })->when(request()->filled('end_date'), function ($q) {
                $q->whereDate('created_at', '<=', request()->input('end_date'));
            })->when(request()->filled('shift'), function ($q) {
                $q->where('shift', '=', request()->input('shift'));
            })->when(request()->filled('product'), function ($q) {
                $q->whereHas('values', function ($subQuery) {
                    $subQuery->where('product_id', '=', request()->input('product'));
                });
            })->when(request()->filled('machine'), function ($q) {
                $q->whereHas('values', function ($subQuery) {
                    $subQuery->where('machine_id', '=', request()->input('machine'));
                });
            })->with('values')->orderByDesc('created_at');
    }
}
