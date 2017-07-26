<?php

namespace Controller\Admin;

use Controller\ControllerAbstract;
use Entity\Commande;

/**
 * Description of CommandeController
 * controlleur de l'entité Commande côté back
 * @author Julien
 */
class CommandeController extends ControllerAbstract
{
    /**
     * Cette méthode sert à afficher toutes les commandes par date d'enregistrement
     */
    public function listAction(){
        $commandes = $this->app['commande.repository']->findAll();
        
        if(!empty($_POST)){
            $id_commande = $_POST['id_commande'];
            $commande = $this->app['commande.repository']->find($id_commande);
            $etat = $commande->setEtat($_POST['etat']);
            $this->app['commande.repository']->save($commande);
            $this->addFlashMessage("L'état de la commande a été mis à jour");
        
            return $this->redirectRoute('admin_commandes');
        }
        
        return $this->render(
            'admin/commande/list.html.twig',
            ['commandes' => $commandes]
        );
    }
    
    /**
     * Cette méthode sert à afficher côté admin l'ensemble des commandes en les triant par état
     * elle prend en paramètre la valeur du champs état de la table commande 
     * 
     * @param string $etat
     * @return Commande
     */
    /*public function commandByState($etat){
        $commandes = $this->app['commande.repository']->findAllByState($etat);

       
        return $this->render(
            'admin/commande/list.html.twig',
            ['commandes' => $commandes]
        );
    }*/
    
    public function detailsByCommande($id_commande){
        $commande = $this->app['commande.repository']->find($id_commande);
        $detail_commandes = $this->app['detail.commande.repository']->findAllByCommande ($id_commande);
        
        //echo '<pre>';print_r($detail_commandes);echo '</pre>';
        
        return $this->render(
            'admin/commande/detail.html.twig',
            ['commande' => $commande,
            'detail_commandes' => $detail_commandes]
        );
    }
    
    /**
     * cette méthode sert à modifier l'état d'une commande
     */
    /*public function editAction($id){
        $commande = $this->app['commande.repository']->find($id);
        echo "<pre>";print_r($commande);echo"</pre>";
        $commande->app['commande.repository']->edit($commande);
        
        $this->addFlashMessage("L'état de la commande a été mis à jour");
        
        return $this->redirectRoute('admin_commandes');
    }*/
    
    public function deleteAction($id){
        $commande = $this->app['commande.repository']->find($id);
        
        $this->app['commande.repository']->delete($commande);
        
        $this->addFlashMessage("La commande a été supprimée");
        
        return $this->redirectRoute('admin_commandes');
    }
    
    public function sendDeliveryMail(){
        
    }
}
