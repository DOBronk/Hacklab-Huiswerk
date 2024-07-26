<?PHP
require_once "models/School.php";
require_once "models/Mailer.php";
require_once "data/db.php";

session_start();

// Load session variables
if (isset($_SESSION["school"])) {
    $school = $_SESSION["school"];
} else {
    $_SESSION["school"] = new School();
}

/**
 * Show all the classes in the school
 * @return void
 */
function showAllClasses(): void
{
    foreach ($_SESSION["school"]->getSchools() as $schoolClass) {
        showclass($schoolClass);
    }
}

/**
 * Show a single class
 * @param SchoolClass $schoolClass The schoolclass to be shown
 * @return void
 */
function showClass(SchoolClass $schoolclass): void
{
    $school = $_SESSION["school"];
    include 'html/schoolclass/schoolclass.html';
}

/**
 * Display mentor in HTML Table Columns
 * @param Mentor $classmentor The mentor to be displayed
 * @return void
 */
function showMentor(Mentor $mentor): void
{
    $school = $_SESSION["school"];
    include 'html/mentor.html';
}

function getStudentDropdown(array $exclude = []): void
{
    $school = $_SESSION["school"];
    include 'html/student/dropdown.html';
}

/**
 * Display single student in HTML Table Columns
 * @param Student $student
 * @return void
 */
function showStudent(Student $student): void
{
    $school = $_SESSION["school"];
    include 'html/student.html';
}

/**
 * Show all students with DOB in year 2004
 * @return array Array of students matching condition
 */
function showSpecials(): array
{
    $school = $_SESSION["school"];
    $studentsMatched = [];
    $students = $school->getStudents();

    foreach ($students as $match) {
        if ($match->getDob()->format('Y') == '2004') {
            array_push($studentsMatched, $match);
        }
    }
    return $studentsMatched;
}

function mailerExample(): void
{
    $school = $_SESSION["school"];

    $mentor = $school->getMentor($_POST["mentorid"]);
    $text = htmlspecialchars(($_POST["mailtext"]));
    $mailer = new Mailer();
    $mailer->send($text, $mentor);
}

function sessionRestart(): void
{
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['msg'] = '<br>Sessie gereset!<br>';
    $_SESSION["school"] = new School();
}

function homeHandler(): void
{
    if (@$_GET['action'] == 'reset') {
        sessionRestart();
        header('location: /');
    } else {
        global $school;
        $msg = $_SESSION['msg'] ?? '';
        unset($_SESSION['msg']);
        include_once "html\home.html";
    }
}
