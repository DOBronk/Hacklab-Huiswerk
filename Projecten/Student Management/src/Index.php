<?php
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
        Mentorcontroller::list();
        break;
    case 'schoolclass':
        switch (@$_GET["action"]) {
            case "show":
                Classcontroller::show($_GET['classid']);
                break;
            case "list":
                Classcontroller::list();
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