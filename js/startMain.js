$(document).ready(function () {

       $('#update-user').on('submit', function (e) {
           e.preventDefault(); // Empêche le rechargement normal du formulaire
           $.ajax({
               url: $(this).attr('action'),
               method: $(this).attr('method'),
               data: $(this).serialize(), // Récupère toutes les données du formulaire
               success: function (response) {
                   $('#user-message').html('<div class="alert alert-success">Informations mises à jour !</div>');
                   // Optionnel : mettre à jour d'autres parties de la page.
               },
               error: function () {
                   $('#user-message').html('<div class="alert alert-danger">Erreur lors de la mise à jour</div>');
               }
           });
       });
});
