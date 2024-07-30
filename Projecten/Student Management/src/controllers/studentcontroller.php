<?php
class Studentcontroller
{
    public static function create($name, string $dob, $mail, $phone): void
    {
        global $school;

        $studentId = PdoService::getInstance()->insert("INSERT into students (first_name,dob,email,phone) VALUES (?,?,?,?)", [$name, $dob, $mail, $phone]);
        $school->addStudent(new Student($studentId, $name, DateTime::createFromFormat('Y-m-d', $dob), $mail, $phone));

        header("location: /");
    }
    public static function modify($id, $name, $dob, $mail, $phone): void
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

    public static function list(): void
    {
        $school = $_SESSION["school"];
        include_once 'html/student/list.html';
    }

    public static function showModify(): void
    {
        $studentId = $_GET['studentid'];
        $student = $_SESSION["school"]->getStudent((int) $studentId);

        include_once '.\html\student\modify.html';
    }
    public static function getStudentDropdown(array $exclude = []): void
    {
        $school = $_SESSION["school"];
        include 'html/student/dropdown.html';
    }

    public static function showCreate(): void
    {
        include_once '.\html\student\create.html';
    }
}