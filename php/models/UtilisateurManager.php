<?php

class UtilisateurManager extends AbstractEntityManager
{
    Public function AddUtilisateur(Utilisateurs $utilisateur):PDOStatement
    {
        $pseudo=$utilisateur->getPseudoUtilisateur();
        $mail=$utilisateur->getMailUtilisateur();
        $pwd=$utilisateur->getMdpUtilisateur();
        $defaultImg='ProfilUserMan.png';
        $utilisateur->setPhotoUtilisateur($defaultImg);
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

            $useractif->hydrate($user);
            $_SESSION['user']=$useractif;
            return true;
        }
        else
        {
            $useractif->setMailUtilisateur($mail);
            $_SESSION['user']=$useractif;
            return false;
            Utils::redirect("connectUser");
        }
    }

    public function updateUser(){
       $mailUser=utils::request('email');
       $mpUser=utils::request('password');
       $pseudo=utils::request('pseudo');
       $imguser=Utils::uploadImage();

       $sql="UPDATE Utilisateurs SET Pseudo_Utilisateur=:PseudoUtilisateur,Mail_Utilisateur=:MailUtilisateur WHERE Pseudo_Utilisateur=:PseudoUtilisateur AND Mail_Utilisateur=:MailUtilisateur";
       $result=$this->db->query($sql,[
           'PseudoUtilisateur' => $pseudo,
           'MailUtilisateur' => $mailUser
       ]);
       return $result;
    }
}