<?PHP
require_once "Requirements.php";
require_once "Mailer.php";



$schoolClasses = [
    new SchoolClass('1A', 1, $mentors[0]),
    new SchoolClass('2B', 2, $mentors[1]),
    new SchoolClass('3C', 3, $mentors[2])
];


$schoolClasses[0]->addStudent($students[0], $students[1], $students[2], $students[3], $students[4]);
$schoolClasses[1]->addStudent($students[5], $students[6], $students[7], $students[8], $students[9]);
$schoolClasses[2]->addStudent($students[10], $students[11], $students[12], $students[13], $students[14]);

function testMailer($mentor): void
{
    $mailer = new Mailer();
    $mailer->send("Testbericht", $mentor);
}

function showClasses($schoolClasses): void
{
    foreach ($schoolClasses as $school) {
        showclass($school);
    }
}
function showAllClasses(): void
{
    global $schoolClasses;
    foreach ($schoolClasses as $school) {
        showclass($school);
    }
}

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
function showMentor($classmentor): void
{
    $mentor = $classmentor;
    include 'html/mentor.html';
}


function showStudents($schoolStudents): void
{
    foreach ($schoolStudents as $student) {
        include 'html/students.html';
    }
}

function showStudent($student): void
{
    include 'html/students.html';
}

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

#showClasses($schoolClasses);
#showSpecials($students);
