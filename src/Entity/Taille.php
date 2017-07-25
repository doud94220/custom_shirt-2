<?php
/**
 * Created by PhpStorm.
 * User: Aha
 * Date: 23/07/2017
 * Time: 11:58
 */

namespace Entity;


class Taille
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $taille;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Taille
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param string $taille
     * @return Taille
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
        return $this;
    }




}