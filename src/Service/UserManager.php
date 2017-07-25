<?php

namespace Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Entity\User;

class UserManager 
{
    /**
     *
     * UserManager constructor
     * @param Session $session
     */
    private $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    /**
     * 
     * @param string $plainPassword
     * @return string
     */
    public function encodePassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }
    
    /**
     * 
     * @param type $plainPassword
     * @param type $encodePassword
     * return bool : renvoi un TRUE ou FALSE
     */
    public function verifyPassword($plainPassword, $encodePassword)
    {
        return password_verify($plainPassword, $encodePassword);
    }
    
    public function login(User $user)
    {
        $this->session->set('user', $user);
    }
    
    /**
     * @return User|null
     */
    public function logout()
    {
        $this->session->remove('user');
    }
    
    /**
     * 
     * @return User|null
     */
    public function getUser()
    {
        return $this->session->get('user');// si pas d'utilisateur connecté > renvoi null
    }
    
    public function getUserName()
    {
        if($this->session->has('user')) //équivalent de if(isset($session('user))
        {
            return $this->session->get('user')->getFullName();
        }
        return '';
    } 
    
    /**
     * 
     * @return bool
     */
    public function isAdmin()
    {
        //Si on a un utilisateur et si l'utilisateur est admin > donc vrai
        // Si pas d'utilisateur > Faux
        // Si l'utilisateur n'est pas admin > Faux
        return $this->session->has('user') && $this->session->get('user')->isAdmin();
    }
    
    /*
     * Créé par Edouard pour recuperer le panier (basket en Uk) en session
     */
    public function getBasket() //
    {
        return $this->session->has('basket');
    }
}