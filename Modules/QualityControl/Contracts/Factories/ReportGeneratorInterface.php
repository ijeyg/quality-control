<?php

namespace Modules\QualityControl\Contracts\Factories;

interface ReportGeneratorInterface
{
    public function generateReport($data);
}
