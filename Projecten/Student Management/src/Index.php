<?php
require_once "Main.php";
require_once "Mailer.php";
require_once "controllers/studentcontroller.php";
require_once "controllers/classcontroller.php";
loadAll();
function test_input($data): mixed
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$page = $_GET['page'] ?? 'home';

$page = test_input($page);

if (isset($_GET['action']) && test_input($_GET['action']) == 'reset') {
    session_unset();
    session_destroy();
    header('location: /');
}

switch ($page) {
    case "mail":
        $mentorId = test_input($_POST["mentorid"]);
        $text = test_input($_POST["mailtext"]);
        $mailer = new Mailer();
        echo "<h3 style='background-color:Tomato;'>";
        $mailer->send($text, $arrs->getMentor($mentorId));
        echo "</h3>";
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
        include_once "html\home.html";
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