<?php

namespace Entity;

class Custom 
{

    private $id_custom;
    
    /**
     * @var string
     */
    private $titre_custom;
    
    /**
     * @var int
     */
    private $tissu_id;
    
    /**
     * @var int
     */
    private $bouton_id;
    
    /**
     * @var int
     */
    private $col_id;
    
    /**
     * @var int
     */
    private $coupe_id;
    
    /**
     * @var int
     */
    private $prix;
    
    /**
     * @var int
     */
    
    private $quantite;
    private $produitOrCustom; //booleen
    
    //Constructeur ///Rajoute par Edouard
    public function __construct()
    {
        $this->setProduitOrCustom('custom');
    }
    
    
    /**********GETTERS****************/
    
    /**
     * @return int
     */
    function getId_custom() {
        return $this->id_custom;
    }
    
    /**
     * @return string
     */
    public function getTitre_custom() {
        return $this->titre_custom;
    }

    /**
     * @return int
     */
    function getTissu_id() {
        return $this->tissu_id;
    }

    /**
     * @return int
     */
    function getBouton_id() {
        return $this->bouton_id;
    }

    /**
     * @return int
     */
    function getCol_id() {
        return $this->col;
    }

    /**
     * @return int
     */
    function getCoupe_id() {
        return $this->coupe;
    }

    /**
     * @return int
     */
    function getPrix() {
        return $this->prix;
    }
    
        
    //Rajouté par Edouard
    
    /**
     * @return int
     */
    public function getQuantite() {
        return $this->quantite;
    }
    
    public function getProduitOrCustom()
    {
        return $this->produitOrCustom;
    }


    /**********SETTERS****************/

    
    /**
     * @param type $id_custom
     * @return Custom
     */
    function setId_custom($id_custom) {
        $this->id_custom = $id_custom;
        return $this;
    }

    /**
     * @param type $titre_custom
     * @return Custom
     */
    public function setTitre_custom($titre_custom) {
        $this->titre_custom = $titre_custom;
        return $this;
    }
    
    /**
     * @param type $tissu_id
     * @return Custom
     */
    function setTissu_id($tissu_id) {
        $this->tissu_id = $tissu_id;
        return $this;
    }

    /**
     * @param type $bouton_id
     * return Custom
     */
    function setBouton_id($bouton_id) {
        $this->bouton_id = $bouton_id;
        return $this;
    }

    /**
     * @param type $col
     * @return Custom
     */
    function setCol_id($col) {
        $this->col = $col;
        return $this;
    }

    /**
     * @param type $coupe
     * @return Custom
     */
    function setCoupe_id($coupe) {
        $this->coupe = $coupe;
        return $this;
    }

    /**
     * @param type $prix
     * @return Custom
     */
    function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    //Rajouté par Edouard
    
    /**
     * @param type $quantite
     * @return Custom
     */
    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
   
    public function setProduitOrCustom($produitOrCustom)
    {
        $this->produitOrCustom = $produitOrCustom;
    }

}
