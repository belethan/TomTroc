<?php

class DialogueManager extends AbstractEntityManager
{
    public function addMessage(int $keyuser){

    }

    Public function getUserMessages(int $keyuser){
        $sql = " select Distinct  A.De_Messagerie,
            A.Msg_Messagerie,
            A.DteCreation,
            B.Pseudo_Utilisateur,
            B.Photo_Utilisateur
            FROM Messagerie A
            INNER JOIN Utilisateurs B ON (A.De_Messagerie = B.ID)
            WHERE (A.Pour_Messagerie = :keyuser)
            AND A.ID = ( SELECT MAX(A2.ID) FROM Messagerie A2
                WHERE A2.De_Messagerie = A.De_Messagerie
                AND A2.Pour_Messagerie = :keyuser
            )
            ORDER BY B.Pseudo_Utilisateur ASC
        ";
        $result = $this->db->query($sql,['keyuser' => $keyuser]);
        $messages = [];
        while ($msgRow = $result->fetch()) {
            $messages[] = new Messagerie($msgRow); // Ajoute chaque message au tableau
        }
        return $messages; // Renvoie un tableau, même s'il est vide
    }

    public function getDialogue(int $keyuserPour,int $keyuserA){
        $sql = "
            select Distinct  A.De_Messagerie,
                 A.Msg_Messagerie,
                 A.DteCreation,
                 B.Pseudo_Utilisateur,
                 B.Photo_Utilisateur
            FROM Messagerie A
            INNER JOIN Utilisateurs B ON (A.De_Messagerie = B.ID)
            WHERE ((A.Pour_Messagerie = :keyuserPour) AND (A.De_Messagerie = :keyuserA))
            OR ((A.Pour_Messagerie = :keyuserA) AND (A.De_Messagerie = :keyuserPour))
            ORDER BY A.DteCreation ASC
       ";
        $result = $this->db->query($sql,['keyuserPour' => $keyuserPour, 'keyuserA' => $keyuserA]);;
        $messages = [];
        while ($msgRow = $result->fetch()) {
            $messages[] = new Messagerie($msgRow); // Ajoute chaque message au tableau
        }
        return $messages; // Renvoie un tableau, même s'il est vide
    }

    function findIndexByPourMessagerie(array $messages, int $valeurRecherchee) {
        foreach ($messages as $index => $msg) {
            $key = $msg->getDeMessagerie();
            if ($key === $valeurRecherchee) {
                return $index; // Retourne l’indice trouvé
            }
        }
        return -1; // Si rien trouvé
    }
}