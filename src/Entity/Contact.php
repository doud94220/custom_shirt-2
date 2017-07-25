<?php
namespace Entity;

/**
 * Description of Contact
 *
 * @author Julien
 */
class Contact {
    /**
     * @var string 
     */
    private $sujet;
    
    /**
     * @var string
     */
    private $message;
    
    /**
     * @var User 
     */
    private $sender;
    
    /**
     * @var string
     */
    private $receiver = "contact@custom-shirt.com";
    
    /***** GETTERS *****/
    
    /**
     * @return string
     */
    public function getSujet() {
        return $this->sujet;
    }
   
    /**
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @return User
     */
    public function getSender() {
        return $this->sender;
    }

    /**
     * l'adresse e-mail de contact
     * @return string
     */
    public function getReceiver() {
        return $this->receiver;
    }
    
    
    /***** SETTERS *****/
    
    /**
     * @param type $sujet
     * @return Contact
     */
    public function setSujet($sujet) {
        $this->sujet = $sujet;
        return $this;
    }

    /**
     * @param type $message
     * @return Contact
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * @param User $sender
     * @return Contact
     */
    public function setSender(User $sender) {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @param type $receiver
     * @return Contact
     */
    public function setReceiver($receiver) {
        $this->receiver = $receiver;
        return $this;
    }
    
    
    /***** PROXYS *****/
    
    /**
     * @return string
     */
    public function getSenderEmail(){
        $user = $this->app['user.manager']->getUser();
        $email = $this->user->getEmail();
        
        return $email;
    }
}
