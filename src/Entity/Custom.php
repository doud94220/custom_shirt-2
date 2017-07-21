<?php

namespace Entity;

class Custom 
{

    private $id_custom;
    private $titre_custom;
    private $tissu_id;
    private $button_id;
    private $col;
    private $coupe;
    private $prix;
    private $quantite;
    
    /**********GETTERS****************/
    
    function getId_custom() {
        return $this->id_custom;
    }

    function getTissu_id() {
        return $this->tissu_id;
    }

    function getButton_id() {
        return $this->button_id;
    }

    function getCol() {
        return $this->col;
    }

    function getCoupe() {
        return $this->coupe;
    }

    function getPrix() {
        return $this->prix;
    }
    
    public function getQuantite() {
        return $this->quantite;
    }
    
    public function getTitre_custom() {
        return $this->titre_custom;
    }

        /**********SETTERS****************/
    
    function setId_custom($id_custom) {
        $this->id_custom = $id_custom;
    }

    function setTissu_id($tissu_id) {
        $this->tissu_id = $tissu_id;
    }

    function setButton_id($button_id) {
        $this->button_id = $button_id;
    }

    function setCol($col) {
        $this->col = $col;
    }

    function setCoupe($coupe) {
        $this->coupe = $coupe;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function setTitre_custom($titre_custom) {
        $this->titre_custom = 'Chemise sur mesure '.$this->coupe;
        return $this;
    }


}

