<?php

namespace App\Manager;

use App\Classes\DB;
use App\Entity\Student;
use App\Entity\School;

class StudentManager {

    /**
     * Return a list of students.
     * @return array|null
     */
    public function getStudents(): ?array {
        $students = [];
        $request = DB::getInstance()->prepare("SELECT * FROM student");
        $request->execute();
        $students_response = $request->fetchAll();

        if($students_response) {
            foreach($students_response as $data) {
                $request = DB::getInstance()->prepare("SELECT * FROM school WHERE id=:id");
                $request->bindValue(':id', $data['school_fk']);
                $request->execute();
                $school_data = $request->fetch();
                if ($school_data) {
                    $school = new School($school_data['name'], $school_data['id']);
                    $students[] = new Student($data['firstname'], $data['lastname'], $school, $data['id']);
                }
                else {
                    return [];
                }
            }
        }
        return $students;
    }
}