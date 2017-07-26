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
    
    private $commande_id;
    
    private $produit_id;
    
    private $custom_id;
    
    /**
     * @var Commande
     */
    private $commande;
    
    /**
     * @var Produit
     */
    private $produit;
    
    /**
     * @var Custom
     */
    private $custom;
    
    /**
     * @var int
     */
    private $quantite;
    
    /**
     * @var int
     */
    private $prix;
    
    
    
    public function getCommande_id() {
        return $this->commande_id;
    }

    public function getProduit_id() {
        return $this->produit_id;
    }

    public function getCustom_id() {
        return $this->custom_id;
    }

    /**
     * @return int
     */
    public function getId_detail_commande() {
        return $this->id_detail_commande;
    }

    /**
    * @return int
    */
    public function getCommande() {
        return $this->commande;
    }

    /**
    * @return int
    */
    public function getProduit() {
        return $this->produit;
    }

    /**
    * @return int
    */
    public function getCustom() {
        return $this->custom;
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
     * @param Commande $commande
     * @return DetailCommande
     */
    public function setCommande(Commande $commande) {
        $this->commande = $commande;
        return $this;
    }

    /**
     * @param Produit $produit
     * @return DetailCommande
     */
    public function setProduit(Produit $produit) {
        $this->produit = $produit;
        return $this;
    }

    /**
     * @param Custom $custom
     * @return DetailCommande
     */
    public function setCustom(Custom $custom) {
        $this->custom = $custom;
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

    /***** fonctions proxy *****/
    
    /**
     * return string
     */
    public function getTitreProduit(){
        if(!is_null($this->produit)){
            return $this->produit->getTitre();
        }
    }
    
    /**
     * 
     * @return int
     */
    public function getProduitId(){
        if(!is_null($this->produit)){
            return $this->produit->getId();
        }
    }
    
    /**
     * return string
     */
    public function getTitreCustom(){
        if(!is_null($this->custom)){
            return $this->custom->getTitre_custom();
        }
    }
    
    /**
     * return int
     */
    public function getCustomId(){
        if(!is_null($this->custom)){
            return $this->custom->getId_custom();
        }
    }

     /**
     * 
     * @return int
     */
    public function getCommandeId(){
        if(!is_null($this->commande)){
            return $this->commande->getId_commande();
        }
    }
    
    public function setCommande_id($commande_id) {
        $this->commande_id = $commande_id;
        return $this;
    }

    public function setProduit_id($produit_id) {
        $this->produit_id = $produit_id;
        return $this;
    }

    public function setCustom_id($custom_id) {
        $this->custom_id = $custom_id;
        return $this;
    }

    public function getTitre()
    {
        if (!empty($this->getTitreCustom())) {
            return $this->getTitreCustom();
        }
        
        return $this->getTitreProduit();
    }

}
