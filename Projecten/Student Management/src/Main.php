<?PHP
require_once "School.php";
require_once "Mailer.php";

session_start();
$school = new School("OSG Piter Jelles");

function loadAll()
{
    global $school;

    if (isset($_SESSION["school"])) {
        $school = $_SESSION["school"];
    } else {
        $_SESSION["school"] = $school;
    }
}

/**
 * Show all the classes in the school
 * @return void
 */
function showAllClasses(): void
{
    global $school;

    foreach ($school->getSchools() as $schoolClass) {
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
    global $school;
    $mentorId = array_search($schoolclass->getMentor(), $school->getMentors());
    $classId = array_search($schoolclass, $school->getSchools());
    include 'html/schoolclass/schoolclass.html';
}

function showAllStudents(): void
{
    global $school;
    include_once 'html/student/list.html';
}

/**
 * Display mentor in HTML Table Columns
 * @param Mentor $classmentor The mentor to be displayed
 * @return void
 */
function showMentor(Mentor $mentor): void
{
    global $school;
    include 'html/mentor.html';
}

function getStudentDropdown(): void
{
    global $school;
    include 'html/student/dropdown.html';
}

/**
 * Display single student in HTML Table Columns
 * @param Student $student
 * @return void
 */
function showStudent(Student $student): void
{
    global $school;
    include 'html/student.html';
}

/**
 * Show all students with DOB in year 2004
 * @return array Array of students matching condition
 */
function showSpecials(): array
{
    global $school;
    $studentsMatched = [];
    $students = $school->getStudents();

    foreach ($students as $match) {
        if ($match->getDob()->format('Y') == '2004') {
            array_push($studentsMatched, $match);
        }
    }
    return $studentsMatched;
}
