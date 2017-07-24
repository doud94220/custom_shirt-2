<?php

namespace Repository;

use Entity\Coupe;


class CoupeRepository extends RepositoryAbstract
{
    public function getTable()
    {
        return 'coupe';
    }
    
    public function findAllCoupe()
    {
        $query = <<<EOS
SELECT *
FROM coupe
EOS;
    

        $dbCoupes = $this->db->fetchAll($query);
        $shapes = [];

        foreach($dbCoupes as $dbCoupe)
        {
            $coupe = $this->buildFromArray($dbCoupe);
            $shapes [] = $coupe;
        }
        return $shapes;
    }

     public function buildFromArray(array $dbCoupe)
    {
        $coupes = new Coupe();
        
        $coupes
               ->setId_coupe($dbCoupe['id_coupe'])
               ->setTitre($dbCoupe['titre'])
               ->setDescription($dbCoupe['description'])
               ->setPhoto($dbCoupe['photo'])
        ;
        return $coupes;
    }
}
