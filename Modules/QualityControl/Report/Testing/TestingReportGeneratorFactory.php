<?php

namespace Modules\QualityControl\Report\Testing;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Entities\TestingValue;
use Modules\QualityControl\Repository\Testing\TestingRepository;

class TestingReportGeneratorFactory extends ReportGeneratorFactoryInterface
{
    /**
     * @param TestingRepository $testingRepository
     */
    public function __construct(private TestingRepository $testingRepository)
    {
    }

    protected function makeReportGenerator($generatorType, $query)
    {
        return match ($generatorType) {
            'query' => (new QueryTestingReportGenerator())->generateReport($query),
            default => throw new \InvalidArgumentException("Invalid generator"),
        };
    }

    protected function getQuery()
    {
        $id = $this->testingRepository->getQuery()
            ->when(request()->filled('start_date'), function ($q) {
                $q->whereDate('quality_control_testings.created_at', '=', request()->input('start_date'));
            })
            ->when(request()->filled('shift'), function ($q) {
                $q->where('quality_control_testings.night', '=', request()->input('shift'));
            })->first();

        if($id){
            return TestingValue::query()
                ->where('parent_id','=',$id['id'])
                ->where('product_id','=',request()->input('product'))
                ->where('machine_id','=',request()->input('machine'))
                ->orderByRaw("TIME_FORMAT(time, '%H:%i') ASC")->get()->toArray();
        }else{
            return ;
        }
    }
}
