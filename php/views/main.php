<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */

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
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Lien vers un fichier CSS -->
</head>
<body>
<header class="navbar container" role="presentation">
    <div class="logo-title">
        <div class="logo_cadre">
            <img src="../images/LogoTitre.svg" alt="Logo TomTroc" class="logo">
        </div>
        <span class="site_title">Tom Troc </span>
    </div>
    <div class="navbar-main">
        <div class="navbar-left">
            <ul class="navbar-links-left">
                <li class="navbar-link-left"><a href="#">Accueil</a></li>
                <li class="navbar-link-left"><a href="#">Nos livres à l'échange</a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <ul class="navbar-links-right">
                <li class="navbar-msg-left navbar-link-right"><a href="#" class="bulle">Messagerie <span class="badge">5</span> </a></li>
                <li  class="navbar-link-right"><a href="#">Mon compte</a></li>
                <li  class="navbar-link-right"><a href="#">Connexion</a></li>
            </ul>
        </div>
    </div>
    <div class="burger"> <!--show-burger-->
        <ul class="navbar-links-burger">
            <li class="navbar-link-burger"><a href="#">Accueil</a></li>
            <li class="navbar-link-burger"><a href="#">Nos livres à l'échange</a></li>
            <li class="navbar-link-burger"><a href="#">Messagerie</a></li>
            <li  class="navbar-link-burger"><a href="#">Mon compte</a></li>
            <li  class="navbar-link-burger"><a href="#">Connexion</a></li>
        </ul>
        <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
        <button class="btn-burger">
            <span class="bar"> </span>
        </button>
    </div>
</header>
<main>
    <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
</main>
<footer>
    <p>Copyright © TomTroc - Openclassrooms - </p>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>