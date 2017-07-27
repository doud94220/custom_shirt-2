<?php

namespace Controller;

use Service\BasketManager;
use Service\CustomManager;
use Entity\Basket;
use Entity\Produit;
use Entity\Custom;
use Repository\ProduitRepository;
use Repository\CustomRepository;

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
        ////////////////// JE CREER UNE CUSTOM ET LA MET DANS LE PANIER EN DUR //////////////////
        /////////////////////////////////////////////////////////////////////////////////////////

        //Recup du dernier id dans table custom
        //$idCustom = $this->app['custom.repository']->getLastInsertId();
        
        //Creation d'un array custom pour session => BOUCHON
//        $custom = array(
//                    'tissu' => 1,
//                    'bouton'  => 1,
//                    'titre_custom'  => 'Ma premiere chemise custom',
//                    'id_custom' => 1
//                );

        //Mise en session du Custom
        //$this->session->set('custom', $custom);
        
        
        //Pour GUILLAUME
        
        //Creation d'un objet Custom à partir des données du custom en session
        //$customShirtObject = $this->app['custom.manager']->getCustomSessionAndMoreAndCreateCustomObjectForSessionBasket();
        
        //Mise dans panier du Custom
        //$this->app['basket.manager']->putConfigToBasket($customShirtObject);
        
         /////////////////////////////////////////////////////////////////////////////////////////       
        //////////////////////////////// FIN FORCAGE EN DUR //////////////////////////////////////
        
        
        
        
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

        if($productsAndConfigs[$idProduitEnSession]->getQuantite() == 1) //Si quantite du produit cliqué = 1
        {
            //Je mets un message warning et je reviens vers le panier
            $this->addFlashMessage("La quantité est de 1, si vous voulez retirer ce produit, cliquer sur le lien 'Retirer le produit'", "warning");
            return $this->redirectRoute('basket_consult');
        }
        else //Si quantite du produit cliqué > 1
        {
            //Je décrémente la quantité du produit passé en arg de la fonction
            $productsAndConfigs[$idProduitEnSession]->setQuantite($productsAndConfigs[$idProduitEnSession]->getQuantite() - 1);
        }
        //Je mets le nouveau panier en session
        $this->session->set('basket', $productsAndConfigs);

        //Je redirige vers la page consultation panier
        return $this->redirectRoute('basket_consult');
 
    }//Fin decrementAction()
    
    /**
     * TEST JULIEN :
     * Cette méthode sert à envoyer sur la page de paiement lorsque l'utilisateur valide son panier
     */
//    public function payAction(){
//        if ($this->session->has("basket")){
//            $basket = $this->app["basket.controller"]->consultAction();
//            
//            return $this->render(
//                'paiement/paiement.html.twig',
//                ['basket' => $basket]
//            );
//        }else{
//            $this->addFlashMessage("Votre panier est vide !", "warning");
//            
//            return $this->redirectRoute('basket_consult');
//        }
//    }
    
    //Fonction pour payer le panier
    public function payAction()
    {
        //Mise en session du prix du panier
        if(!empty($_POST)) //Si y'a bien qque chose dans $_POST
        {
            $this->app['basket.manager']->putTotalAmountToBasket($_POST['montantTotalPanier']); //On met le montant total du panier en session
        }
        else //Si y'a rien dans $_POST => probleme
        {
            $this->addFlashMessage("Le montant du panier n'est pas dans POST", "error"); 
            return $this->redirectRoute('basket_consult');
        }
        
        //On va vers la page de paiment du panier en passant en param le montant total du panier
        return $this->render(
                                'basket/basketPayment.html.twig',
                                [
                                    'basketTotalAmount' => $_POST['montantTotalPanier']
                                ]
                             );
    } //Fin payAction()


    public function payChargeAction()
    {
        //Creation de la commande en BDD
       $this->app['commande.controller']->createCommandAction();
       
       //Retirer 'basket' et 'basketTotalAmount' de la session
       $this->app['basket.manager']->flushBasketAndBasketAmount();
       
        return $this->render(
            'paiement/charge.html.twig'
        );
    }

}//Fin BasketController
