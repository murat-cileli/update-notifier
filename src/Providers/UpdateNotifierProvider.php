<?php
declare(strict_types=1);

namespace MuratCileli\UpdateNotifier\Providers;

use Illuminate\Support\ServiceProvider;
use MuratCileli\UpdateNotifier\Console\Commands\UpdateNotifierCommand;

final class UpdateNotifierProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateNotifierCommand::class,
            ]);

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('update_notifier.php'),
            ], 'update-notifier');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'update_notifier');
    }
}
