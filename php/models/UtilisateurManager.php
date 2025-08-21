<?php

class UtilisateurManager extends AbstractEntityManager
{
    /**
     * Adds a new user to the database.
     *
     * @param Utilisateurs $utilisateur The user object containing details such as pseudo, email, and password to be added to the database.
     * @return PDOStatement The result of the SQL query execution.
     */
    Public function AddUtilisateur(Utilisateurs $utilisateur):PDOStatement
    {

        $pseudo=$utilisateur->getPseudoUtilisateur();
        $mail=$utilisateur->getMailUtilisateur();
        $passagepwd=$utilisateur->getPwdUtilisateur();
        $pwd=$utilisateur->encrypt_decrypt('encrypt',$passagepwd);
        $utilisateur->setPwdUtilisateur($pwd);
        $defaultImg='ProfilUserMan.png';
        $utilisateur->setPhotoUtilisateur($defaultImg);
        $sql="INSERT INTO Utilisateurs(Pseudo_Utilisateur,Mail_Utilisateur,Pwd_Utilisateur)  
        VALUES (:PseudoUtilisateur,:MailUtilisateur,:MdpUtilisateur)";

        $result=$this->db->query($sql,[
            'PseudoUtilisateur' => $pseudo,
            'MailUtilisateur' => $mail,
            'MdpUtilisateur' => $pwd
        ]);
        if($result->errorCode()=='00000'){
            $_SESSION['user']=$utilisateur;
        }
        return $result;
    }

    /**
     * Authenticates a user using the provided email and password.
     *
     * @param string $mail The email address of the user.
     * @param string $pwd The password of the user.
     * @return bool True if authentication is successful, false otherwise.
     */
    Public function login($mail, $pwd):bool
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
        if($result->errorCode()=='00000'){
            $_SESSION['user']->setMailUtilisateur($mailUser);
            $_SESSION['user']->setPwdUtilisateur($pwdUser);
            $_SESSION['user']->setPseudoUtilisateur($pseudo);
            if ($_SESSION['user']->getPhotoUtilisateur() != $imguser) {
                $_SESSION['user']->setPhotoUtilisateur($imguser);
            }
//            var_dump($_SESSION['user']);
        }
       return $result;
    }
}