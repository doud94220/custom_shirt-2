<?php



namespace Entity;

class Bouton 
{
    private $id_bouton;
    private $titre;
    private $stock;
    private $description;
    private $photo;
    private $prix;
    
    public function getTitre() {
        return $this->titre;
    }

    public function getId_bouton() {
        return $this->id_bouton;
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

    public function setId_bouton($id_bouton) {
        $this->id_bouton = $id_bouton;
        return $this;
    }
    
    
    public function setTitre($titre) {
        $this->titre = $titre;
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


}
