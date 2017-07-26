<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 17/07/2017
 * Time: 14:56
 */

namespace Entity;


class Tissu
{
    private $id;
    private $nom;
    private $descr;
    private $photo;
    private $prix;
    private $composition;
    private $grammage;
    private $tirage;
    private $stock;
    private $fil;

    /**
     * @return mixed
     */
    public function getFil()
    {
        return $this->fil;
    }

    /**
     * @param mixed $fil
     * @return Tissu
     */
    public function setFil($fil)
    {
        $this->fil = $fil;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Tissu
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Tissu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * @param mixed $desc
     * @return Tissu
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     * @return Tissu
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     * @return Tissu
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * @param mixed $composition
     * @return Tissu
     */
    public function setComposition($composition)
    {
        $this->composition = $composition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrammage()
    {
        return $this->grammage;
    }

    /**
     * @param mixed $grammage
     * @return Tissu
     */
    public function setGrammage($grammage)
    {
        $this->grammage = $grammage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTirage()
    {
        return $this->tirage;
    }

    /**
     * @param mixed $tirage
     * @return Tissu
     */
    public function setTirage($tirage)
    {
        $this->tirage = $tirage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     * @return Tissu
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }


}