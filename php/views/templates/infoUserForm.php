<?php
// Initialisation du gestionnaire d'utilisateurs
//    if (isset($_SESSION['user'])) {
//        $userobjet = $_SESSION['user'];
//    }
?>
<div class="titre">
    <h1 >Mon Compte</h1>
</div>
<div class="compte">
    <!--1er bloc à gauche-->
    <section class="left-section">
            <div class="infouser">
                <form action="index.php?action=saveuser" method="post" enctype="multipart/form-data">
                <div class="visageimg">
                    <img id="visage" src=<?php echo $userobjet->getPhotoUtilisateur(); ?> alt="Image Profil class="profile-img">
                </div>
                    <input type="file" name="img_tomtroc" id="img_tomtroc" accept="image/*" " >
                <label for="img_tomtroc" class="label-like-link">Modifier</label>
                <div id="error-message"></div>
                <div class="divider"></div>
                <div class="labels">
                    <h3><?=$userobjet->getPseudoUtilisateur();?></h3>
                    <p class="label-Nom"><?php echo $userobjet->anciennete(); ?></p>
                    <p class="biblio">Bibliothéque</p>
                    <p class="book-paragraph">
                        <img src="../images/LivreTexte.svg" alt="Livres" class="book-icon">
                        <span class="book-count"><?=$nblivre;?></span>
                        livres
                    </p>
                </div>
           </div>
    </section>

    <!--2eme bloc à droite-->
        <aside class="right-aside">
            <div class="carduser">
                <div class="PersoData">
                    <h2>Vos informations personnelles</h2>
                    <div class="PersoData">
                        <label for="email">Adresse Mail</label>
                        <input type="email" id="email" name="email" value="<?php echo $userobjet->getMailUtilisateur(); ?>"required>
                    </div>
                    <div class="PersoData">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" value="<?php echo $userobjet->getPwdUtilisateur(); ?>"required>
                    </div>
                    <div class="PersoData">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" id="pseudo" name="pseudo" value="<?php echo $userobjet->getPseudoUtilisateur(); ?>" required>
                    </div>
                    <button type="submit">Enregistrer</button>
                </div>
            </div>
        </aside>
    </form>
</div>

<!--Bloc du bas Tableau-->
<section class="full-width-section">
    <div class="btnAddContainer">
        <a href="index.php?action=newlivre&mode=1&utilisateur=<?php echo $userobjet->getid(); ?>" class="bouton-ajout">Ajouter un nouveau Livre</a>
    </div>
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
                <th>disponibilité</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($livres)): ?>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td data-label="Photo">
<!--                            ?? 'https://picsum.photos/50'-->
                            <img src="<?= htmlspecialchars($livre->getphotoLivre()) ?>"alt="Miniature" width="50">
                        </td>
                        <td data-label="Titre"><?= htmlspecialchars($livre->gettitreLivre()) ?></td>
                        <td data-label="Auteur"><?= htmlspecialchars($livre->getnomAuteur()) ?></td>
                        <td data-label="Description"><?= htmlspecialchars($livre->getCourtCommentaire(50)) ?></td>
                        <td data-label="Disponibilite" class="statut-cell">
                            <span class="<?= ($livre->getstatutLivre() ===1) ? 'badge-dispo' : 'badge-indispo'; ?>">
                                <?= $livre->getdispolabel()?>
                            </span>
                        </td>
                        <td class="actions" data-label="Actions">
<!--                            <a href="edit.php?id=--><?php //= urlencode($livre->id) ?><!--" class="edit">Éditer</a>-->
<!--                            <a href="delete.php?id=--><?php //= urlencode($livre->id) ?><!--" class="delete">Supprimer</a>-->
                            <a href="index.php?action=editlivre&mode=2&utilisateur=<?= urlencode($userobjet->getId()); ?>&keyinfo=<?= urlencode($livre->getId()); ?>" class="edit">Éditer</a>
                            <a href="#" class="delete"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmDellivreModal"
                                data-id="<?= $livre->getId() ?>"
                                data-titre="<?= htmlspecialchars($livre->gettitreLivre()) ?>"
                                data-auteur="<?= htmlspecialchars($livre->getnomAuteur()) ?>">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun livre trouvé</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal de confirmation -->
    <?php if (!empty($livres)): ?>
        <div class="modal fade" id="confirmDellivreModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="index.php?action=livredelete&keylivre=<?=urlencode($livre->getId());?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <p id="modal-message"></p>
                            <input type="hidden" name="delete_id" id="delete-id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="card-view">
        <?php if (!empty($livres)): ?>
            <?php foreach ($livres as $livre): ?>
                <div class="card">
                    <div>
                        <div class="top-section">
                            <img src="<?= htmlspecialchars($livre->getphotoLivre()) ?>" alt="Image">
                            <div class="info">
                                <h3><?= htmlspecialchars($livre->gettitreLivre()) ?></h3>
                                <p><?= htmlspecialchars($livre->getnomAuteur()) ?></p>
                                <div class="<?= ($livre->getstatutLivre() ===1) ? 'badge-dispo' : 'badge-indispo'; ?>">
                                    <?= $livre->getdispolabel()?>
                                </div>
                            </div>
                        </div>
                        <div class="text-zone">
                            <?= htmlspecialchars($livre->getCourtCommentaire(280)) ?>
                        </div>
                    </div>
                    <div class="button-group">
                        <a href="index.php?action=editlivre&mode=2&utilisateur=<?= urlencode($userobjet->getId()); ?>&keyinfo=<?= urlencode($livre->getId()); ?>" class="edit">Éditer</a>
                        <a href="#" class="delete">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card">
                <span>Aucun livre trouvé</span>
            </div>
        <?php endif; ?>
    </div>
</section>
