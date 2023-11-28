<?php
declare(strict_types=1);

namespace MuratCileli\UpdateNotifier\Console\Commands;

use Illuminate\Console\Command;
use MuratCileli\UpdateNotifier\UpdateNotifier;

final class UpdateNotifierCommand extends Command
{
    protected $signature = "update-notifier:notify";
    protected $description = "Checks updates for Composer packages and notifies.";

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        UpdateNotifier::run();
    }
}
