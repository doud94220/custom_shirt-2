<?php

namespace Controller;

use Service\BasketManager;
use Entity\Basket;

//Pour tests (ou pas)
use Entity\Produit;
use Entity\Custom;
use Repository\ProduitRepository;


class BasketController extends ControllerAbstract
{
    /*
    Vue de la session avec le basket dedans :

        SESSION
                basket   =>   $productsAndConfigs[produit1, produit2, config1, config2, produit3, config3]
    */

    //Fonction pour voir tout le panier
    public function consultAction()
    { 
        // !!!!!!!!!!!!!!! FORCAGE DE LA SESSION EN DUR POUR TESTS !!!!!!!!!!!!!!!
        if(!$this->session->has('basket'))
        {
//            echo 'je creer un basket dans session en dur avec 3 produits et 3 customs ';
            
//            $product1 = new Produit;
//            $product1->setId(1);
//            $product1->setTitre("Titre Produit 1");
//            $product1->setPrix(15);
//            $product1->setQuantite(3);
//
//            $product2 = new Produit;
//            $product2->setId(2);
//            $product2->setTitre("Titre Produit 2");
//            $product2->setPrix(25);
//            $product2->setQuantite(5);
//
//            $product3 = new Produit;
//            $product3->setId(3);
//            $product3->setTitre("Titre Produit 3");
//            $product3->setPrix(35);
//            $product3->setQuantite(10);
//                        
//            $custom1 = new Custom;
//            $custom1->setId_config(1);
//            $custom1->setTitre("Chemise Custom 1");
//            $custom1->setCol(1);
//            $custom1->setCoupe(1);   
//            $custom1->setTissu_id(1);
//            $custom1->setButton_id(1);
//            $custom1->setPrix(79);   
//            $custom1->setQuantite(1);
//
//            $productsAndConfigs = array($product1, $product2, $product3, $custom1);
//            $this->session->set('basket', $productsAndConfigs);
            
            ////// TESTS EN DUR FONCTION putProductToBasket() qu'est dans le basketmanager
            // On creer un PRODUIT à rajouter dans panier (produit deja existant), et on le met en session
//            $produit_a_ajoute = new Produit();
//            $produit_a_ajoute->setId(1);
//            $produit_a_ajoute->setTitre("Titre Produit 1");
//            $produit_a_ajoute->setPrix(15);
//            $produit_a_ajoute->setQuantite(1);
//            $this->app['basket.manager']->putProductToBasket($produit_a_ajoute);

            // On creer un PRODUIT à rajouter dans panier (produit deja existant), et on le met en session
//            $produit_a_ajoute_2 = new Produit();
//            $produit_a_ajoute_2->setId(2);
//            $produit_a_ajoute_2->setTitre("Titre Produit 2");
//            $produit_a_ajoute_2->setPrix(25);
//            $produit_a_ajoute_2->setQuantite(1);
//            $this->app['basket.manager']->putProductToBasket($produit_a_ajoute_2);
            
             // On creer un PRODUIT à rajouter dans panier (produit NON EXISTANT), et on le met en session
//            $produit_a_ajoute_3 = new Produit();
//            $produit_a_ajoute_3->setId(4);
//            $produit_a_ajoute_3->setTitre("Titre Produit 4");
//            $produit_a_ajoute_3->setPrix(45);
//            $produit_a_ajoute_3->setQuantite(1);
//            $this->app['basket.manager']->putProductToBasket($produit_a_ajoute_3);
            
            // On creer une CONFIG à rajouter dans panier (config deja existante), et on le met en session
//            $custom2 = new Custom;
//            $custom2->setId_config(1);
//            $custom2->setTitre("Chemise Custom 1");
//            $custom2->setCol(1);
//            $custom2->setCoupe(1);   
//            $custom2->setTissu_id(1);
//            $custom2->setButton_id(1);
//            $custom2->setPrix(79);   
//            $custom2->setQuantite(1);
//            $this->app['basket.manager']->putConfigToBasket($custom2);      
//            
//            // On creer une CONFIG à rajouter dans panier (config NON EXISTANTE), et on la met en session
//            $custom3 = new Custom;
//            $custom3->setId_config(2);
//            $custom3->setTitre("Chemise Custom 2");
//            $custom3->setCol(2);
//            $custom3->setCoupe(2);   
//            $custom3->setTissu_id(2);
//            $custom3->setButton_id(2);
//            $custom3->setPrix(99);   
//            $custom3->setQuantite(1);
//            $this->app['basket.manager']->putConfigToBasket($custom3);
        }
        //Fin du forcage en dur de la session


        //Je recupère le panier en session
        $productsAndConfigs = $this->app['basket.manager']->readBasket(); //auto-completion marche pas mais normal
        

        //Render vers la vue "basket"
        return $this->render(
                                'basket/index.html.twig'
                                ,
                                [
                                  'basket' => $productsAndConfigs
                                ]
                             );
        
    }//Fin consultAction()
    
    
    //Fonction pour supprimer un produit du panier
    public function deleteAction($idProduitEnSession)
    {
        //Je recupère le basket de la session
        $productsAndConfigs = $this->app['basket.manager']->readBasket();

        //Je retire le produit à supprimer
        array_splice($productsAndConfigs, $idProduitEnSession, 1);

        //Je mets le nouveau panier 'allégé d'un produit' en session
        $this->session->set('basket', $productsAndConfigs);

        //Je redirige vers la page consultation panier
        return $this->redirectRoute('basket_consult');

    }//Fin deleteAction()
    
    
    //Fonction pour incrémenter la quantité d'un produit dans le panier
    public function incrementAction($idProduitEnSession) //Id du produit en session
    {
        //Je recupère le basket de la session
        $productsAndConfigs = $this->app['basket.manager']->readBasket();		

        //J'incrémente la quantité du produit passé en arg de la fonction
        $productsAndConfigs[$idProduitEnSession]->setQuantite($productsAndConfigs[$idProduitEnSession]->getQuantite() + 1);
                
        //Je mets le nouveau panier en session
        $this->session->set('basket', $productsAndConfigs);

        //Je redirige vers la page consultation panier
        return $this->redirectRoute('basket_consult');

    }//Fin incrementAction()

    
    //Fonction pour décrémenter la quantité d'un produit dans le panier
    public function decrementAction($idProduitEnSession)
    {
        //Je recupère le basket de la session
        $productsAndConfigs = $this->app['basket.manager']->readBasket();

        //Je décrémente la quantité du produit passé en arg de la fonction
        $productsAndConfigs[$idProduitEnSession]->setQuantite($productsAndConfigs[$idProduitEnSession]->getQuantite() - 1);

        //Je mets le nouveau panier en session
        $this->session->set('basket', $productsAndConfigs);

        //Je redirige vers la page consultation panier
        return $this->redirectRoute('basket_consult');
 
    }//Fin decrementAction()
    
    
    //Fonction pour payer le panier
    public function payAction()
    {
        //Mise en session du prix du panier
        if(!empty($_POST)) //Si y'a bien qque chose dans $_POST
        {
            $this->app['basket.manager']->putTotalAmountToBasket($_POST['montantTotalPanier']); //On met le montant total du panier en session
        }
        
        
        //////////////////////////////////////////////////////////
        //TEMPORAIRE - TEST INSERTION DANS TABLE COMMANDE
        $this->app['commande.controller']->createCommandAction();
        //////////////////////////////////////////////////////////
        
        
        //On va vers la page de paiment du panier en passant en param le montant total du panier
        return $this->render(
                                'basket/basketPayment.html.twig',
                                [
                                    'basketTotalAmount' => $_POST['montantTotalPanier']
                                ]
                             );
    } //Fin payAction()


}//Fin BasketController
