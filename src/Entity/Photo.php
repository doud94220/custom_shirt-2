<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/07/2017
 * Time: 13:26
 */

namespace Entity;


class Photo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var int
     */
    private $produit;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return type
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param int $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }








}