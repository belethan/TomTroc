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

    public function LivreSauvegarder(int $modework=1,livre $livre) : bool{
        if ($modework === 1) {
            // INSERT - Création d'un nouveau livre
            $sql = "INSERT INTO livres (Titre_Livre, ID_Auteur, Photo_Livre, ID_Utilisateur, Statut_Livre, Commentaire)
                    VALUES (:titre, :idAuteur, :photo, :idUtilisateur, :statut, :commentaire)";
            $stmt = $this->db->prepare($sql);

            $result = $stmt->execute([
                ':titre'         => $livre->getTitreLivre(),
                ':idAuteur'      => $livre->getIDAuteur(),
                ':photo'         => $livre->getPhotoLivre(),
                ':idUtilisateur' => $livre->getIDUtilisateur(),
                ':statut'        => $livre->getStatutLivre(),
                ':commentaire'   => $livre->getCommentaire(),
            ]);
        } else {
            // UPDATE - Modification d'un livre existant
            $sql = "UPDATE livres SET 
                    Titre_Livre = :titre, 
                    ID_Auteur = :idAuteur, 
                    Photo_Livre = :photo, 
                    ID_Utilisateur = :idUtilisateur, 
                    Statut_Livre = :statut, 
                    Commentaire = :commentaire
                    WHERE ID_Livre = :idLivre";
            $stmt = $this->db->prepare($sql);

            $result = $stmt->execute([
                ':titre'         => $livre->getTitreLivre(),
                ':idAuteur'      => $livre->getIDAuteur(),
                ':photo'         => $livre->getPhotoLivre(),
                ':idUtilisateur' => $livre->getIDUtilisateur(),
                ':statut'        => $livre->getStatutLivre(),
                ':commentaire'   => $livre->getCommentaire(),
                ':idLivre'       => $livre->getId(), // Nécessaire pour identifier le livre à modifier
            ]);
        }

        return $result && $stmt->errorCode() === '00000';


    }
}