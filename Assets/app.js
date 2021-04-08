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
                    console.log(studentXhr.responseText);
                }

                studentXhr.open('GET', this.href);
                studentXhr.send();
            });
        }
    };

    xhr.open('GET', '/api/students');
    xhr.send();
});