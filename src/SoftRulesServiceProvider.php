<?php declare(strict_types=1);

namespace SoftRules\Laravel;

use Illuminate\Foundation\Application;
use SoftRules\Laravel\Services\SoftRulesClient;
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

        $this->publishes([
            $this->package->basePath('/../../php/public/js') => public_path("vendor/{$this->package->shortName()}/js"),
        ], "{$this->package->shortName()}-assets");
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-softrules')
            ->hasConfigFile('softrules')
            ->hasRoute('web');
    }
}
