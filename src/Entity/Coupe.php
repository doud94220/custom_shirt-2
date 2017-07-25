<?php

namespace Entity;


class Coupe 
{
    private $id_coupe;
    
    private $description_coupe;
    private $photo_coupe;
    private $titre_coupe;
    
    public function getId_coupe() {
        return $this->id_coupe;
    }

    public function getDescription_coupe() {
        return $this->description_coupe;
    }

    public function getPhoto_coupe() {
        return $this->photo_coupe;
    }

    public function getTitre_coupe() {
        return $this->titre_coupe;
    }

    public function setId_coupe($id_coupe) {
        $this->id_coupe = $id_coupe;
        return $this;
    }

    public function setDescription_coupe($description_coupe) {
        $this->description_coupe = $description_coupe;
        return $this;
    }

    public function setPhoto_coupe($photo_coupe) {
        $this->photo_coupe = $photo_coupe;
        return $this;
    }

    public function setTitre_coupe($titre_coupe) {
        $this->titre_coupe = $titre_coupe;
        return $this;
    }






}
