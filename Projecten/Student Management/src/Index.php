<?php
require_once "Main.php";
require_once "controllers/studentcontroller.php";
require_once "controllers/classcontroller.php";

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
    case "student":
        switch (@$_GET["action"]) {
            case "list":
                Studentcontroller::List();
                break;
            case "modify":
                Studentcontroller::ShowModify();
                break;
            case "save":
                if (!isset($_GET['studentid'])) {
                    Studentcontroller::Create($_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']);
                } else {
                    Studentcontroller::Modify($_GET['studentid'], $_POST['name'], $_POST['dob'], $_POST['mail'], $_POST['phone']);
                }
                break;
            case "create":
                Studentcontroller::ShowCreate();
                break;
        }
}
?>