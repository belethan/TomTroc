<?php
// Supposons que $livre est passé en paramètre
// et que ses méthodes sont du type getTitre(), getAuteur(), etc.
 $titre = ($mode==1) ? "Ajouter un livre" : "Modifier un livre";
 $livre = $livredata;
?>

<div class="wrapper">
    <div class="infotitre">
        <a href="index.php?action=infouser" class="retour">&larr; Retour</a>
        <h1><?php echo htmlspecialchars($titre); ?></h1>
    </div>

    <form action="index.php?action=livresave&mode=<?=$mode;?>&keylivre=<?=$livre->getid();?>" method="post" enctype="multipart/form-data" class="container-updLivre">
        <!-- Champ caché pour passer l'ID du livre (important pour l'édition) -->
        <div class="imageUpd-section">
            <img src="<?= $livre->getphotoLivre()===null ? '../images/livre-neutre.png' :htmlspecialchars($livre->getphotoLivre());?>"
                 class="imageupd-img"
                 alt="Photo du livre">
            <br>
            <label for="img_tomtroc" class="label-like-link">Modifier</label>
            <input type="file" name="img_tomtroc" id="img_tomtroc" accept="image/*" value="<?= htmlspecialchars($livre->getphotoLivre()); ?>">
        </div>

        <div class="form-sectionupd">
            <div class="formulaire">
                <label for="titre_Livre">Titre</label>
                <input class="form-input"
                       type="text"
                       id="titre_Livre"
                       name="titre_Livre"
                       value="<?= htmlspecialchars($livre->gettitreLivre()); ?>">

                <label for="nom_Auteur">Auteur</label>
                <input class="form-input"
                       type="text"
                       id="nom_Auteur"
                       name="nom_Auteur"
                       value="<?= htmlspecialchars($livre->getnomAuteur()); ?>">

                <label for="commentaire">Commentaire</label>
                <textarea class="form-textarea"
                          id="commentaire"
                          name="commentaire"><?= htmlspecialchars($livre->getCommentaire()); ?></textarea>

                <label for="statut_Livre">Statut</label>
                <select id="statut_Livre" name="statut_Livre">
                    <option value="1" <?= $livre->getstatutLivre() == 1 ? 'selected' : ''; ?>>Disponible</option>
                    <option value="0" <?= $livre->getstatutLivre() == 0 ? 'selected' : ''; ?>>Indisponible</option>
                </select>

                <button type="submit">Valider</button>
            </div>
        </div>
    </form>
</div>

