<?php

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
            <img src="../images/livre-neutre.png" class="imageupd-img" alt="Grande photo">
            <br>
            <label for="img_tomtroc" class="label-like-link">Modifier</label>
            <input type="file" name="img_tomtroc" id="img_tomtroc" accept="image/* " >
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
                <select id="statut_Livre" name="statut_Livre" value="0">
                    <option value="1">Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
                <button type="submit">Valider</button>
            </div>
    </form>
</div>

