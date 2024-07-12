<?PHP
require_once "Requirements.php";
require_once "Mailer.php";

// Set up the schoolclasses
$schoolClasses = [
    new SchoolClass('1A', 1, $mentors[0]),
    new SchoolClass('2B', 2, $mentors[1]),
    new SchoolClass('3C', 3, $mentors[2])
];

// Load the students into the appropriate classes
$schoolClasses[0]->addStudent($students[0], $students[1], $students[2], $students[3], $students[4]);
$schoolClasses[1]->addStudent($students[5], $students[6], $students[7], $students[8], $students[9]);
$schoolClasses[2]->addStudent($students[10], $students[11], $students[12], $students[13], $students[14]);

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
    global $schoolClasses;
    foreach ($schoolClasses as $school) {
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
    global $students;
    $studentsMatched = [];
    foreach ($students as $student) {
        if (str_contains($student->getBirth(), '2004')) {
            array_push($studentsMatched, $student);
        }
    }
    return $studentsMatched;
}

