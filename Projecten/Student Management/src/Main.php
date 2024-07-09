<?PHP
require_once "Mentor.php";
require_once "Student.php";
require_once "SchoolClass.php";

use Projecten\StudentManager\Mentor;
use Projecten\StudentManager\SchoolClass;
use Projecten\StudentManager\Student;

$testMentor = new Mentor(name: "Test", mail: "test@test.com", dob: new DateTime("01-12-1989"), phone: "0640872193");

$schoolClasses = [new schoolClass(name: "1A", year: 1, mentor: $testMentor)];
$studs = [
    new Student(name: "Dennis Bronk", mail: "dbronk2@gmail.com", dob: new DateTime("01-12-1989"), phone: "0640872193"),
    new Student(name: "Test 1", mail: "1@gmail.com", dob: new DateTime("14-2-2002"), phone: "0649283123"),
    new Student(name: "Test 2", mail: "2@gmail.com", dob: new DateTime("19-11-2003"), phone: "0657282912")
];

foreach ($schoolClasses as $schoolClass) {
    $ment = $schoolClass->getMentor();
    echo "Klas: " . $schoolClass->name . " Leerjaar: " . $schoolClass->year . "\n\n";
    echo "\n\n De mentor " . $ment->name . " is geboren op: " . $ment->getBirth() . "\n\n";
    foreach ($studs as $studentje) {
        $schoolClass->addStudent($studentje);
    }
}

$schoolClass->delStudent($studs[0]);
