<?php

//C'est la racine de notre site web où il est héberger -> $_SERVER['DOCUMENT_ROOT'].
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/School.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/Student.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/StudentManager.php';

use App\Entity\Student;
use App\Manager\StudentManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD']; // Récupère la méthode soit GET ou POST.
$manager = new StudentManager();

switch ($requestType) {
    case 'GET':
        $response = [];
        // Obtention des students.
    $data = $manager->getStudents();
    foreach ($data as $student) {
        /* @var Student $student */
        $response[] = [
            'id' => $student->getId(),
            'firstname' => $student->getFirstName(),
            'lastname' => $student->getLastName(),
            'school' => [
                'id' => $student->getSchool()->getId(), //fonction chainée
                'name' => $student->getSchool()->getName(),
            ],
        ];
    }
        /**
         [
            {
               'id' : 5,
               'firstname' : 'le first name',
               'lastname' : 'le last name',
               'school' : {
                    'id' : 8,
                    'name' : 'UpTo grande école du numérique'
               }
            },
            {
               'id" : 6,
               'firstname' : 'deuxième firstname',
               'lastname' : 'le last name',
               'school' : {
                    'id' : 8,
                    'name' : 'UpTo grande école du numérique'
               }
            }
        ]
         */

        //Envoie de la réponse (on encode notre tableau au format json).
        echo json_encode($response);
        break;
    default:
        break;
}

exit;