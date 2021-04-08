let studentListButton = document.getElementById('students-list');

/**
 * Récupération de la liste des utilisateurs au click du bouton.
 */
studentListButton.addEventListener('click', function(e) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        // Les données sont la :-)
        const students = JSON.parse(xhr.responseText);
        const table = document.querySelector('#student-list-content tbody');
        table.innerHTML = '';

        for(let student of students) {
            table.innerHTML += `
                <tr>
                    <td>${student.id}</td>
                    <td>${student.firstname}</td>
                    <td>${student.lastname}</td>
                    <td>${student.school.name}</td>
                    <td>
                        <a class="get-student" href="/api/students?id=${student.id}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            `;
        }

        table.parentElement.style.display = 'table';

        /**
         * Récupération de tous les neneuils.
         */
        let eyes = document.getElementsByClassName('get-student');
        for(let eye of eyes) {
            const studentXhr = new XMLHttpRequest();
            eye.addEventListener('click', function(e) {
                // On annule l'action par défaut.
                e.preventDefault();
                studentXhr.onload = function () {
                    const student = JSON.parse(studentXhr.responseText);
                    const divStudent = document.getElementById('student-content');
                    divStudent.innerHTML = `
                        <div class="card w-75 shadow-lg p-3 mb-5 bg-white roudded">
                            <h5 class="card-header">Informations de l'élève</h5>
                          <div class="card-body">
                            <h5 class="card-title">${student.firstname} ${student.lastname}</h5>
                            <p class="card-text">ID : ${student.id}</p>
                            <p class="card-text">Ecole : ${student.school.name}</p>
                            <a href="#" class="btn btn-primary">Supprimer</a>
                            <a href="#" class="btn btn-primary">Modifier</a>
                          </div>
                        </div>
                    `;
                    divStudent.style.display = "block";
                }

                studentXhr.open('GET', this.href);
                studentXhr.send();
            });
        }
    };

    xhr.open('GET', '/api/students');
    xhr.send();
});