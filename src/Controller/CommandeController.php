<?php
namespace Controller;

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
     * cette méthode sert à créer en base une commande et ses détails à partir des éléments contenus dans le panier en session
     */
    public function registerAction(){
        
        // vérifications et création en base des détails de la commande
        if(!empty($_SESSION['basket']['productsandconfigs'])){
            foreach($productOrconfig as $productsandconfigs){
                $detail_commandes = new DetailCommande;
                
                $detail_commandes
                    ->setCommande_id($_SESSION['basket']['productsandconfigs']['commande_id'])
                    ->setPrix($_SESSION['basket']['productsandconfigs']['prix'])
                    ->setQuantite($_SESSION['basket']['productsandconfigs']['quantite'])
                ;
                if(!empty($_SESSION['basket']['productsandconfigs']['custom_id'])){
                    $detail_commandes
                        ->setCustom_id($_SESSION['basket']['productsandconfigs']['custom_id'])
                        ->setTitre_custom($_SESSION['basket']['productsandconfigs']['titre_custom'])    
                    ;
           
                }else{
                    $detail_commandes
                        ->setProduit_id($_SESSION['basket']['productsandconfigs']['produit_id'])
                        ->setTitre($_SESSION['basket']['productsandconfigs']['titre'])
                    ;
                }
                // insertion en base de chaque détail de la commande
                $this->app['detail.commandes.repository']->save($detail_commandes);
            }
        }
        
        //vérifications et création en base de la commande
        $commande = new Commande();
        $errors = [];
        
        if(!empty($_SESSION['basket'])){
            $commande
                ->setUser_id($_SESSION['basket']['user_id'])
                ->setPrix_livraison($_SESSION['basket']['prix_livraison'])
                ->setTotal($_SESSION['basket']['total'])
                ->setEtat('en préparation')
                ->setDate_commande(NOW())
            ;
        }
        
        // message et redirection s'il n'y a pas d'utilisateur associé au panier
        if(empty($_SESSION['basket']['user'])){
            $errors['user'] = 'Veuillez vous connecter ou créer un compte';
            return $this->redirectRoute('login');
        }
        
        // message et redirection si le panier est vide
        if(empty(['basket']['productsandconfigs'])){
            $errors['productsandconfigs'] = 'Votre panier est vide !';
            return $this->redirectRoute('homepage');
        }
        
        // insertion en base de la commande
        if(empty($errors)){
            $this->app['commande.repository']->save($commande);
            $this->addFlashMessage("Toute l'équipe de Custom-shirt vous remercie pour votre confiance ! Votre commande a été enregistrée avec succès. Vous pouvez suivre l'ensemble de vos commandes depuis votre page personnelle", 'success');
            return $this->redirectRoute('profile');
        }else{
            $msg = '<strong>Requête impossible</strong>';
            $msg .= '<br>'. implode('<br>', $errors);

            $this->addFlashMessage($msg, 'error');
        }
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
