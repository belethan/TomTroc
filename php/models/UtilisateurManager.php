<?php

class UtilisateurManager extends AbstractEntityManager
{
    /**
     * Adds a new user to the database.
     *
     * @param Utilisateurs $utilisateur The user object containing details such as pseudo, email, and password to be added to the database.
     * @return PDOStatement The result of the SQL query execution.
     */
    Public function addUtilisateur(Utilisateurs $utilisateur):PDOStatement
    {
        $pseudo=$utilisateur->getPseudoUtilisateur();
        $mail=$utilisateur->getMailUtilisateur();
        $passagepwd=$utilisateur->getPwdUtilisateur();
        $pwd=$utilisateur->encrypt_decrypt('encrypt',$passagepwd);
        $utilisateur->setPwdUtilisateur($pwd);
        $defaultImg='../images/user_picture/ProfilUserMan.png';
        $utilisateur->setPhotoUtilisateur($defaultImg);
        $sql="INSERT INTO Utilisateurs(Pseudo_Utilisateur,Mail_Utilisateur,Pwd_Utilisateur,photo_Utilisateur)  
        VALUES (:PseudoUtilisateur,:MailUtilisateur,:MdpUtilisateur,:photouser)";

        $result=$this->db->query($sql,[
            'PseudoUtilisateur' => $pseudo,
            'MailUtilisateur' => $mail,
            'MdpUtilisateur' => $pwd,
            'photouser' => $defaultImg,
        ]);
        if($result->errorCode()=='00000'){
            $_SESSION['keyIdUser']= $this->db->LastKeyInfo();
            $utilisateur=$this->getUtilisateurById($_SESSION['keyIdUser']);
            $_SESSION['user']=$utilisateur;
            Utils::redirect("home");
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
            return true;
        }
        else
        {
            $useractif->setMailUtilisateur($mail);
            $_SESSION['user']=$useractif;
            //return false;
            Utils::redirect("connectUser");
        }
    }

    /**
     * Updates the user information such as email, pseudo, password, and profile picture in the database.
     * The updated data is reflected in the current session for the logged-in user.
     *
     * @return PDOStatement Returns the result of the SQL query executed for updating the user data.
     */
    public function updateUser(): PDOStatement
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

        }
       return $result;
    }

    Public function getUtilisateurById($id):Utilisateurs{
        $sql="SELECT * FROM Utilisateurs WHERE id=:id";
        $result=$this->db->query($sql,[
            'id' => $id
        ]);
        $user=$result->fetch();
        $useractif = new Utilisateurs($user);
        return $useractif;
    }

    PUBLIC FUNCTION GetNblivre($id):int{
    $sql="SELECT COUNT(*) as nblivre FROM livres WHERE id_Utilisateur=:id";
    $result=$this->db->query($sql,[
        'id' => $id
    ]);
    $user=$result->fetch();
    return $user['nblivre'];
    }

    Public function getNbMessage($id):int{
        $sql="SELECT COUNT(*) as nbMsg FROM Messagerie WHERE Pour_Messagerie=:id";
        $result=$this->db->query($sql,[
            'id' => $id
        ]);
        $user=$result->fetch();
        return $user['nbMsg'];
    }
}