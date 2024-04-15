<?php

namespace Modules\QualityControl\Report\UnitInception;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Repository\UnitInspection\UnitInspectionRepository;

class UnitInceptionReportGeneratorFactory extends ReportGeneratorFactoryInterface
{
    /**
     * @param UnitInspectionRepository $unitInspectionRepository
     */
    public function __construct(private UnitInspectionRepository $unitInspectionRepository)
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
            'html' => (new HtmlUnitInceptionReportGenerator())->generateReport($query),
            default => throw new \InvalidArgumentException("Invalid generator"),
        };
    }

    protected function getQuery()
    {
        return $this->unitInspectionRepository->getQuery()
            ->when(request()->filled('start_date'), function ($q) {
                $q->whereDate('created_at', '>=', request()->input('start_date'));
            })->when(request()->filled('end_date'), function ($q) {
                $q->whereDate('created_at', '<=', request()->input('end_date'));
            })->when(request()->filled('shift'), function ($q) {
                $q->where('shift', '=', request()->input('shift'));
            })->when(request()->filled('place'), function ($q) {
                $q->where('place', '=', request()->input('place'));
            })->when(request()->filled('product'), function ($q) {
                $q->whereHas('values', function ($subQuery) {
                    $subQuery->where('product_id', '=', request()->input('product'));
                });
            })->with('values')->orderByDesc('created_at');
    }
}
