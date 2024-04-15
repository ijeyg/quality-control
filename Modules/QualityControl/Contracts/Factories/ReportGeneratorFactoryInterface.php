<?php

namespace Modules\QualityControl\Contracts\Factories;

use Modules\QualityControl\Report\UnitInception\HtmlAverageReportGenerator;

abstract class ReportGeneratorFactoryInterface
{
    /**
     * @param $format
     */
    public function createReportGenerator($format)
    {
        $preferredGenerator = $this->getPreferredGenerator($format);

        return $this->makeReportGenerator($preferredGenerator, $this->getQuery());
    }

    /**
     * @param $generatorType
     * @param $query
     */
    abstract protected function makeReportGenerator($generatorType, $query);
    /**
     * @param $format
     * @return string
     */
    protected function getPreferredGenerator($format): string
    {
        return $format ?? 'html';
    }

    abstract protected function getQuery();

}
