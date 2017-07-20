<?php

namespace Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Entity\Basket;

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
           //Créer un objet Basket
           $basket = new Basket();
           
           //Y placer un tableau de produit(s) et config(s)
           $productsAndConfigs = [];
           $this->session->set('basket', $productsAndConfigs);
        }
        else //Si y'a un panier
        {
           $productsAndConfigs = $this->session->get('basket'); //Je recup la value correspondant à la key 'basket'
        }
        
        //Ajouter le produit (en arg de la focntion) dans le $productsAndConfigs[] du panier
        array_push($productsAndConfigs, $produit);
        
        //Maj panier en session
        $this->session->set('basket', $productsAndConfigs);
        
    }//Fin putProductToBasket()
  
  
    //Méthode putConfigToBasket($config) qui met en session les infos de la CONFIG choisi
    public function putConfigToBasket($config)
    {
        //Initialisation variable basket
        if(!$this->session->get('basket')) //Si y'a pas de panier
        {
          //Créer un objet Basket
          $basket = new Basket();
           
           //Y placer un tableau de produit(s) et config(s)

          $productsAndConfigs = array();

          $basket = $productsAndConfigs;
        }
        else //Si y'a un panier
        {
           $productsAndConfigs[] = $this->session->get('basket'); //Je recup la value correspondant à la key 'basket'
        }
        
        //Ajouter la config (en arg de la focntion) dans le $productsAndConfigs[] du panier
        $productsAndConfigs[] = $config;
        
        //Maj panier en session
        $this->session->set('basket', $productsAndConfigs[]);
        
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

}//Fin BasketManager