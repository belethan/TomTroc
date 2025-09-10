<?php

?>
<section class="container" role="main">
    <Div class="section-exchange">
        <h1 >Nos livres à l'échange</h1>
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <label>
                <input type="text" id="searchbooks" placeholder="Rechercher un livre">
            </label>
        </div>
    </Div>
    <div class="livre-grid">
        <?php if (!empty($livredata)): ?>
            <?php foreach ($livredata as $livre): ?>
                <article class="Card-livre">
                    <img src="<?= htmlspecialchars($livre->getphotoLivre()) ?>" alt="livre image"  class="Card-livre_img">
                    <a href="index.php?action=showLivreReadOnly&keybook=<?=$livre->getid() ?>" class="Card-livre_titre">
                        <?= htmlspecialchars($livre->gettitreLivre()) ?>
                    </a>
                    <div class="Card-livre_Auteur">
                        <?= htmlspecialchars($livre->getnomAuteur()) ?>
                    </div>
                    <div class="Card-livre_VenduPar">
                        vendu par : <?= htmlspecialchars($livre->getPseudoUtilisateur()) ?>
                    </div>
                    <div class="<?= ($livre->getstatutLivre() ===1) ? "card-livre_statut_dispo":"card-livre_statut_indispo" ?>">
                        <?= ($livre->getstatutLivre() ===1) ? 'Disponible' : 'Non Dispo.'; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <span>Aucun livre trouvé</span>
        <?php endif; ?>
    </div>
</section>
