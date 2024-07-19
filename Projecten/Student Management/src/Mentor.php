<?PHP
require_once ("person.php");
/**
 * Mentor class with all properties on public so they can be modified outside the class at will
 */
class Mentor extends Person
{
    /**
     * Construct a new mentor object
     * @param string $name Full Name
     * @param string $dob Date of Birth
     * @param string $mail Email address
     * @param string $phone Phone number
     */
    public function __construct(string $name, string $dob, string $mail, string $phone)
    {
        parent::__construct($name, $dob, $mail, $phone);
    }

}

