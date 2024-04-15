<?php

namespace Modules\QualityControl\Report\Reject;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorInterface;

class HtmlRejectReportGenerator implements ReportGeneratorInterface
{
    public function generateReport($data)
    {
        $result = $data->get()->toArray();
        if (!request()->product) {
            return $result;
        } else {
            $exportData = [];


            foreach ($result as $record) {
                $exportRow = $record;

                // Check if 'values' array is not empty
                if (!empty($record['values'])) {
                    // Assuming there is only one 'values' record per 'unitInspection'
                    $values = collect($record['values']);
                    if (request()->product)
                        $values = $values->where('product_id',request()->product);
                    if (request()->machine)
                        $values = $values->where('machine_id',request()->machine);

                    foreach ($values as $value){
                        // Merge the 'values' array into the export row
                        $exportRow = array_merge($exportRow, [
                            'line_weight' => $value['line_weight'],
                            'run_weight' => $value['run_weight'],
                            'technical_weight' => $value['technical_weight'],
                            'accept_weight' => $value['accept_weight'],
                            'quality_weight' => $value['quality_weight']
                        ]);
                    }
                }

                // Remove the 'values' key from the export row
                unset($exportRow['values']);

                // Add the export row to the export data array
                $exportData[] = $exportRow;
            }

            return $exportData;
        }
    }
}
