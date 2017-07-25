<?php
namespace Controller;
use Entity\User;
use Service\UserManager;
use DateTime;

class UserController extends ControllerAbstract
{
    public function registerAction(){
        $user = new User();
        $errors = [];
        
        if(!empty($_POST)){
            $user
                ->setNom($_POST['nom'])
                ->setPrenom($_POST['prenom'])
                //->setDate_naissance(new \DateTime($_POST['date_naissance']))
                ->setEmail($_POST['email'])
                ->setPassword($_POST['password'])
                ->setAdresse($_POST['adresse'])
                ->setComplement_adresse($_POST['complement_adresse'])
                ->setCode_postal($_POST['code_postal'])
                ->setVille($_POST['ville'])
                ->setTel($_POST['tel'])
                ->setSexe($_POST['sexe'])
                ->setStatut('membre')
            ;
            
            if(empty($_POST['nom'])){
                $errors['nom'] = 'Le nom est obligatoire';
            }
            
            if(empty($_POST['prenom'])){
                $errors['prenom'] = 'Le prénom est obligatoire';
            }
            
//            if (empty($_POST['date_naissance'])) {
//                $errors['date_naissance'] = 'La date de naissance est obligatoire';
//            }
            
            if(empty($_POST['email'])){
                $errors['email'] = "L'e-mail est obligatoire";
            }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "L'e-mail n'est pas valide";
            }elseif(!empty($this->app['user.repository']->findByEmail($_POST['email']))){
                $errors['email'] = 'Cet email est déjà utilisé';
            }
            
            if(empty($_POST['adresse'])){
                $errors['adresse'] = "Veuillez indiquer votre adresse";
            }
            
            if(empty($_POST['code_postal'])){
                $errors['code_postal'] = "Veuillez indiquer votre code postal";
            }
            
            if(empty($_POST['tel'])){
                $errors['tel'] = "Veuillez indiquer votre numéro de téléphone";
            }
            
            if(empty($_POST['ville'])){
                $errors['ville'] = "Veuillez indiquer votre ville";
            }

            if (empty($_POST['sexe'])) {
                $errors['sexe'] = 'Veuillez indiquer votre genre svp';
            }
            
            if(empty($_POST['password'])){
                $errors['password'] = "Le mot de passe est obligatoire";
            }elseif(!preg_match('/^[a-zA-Z0-9_-]{6,20}$/', $_POST['password'])){
                $errors['password'] = "Le mot de passe doit comprendre entre 6 et 20 caractères et ne doit contenir que des lettres, des chiffres ou les caractères _ et -";
            }
            
            if(empty($_POST['password_confirm'])){
                $errors['password_confirm'] = "La confirmation du mot de passe est obligatoire";
            }elseif($_POST['password'] != $_POST['password_confirm']){
                $errors['password_confirm'] = "La confirmation n'est pas identique au mot de passe";
            }
            
            if (empty($errors)){
                $user->setPassword($this->app['user.manager']->encodePassword($_POST['password']));
                $this->app['user.repository']->save($user);
                $this->app['user.manager']->login($user);
                
                return $this->redirectRoute('homepage');
            }else{
                $msg = '<strong>Le formulaire contient des erreurs</strong>';
                $msg .= '<br>'. implode('<br>', $errors);
                
                $this->addFlashMessage($msg, 'error');
            }
        }
        
        return $this->render(
            'user/register.html.twig',
            [
                'user' => $user
            ]
        );
    }
    
    public function loginAction(){
        $email = '';
        
        if(!empty($_POST)){
            $email = $_POST['email'];
            
            $user = $this->app['user.repository']->findByEmail($email);
            
            if(!is_null($user)){
                if($this->app['user.manager']->verifyPassword($_POST['password'], $user->getPassword())){
                    $this->app['user.manager']->login($user);
                
                return $this->redirectRoute('homepage');
                }
            }
            
            $this->addFlashMessage('Identification incorrecte', 'error');
        }
        
        return $this->render(
            'user/login.html.twig',
            ['email' => $email]
        );
    }
    
    public function logoutAction(){
        $this->app['user.manager']->logout();
        
        return $this->redirectRoute('homepage');
    }

    public function modifAction()
    {
        $user = $this->app['user.manager']->getUser();
        return $this->render(
            'user/modif.html.twig',
            [
                'user' => $user
            ]
        );
    }

    public function showProfile(){
        $user = $this->app['user.manager']->getUser();
        $commandes = $this->app['commande.repository']->findAllByUser($user);
        
        return $this->render(
            'user/profile.html.twig',
            [
                'user' => $user,
                'commandes' => $commandes
                ] 
        );
    }
}