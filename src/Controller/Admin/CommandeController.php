<?php

namespace Controller\Admin;

use Controller\ControllerAbstract;
use Entity\Commande;

/**
 * Description of CommandeController
 *
 * @author Julien
 */
class CommandeController extends ControllerAbstract
{
    /**
     * Cette méthode sert à afficher toutes les commandes par date d'enregistrement
     */
    public function listAction(){
        $commandes = $this->app['commande.repository']->findAll();
        
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
    public function commandByState($etat){
        $commandes = $this->app['commande.repository']->findAllByState($etat);

       
        return $this->render(
            'admin/commande/list.html.twig',
            ['commandes' => $commandes]
        );
    }
    
    /**
     * cette méthode sert à modifier l'état d'une commande
     */
    public function editAction($id){
        $commande = $this->app['commande.repository']->find($id);
        $commande->app['commande.repository']->edit($commande);
        
        $this->addFlashMessage("L'état de la commande a été mis à jour");
        
        return $this->redirectRoute('admin_commandes');
    }
    
    public function deleteAction($id){
        $commande = $this->app['commande.repository']->find($id);
        
        $this->app['commande.repository']->delete($commande);
        
        $this->addFlashMessage("La commande est supprimée");
        
        return $this->redirectRoute('admin_commandes');
    }
    
    public function sendDeliveryMail(){
        
    }
}
