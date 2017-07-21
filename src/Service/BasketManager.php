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

    //Constructeur qui initialise la session
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
  
    //Méthode putProductToBasket($produit) qui met en session les infos du PRODUIT choisi
    public function putProductToBasket($produit)
    {
        //Initialisation variable basket
        if(!$this->session->get('basket')) //Si y'a pas de panier
        {
           //Initialisation du tableau contenu dans basket dans session
           $productsAndConfigs = [];
        }
        else //Si y'a un panier
        {
           $productsAndConfigs = $this->session->get('basket'); //Je recup la value correspondant à la key 'basket'
        }
        
        ///// Ajout du produit dans le panier (soit incrémenter quantité ou mettre un nouveau produit en quantité = 1)
        
        if($produit->getId() == 'A_FINIR') //Si le le produit est deja présent dans le oanier Alors aller incrémenter la quantité de ce produit
        {
            
        }
        else //Le produit n'etait pas encore dans le panier
        {
            //Ajouter le produit (en arg de la fonction) dans le $productsAndConfigs[] du panier à la fin
            array_push($productsAndConfigs, $produit);
        }
        
        
        //Maj panier en session
        $this->session->set('basket', $productsAndConfigs);
        
    }//Fin putProductToBasket()
  
    
    //Méthode putConfigToBasket($config) qui met en session les infos de la CONFIG choisi
    public function putConfigToBasket($config)
    {
          // A FAIRE QUAND CELLE DU DESSU NIKEL
        
    }//Fin putConfigToBasket()
    

    //Méthode readBasket() qui retourne le contenu du panier
    public function readBasket()
    {

        if(!$this->session->has('basket')) //Si y'a pas de panier
        {
            return null;
        }
        else
        {
            return $this->session->get('basket');
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
    
    
    //Méthode qui retourne la position d'un produit dans le panier de la session (si il existe), si il n'existe pas il retourne -1
    public function searchProductInBasket($produit)
    {
        $productsAndConfigs[] = readBasket(); //Récupérer le panier en session
        
        if ($productsAndConfigs == null) //Si le panier est vide
        {
            return -1; //on n'a pas toruvé le produit donc -1
        }
        else //Si le panier n'est pas vide
        {
            //Init position dans panier
            $positionDansPanier = 0;
            
            //On boucle sur les objets (product ou config) dans le panier
//            foreach ($productsAndConfigs as productOrConfig)
//            {
//                if (productOrConfig->isProduct()) //si l'objet est un produit
//                {
//                    //On regarde si c'est le même produit que celui passé en arg de la fonction
//                    if(productOrConfig->getId() == $produit->getId())
//                    {
//                        return $positionDansPanier;
//                    }
//                }
//                
//                $positionDansPanier++;
//            }
            
            //Si on n'a rien trouvé
            return -1;
        }
    }

}//Fin BasketManager
