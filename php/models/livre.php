<?php

class livre extends AbstractEntity
{

    private string $titre_Livre;
    private string $nom_Auteur ;
    private string $photo_Livre = '';
    private int $id_Utilisateur = -1;
    private int $statut_Livre = 1;
    private string $commentaire;

    // Data de jointure non sauvegardée
    private string $Pseudo_Utilisateur= '';
    private string $Photo_Utilisateur ="";


    public function getPseudoUtilisateur(): string{
        return $this->Pseudo_Utilisateur;
    }

    public function setPseudoUtilisateur(string $pseudo_Utilisateur): void
    {
        $this->Pseudo_Utilisateur = htmlspecialchars($pseudo_Utilisateur);
    }

    public function getPhotoUtilisateur(): string{
        return $this->Photo_Utilisateur;
    }
    public function setPhotoUtilisateur(string $Photo_Utilisateur): void
    {
        $this->Photo_Utilisateur = htmlspecialchars($Photo_Utilisateur);
    }

    public function gettitreLivre(): string
    {
        return $this->titre_Livre;
    }

    public function getnomAuteur(): string
    {
        return $this->nom_Auteur;
    }

    public function getphotoLivre(): string
    {
        return $this->photo_Livre;
    }

    public function getIDUtilisateur(): int
    {
        return $this->id_Utilisateur;
    }

    public function getstatutLivre(): int
    {
        return $this->statut_Livre;
    }
    public function getCommentaire(): string{
        return $this->commentaire;
    }

    public function getdispolabel():string{
        $retour ="Indisponible";
        if ($this->statut_Livre==1) {
            $retour='Disponible';
        }
        return $retour;
    }
    public function settitreLivre(string $Titre_Livre): self
    {
        $this->titre_Livre = $Titre_Livre;
        return $this;
    }

    public function setnomAuteur(string $nom_Auteur): self
    {
        $this->nom_Auteur = $nom_Auteur;
        return $this;
    }

    public function setphotoLivre(string $Photo_livre): self
    {
        $this->photo_Livre = $Photo_livre;
        return $this;
    }

    public function setidUtilisateur(int $ID_Utilisateur): self
    {
        $this->id_Utilisateur = $ID_Utilisateur;
        return $this;
    }


    public function setstatutLivre(int $Statut_Livre): self
    {
        $this->statut_Livre = $Statut_Livre;
        return $this;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getCourtCommentaire(int $taille=53):string{
        $retour = $this->commentaire;
        if (strlen($this->commentaire)>$taille) {
            $retour = substr($this->commentaire,0,$taille).'...';
        }
        return $retour;
    }
}
