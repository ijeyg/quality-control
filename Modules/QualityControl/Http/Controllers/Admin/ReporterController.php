<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\QualityControl\Report\Reject\RejectReportGeneratorFactory;
use Modules\QualityControl\Report\Testing\TestingReportGeneratorFactory;
use Modules\QualityControl\Report\Average\AverageReportGeneratorFactory;
use Modules\QualityControl\Report\UnitInception\UnitInceptionReportGeneratorFactory;
use Modules\QualityControl\Services\Report\ReportService;

class ReporterController extends Controller
{
    public function __construct(
        private ReportService $reportService
    )
    {
        //
    }

    public function htmlRejectReport(RejectReportGeneratorFactory $reportGeneratorFactory): Renderable
    {
        $sumFields = ['line_weight', 'run_weight', 'technical_weight', 'accept_weight', 'quality_weight','total'];
        return $this->reportService->htmlGenerateReport($reportGeneratorFactory, 'qualitycontrol::panel.report.rejects', $sumFields);
    }

    public function htmlUnitInspectionReport(UnitInceptionReportGeneratorFactory $reportGeneratorFactory): Renderable
    {
        $sumFields = ['water', 'oil', 'pollution', 'membrane', 'rupture', 'humidity', 'burn', 'wrinkles', 'weight', 'total_of_total'];
        return $this->reportService->htmlGenerateReport($reportGeneratorFactory, 'qualitycontrol::panel.report.unitInspections', $sumFields);
    }

    public function htmlAverageReport(AverageReportGeneratorFactory $reportGeneratorFactory): Renderable
    {
        $sumFields = ['design', 'average'];
        return $this->reportService->htmlGenerateReport($reportGeneratorFactory, 'qualitycontrol::panel.report.averages', $sumFields);
    }

    public function queryTestingReport(TestingReportGeneratorFactory $testingReportGeneratorFactory): Renderable
    {
        $sumFields = [];
        return $this->reportService->queryGenerateReport($testingReportGeneratorFactory, 'qualitycontrol::panel.report.testings', $sumFields);
    }
}
