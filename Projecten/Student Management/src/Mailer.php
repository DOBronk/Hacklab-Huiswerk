<?php
require_once "Mentor.php";

class Mailer
{
    /**
     * Send a mail to a mentor (or atleast pretent to do so)
     * @param string $text Should contain the message to be send
     * @param Mentor $mentor Mentor to be addressed
     * @return void
     */
    public function send(string $text, Mentor $mentor): void
    {
        echo "Mail verstuurd naar [$mentor->name] [$mentor->mail]<br/><br />[$text]";
    }
}
