<?php

namespace Modules\QualityControl\Services\Report;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Contracts\Factories\ReportGeneratorInterface;

class ReportManager
{
    private ReportGeneratorFactoryInterface $reportGeneratorFactory;

    /**
     * @param ReportGeneratorFactoryInterface $factory
     * @return void
     */
    public function setReportGeneratorFactory(ReportGeneratorFactoryInterface $factory): void
    {
        $this->reportGeneratorFactory = $factory;
    }

    /**
     * @param $format
     */
    public function generateReport($format)
    {
        return $this->reportGeneratorFactory->createReportGenerator($format);
    }
}
