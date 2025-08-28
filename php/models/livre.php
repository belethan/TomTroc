<?php

class livre extends AbstractEntity
{

    private string $titre_Livre;
    private string $nom_Auteur ;
    private string $photo_Livre;
    private int $id_Utilisateur = -1;
    private int $statut_Livre = 1;
    private string $commentaire;

    public function gettitreLivre(): string
    {
        return $this->titre_Livre;
    }

    public function getnomAuteur(): int
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
}
