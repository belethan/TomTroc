<?php

class Utilisateurs
{
    private string $secret_key = 'Isidar!9729Ag';
    private string $iv_length = '';
    private string $iv = '';
    private string $Nom_Utilisateur;
    private string $Prenom_Utilisateur;
    private string $pseudo_Utilisateur;
    private string $photo_Utilisateur;
    private string $mail_Utilisateur;
    private string $mdp_Utilisateur;





    /**
     * Retrieves the last name of the user.
     *
     * @return string The last name of the user.
     */
    public function getNomUtilisateur(): string
    {
        return $this->Nom_Utilisateur;
    }

    public function setNomUtilisateur(string $Nom_Utilisateur): void
    {
        $this->Nom_Utilisateur = $Nom_Utilisateur;
    }

    /**
     * Retrieves the first name of the user.
     *
     * @return string The first name of the user.
     */
    public function getPrenomUtilisateur(): string
    {
        return $this->Prenom_Utilisateur;
    }

    public function setPrenomUtilisateur(string $Prenom_Utilisateur): void
    {
        $this->Prenom_Utilisateur = $Prenom_Utilisateur;
    }

    /**
     * Retrieves the pseudonym of the user.
     *
     * @return string The pseudonym of the user.
     */
    public function getPseudoUtilisateur(): string
    {
        return $this->pseudo_Utilisateur;
    }

    public function setPseudoUtilisateur(string $pseudo_Utilisateur): void
    {
        $this->pseudo_Utilisateur = $pseudo_Utilisateur;
    }

    /**
     * Retrieves the photo of the user.
     *
     * @return string The photo of the user.
     */
    public function getPhotoUtilisateur(): string
    {
        return $this->photo_Utilisateur;
    }

    public function setPhotoUtilisateur(string $photo_Utilisateur): void
    {
        $this->photo_Utilisateur = $photo_Utilisateur;
    }

    /**
     * Retrieves the email of the user.
     *
     * @return string The email of the user.
     */
    public function getMailUtilisateur(): string
    {
        return $this->mail_Utilisateur;
    }

    public function setMailUtilisateur(string $mail_Utilisateur): void
    {
        $this->mail_Utilisateur = $mail_Utilisateur;
    }

    /**
     * Retrieves the password of the user.
     *
     * @return string The password of the user.
     */
    public function getMdpUtilisateur(): string
    {
        $mpddecode= $this->decrypter($this->mdp_Utilisateur, $this->secret_key);
        return $mpddecode;
    }

    public function setMdpUtilisateur(string $mdp_Utilisateur): void
    {

        $this->mdp_Utilisateur = $this->crypter($mdp_Utilisateur, $this->secret_key, $this->iv);

    }

    protected function crypter($data, $key, $iv) {
        $cipher = 'AES-256-CBC';
        $crypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
        // Encode le résultat et l'IV pour les stocker ou transmettre facilement
        return base64_encode($iv . $crypted);
    }

    protected function decrypter($crypted_data, $key) {
        $cipher = 'AES-256-CBC';
        $data = base64_decode($crypted_data);
        $iv_length = openssl_cipher_iv_length($cipher);
        $iv = substr($data, 0, $iv_length);
        $crypted = substr($data, $iv_length);
        return openssl_decrypt($crypted, $cipher, $key, 0, $iv);
    }

}