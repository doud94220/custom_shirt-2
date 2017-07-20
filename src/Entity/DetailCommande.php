<?php
namespace Entity;

/**
 * Description of DetailCommande
 *
 * @author Julien
 */
class DetailCommande 
{
    /**
     * @var int
     */
    private $id_detail_commande;
    
    /**
     * @var int
     */
    private $commande_id;
    
    /**
     * @var int
     */
    private $produit_id;
    
    /**
     * @var int
     */
    private $custom_id;
    
    /**
     * @var int
     */
    private $quantite;
    
    /**
     * @var int
     */
    private $prix;
    
    /**
     * @return int
     */
    public function getId_detail_commande() {
        return $this->id_detail_commande;
    }

    /**
    * @return int
    */
    public function getCommande_id() {
        return $this->commande_id;
    }

    /**
    * @return int
    */
    public function getProduit_id() {
        return $this->produit_id;
    }

    /**
    * @return int
    */
    public function getCustom_id() {
        return $this->custom_id;
    }

    /**
    * @return int
    */
    public function getQuantite() {
        return $this->quantite;
    }

    /**
    * @return int
    */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * @param int $id_detail_commande
     * @return DetailCommande
     */
    public function setId_detail_commande($id_detail_commande) {
        $this->id_detail_commande = $id_detail_commande;
        return $this;
    }

    /**
     * @param int $commande_id
     * @return DetailCommande
     */
    public function setCommande_id($commande_id) {
        $this->commande_id = $commande_id;
        return $this;
    }

    /**
     * @param int $produit_id
     * @return DetailCommande
     */
    public function setProduit_id($produit_id) {
        $this->produit_id = $produit_id;
        return $this;
    }

    /**
     * @param int $custom_id
     * @return DetailCommande
     */
    public function setCustom_id($custom_id) {
        $this->custom_id = $custom_id;
        return $this;
    }

    /**
     * @param int $quantite
     * @return DetailCommande
     */
    public function setQuantite($quantite) {
        $this->quantite = $quantite;
        return $this;
    }

    /**
     * @param int $prix
     * @return DetailCommande
     */
    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }


}
