<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use PDO; 


class Cnx {
    
    const HOST='localhost';
    const USER='root';
    const PASSWORD ='';
    const DB_NAME = 'mvc';
    /**
     *
     * @var PDO
     */
    private static $instance; 
    
    private function __construct(){}
    
    public static function getInstance(){
        
        if (is_null(self::$instance)){
            self::$instance = new PDO(
                    'mysql:host='.self::HOST.';dbname='.self::DB_NAME, 
                    self::USER, 
                    self::PASSWORD,
                    [
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, 
                    ]
                    );
        }
        return self::$instance;
    }
}
