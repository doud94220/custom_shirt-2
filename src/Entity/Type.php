<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/07/2017
 * Time: 14:39
 */

namespace Entity;


class Type
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $categorie;

    /**
     * @var string
     */
    private $type;

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

        return $this;
    }

    /**
     * @return Type
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Type $categorie
     */
    public function setCategorie(Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    public function __toString()
    {
        return $this->type;
    }




}