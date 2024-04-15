<?php

namespace Modules\QualityControl\Services\Report;

use Illuminate\Contracts\Support\Renderable;
use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;
use Modules\QualityControl\Services\Strategies\DateModifier;
use Modules\QualityControl\Services\Strategies\SumResultStrategy;

class ReportService
{
    public function __construct(
        private ReportManager     $reportManager,
        private MachineRepository $machineRepository,
        private ProductRepository $productRepository,
        private SumResultStrategy $sumResultStrategy,
        private DateModifier      $dateModifier
    )
    {
        //
    }

    public function htmlGenerateReport(
        ReportGeneratorFactoryInterface $reportGeneratorFactory,
        string                          $view,
        array                           $sumFields
    ): Renderable
    {
        $this->dateModifier->modifyDates();
        $this->reportManager->setReportGeneratorFactory($reportGeneratorFactory);
        $reportGenerator = $this->reportManager->generateReport('html');

        $viewData = [
            'reportGenerator' => $reportGenerator,
            'shifts' => config('qualitycontrol.statics.type_periods'),
            'places' => config('qualitycontrol.statics.3_work_places'),
            'machines' => $this->machineRepository->all(),
            'products' => $this->productRepository->all(),
        ];

        foreach ($sumFields as $field) {
            $viewData[$field] = $this->sumResultStrategy->sum($reportGenerator, $field);
        }

        return view($view, $viewData);
    }

    public function queryGenerateReport(
        ReportGeneratorFactoryInterface $reportGeneratorFactory,
        string                          $view,
        array                           $sumFields
    ): Renderable
    {
        $this->dateModifier->modifyDates();
        $this->reportManager->setReportGeneratorFactory($reportGeneratorFactory);
        $reportGenerator = $this->reportManager->generateReport('query');
        $viewData = [
            'reportGenerator' => $reportGenerator,
            'shifts' => config('qualitycontrol.statics.type_periods'),
            'places' => config('qualitycontrol.statics.3_work_places'),
            'machines' => $this->machineRepository->all(),
            'products' => $this->productRepository->all(),
        ];

        return view($view, $viewData);
    }
}
