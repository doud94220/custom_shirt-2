<?php

namespace Controller;

use Entity\User;
use Repository\UserRepository;

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
                return $this->redirectRoute('etape_5_poidstaille');
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

        $user = new User();
        

        if (!empty($_POST)) {
            $user
                    ->setPoids($_POST['poids'])
                    ->setTaille($_POST['taille'])
            ;

            if (empty($_POST['poids'])) {
                $this->addFlashMessage("Merci de renseigner un poids", 'error');
            }

            elseif (empty($_POST['taille'])) {
                $errors['taille'] = 'Merci de renseigner votre taille';
            }

            elseif (!is_numeric($_POST['poids'])) {
                $errors['poids'] = 'Merci de renseigner un chiffre';
            }
            elseif (!is_numeric($_POST['taille'])) {
                $errors['taille'] = 'Merci de renseigner un chiffre';
            }

            else 
            {
                $this->app['custom.manager']->setPoidsTaille($_POST['poids'], $_POST['taille']);
                return $this->redirectRoute('etape_5_tronc');
                
            }
        }

        return $this->render
                        (
                        'custom/mesure_etape1.html.twig', 
                        [
                            'user' => $user
                        ]
        );
    }

    public function fillTailleTronc() {
        //chercher l'user qui correspond
        $user = new User();
        $errors = [];

        if (!empty($_POST)) {
            $user
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
                $this->app['custom.manager']->setTronc($_POST['tour_cou'], $_POST['tour_poitrine'], $_POST['tour_taille'], $_POST['tour_bassin']);
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
            $user
                    ->setManche_droite($_POST['manche_droite'])
                    ->setManche_gauche($_POST['manche_gauche'])
                    ->setPoignet_droit($_POST['poignet_droit'])
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
                $this->app['custom.manager']->setBras($_POST['manche_droite'], $_POST['manche_gauche'], $_POST['poignet_droit'], $_POST['poignet_gauche']);
                return $this->redirectRoute('etape_5_carrure');
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
            //var_dump($_POST);
            $user
                    ->setCarrure($_POST['carrure'])
                    ->setEpaule_droite($_POST['epaule_droite'])
                    ->setEpaule_gauche($_POST['epaule_gauche'])
                    ->setDos($_POST['dos'])
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
                $errors['dos'] = 'Merci de renseigner la mesure : Longueur dos en cm';
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
                $errors['dos'] = 'Merci de renseigner un chiffre';
            }
            if (empty($errors)) {
                $this->app['custom.manager']->setCarrure($_POST['carrure'], $_POST['epaule_gauche'], $_POST['epaule_droite'], $_POST['dos']);
                return $this->redirectRoute('custom_recap');
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
    public function consultSession() 
    {
        if (!$this->session->has('custom')) 
        { //S'il n'y a pas de session existante
            return $this->redirectRoute('etape_1_tissu');
        } 
        
        else 
        {
            $custom = $this->session->get('custom');
            //$custom = $this->app['custom.manager']->readCustom()->getTissu(); //S'il y a une session affichage des informations
            //print_r($custom);die;
        }
        
        $elements = [];
        $tissu = $this->app['tissu.repository']->findTissuById($custom['tissu']);
        $bouton = $this->app['bouton.repository']->findBoutonById($custom['bouton']);
        $col = $this->app['col.repository']->findColById($custom['col']);
        $coupe = $this->app['coupe.repository']->findCoupeById($custom['coupe']);
        $poids = $custom ['user_poids'];
        $taille = $custom ['user_taille'];
        $tour_cou = $custom ['user_tour_cou'];
        $tour_poitrine = $custom ['user_tour_poitrine'];
        $tour_taille = $custom['user_tour_taille'];
        $tour_bassin = $custom['user_tour_bassin'];
        $manche_droite = $custom['user_manche_droite'];
        $manche_gauche = $custom['user_manche_gauche'];
        $poignet_droit = $custom['user_poignet_droit'];
        $poignet_gauche = $custom['user_poignet_gauche'];
        $carrure = $custom['user_carrure'];
        $epaule_droite = $custom['user_epaule_droite'];
        $epaule_gauche = $custom['user_epaule_gauche'];
        $dos = $custom['user_dos'];
        $elements[] = $bouton;
        $elements[] = $tissu;
        $elements[] = $col;
        $elements[] = $coupe;
        $elements[] = $poids;
        $elements[] = $tour_cou;
        $elements[] = $tour_poitrine;
        $elements[] = $tour_taille;
        $elements[] = $tour_bassin;
        $elements[] = $manche_droite;
        $elements[] = $manche_gauche;
        $elements[] = $poignet_droit;
        $elements[] = $poignet_gauche;
        $elements[] = $carrure;
        $elements[] = $epaule_droite;
        $elements[] = $epaule_gauche;
        $elements[] = $dos;
        //print_r($elements);die;
        return $this->render
                        (
                    'custom/customrecap.html.twig', 
                    [
                    'tissu' => $tissu,
                    'bouton' => $bouton,
                    'col' => $col,
                    'coupe' => $coupe,
                    'poids' => $poids,
                    'taille' => $taille,
                    'tour_cou' => $tour_cou,
                    'tour_poitrine' => $tour_poitrine,
                    'tour_taille' => $tour_taille,
                    'tour_bassin' => $tour_bassin,
                    'manche_droite' => $manche_droite,
                    'manche_gauche' => $manche_gauche,
                    'poignet_droit' => $poignet_droit,
                    'poignet_gauche' => $poignet_gauche,
                    'carrure' => $carrure,
                    'epaule_droite' => $epaule_droite,
                    'epaule_gauche' => $epaule_gauche,
                    'dos' => $dos
                    ]
        );
    }
    
    public function customValidateAction()
    {
        $user = new User();
         
        $sessioncustom = $this->app['custom.manager']->readCustom();
        print_r($sessioncustom);
        $poids = $sessioncustom['user_poids'];
        $taille = $sessioncustom ['user_taille'];
        $tour_cou = $sessioncustom ['user_tour_cou'];
        $tour_poitrine = $sessioncustom ['user_tour_poitrine'];
        $tour_taille = $sessioncustom['user_tour_taille'];
        $tour_bassin = $sessioncustom['user_tour_bassin'];
        $manche_droite = $sessioncustom['user_manche_droite'];
        $manche_gauche = $sessioncustom['user_manche_gauche'];
        $poignet_droit = $sessioncustom['user_poignet_droit'];
        $poignet_gauche = $sessioncustom['user_poignet_gauche'];
        $carrure = $sessioncustom['user_carrure'];
        $epaule_droite = $sessioncustom['user_epaule_droite'];
        $epaule_gauche = $sessioncustom['user_epaule_gauche'];
        $dos = $sessioncustom['user_dos'];

        $user
            ->setPoids($poids)
            ->setTaille($taille)
            ->setTour_cou($tour_cou)
            ->setTour_cou($tour_cou)
            ->setTour_poitrine($tour_poitrine)
            ->setTour_taille($tour_taille)
            ->setTour_bassin($tour_bassin)
            ->setManche_droite($manche_droite)
            ->setManche_gauche($manche_gauche)
            ->setPoignet_gauche($poignet_gauche)
            ->setPoignet_droit($poignet_droit)
            ->setCarrure($carrure)
            ->setEpaule_droite($epaule_droite)
            ->setEpaule_gauche($epaule_gauche)
            ->setDos($dos)
            ;
        
        $this->app['user.repository']->saveUserMeasure($user); 
        
                return $this->render
                        (
                        'custom/customvalidate.html.twig', 
                        [
//                    'user' => $user
                       ]
       );

    }
    
//    public function consultSessionCustomBouton() 
//    {
//        if (!$this->session->has('custom')) 
//        { //S'il n'y a pas de session existante
//            return $this->redirectRoute('etape_1_tissu');
//        } 
//        
//        else 
//        {
//            $custom = $this->session->get('custom');
//            //$custom = $this->app['custom.manager']->readCustom()->getTissu(); //S'il y a une session affichage des informations
//            //print_r($custom['tissu']);
//        }
//        $elements = [];
//        $bouton = $this->app['customrecapbouton.repository']->findBoutonById($custom['bouton']);
//        $elements[] = $bouton;
//        
//        //print_r($elements);die;
//        
//        return $this->render
//                        (
//                    'custom/customrecap.html.twig', [
//                    'custom' => $bouton
//                        ]
//        );
//    }
    
//        //Fonction pour supprimer un produit du panier
//    public function deleteAction($idProduitEnSession)
//    {
//        //// TEMPORAIRE (Debug)
//        //$messagePourDebug = "je vais supprimer le produit en position " . $idProduitEnSession . " dans le panier";
//        //$this->addFlashMessage($messagePourDebug);
//
//        //Je recupère le basket de la session
//        $productsAndConfigs = $this->app['basket.manager']->readBasket();
//
//        //Je retire le produit à supprimer
//        array_splice($productsAndConfigs, $idProduitEnSession, 1);
//
//        //Je mets le nouveau panier 'allégé d'un produit' en session
//        $this->session->set('basket', $productsAndConfigs);
//
//        //Je redirige vers la page consultation panier
//        return $this->redirectRoute('basket_consult');
//
//    }//Fin deleteAction()

    
    
    
}

