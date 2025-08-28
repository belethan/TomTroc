<?php
    $titre = "Modifier le livre";
?>
<div class="wrapper">
    <div class="infotitre">
        <a href="index.php?action=infouser" class="retour">&larr; Retour</a>
<!--        href="javascript:history.back()" autre manière de faire-->
        <h1><?php echo $titre ;?></h1>
    </div>
    <form  action="index.php?action=livresave&mode=1" method="post" enctype="multipart/form-data" class="container-updLivre">
        <!--       <form action="#" method="post">-->
        <div class="imageUpd-section">
            <img src="https://picsum.photos/488/553"  class="imageupd-img" alt="Grande photo">
            <br>
            <input type="file" name="photo_livre" id="fileInput" accept="image/*" >
            <label for="fileInput" class="label-like-link">Modifier</label>
        </div>
        <div class="form-sectionupd">
            <div class="formulaire" >
                <label for="titre_Livre">Titre</label>
                <input class="form-input" type="text" id="titre_Livre" name="titre_Livre">

                <label for="nom_Auteur">Auteur</label>
                <input class="form-input" type="text" id="nom_Auteur" name="nom_Auteur">

                <label for="commentaire">Commentaire</label>
                <textarea class="form-textarea" id="commentaire" name="commentaire" style=""></textarea>
                <label for="statut_Livre">Statut</label>
                <select id="statut_Livre" name="statut_Livre">
                    <option value="disponible">Disponible</option>
                    <option value="indisponible">Indisponible</option>
                </select>
                <button type="submit">Valider</button>
            </div>
    </form>
</div>

