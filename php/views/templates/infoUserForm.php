<?php
// Initialisation du gestionnaire d'utilisateurs
    if (isset($_SESSION['user'])) {
        $userobjet = $_SESSION['user'];
    }
?>
<div class="titre">
    <h1 >Mon Compte</h1>
</div>
<div class="compte">
    <!--1er bloc à gauche-->

    <section class="left-section">
            <div class="infouser">
                <form action="index.php?action=saveuser" method="post" enctype="multipart/form-data">
                <img id="visage" src=<?php echo JS_IMAGE.'user_picture/'.$userobjet->getPhotoUtilisateur() ?> alt="Image Profil" class="profile-img">
                <input type="file" name="photo_profil" id="fileInput" accept="image/*" " >
                <label for="fileInput" class="label-like-link">Modifier</label>
                <div id="error-message"></div>
                <div class="divider"></div>
                <div class="labels">
                    <h3>nathalire</h3>
                    <p class="label-Nom"><?php echo $userobjet->anciennete(); ?></p>
                    <p class="biblio">Bibliothéque</p>
                    <p class="book-paragraph">
                        <img src="../../images/LivreTexte.svg" alt="Livres" class="book-icon">
                        <span class="book-count">4 </span>
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
        <form action=index.php?action=newlivre&utilisateur=<?php echo $userobjet->getid(); ?> method="get" enctype="multipart/form-data">
            <button type="submit" class="bouton-ajout">Ajouter un nouveau livre</button>
        </form>

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
            <tr>
                <td data-label="Photo"><img src="https://picsum.photos/50" alt="Miniature"></td>
                <td data-label="Titre">Produit A</td>
                <td data-label="Auteur">Électronique</td>
                <td data-label="Description">Un petit appareil utile</td>
                <td data-label="disponibilité">22/05/2025</td>
                <td class="actions" data-label="Actions">
                    <a href="#" class="edit">Éditer</a>
                    <a href="#" class="delete">Supprimer</a>
                </td>
            </tr>

            <tr>
                <td data-label="Photo"><img src="https://picsum.photos/50" alt="Miniature"></td>
                <td data-label="Titre">Produit B</td>
                <td data-label="Auteur">Maison</td>
                <td data-label="Description">Objet décoratif</td>
                <td data-label="Date">15/04/2025</td>
                <td class="actions" data-label="Actions">
                    <a href="#" class="edit">Éditer</a>
                    <a href="#" class="delete">Supprimer</a>
                </td>
            </tr>
            <tr>
                <td data-label="Photo"><img src="https://picsum.photos/50" alt="Miniature"></td>
                <td data-label="Titre">Produit B</td>
                <td data-label="Auteur">Maison</td>
                <td data-label="Description">Objet décoratif</td>
                <td data-label="Date">15/04/2025</td>
                <td class="actions" data-label="Actions">
                    <a href="#" class="edit">Éditer</a>
                    <a href="#" class="delete">Supprimer</a>
                </td>
            </tr>
            <tr>
                <td data-label="Photo"><img src="https://picsum.photos/50" alt="Miniature"></td>
                <td data-label="Titre">Produit B</td>
                <td data-label="Auteur">Maison</td>
                <td data-label="Description">Objet décoratif</td>
                <td data-label="Date">15/04/2025</td>
                <td class="actions" data-label="Actions">
                    <a href="#" class="edit">Éditer</a>
                    <a href="#" class="delete">Supprimer</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="card-view">
        <div class="card">
            <div>
                <div class="top-section">
                    <img src="https://picsum.photos/80" alt="Image">
                    <div class="info">
                        <h3>The Kinkfolk Table</h3>
                        <p>Nathan Williams</p>
                        <div class="badge">disponible</div>
                    </div>
                </div>
                <div class="text-zone">
                    J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
                    le savoir de tous est bizarre et je ne sais pas quoi écrire en plus pour faire un max de ligne et
                    voir si cela déborde.
                </div>
            </div>
            <div class="button-group">
                <button>Éditer</button>
                <button class="delbtn">Supprimer</button>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="top-section">
                    <img src="https://picsum.photos/80" alt="Image">
                    <div class="info">
                        <h3>The Kinkfolk Table</h3>
                        <p>Nathan Williams</p>
                        <div class="badge">disponible</div>
                    </div>
                </div>
                <div class="text-zone">
                    J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
                    le savoir de tous est bizarre et je ne sais pas quoi écrire en plus pour faire un max de ligne et
                    voir si cela déborde.
                </div>
            </div>
            <div class="button-group">
                <button>Supprimer</button>
                <button>Éditer</button>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="top-section">
                    <img src="https://picsum.photos/80" alt="Image">
                    <div class="info">
                        <h3>The Kinkfolk Table</h3>
                        <p>Nathan Williams</p>
                        <div class="badge">disponible</div>
                    </div>
                </div>
                <div class="text-zone">
                    J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
                    le savoir de tous est bizarre et je ne sais pas quoi écrire en plus pour faire un max de ligne et
                    voir si cela déborde.
                </div>
            </div>
            <div class="button-group">
                <button>Supprimer</button>
                <button>Éditer</button>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="top-section">
                    <img src="https://picsum.photos/80" alt="Image">
                    <div class="info">
                        <h3>The Kinkfolk Table</h3>
                        <p>Nathan Williams</p>
                        <div class="badge">disponible</div>
                    </div>
                </div>
                <div class="text-zone">
                    J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre
                    le savoir de tous est bizarre et je ne sais pas quoi écrire en plus pour faire un max de ligne et
                    voir si cela déborde.
                </div>
            </div>
            <div class="button-group">
                <button>Supprimer</button>
                <button>Éditer</button>
            </div>
        </div>
    </div>
</section>
