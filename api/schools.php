<?php
/* alexis.laroche.02240@gmail.com */
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/School.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/SchoolManager.php';


use App\Entity\School;
use App\Manager\SchoolManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new SchoolManager();

switch($requestType) {
    // Obtention d'informations.
    case 'GET':
        echo getSchools($manager);
        break;
    default:
        break;
}

/**
 * Return the schools list.
 * @param SchoolManager $manager
 * @return false|string
 */
function getSchools(SchoolManager $manager): string {
    $response = [];
    // Obtention des students.
    $data = $manager->getSchools();
    foreach($data as $school) {
        /* @var School $student */
        $response[] = [
            'id' => $school->getId(),
            'name' => $school->getName(),
        ];
    }
    return json_encode($response);
}