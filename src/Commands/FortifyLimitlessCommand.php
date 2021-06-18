<?php

namespace Vanthao03596\FortifyLimitless\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class FortifyLimitlessCommand extends Command
{
    public $signature = 'fortify-limitless
                    {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    public $description = 'Setup FortifyLimitless routes, service providers and views';

    public function handle()
    {
        $this->requireComposerPackages('laravel/fortify:^1.7');

        // Fortify Provider...
        $this->installServiceProviderAfter('RouteServiceProvider', 'FortifyServiceProvider');

        // FortifyUi Provider...
        $this->installServiceProviderAfter('FortifyServiceProvider', 'FortifyUIServiceProvider');

        $this->publishAssets();

        $this->updateRoutes();

        $this->comment('FortifyLimitless is now installed.');

        $this->info('Please, run php artisan migrate, yarn install && yarn dev!');
    }

    protected function publishAssets()
    {
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-support', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-migrations', '--force' => true]);

        $this->callSilent('vendor:publish', ['--tag' => 'fortify-limitless-assets', '--force' => true]);

        $this->updateNodePackages(function ($packages) {
            return [
                'bootstrap' => '^4.6.0',
                'jquery' => '^3.6',
                'popper.js' => '^1.16.1',
                'resolve-url-loader' => '^4.0.0',
                'sass' => '^1.32.8',
                'sass-loader' => '^12.0.0',
                'node-sass' => '^6.0.0',
            ] + $packages;
        });

        copy(__DIR__.'/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/profile'));
        
        // Service Providers...
        copy(__DIR__.'/../../stubs/app/Providers/FortifyUIServiceProvider.php', app_path('Providers/FortifyUIServiceProvider.php'));
        
        // View Components...
        copy(__DIR__.'/../../stubs/app/View/Components/AppLayout.php', app_path('View/Components/AppLayout.php'));
        copy(__DIR__.'/../../stubs/app/View/Components/GuestLayout.php', app_path('View/Components/GuestLayout.php'));

        // Layouts...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/views/layouts', resource_path('views/layouts'));

        // Other Views...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/views/profile', resource_path('views/profile'));
     
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/views/auth', resource_path('views/auth'));

        // Single Blade Views...
        copy(__DIR__.'/../../stubs/resources/views/dashboard.blade.php', resource_path('views/dashboard.blade.php'));
    }

    protected function updateRoutes()
    {
        if (! Str::contains(file_get_contents(base_path('routes/web.php')), "'/dashboard'")) {
            File::append(
                base_path('routes/web.php'),
                "\nRoute::view('/dashboard', 'dashboard')\n\t->name('dashboard')\n\t->middleware(['auth', 'verified']);\n"
            );
        }

        if (! Str::contains(file_get_contents(base_path('routes/web.php')), "'/user/profile'")) {
            File::append(
                base_path('routes/web.php'),
                "\nRoute::view('/user/profile', 'profile.show')\n\t->name('profile.show')\n\t->middleware(['auth', 'verified']);\n"
            );
        }

        File::put(
            resource_path('views/welcome.blade.php'),
            str_replace(
                "{{ url('/home') }}",
                "{{ url('/dashboard') }}",
                File::get(resource_path('views/welcome.blade.php'))
            )
        );

        File::put(
            app_path('Providers/RouteServiceProvider.php'),
            str_replace(
                "public const HOME = '/home';",
                "public const HOME = '/dashboard';",
                File::get(app_path('Providers/RouteServiceProvider.php'))
            )
        );
    }

    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    protected function installServiceProviderAfter($after, $name)
    {
        if (! Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\'.$name.'::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\'.$after.'::class,',
                'App\\Providers\\'.$after.'::class,'.PHP_EOL.'        App\\Providers\\'.$name.'::class,',
                $appConfig
            ));
        }
    }
}
