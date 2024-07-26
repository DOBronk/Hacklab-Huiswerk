<?php
use PHPUnit\Event\Test\MockObjectForIntersectionOfInterfacesCreated;

require_once "Main.php";
require_once "controllers/studentcontroller.php";
require_once "controllers/classcontroller.php";
require_once "controllers/mentorcontroller.php";

$page = $_GET['page'] ?? 'home';


switch ($page) {
    case "mail":
        mailerExample();
        break;
    case 'class':
        switch (@$_GET["action"]) {
            case 'del':
                Classcontroller::deleteStudent((int) $_POST["studentid"], (int) $_POST["schoolclassid"]);
                break;
            case 'add':
                Classcontroller::addStudent((int) $_POST["studentid"], (int) $_POST["schoolclassid"]);
                break;
        }
        break;
    case 'home':
        homeHandler();
        break;
    case 'mentor':
        switch (@$_GET["action"]) {
            case "list":
                Mentorcontroller::list();
                break;
            case "modify":
                Mentorcontroller::showModify();
                break;
            case "create":
                Mentorcontroller::showCreate();
                break;
            case "save":
                if (!isset($_GET['mentorid'])) {
                    Mentorcontroller::create($_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']);
                } else {
                    Mentorcontroller::modify($_GET['mentorid'], $_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']);
                }
                break;
        }
        break;
    case 'schoolclass':
        switch (@$_GET["action"]) {
            case "show":
                Classcontroller::show($_GET['classid']);
                break;
            case "list":
                Classcontroller::list();
                break;
            case "save":
                Classcontroller::modify($_GET['classid'], (int) $_POST['mentid']);
                break;
        }
        break;
    case "student":
        switch (@$_GET["action"]) {
            case "list":
                Studentcontroller::list();
                break;
            case "modify":
                Studentcontroller::showModify();
                break;
            case "save":
                if (!isset($_GET['studentid'])) {
                    Studentcontroller::create($_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']);
                } else {
                    Studentcontroller::modify($_GET['studentid'], $_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']);
                }
                break;
            case "create":
                Studentcontroller::showCreate();
                break;
        }
}
?>