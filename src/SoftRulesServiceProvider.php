<?php declare(strict_types=1);

namespace SoftRules\Laravel;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use SoftRules\Laravel\Services\SoftRulesClient;
use SoftRules\Laravel\View\Components\SoftRulesForm;
use SoftRules\PHP\Contracts\ClientContract;
use SoftRules\PHP\Services\SoftRulesClient as BaseClient;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TypeError;

final class SoftRulesServiceProvider extends PackageServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->singleton(ClientContract::class, function (Application $app, array $args): SoftRulesClient {
            if (! isset($args['product'])) {
                throw new TypeError('Please provide the SoftRules product to create a client for');
            }

            $product = $args['product'];

            if (! is_string($product)) {
                throw new TypeError('product is not a [string].');
            }

            return SoftRulesClient::fromConfig($product);
        });

        $this->app->alias(ClientContract::class, SoftRulesClient::class);
        $this->app->alias(ClientContract::class, BaseClient::class);
    }

    public function boot(): void
    {
        parent::boot();

        Blade::component('softrules-form', SoftRulesForm::class);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('SoftRules Laravel')
            ->hasConfigFile('softrules')
            ->hasViews()
            ->hasRoute('web');
    }
}