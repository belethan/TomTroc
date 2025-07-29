<?php

?>
<section class="container-inscription">
    <div class="left-column">
        <h1>Inscription</h1>
        <form action="index.php?action=newUtilisateur" method="post">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo_Utilisateur" id="pseudo" placeholder="Pseudo" required>
            <label for="email">Adresse mail</label>
            <input type="email" name="mail_Utilisateur" id="email" placeholder="Adresse mail" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="mdp_Utilisateur" id="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <div class="login-link">
            <p>Déjà inscrit ? <a href="index.php?action=inscription">Connectez-vous</a></p>
        </div>
    </div>
    <div class="right-column">
        <img src="../../images/inscription.png" alt="Image Bibliothéque">
    </div>
</section>
