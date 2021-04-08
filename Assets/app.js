
let studentListButton = document.getElementById("students-list");

/**
 * Récupération de la liste des utilisateurs au click du bouton.
 */
studentListButton.addEventListener("click", function (e) {
   let xhr = new XMLHttpRequest();
   xhr.onload = function () {
       // Les données sont là :-)
       const students = JSON.parse(xhr.responseText);
       const table = document.querySelector('#student-list-content tbody');
       table.innerHTML = '';

       for (let student of students) {
           let tr = document.createElement('tr');
           let id = document.createElement("td");
           let firstname = document.createElement("td");
           let lastname = document.createElement("td");
           let school = document.createElement("td");

           id.innerHTML = student.id;
           firstname.innerHTML = student.firstname;
           lastname.innerHTML = student.lastname;
           school.innerHTML = student.school.name;

           tr.append(id, firstname, lastname, school);
           table.append(tr);
       }
       table.parentElement.style.display = 'table';
   }

   xhr.open('GET','/api/students');
   xhr.send();
});