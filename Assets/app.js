
let studentListButton = document.getElementById("students-list");

/**
 * Récupération de la liste des utilisateurs au click du bouton.
 */
studentListButton.addEventListener("click", function (e) {
   let xhr = new XMLHttpRequest();
   xhr.onload = function () {
       // Les données sont là :-)
       const students = xhr.responseText;
       console.log(students);
   }

   xhr.open('GET','/api/students');
   xhr.send();
});