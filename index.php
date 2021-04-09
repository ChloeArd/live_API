<?php
/**
 * Méthode HTTP	   Endpoint	         Action
 * -------------   ----------        --------
 * GET		       /api/students     Liste les étudiants.
 * GET		       /api/students?id  Visualisation d'un seul étudiant.
 *
 * POST	           /api/students     Ajoute un nouvel étudiant.
 * PUT		       /api/students?id  Modifie un étudiant.
 * DELETE	       /api/students?id  Supprimer un étudiant.
 *
 */
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/Assets/style.css">
    <title>Test API</title>
</head>
<body>

<div class="container mt-4">
    <div class="d-flex w-50 justify-content-between">
        <button id="students-list" class="btn btn-rounded btn-primary">Liste des étudiants</button>
        <button id="student-add-button" type="button" class="btn btn-secondary btn-floating">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div id="students">
        <table style="display: none" id="student-list-content" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>School Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div style="display: none" id="student-content"></div>
    </div>

    <div id="student-add-form" style="display: none">
        <form class="mt-2">
            <div class="form-group">
                <input class="form-control" type="text" name="firstname" placeholder="Prénom">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="lastname" placeholder="Nom">
            </div>
            <div class="form-group">
                <select class="form-control" name="school" id="school"></select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/fontawesome.min.js" integrity="sha512-KCwrxBJebca0PPOaHELfqGtqkUlFUCuqCnmtydvBSTnJrBirJ55hRG5xcP4R9Rdx9Fz9IF3Yw6Rx40uhuAHR8Q==" crossorigin="anonymous"></script>
<script src="Assets/app.js"></script>
</body>
</html>
