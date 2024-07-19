<?php

require_once "main.php";

class Classcontroller
{
    public static function deleteStudent(int $student_id, int $class_id): void
    {
        global $arrs;
        $arrs->getSchool($class_id)->delStudentId($student_id);
        header('location: /');
    }

    public static function addStudent(int $student_id, int $class_id): void
    {
        global $arrs;
        $arrs->getSchool($class_id)->addStudent($arrs->GetStudent($student_id));
        header('location: /');
    }
}