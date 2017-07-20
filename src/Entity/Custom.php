<?php

namespace Entity;

class Custom 
{

    private $id_config;
    
    private $tissu_id;
    private $button_id;
    private $col;
    private $coupe;
    private $prix;
    private $quantite;
    
    /**********GETTERS****************/
    
    function getId_config() {
        return $this->id_config;
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

        /**********SETTERS****************/
    
    function setId_config($id_config) {
        $this->id_config = $id_config;
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
}

