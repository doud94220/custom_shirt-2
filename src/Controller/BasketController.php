<?php

namespace Controller;


use Service\BasketManager;
use Entity\Basket;

//Pour tests
use Entity\Produit;
use Entity\Custom;

//Pour test mail
use Silex\Provider\SwiftmailerServiceProvider;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Swift_MailTransport;

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
//        if(!$this->session->has('basket'))
//        {
//            echo 'je creer un basket dans session en dur avec 3 produits et 3 customs ';
//            
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
//            $custom1->setButton_id(3);
//            $custom1->setCol(3);
//            $custom1->setCoupe(3);   
//            $custom1->setId_config(1);
//            $custom1->setPrix(70);   
//            $custom1->setTissu_id(7);
//            $custom1->setQuantite(1);
//
//            $custom2 = new Custom;
//            $custom2->setButton_id(5);
//            $custom2->setCol(5);
//            $custom2->setCoupe(5);   
//            $custom2->setId_config(2);
//            $custom2->setPrix(80);   
//            $custom2->setTissu_id(5);
//            $custom2->setQuantite(2);
//
//            $custom3 = new Custom;
//            $custom3->setButton_id(7);
//            $custom3->setCol(7);
//            $custom3->setCoupe(7);   
//            $custom3->setId_config(3);
//            $custom3->setPrix(90);   
//            $custom3->setTissu_id(7);
//            $custom3->setQuantite(3);
//
//            $productsAndConfigs = array($product1, $product2, $custom1, $custom2, $product3, $custom3);        
//            $this->session->set('basket', $productsAndConfigs);       
//        }
        //Fin du focage en dur de la session

        
        //Je recupère le basket en session
        $productsAndConfigs = $this->app['basket.manager']->readBasket(); //auto-completion marche pas mais normal
        //echo '<pre>'; print_r($productsAndConfigs); echo '</pre><br><br>';
        
        
        ///////////////// TEMPORAIRE /////////////////
        ////////////  TEST 2 DU MAIL////////////
                    //        $this->app['mailer']->send(\Swift_Message::newInstance()
                    //                ->setSubject('sujet mail test')
                    //                ->setFrom(array('doud75@gmail.com'))
                    //                ->setTo(array('edouard.anthony@gmail.com'))
                    //                ->setBody('corps du mail test');
                
        ////////////  TEST 3 DU MAIL////////////
                            // Create the mail transport configuration
                    //        $transport = Swift_MailTransport::newInstance();
                            // Create the message
                    //        $message = Swift_Message::newInstance();
                    //        $message->setTo(array(
                    //          "doud75@gmail.com" => "doud"
                    //        ));
                    //        $message->setSubject("Test Mail SwiftMailer");
                    //        $message->setBody("Chai pas quoi mettre dans le body");
                    //        $message->setFrom("edouard.anthony@gmail.com", "MrAnthony");
                            // Send the email
                    //        $mailer = Swift_Mailer::newInstance($transport);
                    //        $mailer->send($message);
        
       
        //Render vers la vue "basket"
        return $this->render(
                                'basket/index.html.twig',
                                [
                                  'basket' => $productsAndConfigs
                                ]
                             );
        
    }//Fin consultAction()
    
    
    //Fonction pour supprimer un produit du panier
    public function deleteAction($idProduitEnSession)
    {
        //// TEMPORAIRE (Debug)
        //$messagePourDebug = "je vais supprimer le produit en position " . $idProduitEnSession . " dans le panier";
        //$this->addFlashMessage($messagePourDebug);

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
    
    
}//Fin BasketController
