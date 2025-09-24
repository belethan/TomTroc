<?php

?>
<div class="container-livre">
    <div class="left-column">
        <img src=" <?= htmlspecialchars($livre->getphotoLivre()) ?>" alt="<?= htmlspecialchars($livre->gettitreLivre()) ?>">
    </div>
    <div class="right-column">
        <h1><?= htmlspecialchars($livre->gettitreLivre()) ?></h1>
        <p><em> <?= htmlspecialchars($livre->getnomAuteur()) ?></em></p>
        <div class="separator"></div>
        <h4>Description</h4>
        <p>
            <?= htmlspecialchars($livre->getCommentaire()) ?>
        </p>
        <h4>Propriétaire</h4>
        <div class="owner">
            <img src="<?= htmlspecialchars($livre->getPhotoUtilisateur()) ?>" alt="Propriétaire">
            <span>
                <a href="index.php?action=userlivre&keyIdUser=<?= $livre->getIdUtilisateur() ?>">
                    <?= htmlspecialchars($livre->getPseudoUtilisateur()) ?>
                </a>
            </span>
        </div>

        <a href="index.php?action=dialoguser&keyIdUser=<?= $livre->getIdUtilisateur() ?>"
           id="btnMessage"
           class="message-button"
            <?php if (isset($msgdial) && !empty($msgdial)): ?>
                data-bs-toggle='popover'
                data-bs-trigger='focus'
                data-bs-content='<?= htmlspecialchars($msgdial) ?>'
            <?php endif; ?>
            >Envoyer un message</a>
    </div>

</div>
