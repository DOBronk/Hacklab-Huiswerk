<?php
use PHPUnit\Event\Test\MockObjectForIntersectionOfInterfacesCreated;

require_once "Main.php";
require_once "controllers/studentcontroller.php";
require_once "controllers/classcontroller.php";
require_once "controllers/mentorcontroller.php";

function routeClass()
{
    return match (@$_GET["action"]) {
        'del' => Classcontroller::deleteStudent((int) $_POST["studentid"], (int) $_POST["schoolclassid"]),
        'add' => Classcontroller::addStudent((int) $_POST["studentid"], (int) $_POST["schoolclassid"])
    };
}
function routeMentor()
{
    return match (@$_GET["action"]) {
        "list" => Mentorcontroller::list(),
        "modify" => Mentorcontroller::showModify(),
        "create" => Mentorcontroller::showCreate(),
        "save" => (!isset($_GET['mentorid'])) ? Mentorcontroller::create($_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']) :
        Mentorcontroller::modify($_GET['mentorid'], $_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone'])
    };
}

function routeSchoolclass()
{
    return match (@$_GET["action"]) {
        "show" => Classcontroller::show($_GET['classid']),
        "list" => Classcontroller::list(),
        "save" => Classcontroller::modify($_GET['classid'], (int) $_POST['mentid'])
    };
}

function routeStudent()
{
    return match (@$_GET["action"]) {
        "list" => Studentcontroller::list(),
        "modify" => Studentcontroller::showModify(),
        "save" => (!isset($_GET['studentid'])) ? Studentcontroller::create($_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone'])
        : Studentcontroller::modify($_GET['studentid'], $_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']),
        "create" => Studentcontroller::showCreate()
    };
}

match ($_GET['page'] ?? 'home') {
    "mail" => mailerExample(),
    "class" => routeClass(),
    "home" => homeHandler(),
    "mentor" => routeMentor(),
    'schoolclass' => routeSchoolclass(),
    "student" => routeStudent()
};


?>