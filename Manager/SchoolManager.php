<?php

namespace App\Manager;

use App\Classes\DB;
use App\Entity\School;

class SchoolManager {

    /**
     * Return a school based on id.
     * @param int $id
     * @return School
     */
    public function getSchool(int $id): School {
        $request = DB::getInstance()->prepare("SELECT * FROM school WHERE id=:id");
        $request->bindValue(':id', $id);
        $request->execute();
        $school_data = $request->fetch();
        $school = new School();
        if ($school_data) {
            $school->setId($school_data['id']);
            $school->setName($school_data['name']);
        }
        return $school;
    }

    /**
     * Return a schools list.
     * @return array
     */
    public function getSchools(): array {
        $schools = [];
        $request = DB::getInstance()->prepare("SELECT * FROM school");
        $request->execute();
        $schools_response = $request->fetchAll();

        if($schools_response) {
            foreach($schools_response as $data) {
                $schools[] = new School($data['name'], $data['id']);
            }
        }

        return $schools;
    }
}