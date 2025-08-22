<?php

class livre extends AbstractEntity
{

    private string $Titre_Livre;
    private int $ID_Auteur = -1;
    private string $Photo_livre;
    private int $ID_Utilisateur = -1;
    private string $Memo_Livre;
    private int $Statut_Livre = 1;

    public function getTitreLivre(): string
    {
        return $this->Titre_Livre;
    }

    public function getIDAuteur(): int
    {
        return $this->ID_Auteur;
    }

    public function getPhotoLivre(): string
    {
        return $this->Photo_livre;
    }

    public function getIDUtilisateur(): int
    {
        return $this->ID_Utilisateur;
    }

    public function getMemoLivre(): string
    {
        return $this->Memo_Livre;
    }

    public function getStatutLivre(): int
    {
        return $this->Statut_Livre;
    }

    public function setTitreLivre(string $Titre_Livre): self
    {
        $this->Titre_Livre = $Titre_Livre;
        return $this;
    }

    public function setIDAuteur(int $ID_Auteur): self
    {
        $this->ID_Auteur = $ID_Auteur;
        return $this;
    }

    public function setPhotoLivre(string $Photo_livre): self
    {
        $this->Photo_livre = $Photo_livre;
        return $this;
    }

    public function setIDUtilisateur(int $ID_Utilisateur): self
    {
        $this->ID_Utilisateur = $ID_Utilisateur;
        return $this;
    }



    public function setMemoLivre(string $Memo_Livre): self
    {
        $this->Memo_Livre = $Memo_Livre;
        return $this;
    }

    public function setStatutLivre(int $Statut_Livre): self
    {
        $this->Statut_Livre = $Statut_Livre;
        return $this;
    }
}
