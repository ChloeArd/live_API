<?php

//C'est la racine de notre site web où il est héberger -> $_SERVER['DOCUMENT_ROOT'].
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/School.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/Student.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/StudentManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/SchoolManager.php';
use App\Entity\Student;
use App\Manager\StudentManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD']; // Récupère la méthode soit GET ou POST.
$manager = new StudentManager();

switch ($requestType) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo getStudent($manager,intval($_GET['id']));
        }
        else {
            echo getStudents($manager);
        }
        break;
    default:
        break;
}

/**
 * Return the students list.
 * @param StudentManager $manager
 * @return false|string
 */
function getStudents(studentManager $manager): string {
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
    //Envoie de la réponse (on encode notre tableau au format json).
    return json_encode($response);
}

/**
 * Return only one student.
 * @param StudentManager $manager
 * @param int $id
 * @return string
 */
function getStudent(StudentManager $manager, int $id): string {
    $student = $manager->getStudent($id);
    $response = [
        'id' => $student->getId(),
        'firstname' => $student->getFirstName(),
        'lastname' => $student->getLastName(),
        'school' => [
            'id' => $student->getSchool()->getId(), //fonction chainée
            'name' => $student->getSchool()->getName(),
        ],
    ];
    return json_encode($response);
}

exit;

/**
 * Format attendu pour get /api/students
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