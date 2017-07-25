<?php

namespace Entity;


class Col 
{
    private $id_col;
    
    private $stock;
    private $description;
    private $photo;
    private $prix;
    private $titre;
    
    public function getId_col() {
        return $this->id_col;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setId_col($id_col) {
        $this->id_col = $id_col;
        return $this;
    }

    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
        return $this;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }

}
