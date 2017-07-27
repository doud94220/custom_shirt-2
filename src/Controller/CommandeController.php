<?php
namespace Controller;

use Repository\CommandeRepository;
use Service\BasketManager;
use Service\UserManager;
use Entity\User;
use Entity\Produit;
use Entity\Custom;
use Entity\Commande;
use Entity\DetailCommande;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

/**
 * Description of CommandeController
 * controlleur de l'entité Commande côté front
 * @author Julien
 */
class CommandeController extends ControllerAbstract
{
    /**
     * Cette méthode sert à afficher les commandes (en cours et passées) de l'utilisateur connecté
     * elle récupère l'utilisateur connecté grâce à la session et passe à la vue les commandes associées
     */
    public function showAction(){
        $user = $this->app['user.manager']->getUser();
        $commandes = $this->app['commande.repository']->findAllByUser($user);
        
        return $this->render(
            'user/profile.html.twig',
            ['commandes' => $commandes]
        );
    }
    
    /**
     * cette méthode sert à créer une COMMANDE à partir des éléments contenus dans le panier en session
     */
    public function createCommandAction()
    {
        if($this->app['user.manager']->getUser() == null) //Si le user n'est pas connecte
        {
            $this->addFlashMessage('Vous devez être loggué pour payer votre panier', 'error');
            return $this->redirectRoute('login');
        }

        ////// Recup 'basket' et 'basketTotalAmount' à partir de la session
        $productsAndConfigs = $this->app['basket.manager']->readBasket();
        //echo '<pre>';var_dump($this->app['basket.manager']->readBasket());echo'</pre>';
        $basketAmount = $this->app['basket.manager']->readBasketAmount();
        
        ////// Insertion d'une partie de la commande dans la table commande (etape 1 sur 2)
        $commande = new Commande();
        $idUser = $this->app['user.manager']->getUser()->getId_user();
        $commande->setUser_id($idUser);
        $commande->setPrix_livraison(15); //PRIX LIVRAISON EN DUR
        $commande->setTotal($basketAmount+15); //IDEM
        $commande->setEtat('en préparation');
        $this->app['commande.repository']->save($commande); //Insertion ds table commande
        
        ////// Insertion d'une partie de la commande dans la table detail_commande (etape 2 sur 2)
         //Recup du dernier id dans la table commande
        $lastIdTableCommand = $this->app['commande.repository']->getLastInsertId();
        
        //On boucle sur les produits du panier
        foreach ($productsAndConfigs as $productOrConfig)
        {
            //Instanciation d'une DetailCommande
            $detailCommande = new DetailCommande();

            //Set de l'id
            $detailCommande->setCommande_id($lastIdTableCommand);

            //Set de l'id du produit ou de la config
            if ($this->app['basket.manager']->isProduct($productOrConfig)) //Si c'est un produit
            {
                $idProduit = $productOrConfig->getId();
                $detailCommande->setProduit_id($idProduit);
            }
            else //Si c'est une config
            {
               $idCustom = $productOrConfig->getId_custom();
               $detailCommande->setCustom_id($idCustom);
            }

            //Set de la quantite
            $quantiteProduitOuConfig = $productOrConfig->getQuantite();
            $detailCommande->setQuantite($quantiteProduitOuConfig);

            //Set du prix
            $prixProduitOuConfig = $productOrConfig->getPrix();
            $detailCommande->setPrix($prixProduitOuConfig);        

            ////Insertion ds table id_commande
            $this->app['detail.commande.repository']->save($detailCommande);
            
        }//Fin du foreach
    }
    
    /**
     * cette méthode
     */
    public function followAction($id_commande){
        
    }
    
    public function deleteAction($id){
        $commande = $this->app['commande.repository']->find($id);
        
        $this->app['commande.repository']->delete($commande);
        
        $this->addFlashMessage("La commande est supprimée");
        
        return $this->redirectRoute('profile');
    }
    
    public function returnAction($id){
        $commande = $this->app['commande.repository']->find($id);
        
        return $this->render(
                'commande/return.html.twig',
                ['commande' => $commande]
        );
    }
    
    
    
    /**
     * Cette méthode sert à envoyer un mail de confirmation lorsque la commande est validée 
     * @param int $id_commande
     */
    public function sendConfirmationMail($id_commande){
        $user = $this->app['user.manager']->getUser();
        $commande = $this->app['commande.repository']->find($id_commande);
        
        $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
            ->setUsername('admin')
            ->setPassword('admin')
        ;
        
        $mailer = new Swift_Mailer($transport);
        
        $message = (new Swift_Message('Validation de commande'))
            ->setFrom(['admin@custom-shirt.com' => 'Admin'])
            ->setTo([$this->user->getEmail() => $this->user->getNom()." ".$this->user->getPrenom()])
            ->setBody('Merci, votre commande n°'.$this->commande->getId_commande.' a été validée')
        ;
        
        echo $message;
    }
    
    /**
     * Cette méthode permet à l'utilisateur de reproduire une commande passée
     */
    public function cloneCommande($id_commande){
        
    }
    
    
    
    
}
