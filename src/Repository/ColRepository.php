<?php

namespace Repository;

use Entity\Col;

class ColRepository extends RepositoryAbstract
{
    public function getTable()
    {
        return 'col';
    }
    
    public function findAllCol()
    {
        $query = <<<EOS
SELECT *
FROM col
ORDER BY id_col DESC
EOS;
    

        $dbCols = $this->db->fetchAll($query);
        $collars = [];

        foreach($dbCols as $dbCol)
        {
            $col = $this->buildFromArray($dbCol);
            $collars [] = $col;
        }
        return $collars;
    }
    
    public function buildFromArray(array $dbCol)
    {
        $cols = new Col();
        
        $cols
               ->setId_col($dbCol['id_col'])
               ->setTitre($dbCol['titre'])
               ->setStock($dbCol['stock'])
               ->setDescription($dbCol['description'])
               ->setPhoto($dbCol['photo'])
               ->setPrix($dbCol['prix'])
        ;
        return $cols;
    }
}
