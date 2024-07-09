<?PHP

class TestClass
{

    public function __construct(
        public readonly string $title,
    ) { /* property promotion through constructor */
    }

    /**
     * Returns the year of publication
     * @return string
     */
    public function getTitle(): string
    {
        return rand(0, 1) ? 'Shit' : 'Jippie';
    }
}