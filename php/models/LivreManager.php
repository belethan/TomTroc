<?php

class LivreManager extends AbstractEntityManager
{
    /**
     * Cette méthode a pour but de récupérer les quatre derniers livres sauvegardés en base de données,
     * avec un statut actif (), les trier par date de création en ordre décroissant,
     * et ensuite retourner ces livres sous forme d'objets `livre`
     */
    public function getFourPicture() : array
    {
        $sql = "SELECT * FROM livres WHERE Statut_Livre = 1 ORDER BY DteCreation DESC LIMIT 4";
        $result = $this->db->query($sql);

        $books = []; // Initialise le tableau pour les livres

        while ($bookRow = $result->fetch()) {
            $books[] = new livre($bookRow); // Ajoute chaque livre au tableau
        }
        return $books; // Renvoie un tableau, même s'il est vide
    }
}