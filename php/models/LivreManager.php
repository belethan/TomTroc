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

    public function getalluserLivre() : array{
        $sql = "SELECT * FROM livres WHERE id_Utilisateur=:keyutilisateur ORDER BY DteCreation DESC";
        $result = $this->db->query($sql,['keyutilisateur'=>4]);
        //$_SESSION['user']->getIdUtilisateur()
        $books = [];
        while ($bookRow = $result->fetch()) {
            $books[] = new livre($bookRow); // Ajoute chaque livre au tableau
        }
        return $books; // Renvoie un tableau, même s'il est vide
    }

    /**
     * Enregistre un objet livre dans la base de données. Selon le mode, la méthode crée
     * un nouveau livre (opération d’insertion) ou met à jour un livre existant (opération de mise à jour).
     *
     * @param int $modework Le mode d’opération. Utiliser 1 pour créer un nouveau livre (insertion),
     *                      ou toute autre valeur pour mettre à jour un livre existant.
     * @param livre $livre L’objet livre à enregistrer, contenant toutes les données nécessaires.
     * @return int L’ID du livre enregistré. Retourne -1 en cas d’erreur lors de l’opération de mise à jour.
     */
    public function LivreSauvegarder(livre $livre,int $modework=1,int $idlivre=-1 ):int
{
        $retourcle = -1;
        if ($modework === 1) {
            // INSERT - Création d'un nouveau livre
            $sql = "INSERT INTO livres (Titre_Livre, nom_Auteur, Photo_Livre, ID_Utilisateur, Statut_Livre, Commentaire)
                    VALUES (:titre, :nomAuteur, :photo, :idUtilisateur, :statut, :commentaire)";
            $stmt = $this->db->query($sql,[
                ':titre'         => $livre->getTitreLivre(),
                ':nomAuteur'      => $livre->getnomAuteur(),
                ':photo'         => $livre->getPhotoLivre(),
                ':idUtilisateur' => $livre->getIDUtilisateur(),
                ':statut'        => $livre->getstatutLivre(),
                ':commentaire'   => $livre->getCommentaire(),
            ]);

            utils::logsuccess("Un nouveau livre a été enregistré");
            if ($stmt->errorCode() != '00000') {
                utils::logError("Erreur sur création du livre : erreur de sauvegarde SQL . " . implode(", ", $stmt->errorInfo()));
                $retourcle = -1;
            } else {
                $retourcle = $this->db->LastKeyInfo();
                $imglivre = utils::uploadImage($retourcle, $valueinit, "LIVRE-", 1);
            }

        } else {
            // UPDATE - Modification d'un livre existant
            $sql = "UPDATE Livres SET 
                    Titre_Livre = :titre, 
                    nom_Auteur = :nomAuteur, 
                    Photo_Livre = :photo, 
                    ID_Utilisateur = :idUtilisateur, 
                    Statut_Livre = :statut, 
                    Commentaire = :commentaire
                    WHERE id = :idLivre";
            $stmt = $this->db->query($sql,[
                ':titre'         => $livre->getTitreLivre(),
                ':nomAuteur'    => $livre->getnomAuteur(),
                ':photo'         => $livre->getPhotoLivre(),
                ':idUtilisateur' => $livre->getIDUtilisateur(),
                ':statut'        => $livre->getStatutLivre(),
                ':commentaire'   => $livre->getCommentaire(),
                ':idLivre'       => $idlivre, // Nécessaire pour identifier le livre à modifier $livre->getId()
            ]);
            utils::logsuccess("les modifications sur les informations livre ont été enregistrées");
            $retourcle = $livre->getId();
            if ($stmt->errorCode()!='00000') {
                utils::logError("Erreur sur la modification des données du livre : erreur de sauvegarde SQL .". $stmt->errorInfo());
                $retourcle = -1;
            }
        }
        return $retourcle;

    }

    /**
     * Retrieves a single livre object from the database using its ID.
     *
     * @param int $idLivre The ID of the livre to retrieve.
     * @return livre The livre object corresponding to the given ID.
     */
    public function getLivreById(int $idLivre) : livre{
        $sql = "SELECT * FROM livres WHERE id = :keylivre ORDER BY DteCreation DESC";
        $result = $this->db->query($sql,['keylivre' => $idLivre]);
        $result = $result->fetch();
        return new livre($result);
    }

    /**
     * Cette méthode permet de récupérer tous les livres actifs associés à un auteur spécifique,
     * identifiés par l'identifiant de l'auteur donné. Les livres sont triés par date de création
     * en ordre décroissant, puis retournés sous forme d'objets `livre`.
     *
     * @param int $idAuteur L'identifiant de l'auteur dont on souhaite récupérer les livres.
     * @return array Un tableau contenant les livres sous forme d'objets `livre`. Le tableau
     * peut être vide si aucun livre ne correspond aux critères.
     */
    public function getLivreByAuteur(string $nomAuteur) : array{
        $sql = "SELECT * FROM livres WHERE Statut_Livre = 1 AND nom_Auteur = :nomAuteur ORDER BY DteCreation DESC";
        $result = $this->db->query($sql,[
            'nomAuteur' => $nomAuteur
        ]);
        $books = [];
        while ($bookRow = $result->fetch()) {
            $books[] = new livre($bookRow); // Ajoute chaque livre au tableau
        }
        return $books; // Renvoie un tableau, même s'il est vide
    }

    public function DelLivreByid(int $keylivre) : PDOStatement
    {
        $sql = "DELETE FROM livres WHERE id = :keylivre";
        $result = $this->db->query($sql,['keylivre' => $keylivre]);
        utils::logsuccess("la suppression du livre a été réalisée avec succès");
        if ($result->errorCode()!='00000') {
            utils::logError("Erreur sur la suppressions du livre : erreur de sauvegarde SQL .". $result->errorInfo());
        }
        return $result;
    }
}