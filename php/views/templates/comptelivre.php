<?php
    $dialogAuthorise = "Vous devez vous identifier pour envoyer un message" ;
    if (isset($_SESSION['user'])) {
        $dialogAuthorise= $_SESSION['user']['id'] !== $userobjet->getIdUtilisateur() ? "" : "Vous ne pouvez pas vous envoyer un message !";
    }
?>
<div class="container" role="main">
    <div class="compteLivre">
        <section class="left-sectionLivre">
            <div class="infouser">
                <div class="visageimg">
                    <img id="visage" src="<?php echo $userobjet->getPhotoUtilisateur(); ?>" alt="Image Profil" class="profile-img">
                </div>
                <div class="divider"></div>
                <div class="labels">
                        <h3><?=$userobjet->getPseudoUtilisateur();?></h3>
                        <p class="label-Nom"><?= $userobjet->anciennete(); ?></p>
                        <p class="biblio">Bibliothéque</p>
                        <p class="book-paragraph">
                            <img src="../images/LivreTexte.svg" alt="Livres" class="book-icon">
                            <span class="book-count"><?=$nblivre;?></span>
                            livres
                        </p>
                </div>
<!--                <button id="btnMessage" class="comptebutton" onclick="window.location.href='index.php?action=dialoguser'">Ecrire un message</button>-->
                <a href="index.php?action=dialoguser&keyIdUser=<?= $userobjet->getIdUtilisateur() ?>" id="btnMessage" class="comptebutton">
                    <?php if (isset($dialogAuthorise) && !empty($dialogAuthorise)): ?>
                        data-bs-toggle="popover"
                        data-bs-trigger="focus"
                        data-bs-content="<?= htmlspecialchars($dialogAuthorise) ?>"
                    <?php endif; ?>
                    Ecrire un message
                </a>
            </div>
        </section>
        <section class="full-width-section">
            <div class="table-wrapper">
                <table class="compte-table">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th>disponibilité</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($livres)): ?>
                            <?php foreach ($livres as $livre): ?>
                                    <tr>
                                        <td data-label="Photo">
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
            <div class="card-view">
                <?php if (!empty($livres)): ?>
                    <?php foreach ($livres as $livre): ?>
                        <div class="cardcompte">
                            <div>
                                <div class="top-section">
                                    <img src="<?= htmlspecialchars($livre->getphotoLivre()) ?>" alt="Image">
                                    <div class="infocompte">
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
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card">
                        <span>Aucun livre trouvé</span>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
