<?PHP
require_once "Student.php";
require_once "Person.php";
/**
 * SchoolClass class which holds the data of a schoolclass, some properties private so you can't modify from outside the class
 */
class SchoolClass
{
    private array $students;
    private int $class_id = -1;

    public function __construct(int $class_id, private string $name, private int $year, private Mentor $mentor)
    {
        $this->students = [];
        $this->class_id = $class_id;
    }

    public function getId(): int
    {
        return $this->class_id;
    }

    public function getMentor(): Mentor
    {
        return $this->mentor;
    }

    public function getMentorId(array $mentors): int|bool
    {
        $mentorid = array_search($this->getMentor(), $mentors);
        return ($mentorid !== false) ? $mentorid : false;
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
                $student->setClassId($this->class_id);
                $this->students += [$student->getId() => $student];

            } else {
                throw new \Exception("Deze student zit er al in");
            }
        }
    }
    public function delStudentId(int $id): void
    {
        $this->students[$id]->setClassId(-1);
        unset($this->students[$id]);
    }
    public function delStudent(Student $student): void
    {
        if (in_array($student, $this->students)) {
            $student->setClassId(-1);
            $this->delStudentId(array_search($student, $this->students));
        } else {
            throw new \Exception("Deze student zit er niet eens in");
        }
    }
}
