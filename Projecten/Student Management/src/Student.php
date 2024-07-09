<?PHP

namespace Projecten\StudentManager;

class Student
{
    public function __construct(
        public readonly string $name,
        public readonly string $birth,
        public readonly string $email,
        public readonly string $phone
    ) {
    }
}
