<?php

namespace MuratCileli\UpdateNotifier;

final class UpdateNotifier
{
    private static string $command = "";

    /**
     * @throws \Exception
     */
    public static function run(): void
    {
        self::buildResult(
            shell_exec(
                self::$command = new CommandBuilder()
            )
        );
    }

    /**
     * @throws \Exception
     */
    private static function buildResult(string $output): void
    {
        $jsonData = substr($output, strpos($output, "{"));

        $outdatedPackages = json_decode(
            trim($jsonData),
            true,
            512,
            JSON_THROW_ON_ERROR);

        $outdatedPackages = $outdatedPackages[array_key_first($outdatedPackages)];

        if (!empty($outdatedPackages)) {
            $notifier = new EmailNotifier([
                "outdatedPackages" => $outdatedPackages,
                "command" => self::$command,
                "timestamp" => date("Y-m-d H:i:s")
            ]);
            $notifier->notify();
        }
    }
}
