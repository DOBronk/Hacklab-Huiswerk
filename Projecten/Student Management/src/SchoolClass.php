<?PHP

namespace Projecten\StudentManager;

/**
 * Summary of SchoolClass
 */
class SchoolClass
{
    private array $students;
    public string $name;
    public int $year;
    public Mentor $mentor;

    public function __construct(string $name, string $year, Mentor $mentor)
    {
        $this->students = [];
        $this->name = $name;
        $this->mentor = $mentor;
        $this->year = $year;
    }

    public function getMentor(): Mentor
    {
        return $this->mentor;
    }
    public function getStudents(): array
    {
        return $this->students;
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
