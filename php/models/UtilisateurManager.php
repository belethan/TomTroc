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
            $_SESSION['keyIdUser']=$useractif->getId();
//            var_dump($useractif);
//            die;
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

    /**
     * Updates the user information such as email, pseudo, password, and profile picture in the database.
     * The updated data is reflected in the current session for the logged-in user.
     *
     * @return PDOStatement Returns the result of the SQL query executed for updating the user data.
     */
    public function updateuser(): PDOStatement
    {
      // Création d'un objet Utilisateurs'
       $useractif = new Utilisateurs();
      // affectation ID du user connecté
       $keyuser=$_SESSION['keyIdUser'];
       $namephoto=$_SESSION['user']->getPhotoUtilisateur();
      // Affectation des données pour mise à jour
       $mailUser=utils::request('email');
       $pseudo=utils::request('pseudo');
       $pwdUser=utils::request('password');
       if($pwdUser!=$_SESSION['user']->getPwdUtilisateur()){
          // Cryptage du mot de passe
          $pwdUser=$useractif->encrypt_decrypt('encrypt',$pwdUser);
       }
      // récupérer nom et chemin de l'image profil utilisateur
       $imguser=Utils::uploadImage($keyuser,$namephoto);
      // Mise à jour des données dans la base
       $sql="UPDATE Utilisateurs 
            SET Pseudo_Utilisateur=:Pseudo,
            Mail_Utilisateur=:UserMail,
            Pwd_Utilisateur=:MdpUtilisateur,
            Photo_Utilisateur=:PhotoUser
            WHERE id=:keyid";
       $result=$this->db->query($sql,[
           'Pseudo' => $pseudo,
           'UserMail' => $mailUser,
           'MdpUtilisateur' => $pwdUser,
           'PhotoUser' => $imguser,
           'keyid' => $keyuser
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