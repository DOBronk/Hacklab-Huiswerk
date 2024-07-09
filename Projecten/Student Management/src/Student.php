<?PHP

namespace Projecten\StudentManager;

use DateTime;

class Student
{
    public $name;
    public DateTime $dob;
    public $mail;
    public $phone;

    public function __construct(string $name, DateTime $dob, string $mail, string $phone)
    {
        $this->name = $name;
        $this->dob = $dob;
        $this->mail = $mail;
        $this->phone = $phone;
    }

    public function getBirth(): string
    {
        return $this->dob->format("d-m-Y");
    }
}
