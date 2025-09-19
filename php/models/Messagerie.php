<?php

class Messagerie extends AbstractEntity
{
    private string $msgMessagerie = '';
    private int $deMessagerie = 0;
    private int $pourMessagerie = 0;
    private int $messageNew = 0;
    /* data pour faciliter la jointure avec utilisateur */
    private ?string $Pseudo_Utilisateur = '';
    private ?string $Photo_Utilisateur = '';


    /**
     * @return string
     */
    public function getheureMsg(): string
    {
        return $this->DteCreation->format('H:i');
    }

    Public function getheureComplet(): string{
        return $this->DteCreation->format('d/m/Y H:i');
    }

    /**
     * Getter pour le message
     * @return string
     */
    public function getMsgMessagerie(): string
    {
        return $this->msgMessagerie;
    }

    /**
     * Setter pour le message
     * @param string $msgMessagerie
     * @return void
     */
    public function setMsgMessagerie(string $msgMessagerie): void
    {
        $this->msgMessagerie = $msgMessagerie;
    }

    /**
     * Getter pour l'expéditeur du message
     * @return int
     */
    public function getDeMessagerie(): int
    {
        return $this->deMessagerie;
    }

    /**
     * Setter pour l'expéditeur du message
     * @param int $deMessagerie
     * @return void
     */
    public function setDeMessagerie(int $deMessagerie): void
    {
        $this->deMessagerie = $deMessagerie;
    }

    /**
     * Getter pour le destinataire du message
     * @return int
     */
    public function getPourMessagerie(): int
    {
        return $this->pourMessagerie;
    }

    /**
     * Setter pour le destinataire du message
     * @param int $pourMessagerie
     * @return void
     */
    public function setPourMessagerie(int $pourMessagerie): void
    {
        $this->pourMessagerie = $pourMessagerie;
    }

    /**
     * Getter pour le statut nouveau message
     * @return int
     */
    public function getMessageNew(): int
    {
        return $this->messageNew;
    }

    /**
     * Setter pour le statut nouveau message
     * @param int $messageNew
     * @return void
     */
    public function setMessageNew(int $messageNew): void
    {
        $this->messageNew = $messageNew;
    }

    /**
     * Getter pour le pseudo de l'utilisateur
     * @return string
     */
    public function getPseudoUtilisateur(): string
    {
        return $this->Pseudo_Utilisateur ?? '';
    }
    /**
     * Setter pour le pseudo de l'utilisateur
     * @param string $pseudo_Utilisateur
     * @return void
     */
    public function setPseudoUtilisateur(string $pseudo_Utilisateur): void
    {
        $this->Pseudo_Utilisateur = $pseudo_Utilisateur;
    }

    /**
     * Getter pour la photo de l'utilisateur
     * @return string
     */
    public function getPhotoUtilisateur(): string
    {
        if (empty($this->Photo_Utilisateur)==true) {
            $this->photo_Utilisateur='../images/user_picture/ProfilUserMan.png';
        }
        return $this->Photo_Utilisateur;
    }

    /**
     * Setter pour la photo de l'utilisateur
     * @param string $photo_Utilisateur
     * @return void
     */
    public function setPhotoUtilisateur(string $Photo_Utilisateur = ''): void
    {
        if (empty($Photo_Utilisateur)==true) {
            $Photo_Utilisateur='ProfilUserMan.png';
        }
        $this->Photo_Utilisateur = $Photo_Utilisateur;
    }





}
