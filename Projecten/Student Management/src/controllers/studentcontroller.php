<?php
require_once "main.php";

class Studentcontroller
{
    public static function Create($name, $dob, $mail, $phone): void
    {
        global $arrs;
        $arrs->addStudent(new Student($name, $dob, $mail, $phone));
        header("location: /");
    }
    public static function Modify($id, $name, $dob, $mail, $phone): void
    {
        global $arrs;
        $student = $arrs->getStudent($id);
        $student->setName($name);
        $student->setDob($dob);
        $student->setMail($mail);
        $student->setPhone($phone);
        header("location: /");
    }

    public static function List(): void
    {
        showAllStudents();
    }

    public static function ShowModify(): void
    {
        global $arrs;
        $studentId = $_GET['studentid'];
        $student = $arrs->getStudent((int) $studentId);

        include_once '.\html\student\modify.html';
    }

    public static function ShowCreate(): void
    {
        include_once '.\html\student\create.html';
    }
}