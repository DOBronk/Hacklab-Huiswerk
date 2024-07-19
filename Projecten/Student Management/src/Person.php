<?php

class Person
{
    /**
     * Construct a new person object
     * @param string $name Full name
     * @param string $dob Date of birth
     * @param string $mail Email
     * @param string $phone Phone number
     */
    public function __construct(private string $name, private string $dob, private string $mail, private string $phone)
    {
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
