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
               ->setTitre_coupe($dbCoupe['titre_coupe'])
               ->setDescription_coupe($dbCoupe['description_coupe'])
               ->setPhoto_coupe($dbCoupe['photo_coupe'])
        ;
        return $coupes;
    }
    
    public function findCoupeById($id)
    {
        $query = <<<EOS
SELECT id_coupe, titre_coupe, photo_coupe
FROM coupe
WHERE id_coupe = :id
EOS;
        $dbTabCoupes = $this->db->fetchAssoc(
                $query,
                ['id' => $id]
                );
        //$objetTabBoutons= [];
        
        //echo '<pre>';var_dump($dbTabTissus);echo '</pre>';die;
        
//        //foreach($dbTabTissus as $dbTabTissu)
//        {
//            $tissus = $this->buildFromArray($dbTabTissu);
//            $objetTabTissus[] = $tissus;
//            
//        }
        return $dbTabCoupes;
    }
}
