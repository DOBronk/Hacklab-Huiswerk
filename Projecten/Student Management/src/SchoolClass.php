<?PHP

namespace Projecten\StudentManager;

class SchoolClass
{
    private array $students;
    public function __construct(
        public readonly string $name,
        public readonly int $year,
        public Mentor $mentor
    ) {
        $this->students = [];
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        if (!in_array($student, $this->students)) {
            array_push($this->students, $student);
        } else {
            throw new \Exception("Deze student zit er al in");
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
