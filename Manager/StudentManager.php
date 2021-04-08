<?php

namespace App\Manager;

use App\Classes\DB;
use App\Entity\Student;
use App\Entity\School;
use App\Manager\SchoolManager;

class StudentManager {

    private SchoolManager $schoolManager;

    /**
     * StudentManager constructor.
     */
    public function __construct() {
        $this->schoolManager = new SchoolManager();
    }

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
                $school = $this->schoolManager->getSchool($data['school_fk']);
                $students[] = new Student($data['firstname'], $data['lastname'], $school, $data['id']);
            }
        }
        return $students;
    }

    /**
     * Fetch provided student (id).
     * @param int $id
     * @return Student
     */
    public function getStudent(int $id): Student {
        $request = DB::getInstance()->prepare("SELECT * FROM student WHERE  id = :id");
        $request->bindValue(':id', $id);
        $request->execute();
        $student_data = $request->fetch();
        $student = new Student();
        if ($student_data) {
            $student->setId($student_data['id']);
            $student->setLastName($student_data['lastname']);
            $student->setFirstName($student_data['firstname']);
            $school = $this->schoolManager->getSchool($student_data['school_fk']);
            $student->setSchool($school);
        }
        return $student;
    }
}