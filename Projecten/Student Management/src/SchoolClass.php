<?PHP
require_once "Student.php";
require_once "Person.php";
/**
 * SchoolClass class which holds the data of a schoolclass, some properties private so you can't modify from outside the class
 */
class SchoolClass
{
    private array $students;

    public function __construct(private string $name, private int $year, private Mentor $mentor)
    {
        $this->students = [];
    }

    public function getMentor(): Mentor
    {
        return $this->mentor;
    }
    public function getStudents(): array
    {
        return $this->students;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setMentor(Mentor $mentor)
    {
        $this->mentor = $mentor;
    }

    public function addStudent(Student ...$studenten): void
    {
        foreach ($studenten as $student) {
            if (!in_array($student, $this->students)) {
                array_push($this->students, $student);
            } else {
                throw new \Exception("Deze student zit er al in");
            }
        }
    }

    public function delStudent(Student $student): void
    {
        if (in_array($student, $this->students)) {
            unset($this->students[array_search($student, $this->students)]);
        } else {
            throw new \Exception("Deze student zit er niet eens in");
        }
    }
}
