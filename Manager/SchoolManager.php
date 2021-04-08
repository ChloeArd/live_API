<?php

namespace App\Manager;

use APP\Classes\DB;
use App\Entity\School;

Class SchoolManager {

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
}