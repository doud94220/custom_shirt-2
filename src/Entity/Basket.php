<?php

namespace Entity;

class Basket
{
   // ATTRIBUTS 
   
   private $titre;
   private $produitId;
   private $configId;
   private $quantite;
   private $prix;
   
   // GETTERS ET SETTERS
   
   public function getTitre() {
       return $this->titre;
   }

   public function getProduitId() {
       return $this->produitId;
   }

   public function getConfigId() {
       return $this->configId;
   }

   public function getQuantite() {
       return $this->quantite;
   }

   public function getPrix() {
       return $this->prix;
   }

   public function setTitre($titre) {
       $this->titre = $titre;
       return $this;
   }

   public function setProduitId($produitId) {
       $this->produitId = $produitId;
       return $this;
   }

   public function setConfigId($configId) {
       $this->configId = $configId;
       return $this;
   }

   public function setQuantite($quantite) {
       $this->quantite = $quantite;
       return $this;
   }

   public function setPrix($prix) {
       $this->prix = $prix;
       return $this;
   }
   
    // AUTRES FONCTIONS
   
}






//    SPECIFICATION BASKET/PANIER :
//			0) Creer 3 fichiers : 
//				- Entity\Basket.php 'attribys et Getters/Setters'
//				- Service\BasketManager.php vide pour l'instant
//				- Controller\BasketController.php vide pour l'instant
//
//			Dans le Service\BasketManager.php :
//
//			1) Faire une méthode putProductToBasket($produit) qui met en SESSION dans le PANIER les infos du produit choisi dans la partie boutique (hors config demi-mesure)
//				=> fonction qui sera utilisée par Anzor : lors du click sur "Mettre au panier", Anzor fera appel à cette fonction
//
//			2) Faire une méthode putConfigToBasket($config) qui met en SESSION dans le PANIER les infos de la config (cf. chemise demi-mesure) choisi dans la partie boutique config chemise demi-mesure
//				=> fonction qui sera utilisé par Guillaume : lors du click sur "Mettre au panier", Guillaume fera appel à cette fonction
//
//			3) Faire une méthode readBasket() qui va lire les infos en session et les ramènent (cf. return)
//				=> fonction utilisé par le controleur Controller\BasketController.php (lorsque le visiteur a cliqué sur "Panier" pour voir son panier), page
//					qui sera appelé en GET avec action=consult
//
//                      4) Dans le Controller\BasketController.php :
//                      a) appeler readBasket() et afficher dans un tableau les infos PANIER (on y accède avec action=consult dans le GET) en appelant la vue basket\index.html.twig
//                      b) Faire la vue basket\index.html.twig
//                      c) rajouter dans le tableau fait ci-dessus des liens la MODIFICATION et SUPPRESSION des produits du panier
//                      d) Gérer la SUPPRESSION d'un produit du panier
//                      e) Gérer la MODIF d'un produit du panier           
//                      f) rajouter un bouton paiement qui va prendre les DATA en session et "aller vers le paiement"
