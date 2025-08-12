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

    Public function login($mail,$pwd):bool
    {
        $useractif = new Utilisateurs();
        $password=$useractif->encrypt_decrypt('encrypt',$pwd);
        $sql="SELECT * FROM Utilisateurs WHERE Mail_Utilisateur=:MailUtilisateur AND Pwd_Utilisateur=:MdpUtilisateur";
        $result=$this->db->query($sql,[
            'MailUtilisateur' => $mail,
            'MdpUtilisateur' => $password
        ]);
        $user=$result->fetch();
        if($user)
        {
            $_SESSION['user']=$user;
            $_SESSION['pseudo']=$user['Pseudo_Utilisateur'];
            return true;
        }
        else
        {
            $_SESSION['mail']=$mail;
            return false;
            Utils::redirect("connectUser");
        }
    }
}