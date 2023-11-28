<?php

namespace MuratCileli\UpdateNotifier;

final class CommandBuilder
{
    private string $command = "";

    public function __construct()
    {
        $this->build(
            config("update_notifier")
        );
    }

    private function build(array $config): void
    {
        $this->command .= $config["composer_path"] . " outdated ";

        if ($config["check_version"] === "all") {
            $this->command .= " ";
        } else {
            $this->command .= "--" . $config["check_version"] . "-only ";
        }

        $this->command .= $config["direct_packages"] ? "--direct " : " ";
        $this->command .= $config["locked_packages"] ? "--locked " : " ";
        $this->command .= $config["development_packages"] ? " " : "--no-dev ";
        $this->command .= "--format json";
    }

    public function __toString(): string
    {
        return $this->command;
    }
}
