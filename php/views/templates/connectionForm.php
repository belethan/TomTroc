<?php
    $mail='';
    if(isset($_SESSION['mail']))
    {
        $mail=$_SESSION['mail'];
    }
?>
<section class="container-inscription">
    <div class="left-column">
        <h1>Connexion</h1>
        <form action="index.php?action=login" method="post">
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email" placeholder="Adresse mail" value="<?php echo $mail;?>" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <div class="login-link">
            <p>Pas de compte ? <a href="index.php?action=inscription">inscrivez-vous</a></p>
            <?php if(isset($_SESSION['error'])!=""){
                echo '<p class="alerte">'.$_SESSION['error'].'</p>';
            }?>
        </div>

    </div>
    <div class="right-column">
        <img src="../../images/inscription.png" alt="Image Bibliothéque">
    </div>
</section>
