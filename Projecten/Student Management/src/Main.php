<?PHP
require_once "Requirements.php";
require_once "Mailer.php";

$arrs = new Arrays();
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
    include 'html/schoolclass.html';
}

/**
 * Display mentor in HTML Table Columns
 * @param Mentor $classmentor The mentor to be displayed
 * @return void
 */
function showMentor(Mentor $mentor): void
{
    include 'html/mentor.html';
}

/**
 * Display single student in HTML Table Columns
 * @param Student $student
 * @return void
 */
function showStudent(Student $student): void
{
    include 'html/students.html';
}

/**
 * Show all students with DOB in year 2004
 * @return array Array of students matching condition
 */
function showSpecials(): array
{
    global $arrs;
    $studentsMatched = [];
    foreach ($arrs->getStudents() as $student) {
        if (str_contains($student->dob, '2004')) {
            array_push($studentsMatched, $student);
        }
    }
    return $studentsMatched;
}

