<?php
namespace Entity;

use DateTime;

/**
 * Description of Commande
 * Classe de l'entitÃ© commande
 * @author Julien
 */
class Commande 
{
    /**
     * @var int
     */
    private $id_commande;
    
    /**
     * @var int
     */
    private $user_id;
    
    /**
     * @var int
     */
    private $prix_livraison;
    
    /**
     * @var int
     */
    private $total;
    
    /**
     * @var DateTime
     */
    private $date_commande;
    
    /**
     * @var string
     */
    private $etat = 'en préparation';
    
    /**
     * pour récupérer les entrées de la table détail_commande
     * @var array
     */
    private $details = [];
    
    /***** GETTERS *****/
    /**
     * @return int
     */
    public function getId_commande() {
        return $this->id_commande;
    }

    /**
     * @return int
     */
    public function getUser_id() {
        return $this->user_id;
    }
    /**
     * @return int
     */
    public function getPrix_livraison() {
        return $this->prix_livraison;
    }

    /**
     * @return int
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * @return DateTime
     */
    public function getDate_commande() {
        return $this->date_commande;
    }

    /**
     * @return string
     */
    public function getEtat() {
        return $this->etat;
    }

    /**
     * 
     * @return array
     */
    public function getDetails() {
        return $this->details;
    }
    
    /***** SETTERS *****/
    /**
     * @param int $id_commande
     * @return Commande
     */
    public function setId_commande($id_commande) {
        $this->id_commande = $id_commande;
        return $this;
    }

    /**
     * @param int $user_id
     * @return Commande
     */
    public function setUser_id($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param int $prix_livraison
     * @return Commande
     */
    public function setPrix_livraison($prix_livraison) {
        $this->prix_livraison = $prix_livraison;
        return $this;
    }

    /**
     * @param int $total
     * @return Commande
     */
    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    /**
     * @param DateTime $date_commande
     * @return Commande
     */
    public function setDate_commande(DateTime $date_commande) {
        $this->date_commande = $date_commande;
        return $this;
    }

    /**
     * @param string $etat
     * @return Commande
     */
    public function setEtat($etat) {
        $this->etat = $etat;
        return $this;
    }
    
    /**
     * 
     * @param array $details
     * @return Commande
     */
    public function setDetails(array $details) {
        $this->details = $details;
        return $this;
    }


}
