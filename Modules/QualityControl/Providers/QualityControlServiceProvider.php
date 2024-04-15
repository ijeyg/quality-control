<?php

namespace Modules\QualityControl\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\QualityControl\Builder\Average\AverageBuilder;
use Modules\QualityControl\Builder\Daily\DailyBuilder;
use Modules\QualityControl\Builder\Daily\DailyValueBuilder;
use Modules\QualityControl\Builder\Reject\RejectBuilder;
use Modules\QualityControl\Builder\Reject\RejectValueBuilder;
use Modules\QualityControl\Builder\Testing\TestingBuilder;
use Modules\QualityControl\Builder\Testing\TestingValueBuilder;
use Modules\QualityControl\Contracts\Average\AverageInterface;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Contracts\Factories\ReportGeneratorFactoryInterface;
use Modules\QualityControl\Contracts\Factories\ReportGeneratorInterface;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Contracts\Reject\RejectInterface;
use Modules\QualityControl\Contracts\Strategies\CalculationStrategyInterface;
use Modules\QualityControl\Contracts\Strategies\DateModificationStrategyInterface;
use Modules\QualityControl\Contracts\Strategies\SumResultStrategyInterface;
use Modules\QualityControl\Contracts\Testing\TestingInterface;
use Modules\QualityControl\Contracts\UnitInspection\UnitInspectionInterface;
use Modules\QualityControl\Report\Reject\HtmlRejectReportGenerator;
use Modules\QualityControl\Report\Reject\RejectReportGeneratorFactory;
use Modules\QualityControl\Report\Testing\QueryTestingReportGenerator;
use Modules\QualityControl\Report\Testing\TestingReportGeneratorFactory;
use Modules\QualityControl\Repository\Average\AverageRepository;
use Modules\QualityControl\Repository\Daily\DailyRepository;
use Modules\QualityControl\Repository\Machine\MachineRepository;
use Modules\QualityControl\Repository\Product\ProductRepository;
use Modules\QualityControl\Repository\Reject\RejectRepository;
use Modules\QualityControl\Repository\Testing\TestingRepository;
use Modules\QualityControl\Repository\UnitInspection\UnitInspectionRepository;
use Modules\QualityControl\Services\Strategies\EndDateModificationStrategy;
use Modules\QualityControl\Services\Strategies\PrepareArrayTestingValuesStrategy;
use Modules\QualityControl\Services\Strategies\StartDateModificationStrategy;
use Modules\QualityControl\Services\Strategies\SumCalculationStrategy;
use Modules\QualityControl\Services\Strategies\SumResultStrategy;

class QualityControlServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'QualityControl';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'qualitycontrol';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(MachineInterface::class, MachineRepository::class);
        $this->app->bind(DailyInterface::class, DailyRepository::class);
        $this->app->bind(RejectInterface::class, RejectRepository::class);
        $this->app->bind(TestingInterface::class, TestingRepository::class);
        $this->app->bind(AverageInterface::class, AverageRepository::class);
        $this->app->bind(UnitInspectionInterface::class, UnitInspectionRepository::class);
        $this->app->bind(QualityControlBuilderInterface::class, DailyBuilder::class);
        $this->app->bind(QualityControlBuilderInterface::class, DailyValueBuilder::class);
        $this->app->bind(QualityControlBuilderInterface::class, RejectBuilder::class);
        $this->app->bind(QualityControlBuilderInterface::class, RejectValueBuilder::class);
        $this->app->bind(QualityControlBuilderInterface::class, TestingBuilder::class);
        $this->app->bind(QualityControlBuilderInterface::class, TestingValueBuilder::class);
        $this->app->bind(QualityControlBuilderInterface::class, AverageBuilder::class);
        $this->app->bind(CalculationStrategyInterface::class, SumCalculationStrategy::class);
        $this->app->bind(CalculationStrategyInterface::class, PrepareArrayTestingValuesStrategy::class);
        $this->app->bind(ReportGeneratorInterface::class,HtmlRejectReportGenerator::class);
        $this->app->bind(ReportGeneratorInterface::class,QueryTestingReportGenerator::class);
        $this->app->bind(ReportGeneratorFactoryInterface::class,RejectReportGeneratorFactory::class);
        $this->app->bind(ReportGeneratorFactoryInterface::class,TestingReportGeneratorFactory::class);
        $this->app->bind(SumResultStrategyInterface::class,SumResultStrategy::class);
        $this->app->bind(DateModificationStrategyInterface::class,StartDateModificationStrategy::class);
        $this->app->bind(DateModificationStrategyInterface::class,EndDateModificationStrategy::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
