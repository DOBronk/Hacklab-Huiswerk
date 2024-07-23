<?PHP
require_once "Person.php";
/**
 * Student class with all properties on public so they can be modified outside the class at will
 */
class Student extends Person
{
    /**
     * Construct a new student object
     * @param string $firstname Full name
     * @param DateTime $dob Date of birth
     * @param string $mail Email
     * @param string $phone Phone number
     */
    public function __construct(string $firstname, DateTime $dob, string $mail, string $phone)
    {
        parent::__construct($firstname, $dob, $mail, $phone);
    }

}

