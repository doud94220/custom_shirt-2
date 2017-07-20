<?php


namespace Service;

use Symfony\Component\HttpFoundation\Session\Session;

class CustomManager 
{
    private $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    private function init()
    {
        if (!$this->session->has('custom')) {
            $this->session->set('custom', []);
        }
    }

    public function setTissu($tissu)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['tissu'] = $tissu;
    }

    public function setBouton($bouton)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['bouton'] = $bouton;
    }
    
     public function setCol($col)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['col'] = $col;
    }
    
      public function setCoupe($coupe)
    {
        $this->init();
        $custom = $this->session->get('custom');
        $custom['coupe'] = $coupe;
    }


    
    public function putCustominSession($custom)
    {
        if(!$this->session)
        {
           $_SESSION[] = $this->session->get('custom');
        }
        else
        {
            
        }
    }
}
