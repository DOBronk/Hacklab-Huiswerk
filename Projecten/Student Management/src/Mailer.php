<?php
require_once "Mentor.php";

class Mailer
{
    public function send(string $text, Mentor $mentor): void
    {
        echo "Mail verstuurd naar [$mentor->name] [$mentor->mail]<br/><br />[$text]";
    }
}
