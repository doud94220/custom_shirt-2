<?php

namespace Controller;

use Entity\Custom;

class CustomController extends ControllerAbstract
{
    // Récupération des choix de configuration de l'utilisateur 
    // On garde cette configuration en base pour pouvoir la partager
    
    public function listTissu()
    {
       $tissus = $this->app['tissu.repository']->findAllTissu();
       
       if (!empty($_POST)) 
       {
            if(empty($_POST['custom_product'])) 
            {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

               $this->addFlashMessage("Merci de choisir un tissu", 'error');           
               //// stockage en session
                 //redirection vers la page suivante
            }
            else
            {
                $this->app['custom.manager']->setTissu($_POST['custom_product']);
                return $this->redirectRoute('etape_2_bouton');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
       }
       return $this->render
        (
            'custom/tissu.html.twig',
            [
                'tissus' => $tissus
            ]
        );
    }
    
    public function listBouton()
    {
        $boutons = $this->app['bouton.repository']->findAllBouton();
       
       if (!empty($_POST)) 
       {
            if(empty($_POST['custom_product'])) 
            {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

               $this->addFlashMessage("Merci de choisir un bouton", 'error');           
               // stockage en session
               //redirection vers la page suivante
            }
            else
            {
                $this->app['custom.manager']->setBouton($_POST['custom_product']);
                return $this->redirectRoute('etape_3_col');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
       }        
       return $this->render
        (
                'custom/bouton.html.twig',
                [
                    'boutons' => $boutons   
                ]
        );
    }
    
    public function listCol()
    {
        $cols = $this->app['col.repository']->findAllCol();
        
       if (!empty($_POST)) 
       {
            if(empty($_POST['custom_product'])) 
            {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

               $this->addFlashMessage("Merci de choisir un col", 'error');           
               // stockage en session
               //redirection vers la page suivante
            }
            else
            {
                $this->app['custom.manager']->setCol($_POST['custom_product']);
                return $this->redirectRoute('etape_4_coupe');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
       } 
        return $this->render
        (
                'custom/col.html.twig',
                [
                    'cols' => $cols
                ]
        );
    }
    
    public function listCoupe()
    {
        $coupes = $this->app['coupe.repository']->findAllCoupe();
        
       if (!empty($_POST)) 
       {
            if(empty($_POST['custom_product'])) 
            {
                //verif du choix d'un tissu si $_POST['custom_stock'] est vide

               $this->addFlashMessage("Merci de choisir une coupe", 'error');           
               // stockage en session
               //redirection vers la page suivante
            }
            else
            {
                $this->app['custom.manager']->setCoupe($_POST['custom_product']);
                return $this->redirectRoute('custom_recap');
                //$_SESSION['id_tissu'] = $_POST['id'];
                // Créer un tableau associatif pour mieux définir les données récupérées
            }
       } 
        return $this->render
        (
                'custom/coupe.html.twig',
                [
                    'coupes' => $coupes
                ]
        );
    }
    
    public function showCustom()
    {
        $recaps = $this->app['custom.manager']->getCustom();
         return $this->render
        (
                'custom/custom_recap.html.twig',
                 [
                     'recaps' => $recaps
                 ]
        );
    }
    
    public function taillepoidsAction()
    {
        $custom = new Custom();
        $errors = [];
        
        if(!empty($_POST))
        {
            $custom
                   ->setPoids($_POST['poids'])
                   ->setTaille($_POST['taille'])
            ;
            
            if(empty($_POST['poids']))
            {
                $errors['poids'] = 'Merci de renseigner votre poids';
            }
            
            if(empty($_POST['taille']))
            {
                $errors['taille'] = 'Merci de renseigner votre taille';
            }
            
            if(!is_numeric($_POST['poids']))
            {
                $errors['poids'] = 'Merci de renseigner un chiffre';
            }
            if(!is_numeric($_POST['taille']))
            {
                $errors['taille'] = 'Merci de renseigner un chiffre';   
            }
            
            if(empty($errors))
            {
                $custom->app['user.repository']->save($custom);
                return $this->redirectRoute('etape_5_tronc');
            }
            return $this->render
            (
                'custom/mesure_etape1.html.twig',
                [
                    'user' => $user
                ]
            );
        }
    }
}

