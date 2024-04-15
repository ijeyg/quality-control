<?php

namespace Modules\QualityControl\Report\Testing;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorInterface;

class QueryTestingReportGenerator implements ReportGeneratorInterface
{

    public function generateReport($data)
    {
        return $data;
    }
}
