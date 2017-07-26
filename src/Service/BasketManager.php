<?php

namespace Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Entity\Basket;
use Entity\Produit;
use Entity\Custom;

/*
Vue de la session avec le basket dedans :

    SESSION
            basket   =>   $productsAndConfigs[produit1, produit2, config1, config2, produit3]
*/

class BasketManager
{
    private $session;

    //Constructeur qui initialise (initialiser ? Vraiment ?) la session
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
          

    //Méthode readBasket() qui retourne le contenu du panier
    public function readBasket()
    {
        if(!$this->session->has('basket')) //Si y'a pas de basket en session
        {
            return null;
        }
        else
        {
 
            return $this->session->get('basket');
        }
    }

    
    //Méthode readBasketAmount() qui retourne le prix total du panier
    public function readBasketAmount()
    {
        if(!$this->session->has('basketTotalAmount')) //Si y'a pas de basketTotalAmount en session
        {
            return null;
        }
        else
        {
            return $this->session->get('basketTotalAmount');
        }
    }

    
    //Méthode qui dit si l'objet en arg est un produit ou non => retourne un booleen
    public function isProduct($objetDansPanier)
    {
        if($objetDansPanier->getProduitOrCustom() == 'produit')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Méthode qui retourne la position d'un produit dans le panier de la session (si il existe), si il n'existe pas il retourne -1
    public function findProductInBasket(Produit $produit)
    {
        $productsAndConfigs = $this->readBasket(); //Récupérer le panier en session
        
        if ($productsAndConfigs == null) //Si le panier est vide
        {
            return -1; //on n'a pas trouvé le produit donc on retourne -1
        }
        else //Si le panier n'est pas vide
        {
            //Init position dans panier
            $positionDansPanier = 0;
            
            //On boucle sur le tableau d'objets (product ou config) dans le panier
            foreach ($productsAndConfigs as $productOrConfig)
            {
                if ($this->isProduct($productOrConfig)) //si l'objet est un produit
                {
                    //On regarde si c'est le même produit que celui passé en arg de la fonction
                    if($productOrConfig->getId() == $produit->getId())
                    {
                        return $positionDansPanier;
                    }
                }
                
                $positionDansPanier++;
            }
            
            //Si on n'a rien trouvé
            return -1;
        }
    }// fin de findProductInBasket()
    
    
    //Méthode qui dit si l'objet en arg est un custom ou non => retourne un booleen
    public function isCustom($objetDansPanier)
    {
        if($objetDansPanier->getProduitOrCustom() == 'custom')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //Méthode qui retourne la position d'une config dans le panier de la session (si elle existe), si elle n'existe pas on retourne -1

//    public function findConfigInBasket(Custom $config)
//    {
//        $productsAndConfigs = $this->readBasket(); //Récupérer le panier en session
//        
//        if ($productsAndConfigs == null) //Si le panier est vide
//        {
//            return -1; //on n'a pas trouvé la config donc on retourne -1
//        }
//        else //Si le panier n'est pas vide
//        {
//            //Init position dans panier
//            $positionDansPanier = 0;
//            
//            //On boucle sur le tableau d'objets (product ou config) dans le panier
//            foreach ($productsAndConfigs as $productOrConfig)
//            {
//                if ($this->isCustom($productOrConfig)) //si l'objet est une config ou custom (pareil)
//                {
//                    //On regarde si c'est le même produit que celui passé en arg de la fonction
//                    if($productOrConfig->getId_config() == $config->getId_config())
//                    {
//                        return $positionDansPanier;
//                    }
//                }
//                
//                $positionDansPanier++;
//            }
//            
//            //Si on n'a rien trouvé
//            return -1;
//        }
//    }//Fin de findConfigInBasket()
   
    
    //Méthode putProductToBasket($produit) qui met en session les infos du produit choisi
    public function putProductToBasket($produit)
    {
        //echo '<pre>'; print_r($produit); echo '</pre><br><br>';	

        ///// Initialisation variable basket
        if(!$this->session->get('basket')) //Si y'a pas de panier
        {
           //Initialisation du tableau contenu dans basket dans la session
           $productsAndConfigs = [];
        }
        else //Si y'a un panier
        {
           $productsAndConfigs = $this->session->get('basket'); //Je recup le panier
        }

        ///// Ajout du produit dans le panier (soit incrémenter quantité ou mettre un nouveau produit en quantité = 1)
        if($this->findProductInBasket($produit) != -1) //Si le produit est deja présent dans le panier
        {
            //Alors aller incrémenter la quantité de ce produit
            $positionDansPanier = $this->findProductInBasket($produit);
            $produitDontQuantiteFautIncrementer = $productsAndConfigs[$positionDansPanier];
            $quantiteAvantIncrementation = $produitDontQuantiteFautIncrementer->getQuantite();
            $produitDontQuantiteFautIncrementer->setQuantite($quantiteAvantIncrementation + 1);
            $productsAndConfigs[$positionDansPanier] = $produitDontQuantiteFautIncrementer;
        }
        else //Le produit n'etait pas encore dans le panier
        {
            //Ajouter le produit (en arg de la fonction) dans le $productsAndConfigs[] du panier à la fin
            array_push($productsAndConfigs, $produit);
        }

        ///// Maj panier en session
        $this->session->set('basket', $productsAndConfigs);
        
    }//Fin putProductToBasket()

 //Méthode putConfigToBasket($config) qui met en session les infos de la CONFIG choisie
   public function putConfigToBasket($config)
   {
       ///// Initialisation variable basket
       if(!$this->session->get('basket')) //Si y'a pas de panier
       {
          //Initialisation du tableau contenu dans basket dans la session
          $productsAndConfigs = [];
       }
       else //Si y'a un panier
       {
          $productsAndConfigs = $this->session->get('basket'); //Je recup le panier
       }

       ///// Ajout de la config dans le panier
       //Ajouter la config (en arg de la fonction) dans le $productsAndConfigs[] du panier à la fin
       array_push($productsAndConfigs, $config);

       ///// Maj panier en session
       $this->session->set('basket', $productsAndConfigs);
       
   }//Fin putConfigToBasket()
   
    
    //Fonction qui met le montant total du panier en session dans la key basketTotalAmount
    public function putTotalAmountToBasket($basketTotalAmount)
    {
         $this->session->set('basketTotalAmount', $basketTotalAmount);
    }
    
    
    //Fonction qui retire toutes les infos basket de la session
    public function flushBasketAndBasketAmount()
    {
        $this->session->remove('basket');
        $this->session->remove('basketTotalAmount');   
    }

                            //////FONCTION COMMENTEE CAR FAITE EN JQUERY
                            //Méthode calculateAmountBasket() qui va calculer me montant total du panier
                            //
                            //    public function calculateAmountBasket()
                            //    {
                            //        $amountBasket = 0; //Init valeur retour
                            //        
                            //        if($this->session->get('basket')) //Si y'a un panier
                            //        {
                            //           $productsAndConfigs = $this->session->get('basket'); //Je recup le panier
                            //
                            //           //On boucle sur le tableau d'objets (product ou config) dans le panier
                            //            foreach ($productsAndConfigs as $productOrConfig)
                            //            {
                            //                 $prixCurrentProduitOuConfig = $productOrConfig->getQuantite() * $productOrConfig->getPrix();
                            //                 $amountBasket += $prixCurrentProduitOuConfig;
                            //            }
                            //        }
                            //
                            //        return $amountBasket;
                            //    }


}//Fin BasketManager