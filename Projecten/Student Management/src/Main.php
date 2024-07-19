<?PHP
require_once "School.php";
require_once "Mailer.php";

session_start();
$arrs = new School("OSG Piter Jelles");

function loadAll()
{
    global $arrs;

    if (isset($_SESSION["arrs"])) {
        $arrs = $_SESSION["arrs"];
    } else {
        $_SESSION["arrs"] = $arrs;
    }
}

/**
 * Send an email message to a mentor
 * @param Mentor $mentor The mentor to be addressed
 * @return void
 */
function testMailer(Mentor $mentor): void
{
    $mailer = new Mailer();
    $mailer->send("Testbericht", $mentor);
}

/**
 * Show all the classes in the school
 * @return void
 */
function showAllClasses(): void
{
    global $arrs;

    foreach ($arrs->getSchools() as $school) {
        showclass($school);
    }
}

/**
 * Show a single class
 * @param SchoolClass $schoolClass The schoolclass to be shown
 * @return void
 */
function showClass(SchoolClass $school): void
{
    global $arrs;
    include 'html/schoolclass/schoolclass.html';
}

function showAllStudents(): void
{
    global $arrs;
    include_once 'html/student/list.html';
}

/**
 * Display mentor in HTML Table Columns
 * @param Mentor $classmentor The mentor to be displayed
 * @return void
 */
function showMentor(Mentor $mentor): void
{
    global $arrs;
    include 'html/mentor.html';
}

function getStudentDropdown(): void
{
    global $arrs;
    include 'html/student/dropdown.html';
}

/**
 * Display single student in HTML Table Columns
 * @param Student $student
 * @return void
 */
function showStudent(Student $student): void
{
    global $arrs;
    include 'html/student.html';
}

/**
 * Show all students with DOB in year 2004
 * @return array Array of students matching condition
 */
function showSpecials(): array
{
    global $arrs;
    $studentsMatched = [];
    $students = $arrs->getStudents();

    foreach ($students as $match) {
        if ($match->getDob()->format('Y') == '2004') {
            array_push($studentsMatched, $match);
        }
    }
    return $studentsMatched;
}
