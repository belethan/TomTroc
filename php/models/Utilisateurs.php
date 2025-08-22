<?php

class Utilisateurs extends AbstractEntity
{
    private string $secret_key = 'Isidar!9729Ag';
    private string $iv_key = 'Ag=meYlan';
    private string $Pseudo_Utilisateur= '';
    private ?string $Photo_Utilisateur =Null;
    private string $Mail_Utilisateur = '';
    private string $Pwd_Utilisateur = '';


    /**
     * Retrieves the pseudonym of the user.
     *
     * @return string The pseudonym of the user.
     */
    public function getPseudoUtilisateur(): string
    {
        return $this->Pseudo_Utilisateur;
    }

    public function setPseudoUtilisateur(string $pseudo_Utilisateur): void
    {
        $this->Pseudo_Utilisateur = htmlspecialchars($pseudo_Utilisateur);
    }

    /**
     * Retrieves the photo of the user.
     *
     * @return string The photo of the user.
     */
    public function getPhotoUtilisateur(): string
    {
        if (empty($this->Photo_Utilisateur)==true) {
            $this->Photo_Utilisateur='ProfilUserMan.png';
        }
        return $this->Photo_Utilisateur;
    }

    public function setPhotoUtilisateur(string $photo_Utilisateur = ''): void
    {
        if (empty($photo_Utilisateur)==true) {
            $photo_Utilisateur='ProfilUserMan.png';
        }
        $this->Photo_Utilisateur = $photo_Utilisateur;
    }

    /**
     * Retrieves the email of the user.
     *
     * @return string The email of the user.
     */
    public function getMailUtilisateur(): string
    {
        return $this->Mail_Utilisateur;
    }

    public function setMailUtilisateur(string $mail_Utilisateur): void
    {
        $this->Mail_Utilisateur = htmlspecialchars($mail_Utilisateur);
    }

    /**
     * Retrieves the password of the user.
     *
     * @return string The password of the user.
     */
    public function getPwdUtilisateur(): string
    {
        return $this->Pwd_Utilisateur;
    }

    /**
     * Sets the user password after sanitizing and encrypting it.
     *
     * @param string $PwdUtilisateur The plain text password provided by the user.
     * @return void
     */
    public function setPwdUtilisateur(string $PwdUtilisateur): void
    {
        $PwdUser = htmlspecialchars($PwdUtilisateur);
        $this->Pwd_Utilisateur = $PwdUser;
    }

    /**
     * Encrypts or decrypts a given string based on the specified action using the AES-256-CBC encryption method.
     *
     * @param string $action The action to perform. Accepts 'encrypt' for encryption or 'decrypt' for decryption.
     * @param string $string The string to be encrypted or decrypted.
     * @return string The encrypted or decrypted string based on the specified action.
     */
    public function encrypt_decrypt($action, $string):string
    {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    // hash
    $key = hash('sha256', $this->secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $this->iv_key), 0, 16);

    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
    }

    public function anciennete():string
    {
        $date = new DateTime("now");
        $diff = $date->diff($this->getDteCreation());
//        var_dump('cree le '.$this->getDteCreation()->format('Y-m-d'));
//        var_dump($diff);
//        die;
        if ($diff->y > 0) {
            $annee = 'membre depuis '.$diff->y.' an(s)';
        }
        elseif ($diff->m > 0) {
            $annee = 'membre depuis '.$diff->m.' mois';
        }
        elseif ($diff->d > 0) {
            $annee = 'membre depuis '.$diff->d.' jour(s)';
        }
        else {
            $annee = 'membre depuis '.$diff->h.' heure(s)';
        }
        return $annee;
    }

}