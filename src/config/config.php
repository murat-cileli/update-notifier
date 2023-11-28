<?php
declare(strict_types=1);

return [
    'composer_path' => env("UPDATE_NOTIFIER_COMPOSER_PATH", "composer"),
    'check_version' => env("UPDATE_NOTIFIER_CHECK_VERSION", "all"),
    'direct_packages' => env("UPDATE_NOTIFIER_DIRECT_PACKAGES", true),
    'locked_packages' => env("UPDATE_NOTIFIER_LOCKED_PACKAGES", true),
    'development_packages' => env("UPDATE_NOTIFIER_DEVELOPMENT_PACKAGES", false),
    'mail_to' => env("UPDATE_NOTIFIER_MAIL_TO", ""),
];
