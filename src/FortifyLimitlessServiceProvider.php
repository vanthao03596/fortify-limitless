<?php

namespace Vanthao03596\FortifyLimitless;

use Illuminate\Support\ServiceProvider;
use Vanthao03596\FortifyLimitless\Commands\FortifyLimitlessCommand;

class FortifyLimitlessServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../stubs/resources/assets' => base_path('resources/limitless'),
            ], 'fortify-limitless-assets');

            $this->commands([
                FortifyLimitlessCommand::class,
            ]);
        }
    }
}
