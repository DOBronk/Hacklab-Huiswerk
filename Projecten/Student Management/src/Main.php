<?PHP
require_once "models/School.php";
require_once "models/Mailer.php";
require_once "data/db.php";

session_start();

// Load session variables
if (!isset($_SESSION["school"])) {
    $_SESSION["school"] = new School();
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
    return array_filter($_SESSION["school"]->getStudents(), function ($var) {
        return $var->getDob()->format('Y') == '2004';
    });
}

/**
 * Sends a (fake) email through Mailer class
 * @return void
 */
function mailerExample(): void
{
    $mentor = $_SESSION["school"]->getMentor($_POST["mentorid"]);
    $text = htmlspecialchars(($_POST["mailtext"]));
    $mailer = new Mailer();
    $mailer->send($text, $mentor);
}

/**
 * Reset al session veriables and restart everything from scratch.
 * @return void
 */
function sessionRestart(): void
{
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['msg'] = '<br>Sessie gereset!<br>';
}

/**
 * Handle home page
 * @return void
 */
function homeHandler(): void
{
    if (@$_GET['action'] == 'reset') {
        sessionRestart();
        header('location: /');
    } else {
        $msg = $_SESSION['msg'] ?? '';
        unset($_SESSION['msg']);
        include_once "html\home.html";
    }
}
