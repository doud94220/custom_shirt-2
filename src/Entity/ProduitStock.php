<?php
/**
 * Created by PhpStorm.
 * User: Aha
 * Date: 23/07/2017
 * Time: 11:06
 */

namespace Entity;


class ProduitStock
{
    /**
     * @var type
     */
    private $produit;

    /**
     * @var type
     */
    private $taille;

    /**
     * @var int
     */
    private $stock;

    /**
     * @return int
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param int $produit_id
     * @return ProduitTaille
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param int $taille_id
     * @return ProduitTaille
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
        return $this;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return ProduitTaille
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }



}