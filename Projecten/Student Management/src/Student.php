<?PHP
require_once "Person.php";
/**
 * Student class with all properties on public so they can be modified outside the class at will
 */
class Student extends Person
{
    /**
     * Construct a new student object
     * @param string $name Full name
     * @param DateTime $dob Date of birth
     * @param string $mail Email
     * @param string $phone Phone number
     */
    public function __construct(string $name, DateTime $dob, string $mail, string $phone)
    {
        parent::__construct($name, $dob, $mail, $phone);
    }

}

