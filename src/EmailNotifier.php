<?php

namespace MuratCileli\UpdateNotifier;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class EmailNotifier
{
    private string $notificationSubject;
    private string $notificationBody;
    private string $mailTo;

    /**
     * @throws \Exception
     */
    public function __construct(array $results)
    {
        if (empty(config("update_notifier.mail_to"))) {
            throw new \Exception("Mail recipients not defined. Add UPDATE_NOTIFIER_MAIL_TO to your .env file. Example: UPDATE_NOTIFIER_MAIL_TO=example1@example.com,example2@example.com");
        }

        $this->mailTo = config("update_notifier.mail_to");
        $this->build($results);
    }

    public function notify(): void
    {
        Mail::html($this->notificationBody, function (Message $message) {
            $message->to(explode(",", $this->mailTo))
                ->subject($this->notificationSubject);
        });
    }

    /*
     * TODO: Use views for mail template.
     */
    private function build(array $results): void
    {
        $appName = config("app.name");
        $appUrl = config("app.url");

        $this->notificationSubject = sprintf(
            "Composer Updates for %s (%s)",
            $appName,
            $appUrl
        );

        $this->notificationBody = '<style type="text/css">#results { width: 100%; } #results th { background-color: #ccc; } #results td { background-color: #eee; } #results th, #results td { text-align: left; border-bottom: 1px solid #eee; padding: 10px; }</style>';

        $this->notificationBody .= "<strong>App:</strong> " . $appName . "<br>"
            . "<strong>URL:</strong> " . $appUrl . "<br>"
            . "<strong>Command:</strong> " . $results["command"] . "<br>"
            . "<strong>Timestamp:</strong> " . $results["timestamp"] . "<br><br>"
            . "<table id='results'><thead><tr>"
            . "<th>Package</th>"
            . "<th>Status</th>"
            . "<th>Current</th>"
            . "<th>Latest</th>"
            . "<th>Direct</th>"
            . "<th>Abandoned</th>"
            . "<th>Description</th>"
            . "</tr></thead><tbody>";

        foreach ($results["outdatedPackages"] as $outdatedPackage) {
            $this->notificationBody .= "<tr>"
                . "<td>" . $outdatedPackage["name"] . "</td>"
                . "<td>" . $outdatedPackage["latest-status"] . "</td>"
                . "<td>" . $outdatedPackage["version"] . "</td>"
                . "<td>" . $outdatedPackage["latest"] . "</td>"
                . "<td>" . ($outdatedPackage["direct-dependency"] == "1" ? "Yes" : "") . "</td>"
                . "<td>" . ($outdatedPackage["abandoned"] == "" ? "-" : $outdatedPackage["abandoned"]) . "</td>"
                . "<td>" . $outdatedPackage["description"] . "</td>"
                . "</tr>";
        }

        $this->notificationBody .= "</tbody></table>";
    }
}
