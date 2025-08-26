<?php

?>
<div class="wrapper">
    <div class="infotitre">
      <a href="#" class="retour">&larr; Retour</a>
      <h1><?php echo $titre?></h1>
    </div>
    <div class="container-updLivre" role="main">
      <form action="#" method="post">
          <div class="imageUpd-section">
            <img src="https://picsum.photos/488/553"  class="imageupd-img" alt="Grande photo">
            <br>
            <a href="#">Modifier la photo</a>
          </div>

          <div class="PersoData">

              <label for="titre">Titre</label>
              <input type="text" id="titre" name="titre">

              <label for="auteur">Auteur</label>
              <input type="text" id="auteur" name="auteur">

              <label for="commentaire">Commentaire</label>
              <textarea id="commentaire" name="commentaire" style=""></textarea>
              <label for="statut">Statut</label>
              <select id="statut" name="statut">
                <option value="disponible">Disponible</option>
                <option value="indisponible">Indisponible</option>
              </select>

              <button type="submit">Valider</button>
            </form>
      </div>
</div>
