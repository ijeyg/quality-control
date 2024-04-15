<?php

namespace Modules\QualityControl\Report\Average;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Report\Average\HtmlAverageReportGenerator;
use Modules\QualityControl\Repository\Average\AverageRepository;

class AverageReportGeneratorFactory extends ReportGeneratorFactoryInterface
{
    /**
     * @param AverageRepository $averageRepository
     */
    public function __construct(private AverageRepository $averageRepository)
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
            'html' => (new HtmlAverageReportGenerator())->generateReport($query),
            default => throw new \InvalidArgumentException("Invalid generator"),
        };
    }

    protected function getQuery()
    {
        return $this->averageRepository->getQuery()
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
            })->when(request()->filled('machine'), function ($q) {
                $q->whereHas('values', function ($subQuery) {
                    $subQuery->where('machine_id', '=', request()->input('machine'));
                });
            })->with('values')->orderByDesc('created_at');
    }
}
