<?PHP
require_once "Requirements.php";

foreach ($schoolClasses as $schoolClass) {
    $ment = $schoolClass->getMentor();
    echo "Klas: " . $schoolClass->name . " Leerjaar: " . $schoolClass->year . PHP_EOL;
    echo "Mentor: " . $ment->name . PHP_EOL;
    echo "Studenten:";

    $studs = $schoolClass->getStudents();

    foreach ($studs as $student) {
        echo " $student->name";
    }
    echo "\n\n";
}

