<?PHP
require_once "Person.php";
/**
 * Student class with all properties on public so they can be modified outside the class at will
 */
class Student extends Person
{
    private int $id = 0;
    private int $class_id = -1;
    /**
     * Construct a new student object
     * @param string $firstname Full name
     * @param DateTime $dob Date of birth
     * @param string $mail Email
     * @param string $phone Phone number
     */
    public function __construct(int $id, string $firstname, DateTime $dob, string $mail, string $phone, $class_id = -1)
    {
        $this->id = $id;
        $this->class_id = $class_id;
        parent::__construct($firstname, $dob, $mail, $phone);
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getClassId(): int
    {
        return $this->class_id;
    }

    public function setClassId(int $class_id): void
    {
        $this->class_id = $class_id;
    }

}

