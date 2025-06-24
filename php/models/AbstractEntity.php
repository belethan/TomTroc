<?php
abstract class AbstractEntity
{
    // Par défaut l'id vaut -1, ce qui permet de vérifier facilement si l'entité est nouvelle ou pas.
    protected int $id = -1;
    private ?DateTime  $DteCreation = null; // la variable $DteCreation est définie ici pour les bases de données sans triiger
    private ?DateTime  $DteModif = null;  // la variable $DteModif est définie ici pour les bases de données sans triiger

    /*
     *La gestion des dates de création et de modification sont dans chaque table
     *la valeur par défaut pour la variable $DteCreation donc rempli automatiquement
     * lors de la création.
     * La valeur pour la modification est définie dans le trigger before update avec la date/heure système.
     */

    /**
     * Constructeur de la classe.
     * Si un tableau associatif est passé en paramètre, on hydrate l'entité.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms de champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscore sont transformés en camelCase (ex: date_creation devient setDateCreation).
     * @return void
     */
    protected function hydrate(array $data) : void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Setter pour l'id.
     * @param int $id
     * @return void
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }


    /**
     * Getter pour l'id.
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $DteCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateCreation(string|DateTime $DteCreation, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($DteCreation)) {
            $DteCreation = DateTime::createFromFormat($format, $DteCreation);
        }
        $this->$DteCreation = $DteCreation;
    }

    /**
     * Getter pour la date de création du record.
     * @return string
     */
    public function getDteCreation() : DateTime
    {
        return $this->DteCreation;
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $DteModif
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. string|DateTime
     */
    public function setDateUpdate($DteModif, string $format = 'Y-m-d H:i:s') : void
    {
        $this->DteModif = null;
        if (isset($DteModif)) {
            if (is_string($DteModif)) {
                $DteModif = DateTime::createFromFormat($format, $DteModif);
            }
            $this->DteModif = $DteModif;
        }

    }

    /**
     * Getter pour la date de modification du record.
     * @return string
     */
    public function getDteModif() : ?DateTime
    {
        return $this->DteModif;
    }



}