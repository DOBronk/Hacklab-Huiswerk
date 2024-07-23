<?PHP
require_once "SchoolClass.php";
require_once "Main.php";

class School
{
    private array $mentors = [];
    private array $students = [];
    private array $schoolClasses = [];

    private string $name;

    public function __construct()
    {
        $this->name = PdoService::getInstance()->fetch("schooldata")['name'];
        $this->loadDbMentors();
        $this->loadDbStudents();
        $this->loadDbClasses();
    }
    private function loadDbStudents(): void
    {
        $students = PdoService::getInstance()->fetchAll("students");
        foreach ($students as $student) {
            $this->addStudent(new Student($student['first_name'], DateTime::createFromFormat('Y-m-d', $student['dob']), $student['email'], $student['phone']), $student['id'], false);
        }
    }

    private function loadDbMentors(): void
    {
        $mentors = PdoService::getInstance()->fetchAll("mentors");
        foreach ($mentors as $mentor) {
            $this->addMentor(new Mentor($mentor['first_name'], DateTime::createFromFormat('Y-m-d', $mentor['dob']), $mentor['email'], $mentor['phone']), $mentor['id'], false);
        }
    }

    private function loadDbClasses(): void
    {
        $schoolclass = PdoService::getInstance()->fetchAll("schoolclasses");
        foreach ($schoolclass as $class) {
            $result = new SchoolClass($class['name'], $class['year'], $this->mentors[$class['mentor_id']]);
            $students = PdoService::getInstance()->fetchAll("students WHERE class_id=" . $class['id']);
            foreach ($students as $student) {
                $result->addStudent($this->students[$student['id']]);
            }
            $this->addSchoolClass($result, false);
        }
    }

    public function getSchools(): array
    {
        return $this->schoolClasses;
    }

    public function getSchool(int $id): SchoolClass
    {
        return $this->schoolClasses[$id];
    }
    public function getStudents(): array
    {
        return $this->students;
    }

    public function addSchoolClass(SchoolClass $schoolclass, $insert = true): void
    {
        $schoolclassId = count($this->schoolClasses);

        if ($insert === true) {
            $schoolclassId = PdoService::getInstance()->insert("INSERT into schoolclasses (name,year,mentor_id) VALUES (?,?,?)", [$schoolclass->getName(), $schoolclass->getYear(), $schoolclass->getMentorId($this->mentors)]);
        }

        $this->schoolClasses += [$schoolclassId => $schoolclass];
    }

    public function addMentor(Mentor $mentor, int $mentorId = -1, $insert = true): void
    {
        if ($insert === true) {
            $mentorId = PdoService::getInstance()->insert("INSERT into mentors (first_name,dob,email,phone) VALUES (?,?,?,?)", [$mentor->getName(), $mentor->getDob()->format('Y-m-d'), $mentor->getMail(), $mentor->getPhone()]);
        }

        $this->mentors += [$mentorId => $mentor];
    }

    public function addStudent(Student $student, int $studentId = -1, $insert = true): void
    {
        if ($insert === true) {
            $studentId = PdoService::getInstance()->insert("INSERT into students (first_name,dob,email,phone) VALUES (?,?,?,?)", [$student->getName(), $student->getDob()->format('Y-m-d'), $student->getMail(), $student->getPhone()]);
        }

        $this->students += [$studentId => $student];
    }

    public function getStudent(int $id): Student
    {
        return $this->students[$id];
    }

    public function getMentors(): array
    {
        return $this->mentors;
    }
    public function getMentor(int $id): Mentor
    {
        return $this->mentors[$id];
    }

    public function getName(): string
    {
        return $this->name;
    }
}





