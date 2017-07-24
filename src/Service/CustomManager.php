<?php

namespace Service;

use Symfony\Component\HttpFoundation\Session\Session;

class CustomManager {

    private $session;

    //Création de la session
    public function __construct(Session $session) {
        $this->session = $session;
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

    public function setPoidsTaille($poidstaille)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['user'] = $poidstaille;
        $this->session->set('custom', $custom);
    }

//    public function setTronc($tronc)
//    {
//        $this->init();
//        $custom = $this->session->get('custom');
//        $custom['user'] = $tronc;
//    }
//
    //    public function setBras($bras)
    //    {
//        $this->init();
//        $custom = $this->session->get('custom');
//        $custom['user'] = $bras;
//    }
    //    public function setCarrure($carrure)
    //    {
//        $this->init();
//        $custom = $this->session->get('custom');
//        $custom['user'] = $carrure;
//    }

    /*     * *Mise des choix en session****** */

//    public function putCustominSession($custom) {
//        if (!$this->session) {
//            $_SESSION[] = $this->session->get('custom');
//        } else {
//
//        }
//    }
//    /*     * **** affichage des informations mises en session******** */
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


}
