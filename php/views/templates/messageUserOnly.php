<?php

    //Initialisation du gestionnaire d'utilisateurs
    if (isset($_SESSION['user'])) {
        $userobjet = $_SESSION['user'];
        $userCnx = $_SESSION['keyIdUser'];
    }
?>
<!--<div class="main-dialogue">-->
    <div class="chat-area-mini" id="chat-area">
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
                    <?= htmlspecialchars_decode($msg->getMsgMessagerie()) ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="input-area">
            <form class="input-area" action="index.php?action=sendmessage" method="POST">
                <input type="text" name="message" placeholder="Tapez votre message ici ...">
                <!-- Champs cachés initialisés en PHP -->
                <input type="hidden" name="demsg" value="<?=$userCnx; ?>">
                <input type="hidden" name="destinataire" value="<?=$useraskView->getid(); ?>">
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>

<!--</div>-->