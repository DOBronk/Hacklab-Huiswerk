<?php

class Mentorcontroller
{

    public static function list(): void
    {
        $school = $_SESSION["school"];
        include_once 'html/mentor/list.html';
    }

}