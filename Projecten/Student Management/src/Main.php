<?PHP
require_once "Requirements.php";

function showClasses($schoolClasses): void
{
    foreach ($schoolClasses as $schoolClass) {
        echo "Klas: " . $schoolClass->name . " Leerjaar: " . $schoolClass->year . PHP_EOL;
        echo "Mentor: " . $schoolClass->getMentor()->name . PHP_EOL;
        echo "Studenten:";

        showStudents($schoolClass->getStudents());

        echo "\n\n";
    }
}

function showStudents($schoolStudents): void
{
    foreach ($schoolStudents as $student) {
        echo " $student->name";
    }
}

function showSpecials($schoolClasse): void
{
    $studentsMatched = [];
    foreach ($schoolClasse as $school) {
        foreach ($school->getStudents() as $student) {
            if (str_contains($student->getBirth(), '2004')) {
                array_push($studentsMatched, $student);
            }
        }
    }
    echo 'Alle studenten met als geboortejaar 2004 op de school: ';
    showStudents($studentsMatched);
}

showClasses($schoolClasses);
showSpecials($schoolClasses);
