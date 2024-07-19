<?php

class Person
{
    /**
     * Construct a new person object
     * @param string $name
     * @param DateTime $dob
     * @param string $mail
     * @param string $phone
     */
    public function __construct(private string $name, private DateTime $dob, private string $mail, private string $phone)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDob(): DateTime
    {
        return $this->dob;
    }

    public function getDobString(): string
    {
        return $this->dob->format('d-m-Y');
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

    public function setDob(DateTime $dob): void
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
