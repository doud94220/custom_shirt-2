<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 17/07/2017
 * Time: 14:56
 */

namespace Entity;


class Categorie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Categorie
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Categorie
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }








}