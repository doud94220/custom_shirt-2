<?php


namespace Entity;


class Produit
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var type
     */
    private $type;

    /**
     * @var type
     */
    private $tissu;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $sexe;

    /**
     * @var int
     */
    private $prix;
    private $quantite;
    private $produitOrCustom;
    

    public function __construct()
    {
        $this->setProduitOrCustom('produit');
    }

    /**
     * @var int
     */
    private $stock;

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return Produit
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param type $type
     */
    public function setType(Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return type
     */
    public function getTissu()
    {
        return $this->tissu;
    }

    /**
     * @param type $couleur
     */
    public function setTissu(Tissu $tissu)
    {
        $this->tissu = $tissu;

        return $this;
    }

    /**
     * @return type
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param type $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
        return $this;
    }
    
    public function getProduitOrCustom()
    {
        return $this->produitOrCustom;
    }

    public function setProduitOrCustom($produitOuCustom)
    {
        $this->produitOrCustom = $produitOuCustom;
    }
}