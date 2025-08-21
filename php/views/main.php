<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */
// conteneur de messages non lu via chat
$_SESSION['msgcpt']=0;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <!--Import des polices depuis Google Fonts -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/styles.css"> <!-- Lien vers un fichier CSS -->
</head>
<body>
    <header class="navbar container" role="presentation">
        <div class="logo-title">
            <div class="logo_cadre">
                <img src="../../images/LogoTitre.svg" alt="Logo TomTroc" class="logo">
            </div>
            <span class="site_title">Tom Troc </span>
        </div>
        <div class="navbar-main">
            <div class="navbar-left">
                <ul class="navbar-links-left">
                    <li class="navbar-link-left"><a href="index.php?action=home">Accueil</a></li>
                    <li class="navbar-link-left"><a href="#">Nos livres à l'échange</a></li>
                </ul>
            </div>
            <div class="navbar-right">
                <ul class="navbar-links-right">
                    <?php utils::UserMenu(); ?>
                </ul>
            </div>
        </div>
        <div class="burger"> <!--show-burger-->
            <ul class="navbar-links-burger">
                <li class="navbar-link-burger"><a href="index.php?action=home">Accueil</a></li>
                <li class="navbar-link-burger"><a href="#">Nos livres à l'échange</a></li>
                <?php  utils::UserMenu('navbar-link-burger'); ?>
            </ul>
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <button class="btn-burger">
                <span class="bar"> </span>
            </button>
        </div>
    </header>
    <?php if (!empty($_SESSION['alert'])): ?>

        <div id="alertMessage" class="alert alert-<?= $_SESSION['alert']['type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['alert']['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
        <?php unset($_SESSION['alert']); ?>
<!--    script javascript pour la disparition automatique de l'alerte-->
        <script>
            // Disparition automatique au bout de 5 secondes
            setTimeout(() => {
                let alert = document.getElementById('alertMessage');
                if (alert) {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        </script>
    <?php endif; ?>
    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    <footer>
        <p>Copyright © TomTroc - Openclassrooms - </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../../js/menu.js"></script>

</body>
</html>