<?php
 //Initialisation du gestionnaire d'utilisateurs
    if (isset($_SESSION['user'])) {
        $userobjet = $_SESSION['user'];
    }

?>
<?php foreach ($dialogues as $msg): ?>
    <div class="message-block">
        <div class="message-meta">
            <img class="photo-carree" src="<?= $msg->getPhotoUtilisateur() ?>" alt="Photo">
            <span><?=$msg->getheureComplet() ?></span>
        </div>
        <div class="message
                    <?php if ($msg->getDeMessagerie() == $userobjet->getId()): ?>
                        right
                    <?php else: ?>
                        left
                    <?php endif; ?>">
            <?= htmlspecialchars($msg->getMsgMessagerie()) ?>
        </div>
    </div>
<?php endforeach; ?>