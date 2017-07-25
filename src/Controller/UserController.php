<?php
namespace Controller;
use Entity\User;
use Service\UserManager;
use DateTime;

class UserController extends ControllerAbstract
{
    public function registerAction(){
        
    }
    
    public function loginAction(){
        $email = '';
        
        if(!empty($_POST)){
            $email = $_POST['email'];
            
            $user = $this->app['user.repository']->findByEmail($email);
            
            if(!is_null($user)){
                if($this->app['user.manager']->verifyPassword($_POST['password'], $user->getPassword())){
                    $this->app['user.manager']->login($user);
                
                return $this->redirectRoute('homepage');
                }
            }
            
            $this->addFlashMessage('Identification incorrecte', 'error');
        }
        
        return $this->render(
            'user/login.html.twig',
            ['email' => $email]
        );
    }
    
    public function logoutAction(){
        $this->app['user.manager']->logout();
        
        return $this->redirectRoute('homepage');
    }

    public function modifAction()
    {
        $user = $this->app['user.manager']->getUser();
        return $this->render(
            'user/modif.html.twig',
            [
                'user' => $user
            ]
        );
    }

    public function showProfile(){
        $user = $this->app['user.manager']->getUser();
        $commandes = $this->app['commande.repository']->findAllByUser($user);
        $details_commandes =[];
        foreach($commandes as $commande){
            $detailsCurrentCommande = $this->app['detail.commande.repository']->findAllByCommande($commande->getId_commande());
            echo '<pre>'; print_r($detailsCurrentCommande); echo '</pre><hr>';
            foreach ($detailsCurrentCommande as $currentDetails) {
                
                //echo '<pre>'; print_r($currentDetails->getCustom_id()); echo '</pre><hr>';
                $custom = $this->app['custom.repository']->find($currentDetails->getCustom_id());
                //echo '<pre>'; print_r($custom); echo '</pre><hr>';
                $currentDetails->setCustom($custom);
            }
            
            $details_commandes[] = $detailsCurrentCommande;
        }
        
        //
        
        //echo '<pre>'; print_r($commandes); echo '</pre><hr>';
        //echo '<pre>'; print_r($details_commandes); echo '</pre>';
        return $this->render(
        'user/profile.html.twig',
            [
                'user' => $user,
                'commandes' => $commandes,
                'details_commandes' => $details_commandes
            ]        
        );
    }
        
   /* public function showDetails($id_commande){
        $detail_commandes = $this->app['detail.commande.repository']->findAllByCommande($id_commande);
        
        return $this->render(
        'user/profile.html.twig',
            [
                'detail_commandes' => $detail_commandes
            ]        
        );
    }*/
        
//        if(empty($commandes)){
//            $this->addFlashMessage("Vous n'avez pas de commande", 'warning');
//        }
    
}