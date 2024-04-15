<?php

namespace Modules\QualityControl\Tests\Feature\Product;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Modules\QualityControl\Http\Controllers\Admin\DailyController;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            'code' => "adsasd",
            'period' => 1,
            'shift' => 1,
            'delivery_weight' => 1,
            'accept_weight' => 1,
            'reject_weight' => 1,
            'head_shift_name' => "adasd",
            'head_noonday' => "adasd",
            'values' => [
                'delivery_weight' => 1,
                'accept_weight' => 1,
                'reject_weight' => 1,
                'product_id' => 1
            ]
        ];
    }
}
