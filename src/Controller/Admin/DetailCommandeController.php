<?php
namespace Controller\Admin;

use Entity\DetailCommande;
use Repository\DetailCommandeRepository;

/**
 * Description of DetailCommandeController
 *
 * @author Julien
 */
class DetailCommandeController 
{
    /**
     * Cette méthode sert à afficher toutes les détails d'une commande
     */
    /*public function listAction($id_commande){
        $commande = $this->app['commande.repository']->find($id_commande);
        $detail_commandes = $this->app['detail.commande.repository']->findAllByCommande($id_commande);
        
        return $this->render(
            'admin/commande/detail.html.twig',
            [
            'commande' => $commande,
            'detail_commandes' => $detail_commandes
            ]
        );
    }*/
}
