<?php
 //Initialisation du gestionnaire d'utilisateurs
    if (isset($_SESSION['user'])) {
        $userobjet = $_SESSION['user'];
    }
?>
<div class="main-dialogue">
    <div class="sidebar">
        <div class="infotitre">
            <h1>Messagerie</h1>
        </div>
        <?php foreach ($msgUser as $msg): ?>
            <div class="user-card-select" data-id="<?= $msg->getDeMessagerie() ?>">
            <img src="<?= $msg->getPhotoUtilisateur() ?>">
            <div class="user-info">
                <div class="user-header">
                    <span class="user-memo"><?= $msg->getPseudoUtilisateur() ?></span>
                    <span class="user-memo"><?= $msg->getheureMsg() ?></span>
                </div>
                <div class="user-text">
                    <?= $msg->getMsgMessagerie() ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="chat-area" id="chat-area">
        <div class="user-info">
            <img class="logo-chat" src="<?= $useraskView->getPhotoUtilisateur() ?>">
            <span class="user-memo"><?= $useraskView->getPseudoUtilisateur() ?></span>
        </div>
        <?php foreach ($dialogues as $msg): ?>
            <div class="message-block">
                <div class="message-meta<?php if ($msg->getDeMessagerie() == $userobjet->getId()) echo '-right'; else echo ''; ?>">
                    <img class="photo-carree" src="<?= $msg->getPhotoUtilisateur() ?>" alt="Photo">
                    <span><?=$msg->getheureComplet() ?></span>
                </div>
                <div class="message <?php if ($msg->getDeMessagerie() == $userobjet->getId()) echo 'right'; else echo 'left'; ?>">
                    <?= htmlspecialchars($msg->getMsgMessagerie()) ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="input-area">
            <form class="input-area" action="#" method="POST">
                <input type="text" name="message" placeholder="Tapez votre message ici ...">
                <!-- Champs cachés initialisés en PHP -->
<!--                <input type="hidden" name="demsg" value="--><?php //= $userObjet->getId(); ?><!--">-->
<!--                <input type="hidden" name="destinataire" value="--><?php //= $useraskView->getPourMessagerie(); ?><!--">-->
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</div>
