<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;



/**
 * Description of Router
 *
 * @author Etudiant
 */
class Router {
   private static $instance; 
   
   /**
    *
    * @var type 
    */
   
   
   
   private $prefx;
   
   /**
    *
    * @var type 
    */
   
   
   private $routes = []; 
   
   private $address; 
   
   private function __construct(){}
       public static function getInstance(){
           if (is_null(self::$instance))
               self::$instance = new self(); 
       
       return self::$instance;
       
       
       
       public function addRoute(
               $name, 
               $uri, 
               $controller, 
               $action
               ) {
           
               $this -> routes[$name] = [
                   'uri' => $uri; 
               'controller' => $controller; 
               'action' => $action;
                   
               ];
               return $this;
               
       }
       public function findRoute()
       {
           $uri = str_replace(
                   $this)
       }
       }
   }
   
   

