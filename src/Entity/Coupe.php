<?php

namespace Entity;


class Coupe 
{
    private $id_coupe;
    
    private $description;
    private $photo;
    private $titre;
    public function getId_coupe() {
        return $this->id_coupe;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setId_coupe($id_coupe) {
        $this->id_coupe = $id_coupe;
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

    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }





}
