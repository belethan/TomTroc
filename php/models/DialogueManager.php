<?php

class DialogueManager extends AbstractEntityManager
{
    public function addMessage(int $delapart, int $pourlapersonne,string $message):bool
    {

        $sql = "INSERT INTO Messagerie (De_Messagerie, Pour_Messagerie, Msg_Messagerie) VALUES (:delapart, :pourlapersonne,:message)";
        $result = $this->db->query($sql,['delapart' => $delapart,
                 'pourlapersonne' => $pourlapersonne,
                 'message' => $message]);
        return $result->errorCode()==='00000';
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
        if ((isset($messages)) && (count($messages)>0)) {
            $this->UpdMsgNonLu($keyuserA,$keyuserPour);
        }
        return $messages; // Renvoie un tableau, même s'il est vide
    }

    public function findIndexByPourMessagerie(array $messages, int $valeurRecherchee) {
        foreach ($messages as $index => $msg) {
            $key = $msg->getDeMessagerie();
            if ($key === $valeurRecherchee) {
                return $index; // Retourne l’indice trouvé
            }
        }
        return 0; // Si rien trouvé
    }

    private function UpdMsgNonLu(int $keyuser,int $dekeyuser):bool{
        $sql = "update Messagerie
                set Message_new=0
                where ((Pour_Messagerie=:keyuser) and (De_Messagerie=:dekeyuser) and (Message_new=1))";
        $result = $this->db->query($sql,['keyuser' => $keyuser,'dekeyuser'=>$dekeyuser]);
        return $result->errorCode()===0;
    }
}