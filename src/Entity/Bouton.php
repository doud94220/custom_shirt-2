<?php



namespace Entity;

class Bouton 
{
    private $id_bouton;
    private $titre_bouton;
    private $stock;
    private $description_bouton;
    private $photo_bouton;
    private $prix_bouton;
    
    public function getId_bouton() {
        return $this->id_bouton;
    }

    public function getTitre_bouton() {
        return $this->titre_bouton;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getDescription_bouton() {
        return $this->description_bouton;
    }

    public function getPhoto_bouton() {
        return $this->photo_bouton;
    }

    public function getPrix_bouton() {
        return $this->prix_bouton;
    }

    public function setId_bouton($id_bouton) {
        $this->id_bouton = $id_bouton;
        return $this;
    }

    public function setTitre_bouton($titre_bouton) {
        $this->titre_bouton = $titre_bouton;
        return $this;
    }

    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    public function setDescription_bouton($description_bouton) {
        $this->description_bouton = $description_bouton;
        return $this;
    }

    public function setPhoto_bouton($photo_bouton) {
        $this->photo_bouton = $photo_bouton;
        return $this;
    }

    public function setPrix_bouton($prix_bouton) {
        $this->prix_bouton = $prix_bouton;
        return $this;
    }




}
