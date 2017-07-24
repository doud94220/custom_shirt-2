<?php

namespace Controller;

use Entity\User;
use Service\CustomManager;

class CustomController extends ControllerAbstract {

    // Récupération des choix de configuration de l'utilisateur
    // On garde cette configuration en base pour pouvoir la partager

    public function listTissu() {
        $tissus = $this->app['tissu.repository']->findAllTissu();

        if (!empty($_POST)) {
            if (empty($_POST['custom_product'])) {
                
                $this->addFlashMessage("Merci de choisir un tissu", 'error');
              
            } else {
                //var_dump($_POST['custom_product']);
                $this->app['custom.manager']->setTissu($_POST['custom_product']);
                //var_dump($this->app['custom.manager']->readCustom());
                return $this->redirectRoute('etape_2_bouton');
                
            }
        }
        return $this->render
                        (
                        'custom/tissu.html.twig', [
                    'tissus' => $tissus
                        ]
        );
    }

    public function listBouton() {
        $boutons = $this->app['bouton.repository']->findAllBouton();

        if (!empty($_POST)) {
            if (empty($_POST['custom_product'])) {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

                $this->addFlashMessage("Merci de choisir un bouton", 'error');
                // stockage en session
                //redirection vers la page suivante
            } else {
                $this->app['custom.manager']->setBouton($_POST['custom_product']);
                return $this->redirectRoute('etape_3_col');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
        }
        return $this->render
                        (
                        'custom/bouton.html.twig', [
                    'boutons' => $boutons
                        ]
        );
    }

    public function listCol() {
        $cols = $this->app['col.repository']->findAllCol();

        if (!empty($_POST)) {
            if (empty($_POST['custom_product'])) {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

                $this->addFlashMessage("Merci de choisir un col", 'error');
                // stockage en session
                //redirection vers la page suivante
            } else {
                $this->app['custom.manager']->setCol($_POST['custom_product']);
                return $this->redirectRoute('etape_4_coupe');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
        }
        return $this->render
                        (
                        'custom/col.html.twig', [
                    'cols' => $cols
                        ]
        );
    }

    public function listCoupe() {
        $coupes = $this->app['coupe.repository']->findAllCoupe();

        if (!empty($_POST)) {
            if (empty($_POST['custom_product'])) {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

                $this->addFlashMessage("Merci de choisir une coupe", 'error');
                // stockage en session
                //redirection vers la page suivante
            } else {
                $this->app['custom.manager']->setCoupe($_POST['custom_product']);
                return $this->redirectRoute('custom_recap');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
        }
        return $this->render
                        (
                        'custom/coupe.html.twig', [
                    'coupes' => $coupes
                        ]
        );
    }

    public function fillTaillePoids() {
        //$user = $this->session->get('user');
        //$user = $this->app['user.repository']->save();
        $user = new User();
        $errors = [];

        if (!empty($_POST)) {
            $user
                    ->setPoids($_POST['poids'])
                    ->setTaille($_POST['taille'])
            ;

            if (empty($_POST['poids'])) {
                $errors['poids'] = 'Merci de renseigner votre poids';
            }

            if (empty($_POST['taille'])) {
                $errors['taille'] = 'Merci de renseigner votre taille';
            }

            if (!is_numeric($_POST['poids'])) {
                $errors['poids'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['taille'])) {
                $errors['taille'] = 'Merci de renseigner un chiffre';
            }

            if (empty($errors)) {
                $this->app['user.repository']->saveTaillePoids($user);
                return $this->redirectRoute('etape_5_tronc');
            }
        }

        return $this->render
                        (
                        'custom/mesure_etape1.html.twig', [
                    'user' => $user
                        ]
        );
    }

    public function fillTailleTronc() {
        //chercher l'user qui correspond
        $user = new User();
        $errors = [];

        if (!empty($_POST)) {
            $custom
                    ->setTour_cou($_POST['tour_cou'])
                    ->setTour_poitrine($_POST['tour_poitrine'])
                    ->setTour_taille($_POST['tour_taille'])
                    ->setTour_bassin($_POST['tour_bassin'])
            ;

            if (empty($_POST['tour_cou'])) {
                $errors['tour_cou'] = 'Merci de renseigner la mesure : Tour de cou';
            }

            if (empty($_POST['tour_poitrine'])) {
                $errors['tour_poitrine'] = 'Merci de renseigner la mesure : Tour de Poitrine';
            }

            if (empty($_POST['tour_taille'])) {
                $errors['tour_taille'] = 'Merci de renseigner la mesure : Tour de taille';
            }

            if (empty($_POST['tour_bassin'])) {
                $errors['tour_bassin'] = 'Merci de renseigner la mesure : Tour de bassin';
            }

            if (!is_numeric($_POST['tour_cou'])) {
                $errors['tour_cou'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['tour_poitrine'])) {
                $errors['tour_poitrine'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['tour_taille'])) {
                $errors['tour_taille'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['tour_bassin'])) {
                $errors['tour_bassin'] = 'Merci de renseigner un chiffre';
            }
            if (empty($errors)) {
                $custom->app['user.repository']->save($custom);
                return $this->redirectRoute('etape_5_bras');
            }
        }
        return $this->render
                        (
                        'custom/mesure_etape2.html.twig', [
                    'user' => $user
                        ]
        );
    }

    public function fillTailleBras() {
        //chercher l'user qui correspond
        $user = new User();
        $errors = [];

        if (!empty($_POST)) {
            $custom
                    ->setManche_droite($_POST['manche_droite'])
                    ->setManche_gauche($_POST['manche_gauche'])
                    ->setPoignet_droit($_POST['poitgnet_droit'])
                    ->setPoignet_gauche($_POST['poignet_gauche'])
            ;

            if (empty($_POST['manche_droite'])) {
                $errors['manche_droite'] = 'Merci de renseigner la mesure : Manche Droite';
            }

            if (empty($_POST['manche_gauche'])) {
                $errors['manche_gauche'] = 'Merci de renseigner la mesure : Tour de Poitrine';
            }

            if (empty($_POST['poignet_droit'])) {
                $errors['poignet_droit'] = 'Merci de renseigner la mesure : Poignet droit';
            }

            if (empty($_POST['poignet_gauche'])) {
                $errors['poignet_gauche'] = 'Merci de renseigner la mesure : Poignet gauche';
            }

            if (!is_numeric($_POST['manche_droite'])) {
                $errors['manche_droite'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['manche_gauche'])) {
                $errors['manche_gauche'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['poignet_droit'])) {
                $errors['poignet_droit'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['poignet_gauche'])) {
                $errors['poignet_gauche'] = 'Merci de renseigner un chiffre';
            }
            if (empty($errors)) {
                $custom->app['user.repository']->save($custom);
                return $this->redirectRoute('etape_5_bras');
            }
        }
        return $this->render
                        (
                        'custom/mesure_etape3.html.twig', [
                    'user' => $user
                        ]
        );
    }

    public function fillMeasureCarrure() {
        //chercher l'user qui correspond
        $user = new User();
        $errors = [];

        if (!empty($_POST)) {
            $custom
                    ->setCarrure($_POST['carrure'])
                    ->setEpaule_droite($_POST['epaule_droite'])
                    ->setEpaule_gauche($_POST['epaule_gauche'])
                    ->setLongueur_dos($_POST['dos'])
            ;

            if (empty($_POST['carrure'])) {
                $errors['carrure'] = 'Merci de renseigner la mesure : Carrure';
            }

            if (empty($_POST['epaule_gauche'])) {
                $errors['epaule_gauche'] = 'Merci de renseigner la mesure : Epaule gauche en cm';
            }

            if (empty($_POST['epaule_droite'])) {
                $errors['epaule_droite'] = 'Merci de renseigner la mesure : Epaule_droite en cm';
            }

            if (empty($_POST['dos'])) {
                $errors['longueur_dos'] = 'Merci de renseigner la mesure : Longueur dos en cm';
            }

            if (!is_numeric($_POST['carrure'])) {
                $errors['carrure'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['epaule_gauche'])) {
                $errors['epaule_gauche'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['epaule_droite'])) {
                $errors['epaule_droite'] = 'Merci de renseigner un chiffre';
            }
            if (!is_numeric($_POST['dos'])) {
                $errors['longueur_dos'] = 'Merci de renseigner un chiffre';
            }
            if (empty($errors)) {
                $custom->app['user.repository']->save($custom);
                return $this->redirectRoute('etape_5_carrure');
            }
        }
        return $this->render
                        (
                        'custom/mesure_etape4.html.twig', [
                    'user' => $user
                        ]
        );
    }

    //Fonction pour voir tout le panier
    public function consultSessionCustom() 
        {
        if (!$this->session->has('custom')) 
        { //S'il n'y a pas de session existante
            return $this->redirectRoute('etape_1_tissu');
        } 
        
        else 
        {
            $custom = $this->app['custom.manager']->readCustom(); //S'il y a une session affichage des informations
        }
        return $this->render
                        (
                        'custom/customrecap.html.twig', [
                    'tissus' => $custom
                        ]
        );
    }

}
