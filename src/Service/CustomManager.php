<?php

namespace Service;

use Repository\TissuRepository;
use Repository\BoutonRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Entity\Custom;

class CustomManager {

    private $session;
    
    private $app;

    //Création de la session
    public function __construct(\Silex\Application $app) {
       $this->session = $app['session'];
       $this->app = $app;
   }

    
    //Si pas de session > set session appelé custom + création d'un array
    private function init() {
        if (!$this->session->has('custom')) {
            $this->session->set('custom', []);
        }
    }
    
    //Réutilisation de la fonction custom créé
    //Et création d'un "indice" tissu 
    //Indexation d'un attribut à cette indice tissu
    public function setTissu($tissu) {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['tissu'] = $tissu;
        $this->session->set('custom', $custom);
    }

    public function setBouton($bouton) {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['bouton'] = $bouton;
        $this->session->set('custom', $custom);
    }

    public function setCol($col) {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['col'] = $col;
        $this->session->set('custom', $custom);
    }

    public function setCoupe($coupe) {
        $this->init();  
        $custom = $this->session->get('custom');
        $custom['coupe'] = $coupe;
        $this->session->set('custom', $custom);
    }

    public function setPoidsTaille($poids, $taille)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['user_poids'] = $poids;
        $custom['user_taille'] = $taille;
        $this->session->set('custom', $custom);
    }

    public function setTronc($tour_cou, $tour_poitrine, $tour_taille, $tour_bassin)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['user_tour_cou'] = $tour_cou;
        $custom['user_tour_poitrine'] = $tour_poitrine;
        $custom['user_tour_taille'] = $tour_taille;
        $custom['user_tour_bassin'] = $tour_bassin;
        $this->session->set('custom', $custom);
    }

    public function setBras($manche_droite, $manche_gauche, $poignet_droit, $poignet_gauche)
        {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['user_manche_droite'] = $manche_droite;
        $custom['user_manche_gauche'] = $manche_gauche;
        $custom['user_poignet_droit'] = $poignet_droit;
        $custom['user_poignet_gauche'] = $poignet_gauche;
        $this->session->set('custom', $custom);
    }
    public function setCarrure($carrure, $epaule_droite, $epaule_gauche, $dos)
        {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['user_carrure'] = $carrure;
        $custom['user_epaule_droite'] = $epaule_droite;
        $custom['user_epaule_gauche'] = $epaule_gauche;
        $custom['user_dos'] = $dos;
        $this->session->set('custom', $custom);
    }
    
    public function setTitre_custom($titre_custom)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['titre_custom'] = $titre_custom;
        $this->session->set('custom' ,$custom);
    }
    
    public function setId_custom($id_custom)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['id_custom'] = $id_custom;
        $this->session->set('custom' , $custom);
    }

//    /* **** affichage des informations mises en session******** */
//
    public function readCustom() 
    {
        if (!$this->session->has('custom')) { //Si y'a pas de panier
            return null;
        } 
        else {
            return $this->session->get('custom'); //lecture du panier
        }
    }
    
    //Par edouard by Edouard pour info
   //Fonction qui calcule le prix d'une custom shirt à partir de id tissu et id bouton
   public function calculateCustomPrice($idTissu, $idBouton)
   {
       //Recup prix tissu
       $dbTabTissu = $this->app['tissu.repository']->findTissuById($idTissu); //Note : pour faire $this->app, on a rajouté app au custom manager dans app.php
       $prixTissu = $dbTabTissu['prix'];
       
       //Recup prix bouton
       $dbTabBouton = $this->app['bouton.repository']->findBoutonById($idBouton);
       $prixBouton = $dbTabBouton['prix_bouton'];
       
       //Calcul prix chemise, et return de ce prix
       $prixChemiseCusto = $prixTissu + $prixBouton;
       return $prixChemiseCusto;
   }

    //Par edouard by Edouard pour info
   //Fonction qui lit le custom en session, recupère qques infos, et instancie un objet Custom pour le setter avec les infos requises pour le panier, et renvoie cet objet Custom
   public function getCustomSessionAndMoreAndCreateCustomObjectForSessionBasket ()
   {
       //Recup custom en session
       $customSessionArray =  $this->readCustom();
       
       //Mettre les infos utiles en variable dans cette fonction
       $idCustomShirt = $customSessionArray['id_custom'];
       $idTissu = $customSessionArray['tissu'];
       $idBouton = $customSessionArray['bouton'];
       $titreCustomShirt = $customSessionArray['titre_custom'];
               
       //Recup infos custom absentes
       $prixChemiseCustom = $this->calculateCustomPrice($idTissu, $idBouton);
       $quantiteChemiseCustom = 1;
       
       //Creer un objet "Custom" et le setter
       $customShirt = new Custom();
       $customShirt->setId_custom($idCustomShirt);
       $customShirt->setTitre_custom($titreCustomShirt);
       $customShirt->setPrix($prixChemiseCustom);
       $customShirt->setQuantite($quantiteChemiseCustom);

       //Retourner l'objet
       return $customShirt;
   }

    public function flushCustomSession()
    {
       $this->session->remove('custom');
    }

}
