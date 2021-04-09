<?php
/* alexis.laroche.02240@gmail.com */
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/School.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/Student.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/StudentManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/SchoolManager.php';


use App\Entity\Student;
use App\Manager\StudentManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new StudentManager();

switch($requestType) {
    // Obtention d'informations.
    case 'GET':
        if(isset($_GET['id']))
            echo getStudent($manager, intval($_GET['id']));
        else
            echo getStudents($manager);
        break;
    // Ajout d'un nouve élève.
    case 'POST':
        // PRéparation de la réponse.
        $response = [
            'error' => 'success',
            'message' => 'Utilisateur ajouté avec succès',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if(isset($data->firstname, $data->lastname, $data->school)) {
            $school = intval($data->school);
            $result = $manager->addStudent($data->firstname, $data->lastname, $school);
            if(!$result) {
                $response = [
                    'error' => 'danger',
                    'message' => 'Une erreur est survenue en ajoutant cet étudiant',
                ];
            }
        }
        else {
            $response = [
                'error' => 'danger',
                'message' => 'Le nom, prénom ou école est manquant',
            ];
        }
        echo json_encode($response);
        break;
    // Modification d'un élève.
    case 'PUT':
        break;
    case 'DELETE':
        break;
    default:
        break;
}

/**
 * Return the students list.
 * @param StudentManager $manager
 * @return false|string
 */
function getStudents(StudentManager $manager): string {
    $response = [];
    // Obtention des students.
    $data = $manager->getStudents();
    foreach($data as $student) {
        /* @var Student $student */
        $response[] = [
            'id' => $student->getId(),
            'firstname' => $student->getFirstName(),
            'lastname' => $student->getLastName(),
            'school' => [
                'id' => $student->getSchool()->getId(),
                'name' => $student->getSchool()->getName(),
            ],
        ];
    }
    // Envoi de la réponse ( on encode notre tableau au format json ).
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
            'id' => $student->getSchool()->getId(),
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