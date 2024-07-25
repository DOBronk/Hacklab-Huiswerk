<?PHP
require_once "person.php";
/**
 * Mentor class with all properties on public so they can be modified outside the class at will
 */
class Mentor extends Person
{
    /**
     * Construct a new mentor object
     * @param string $name Full Name
     * @param DateTime $dob Date of Birth
     * @param string $mail Email address
     * @param string $phone Phone number
     */
    private int $id;

    public function __construct(int $id, string $name, DateTime $dob, string $mail, string $phone)
    {
        $this->id = $id;
        parent::__construct($name, $dob, $mail, $phone);
    }

    /**
     * Returns the mentors' ID
     * @return int ID
     */
    public function getId(): int
    {
        return $this->id;
    }
}

