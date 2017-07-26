<?php

namespace Entity;


class Col 
{
    private $id_col;
    
    private $stock;
    private $description_col;
    private $photo_col;
    private $prix_col;
    private $titre_col;
    
    public function getId_col() {
        return $this->id_col;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getDescription_col() {
        return $this->description_col;
    }

    public function getPhoto_col() {
        return $this->photo_col;
    }

    public function getPrix_col() {
        return $this->prix_col;
    }

    public function getTitre_col() {
        return $this->titre_col;
    }

    public function setId_col($id_col) {
        $this->id_col = $id_col;
        return $this;
    }

    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    public function setDescription_col($description_col) {
        $this->description_col = $description_col;
        return $this;
    }

    public function setPhoto_col($photo_col) {
        $this->photo_col = $photo_col;
        return $this;
    }

    public function setPrix_col($prix_col) {
        $this->prix_col = $prix_col;
        return $this;
    }

    public function setTitre_col($titre_col) {
        $this->titre_col = $titre_col;
        return $this;
    }



}
