<?php
class Classcontroller
{
    /*       if ($insert === true) {
           $schoolclassId = PdoService::getInstance()->insert("INSERT into schoolclasses (name,year,mentor_id) VALUES (?,?,?)", [$schoolclass->getName(), $schoolclass->getYear(), $schoolclass->getMentorId($this->mentors)]);
       } */

    public static function deleteStudent(int $student_id, int $class_id): void
    {
        global $school;
        PdoService::getInstance()->insert("UPDATE students SET class_id=? WHERE id=?", [-1, $student_id]);
        $school->getSchool($class_id)->delStudentId($student_id);
        header('location: /');
    }

    public static function addStudent(int $student_id, int $class_id): void
    {
        global $school;
        PdoService::getInstance()->insert("UPDATE students SET class_id=? WHERE id=?", [$class_id, $student_id]);
        $school->getSchool($class_id)->addStudent($school->GetStudent($student_id));
        header('location: /');
    }
}