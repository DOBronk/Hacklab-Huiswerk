<?PHP
require_once "Mentor.php";
require_once "Student.php";
require_once "SchoolClass.php";

use Projecten\StudentManager\Mentor;
use Projecten\StudentManager\SchoolClass;
use Projecten\StudentManager\Student;

$schoolClass = new SchoolClass(
    name: "Backend Klass Hacklab",
    year: 1,
    mentor: new Mentor(name: "Test", email: "test@test.com", birth: "01-12-1989", phone: "0640872193")
);

$studentje = new Student(name: "Dennis", email: "dbronk2@gmail.com", birth: "01-12-1989", phone: "0640872193");
$schoolClass->addStudent($studentje);
$schoolClass->delStudent($studentje);

$schoolClasses = [$schoolClass];