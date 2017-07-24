<?php


namespace Repository;

use Entity\Custom;

class CustomRecapRepository extends RepositoryAbstract
{
    public function getTable() {
        return 'tissu' ;
    }
    
    
    public function findTissuById($id)
    {
        $query = <<<EOS
SELECT id, nom, descr, photo, prix
FROM tissu
WHERE id = :id
EOS;
        $dbTabTissus = $this->db->fetchAssoc(
                $query,
                ['id' => $id]
                );
        $objetTabTissus= [];
        
        //echo '<pre>';var_dump($dbTabTissus);echo '</pre>';die;
        
//        //foreach($dbTabTissus as $dbTabTissu)
//        {
//            $tissus = $this->buildFromArray($dbTabTissu);
//            $objetTabTissus[] = $tissus;
//            
//        }
        return $dbTabTissus;
    }
    
    public function buildFromArray($dbTabTissus)
    {
        $tissus = new Custom();
        
        $tissus
               //->setId($dbTabTissus['id'])
               //->setNom($dbTabTissus['nom'])
               //->setDesc($dbTabTissus['desc'])
               //->setPhoto($dbTabTissus['photo'])
               //->setPrix($dbTabTissus['prix'])
        ;
        return $tissus;
    }
}
