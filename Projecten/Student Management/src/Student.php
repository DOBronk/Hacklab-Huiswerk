<?PHP
/**
 * Student class with all properties on public so they can be modified outside the class at will
 */
class Student
{
    public $name;
    public string $dob;
    public $mail;
    public $phone;
    /**
     * Construct a new student object
     * @param string $name Full name
     * @param string $dob Date of birth
     * @param string $mail Email
     * @param string $phone Phone number
     */
    public function __construct(string $name, string $dob, string $mail, string $phone)
    {
        $this->name = $name;
        $this->dob = $dob;
        $this->mail = $mail;
        $this->phone = $phone;
    }
}

