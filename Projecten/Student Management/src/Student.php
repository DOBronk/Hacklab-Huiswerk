<?PHP
/**
 * Student class with all properties on public so they can be modified outside the class at will
 */
class Student
{
    private string $name;
    private string $dob;
    private string $mail;
    private string $phone;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getDob(): string
    {
        return $this->dob;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDob(string $dob): void
    {
        $this->dob = $dob;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}

