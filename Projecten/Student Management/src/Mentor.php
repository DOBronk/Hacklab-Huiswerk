<?PHP
/**
 * Mentor class with all properties on public so they can be modified outside the class at will
 */
class Mentor
{
    public $name;
    public string $dob;
    public $mail;
    public $phone;
    /**
     * Construct a new mentor object
     * @param string $name Full Name
     * @param string $dob Date of Birth
     * @param string $mail Email address
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
