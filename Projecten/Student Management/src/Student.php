<?PHP
class Student
{
    public $name;
    public string $dob;
    public $mail;
    public $phone;

    public function __construct(string $name, string $dob, string $mail, string $phone)
    {
        $this->name = $name;
        $this->dob = $dob;
        $this->mail = $mail;
        $this->phone = $phone;
    }

    public function getBirth(): string
    {
        return $this->dob;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
