<?php

namespace Vanthao03596\FortifyLimitless;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vanthao03596\FortifyLimitless\Commands\FortifyLimitlessCommand;

class FortifyLimitlessServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('fortify-limitless')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_fortify-limitless_table')
            ->hasCommand(FortifyLimitlessCommand::class);
    }
}
