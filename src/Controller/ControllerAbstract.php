<?php

namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Session\Session;

abstract class ControllerAbstract 
{
    /**
     *
     * @var Application 
     * 
     */
        protected $app; //Attribut protégé
    
    /**
     *
     * @var Twig_Environment
     */
        protected $twig;
        
        /**
         *
         * @var Session
         */
        protected $session;
        
    
    /**
    * ControllerAbstract constructor.
    * 
    */
        public function __construct(Application $app) 
    {
       $this->app = $app;
       $this->twig = $app['twig'];
       $this->session = $app['session'];
       
    }
    
    /**
     * 
     * @param string $view
     * @param array $parameters
     * @return string
     */
        public function render($view, array $parameters = [])
    {
        return $this->twig->render($view, $parameters);
    }
    
    /**
     * Enregistre un message en session pour affichage 
     * au prochain chargement de page
     * 
     * @param string $message
     * @param string $type
     */
    public function addFlashMessage($message, $type = 'success')
    {
        $this->session->getFlashBag()->add($type, $message);
    }
    
    /**
     * Redirige vers la route
     * 
     * @param type $routeName
     * @param array $parameters
     * @return \Synfony\Component\HttpFoundation\RedirectResponse
     * 
     */
    public function redirectRoute($routeName, array $parameters = []) 
    {
        return $this->app->redirect
        (
                $this->app['url_generator']->generate($routeName, $parameters)
        );
    }
 
    
}
