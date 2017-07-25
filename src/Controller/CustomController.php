<?php


namespace Controller;

use Entity\Custom;
use Repository\CustomRepository;

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
    


    public function fillMeasure_tissu()
    {
        $custom = new Custom();
        //$user = new User();
        $errors = [];
        
        if(!empty($_GET))
        {
            $custom->setTissu_id($_GET['tissu_id']);
            $custom = $this->app['custom.repository']->save($custom);
            
            $customManager = $this->app('custom.manager');
            $customManager->setTissu($_GET['tissu_id']);
            
            return $this->render
            (
                'custom/tissu.html.twig'
            );
        }
        else
        {
            $errors['tissu_id'] = 'Merci de choisir un tissu';
        }

    }   
        
    public function fillMeasure_bouton()
    {       
        $custom = new Custom();
        //$user = new User();
        $errors = [];

        if(!empty($_GET))
        {
            $custom->setButton_id($_GET['bouton_id']);
            $custom = $this->app['custom.repository']->save($custom);
            
            $customManager = $this->app('custom.manager');
            $customManager->setBouton($_GET['bouton_id']);
            
            return $this->render
            (
                'custom/bouton.html.twig' //à modif
            );
        }
        else
        {
            $errors['bouton_id'] = 'Merci de choisir un type de bouton';
        }
    }    
        
    public function fillMeasure_col()
    {
        $custom = new Custom();
        //$user = new User();
        $errors = [];
        
        if(!empty($_GET))
        {
            $custom->setCol($_GET['col']);
            $custom = $this->app['custom.repository']->save($custom);
            

            $customManager = $this->app('custom.manager');
            $customManager->setCol($_GET['col_id']);
            
            return $this->render
            (
                'custom/col.html.twig'
            );
        }
        else
        {
            $errors['col'] = 'Merci de choisir un type de col';
        }
    }
    
    public function fillMeasure_coupe()
    {    
        $custom = new Custom();
        //$user = new User();
        $errors = [];
        
        if(!empty($_GET))
        {
            $custom->setCoupe($_GET['coupe']);
            $custom = $this->app['custom.repository']->save($custom);
            
            $customManager = $this->app('custom.manager');
            $customManager->setCoupe($_GET['coupe_id']);
            
            return $this->render
            (
                'custom/coupe.html.twig'
            );
        }
        else
        {
            $errors['coupe'] = 'Merci de choisir une coupe';
        }

    } 
}    



   // Champs à vide si utilisateur non connecté via un champs hidden
   //JS en récupérant id_image dans une balise type="hidden"
   //ou aller directement au choix des matières sans le formulaire (appeler les Setter venant de la l'objet User)
   // Si on a un utilisateur connecté
   // Setpoids= userpoids
//        $user = $this->app['user.manager']->getUser();
//        
//        if (!is_null($user)) 
//        {
//            $config->setCol($user->getCol())...
//        } 
//        else 
//        {
//            $this->redirectRoute('la route du form pour le mensurations')
//        }
//        

