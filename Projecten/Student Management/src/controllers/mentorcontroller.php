<?php

class Mentorcontroller
{
    public static function create($name, string $dob, $mail, $phone): void
    {
        global $school;

        $mentorId = PdoService::getInstance()->insert("INSERT into mentors (first_name,dob,email,phone) VALUES (?,?,?,?)", [$name, $dob, $mail, $phone]);
        $school->addMentor(new Mentor($mentorId, $name, DateTime::createFromFormat('Y-m-d', $dob), $mail, $phone));

        header("location: /");
    }
    public static function modify($id, $name, $dob, $mail, $phone): void
    {
        global $school;
        $mentor = $school->getMentor($id);
        $mentor->setName($name);
        $mentor->setDob(DateTime::createFromFormat('Y-m-d', $dob));
        $mentor->setMail($mail);
        $mentor->setPhone($phone);
        PdoService::getInstance()->insert("UPDATE mentors SET first_name=?,dob=?,email=?,phone=? WHERE id=?", [$name, $dob, $mail, $phone, $id]);
        header("location: /");
    }

    public static function list(): void
    {
        $school = $_SESSION["school"];
        include_once 'html/mentor/list.html';
    }

    public static function showModify(): void
    {
        global $school;
        $mentorId = $_GET['mentorid'];
        $mentor = $school->getMentor((int) $mentorId);

        include_once '.\html\mentor\modify.html';
    }

    public static function showCreate(): void
    {
        include_once '.\html\mentor\create.html';
    }
}