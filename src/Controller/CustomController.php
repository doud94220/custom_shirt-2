<?php

namespace Controller;

use Repository\CustomRepository;
use Entity\Custom;
use Entity\User;
use Service\CustomManager;
use Service\BasketManager;

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

        $user = $this->app['user.manager']->getUser();
        $sessioncustom = $this->app['custom.manager']->readCustom();
        
        if (is_null($user))
        {
            $this->addFlashMessage("Merci de vous connecter pour entrer vos mesures !", 'error');
            return $this->redirectRoute('login');
            
        }
        if (!is_null($user)) {
            $taille = $user->getTaille();
            $poids = $user->getPoids();
        } else {
            $taille = $poids = '';
        }
        
        if (!empty($_POST)) {
            $taille = $_POST['taille'];
            $poids = $_POST['poids'];
            
            if (empty($_POST['poids'])) {
                $this->addFlashMessage("Merci de renseigner un poids", 'error');
            }

            elseif (empty($_POST['taille'])) {
                $this->addFlashMessage("Merci de renseigner votre taille", 'error');
            }

            elseif (!is_numeric($_POST['poids'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            elseif (!is_numeric($_POST['taille'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }

            else 
            {
                $this->app['custom.manager']->setPoidsTaille($_POST['poids'], $_POST['taille']);
                return $this->redirectRoute('etape_5_tronc');
            }
        }
        //echo '<pre>'; var_dump($sessioncustom); echo '</pre>';

        return $this->render
                        (
                        'custom/mesure_etape1.html.twig', 
                        [
                            'user' =>$user,
                            'session' => $sessioncustom,    
                            'taille' => $taille,
                            'poids' => $poids
                        ]
        );
    }

    public function fillTailleTronc() {
        
        $user = $this->app['user.manager']->getUser();
        $sessioncustom = $this->app['custom.manager']->readCustom();

        if (!is_null($user)) {
            $tour_cou = $user->getTour_cou();
            $tour_poitrine = $user->getTour_poitrine();
            $tour_taille = $user->getTour_taille();
            $tour_bassin =$user->getTour_bassin();
        } else {
            $tour_cou = $tour_poitrine = $tour_taille = $tour_bassin = '';
        }      

        if (!empty($_POST)) {
 
                    $tour_cou = $_POST['tour_cou'];
                    $tour_poitrine = $_POST['tour_poitrine'];
                    $tour_taille = $_POST['tour_taille'];
                    $tour_bassin = $_POST['tour_bassin'];
            

            if (empty($_POST['tour_cou'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Tour de cou", 'error');
            }

            if (empty($_POST['tour_poitrine'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Tour de Poitrine", 'error');
            }

            if (empty($_POST['tour_taille'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Tour de taille", 'error');
            }

            if (empty($_POST['tour_bassin'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Tour de bassin", 'error');
            }

            if (!is_numeric($_POST['tour_cou'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['tour_poitrine'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['tour_taille'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['tour_bassin'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (empty($errors)) {
                $this->app['custom.manager']->setTronc($_POST['tour_cou'], $_POST['tour_poitrine'], $_POST['tour_taille'], $_POST['tour_bassin']);
                return $this->redirectRoute('etape_5_bras');
            }
        }
        return $this->render
                        (
                        'custom/mesure_etape2.html.twig', [
                            'user' =>$user,
                            'session' => $sessioncustom,   
                            'tour_cou' => $tour_cou,
                            'tour_poitrine' => $tour_poitrine,
                            'tour_taille' => $tour_taille,
                            'tour_bassin' => $tour_bassin
                        ]
        );
    }

    public function fillTailleBras() {
        //chercher l'user qui correspond
                
        $user = $this->app['user.manager']->getUser();
        $sessioncustom = $this->app['custom.manager']->readCustom();

        if (!is_null($user)) {
            $manche_droite = $user->getManche_droite();
            $manche_gauche = $user->getManche_gauche();
            $poignet_droit = $user->getPoignet_droit();
            $poignet_gauche =$user->getPoignet_gauche();
        } else {
            $manche_droite = $manche_gauche = $poignet_droit = $poignet_gauche = '';
        }  

        if (!empty($_POST)) {
            
                    $manche_droite = $_POST['manche_droite'];
                    $manche_gauche = $_POST['manche_gauche'];
                    $poignet_droit = $_POST['poignet_droit'];
                    $poignet_gauche = $_POST['poignet_gauche'];
            ;

            if (empty($_POST['manche_droite'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Manche Droite", 'error');
            }

            if (empty($_POST['manche_gauche'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Tour de Poitrine", 'error');
            }

            if (empty($_POST['poignet_droit'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Poignet droit", 'error');
            }

            if (empty($_POST['poignet_gauche'])) {
                $this->addFlashMessage("Merci de renseigner la mesure : Poignet gauche", 'error');
            }

            if (!is_numeric($_POST['manche_droite'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['manche_gauche'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['poignet_droit'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['poignet_gauche'])) {
                $this->addFlashMessage("Merci de renseigner un chiffre", 'error');
            }
            if (empty($errors)) {
                $this->app['custom.manager']->setBras($_POST['manche_droite'], $_POST['manche_gauche'], $_POST['poignet_droit'], $_POST['poignet_gauche']);
                return $this->redirectRoute('etape_5_carrure');
            }
        }
        return $this->render
                        (
                        'custom/mesure_etape3.html.twig', [
                            'user' =>$user,
                            'session' => $sessioncustom,                              
                            'manche_gauche' => $manche_gauche,
                            'manche_droite' => $manche_droite,
                            'poignet_droit' => $poignet_droit,
                            'poignet_gauche' => $poignet_gauche
                        ]
        );
    }
    
    public function fillMeasureCarrure() {
        //chercher l'user qui correspond
        $user = $this->app['user.manager']->getUser();
        $sessioncustom = $this->app['custom.manager']->readCustom();

        if (!is_null($user)) {
            $carrure = $user->getCarrure();
            $epaule_gauche = $user->getEpaule_gauche();
            $epaule_droite = $user->getEpaule_droite();
            $dos =$user->getDos();
        } else {
            $carrure = $epaule_gauche = $epaule_droite = $dos = '';
        } 

        if (!empty($_POST)) 
        {
                $carrure = $_POST['carrure'];
                $epaule_droite = $_POST['epaule_droite'];
                $epaule_gauche = $_POST['epaule_gauche'];
                $dos = $_POST['dos'];

            if (empty($_POST['carrure'])) {
                $errors['carrure'] = 'Merci de renseigner la mesure : Carrure';
                $this->addFlashMessage("Carrure : Merci de renseigner la mesure en cm", 'error');
            }

            if (empty($_POST['epaule_gauche'])) {
                $this->addFlashMessage("Epaule gauche : Merci de renseigner la mesure en cm", 'error');
            }

            if (empty($_POST['epaule_droite'])) {
                $this->addFlashMessage("Epaule droite: Merci de renseigner la mesure en cm", 'error');
            }

            if (empty($_POST['dos'])) {
                $this->addFlashMessage("Dos : Merci de renseigner la mesure en cm", 'error');
            }

            if (!is_numeric($_POST['carrure'])) {
                $this->addFlashMessage("Carrure : Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['epaule_gauche'])) {
                $this->addFlashMessage("Epaule gauche : Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['epaule_droite'])) {
                $this->addFlashMessage("Epaule Droite : Merci de renseigner un chiffre", 'error');
            }
            if (!is_numeric($_POST['dos'])) {
                $this->addFlashMessage("Dos : Merci de renseigner un chiffre", 'error');
            }
            if (empty($errors)) {
                $this->app['custom.manager']->setCarrure($_POST['carrure'], $_POST['epaule_gauche'], $_POST['epaule_droite'], $_POST['dos']);
                return $this->redirectRoute('custom_recap');
            }
        }
        return $this->render
                        (
                        'custom/mesure_etape4.html.twig', [
                            'user' =>$user,
                            'session' => $sessioncustom,                               
                            'carrure' => $carrure,
                            'epaule_droite' => $epaule_droite,
                            'epaule_gauche' => $epaule_gauche,
                            'dos' => $dos
                        ]
        );
    }

//    public function fillTitreCustom()
//    {
//        $user = $this->app['user.manager']->getUser();
//        $sessioncustom = $this->app['custom.manager']->readCustom();
//        if (!is_null($user)) {
//            $titre_custom = $user->getTitre_custom();
//        } else {
//            $titre_custom = '';
//
//        } 
//            if (!empty($_POST)) 
//            {
//                $titre_custom = $_POST['titre_custom'];
//                 
//                if (empty($_POST['titre_custom'])) 
//                {
//                $this->addFlashMessage("Merci de renseigner un titre", 'error');
//                }
//                if(empty($errors))
//                {
//                    $this->app['custom.manager']->setTitreCustom($_POST['titre_custom']);
//                    return $this->redirectRoute('custom_validate');
//                }
//            }
//        return $this->render
//                        (
//                        'custom/customrecap.html.twig', 
//                        [
//                            'user' =>$user,
//                            'session' => $sessioncustom,   
//                            'titre_custom' => $titre_custom
//                            
//                        ]
//        );
//    }

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
        //$elements = [];
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
        $user = $this->app['user.manager']->getUser();
        $sessioncustom = $this->app['custom.manager']->readCustom();
        
        $nom = $this->app['user.manager']->getUser()->getPrenom();
        $custom_titre = 'custom-shirt'.$nom;
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
        
        $custom = new Custom();
        
        $custom
            ->setTitre_custom($custom_titre)
            ->setTissu_id($sessioncustom['tissu'])
            ->setBouton_id($sessioncustom['bouton'])
            ->setCol_id($sessioncustom['col'])
            ->setCoupe_id($sessioncustom['coupe'])
            ->setPrix('')
           ;
        
        $this->app['custom.repository']->save($custom);
        $idCustom = $this->app['custom.repository']->getLastInsertId();
        
        $this->app['custom.manager']->setId_custom($idCustom);
        $this->app['custom.manager']->setTitre_custom($custom_titre);

        //Creation d'un objet Custom à partir des données du custom en session
       $customShirtObject = $this->app['custom.manager']->getCustomSessionAndMoreAndCreateCustomObjectForSessionBasket();
       echo'<pre>';var_dump($customShirtObject);echo'</pre>';
       //Mise dans panier du Custom
       $this->app['basket.manager']->putConfigToBasket($customShirtObject);
       $this->app['custom.manager']->flushCustomSession();  
        
       return $this->redirectRoute('basket_consult');
//        return $this->render
//                (
//                'basket/index.html.twig', 
//                [
//                    'user' => $user,
//                    'custom' => $sessioncustom,
//                    //'titre_custom' => $titre_custom
//               ]
//       );

    }

}

