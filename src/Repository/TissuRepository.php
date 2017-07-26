<?php


namespace Repository;

use Entity\Tissu;

class TissuRepository extends RepositoryAbstract
{
      public function getTable()
   {
       return 'tissu';
   }    
    
    public function findAllTissu()
   {
              $query = <<<EOS
SELECT *
FROM tissu
ORDER BY id DESC
EOS;

//EOS = END of String
// Syntaxe Heredoc
       $dbTissus = $this->db->fetchAll($query);
       $fabrics = [];
       
       foreach($dbTissus as $dbTissu)
       {
           $fabric = $this->buildFromArray($dbTissu);
           $fabrics[] = $fabric;
       } 
       return $fabrics;
   }
   
    public function buildFromArray(array $dbTissu)
    {
        $tissus = new Tissu();
//        var_dump($dbTissu);
        $tissus
            ->setId($dbTissu['id'])
            ->setNom($dbTissu['nom'])
            ->setStock($dbTissu['stock'])
            ->setDescr($dbTissu['descr'])
            ->setPhoto($dbTissu['photo'])
            ->setPrix($dbTissu['prix'])
            ->setComposition($dbTissu['composition'])
            ->setGrammage($dbTissu['grammage'])
            ->setTirage($dbTissu['tirage'])
        ;
        return $tissus;
    }
    
        public function findTissuById($id)
    {
        $query = <<<EOS
SELECT id, nom, photo, prix
FROM tissu
WHERE id = :id
EOS;
        $dbTabTissus = $this->db->fetchAssoc(
                $query,
                ['id' => $id]
                );
        //$objetTabTissus= [];
        //echo '<pre>';var_dump($dbTabTissus);echo '</pre>';die;
        //foreach($dbTabTissus as $dbTabTissu)
//        {
//            $tissus = $this->buildFromArray($dbTabTissu);
//            $objetTabTissus[] = $tissus;
//            
//        }
        return $dbTabTissus;
    }
    

}
