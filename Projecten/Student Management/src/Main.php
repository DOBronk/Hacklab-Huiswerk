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
 * @param mixed $mentor The mentor to be addressed
 * @return void
 */
function testMailer($mentor): void
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
 * @param mixed $schoolClass The schoolclass to be shown
 * @return void
 */
function showClass($schoolClass): void
{
    $school = $schoolClass;
    include 'html/schoolclass.html';
}

/*    Shit voor in console output function ofzo voor later
         echo "Klas: " . $schoolClass->name . " Leerjaar: " . $schoolClass->year . PHP_EOL;
        echo "Mentor: " . $schoolClass->getMentor()->name . PHP_EOL;
        echo "Studenten:";

        showStudents($schoolClass->getStudents());

        echo "\n\n";

*/

/**
 * Display mentor in HTML Table Columns
 * @param mixed $classmentor The mentor to be displayed
 * @return void
 */
function showMentor($classmentor): void
{
    $mentor = $classmentor;
    include 'html/mentor.html';
}

/**
 * Display single student in HTML Table Columns
 * @param mixed $student
 * @return void
 */
function showStudent($student): void
{
    include 'html/students.html';
}

/**
 * Show all students with DOB in year 2004
 * @param mixed $students Array of students
 * @return array Array of students matching condition
 */
function showSpecials($students): array
{
    $studentsMatched = [];
    foreach ($students as $student) {
        if (str_contains($student->getBirth(), '2004')) {
            array_push($studentsMatched, $student);
        }
    }
    return $studentsMatched;
}

