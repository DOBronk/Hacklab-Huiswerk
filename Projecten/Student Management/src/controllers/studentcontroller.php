<?php
require_once "main.php";

class Studentcontroller
{
    public static function Create($name, string $dob, $mail, $phone): void
    {
        global $school;

        $studentId = PdoService::getInstance()->insert("INSERT into students (first_name,dob,email,phone) VALUES (?,?,?,?)", [$name, $dob, $mail, $phone]);
        $school->addStudent(new Student($studentId, $name, DateTime::createFromFormat('Y-m-d', $dob), $mail, $phone));

        header("location: /");
    }
    public static function Modify($id, $name, $dob, $mail, $phone): void
    {
        global $school;
        $student = $school->getStudent($id);
        $student->setName($name);
        $student->setDob(DateTime::createFromFormat('Y-m-d', $dob));
        $student->setMail($mail);
        $student->setPhone($phone);
        PdoService::getInstance()->insert("UPDATE students SET first_name=?,dob=?,email=?,phone=? WHERE id=?", [$name, $dob, $mail, $phone, $id]);
        header("location: /");
    }

    public static function List(): void
    {
        showAllStudents();
    }

    public static function ShowModify(): void
    {
        global $school;
        $studentId = $_GET['studentid'];
        $student = $school->getStudent((int) $studentId);

        include_once '.\html\student\modify.html';
    }

    public static function ShowCreate(): void
    {
        include_once '.\html\student\create.html';
    }
}