<?php

namespace Modules\QualityControl\Report\Average;

use Modules\QualityControl\Contracts\Factories\ReportGeneratorInterface;

class HtmlAverageReportGenerator implements ReportGeneratorInterface
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

                    foreach ($values as $value) {
                        // Merge the 'values' array into the export row
                        $exportRow = array_merge($exportRow, [
                            'design' => $value['design'],
                            'average' => $value['average'],
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
