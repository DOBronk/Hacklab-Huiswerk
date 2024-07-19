<?php
require_once "Main.php";
require_once "Mailer.php";
require_once "controllers/studentcontroller.php";

loadAll();

if (isset($_GET['action']) && $_GET['action'] == 'abort') {
    session_unset();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["mentorid"])) {
        $mentorId = test_input($_POST["mentorid"]);
        $text = test_input($_POST["mailtext"]);
        $mailer = new Mailer();
        echo "<h3 style='background-color:Tomato;'>";
        $mailer->send($text, $arrs->getMentor($mentorId));
        echo "</h3>";
    } elseif (isset($_POST["studentid"])) {
        $studentId = test_input($_POST["studentid"]);
        $schoolClassId = test_input($_POST["schoolclassid"]);
        $arrs->getSchool($schoolClassId)->delStudent($arrs->getStudent($studentId));
        echo "<h3 style='background-color:Tomato;'>" . count($arrs->getStudents()) . " studenten in main array nog over (mag niet lager zijn) </h3>";
    }
}
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