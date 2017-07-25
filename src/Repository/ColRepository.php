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
               ->setTitre_col($dbCol['titre_col'])
               ->setStock($dbCol['stock'])
               ->setDescription_col($dbCol['description_col'])
               ->setPhoto_col($dbCol['photo_col'])
               ->setPrix_col($dbCol['prix_col'])
        ;
        return $cols;
    }
    
    public function findColById($id)
    {
        $query = <<<EOS
SELECT id_col, titre_col, photo_col , prix_col 
FROM col
WHERE id_col = :id
EOS;
        $dbTabCols = $this->db->fetchAssoc(
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
        return $dbTabCols;
    }
}
