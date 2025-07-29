<?php

class UtilisateurManager extends AbstractEntityManager
{
    Public function AddUtilisateur(Utilisateurs $utilisateur):PDOStatement
    {
        $pseudo=$utilisateur->getPseudoUtilisateur();
        $mail=$utilisateur->getMailUtilisateur();
        $pwd=$utilisateur->getMdpUtilisateur();
        $sql="INSERT INTO Utilisateurs(Pseudo_Utilisateur,Mail_Utilisateur,Pwd_Utilisateur)  
        VALUES (:PseudoUtilisateur,:MailUtilisateur,:MdpUtilisateur)";

        $result=$this->db->query($sql,[
            'PseudoUtilisateur' => $pseudo,
            'MailUtilisateur' => $mail,
            'MdpUtilisateur' => $pwd
        ]);
        return $result;
    }
}