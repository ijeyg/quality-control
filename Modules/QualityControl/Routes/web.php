<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;
use Modules\QualityControl\Http\Controllers\Admin\AverageController;
use Modules\QualityControl\Http\Controllers\Admin\DailyController;
use Modules\QualityControl\Http\Controllers\Admin\MachineController;
use Modules\QualityControl\Http\Controllers\Admin\ProductController;
use Modules\QualityControl\Http\Controllers\Admin\RejectController;
use Modules\QualityControl\Http\Controllers\Admin\ReporterController;
use Modules\QualityControl\Http\Controllers\Admin\TestingController;
use Modules\QualityControl\Http\Controllers\Admin\UnitInspectionController;

$local = request()->segment(1);

Route::group(['prefix' => $local . '/qualitycontrol/'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('machines', MachineController::class);
    Route::resource('daily', DailyController::class);
    Route::resource('unitinspection', UnitInspectionController::class);
    Route::resource('reject', RejectController::class);
    Route::resource('testing', TestingController::class);
    Route::resource('average', AverageController::class);
    Route::get('report/reject', [ReporterController::class,'htmlRejectReport'])->name('qualitycontrol.report.reject');
    Route::get('report/unitinspection', [ReporterController::class,'htmlUnitInspectionReport'])->name('qualitycontrol.report.unitinspection');
    Route::get('report/testing', [ReporterController::class,'queryTestingReport'])->name('qualitycontrol.report.testing');
    Route::get('report/average', [ReporterController::class,'htmlAverageReport'])->name('qualitycontrol.report.average');
});
