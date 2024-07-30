<?php
class Classcontroller
{
    public static function create(string $name, int $year, int $mentorid): void
    {
        $schoolclassId = PdoService::getInstance()->insert("INSERT into schoolclasses (name,year,mentor_id) VALUES (?,?,?)", [$name, $year, $mentorid]);
        $_SESSION["school"]->addSchoolClass(new SchoolClass((int) $schoolclassId, $name, $year, $_SESSION["school"]->getMentors($mentorid)));

        static::ShowClass($schoolclassId);
    }
    public static function modify(int $id, int $mentorid): void
    {
        $schoolclass = $_SESSION["school"]->getSchool($id);
        $schoolclass->setMentor($_SESSION["school"]->getMentor($mentorid));
        PdoService::getInstance()->insert("UPDATE schoolclasses SET mentor_id=? WHERE id=?", [$mentorid, $id]);
        static::ShowClass($id);
    }

    public static function deleteStudent(int $student_id, int $class_id): void
    {
        PdoService::getInstance()->insert("UPDATE students SET class_id=? WHERE id=?", [-1, $student_id]);
        $_SESSION["school"]->getSchool($class_id)->delStudentId($student_id);
        static::ShowClass($class_id);
    }

    public static function addStudent(int $student_id, int $class_id): void
    {
        PdoService::getInstance()->insert("UPDATE students SET class_id=? WHERE id=?", [$class_id, $student_id]);
        $_SESSION["school"]->getSchool($class_id)->addStudent($_SESSION["school"]->GetStudent($student_id));
        static::ShowClass($class_id);
    }

    private static function ShowClass(int $class_id): void
    {
        header('location: /?page=schoolclass&action=show&classid=' . $class_id);
    }

    public static function show(int $class_id): void
    {
        $school = $_SESSION["school"];
        $schoolclass = $school->getSchool($class_id);
        include 'html/schoolclass/schoolclass.html';
    }

    public static function list(): void
    {
        $school = $_SESSION["school"];
        include 'html/schoolclass/list.html';
    }

}