<?php


namespace Repository;

use Entity\Bouton;

class BoutonRepository extends RepositoryAbstract

{
     public function getTable()
   {
       return 'bouton';
   }
    
    
    public function findAllbouton()
   {
              $query = <<<EOS
SELECT *
FROM bouton
ORDER BY id_bouton DESC
EOS;

//EOS = END of String
// Syntaxe Heredoc
       $dbBoutons = $this->db->fetchAll($query);
       $butons = [];
       
       foreach($dbBoutons as $dbBouton)
       {
           $buton = $this->buildFromArray($dbBouton);
           $butons[] = $buton;
       } 
       return $butons;
   }
   
    public function buildFromArray(array $dbBouton)
    {
        $butons = new Bouton();
//        var_dump($dbTissu);
        $butons
            ->setId_bouton($dbBouton['id_bouton'])
            ->setTitre_bouton($dbBouton['titre_bouton'])
            ->setStock($dbBouton['stock'])
            ->setDescription_bouton($dbBouton['description_bouton'])
            ->setPhoto_bouton($dbBouton['photo_bouton'])
            ->setPrix_bouton($dbBouton['prix_bouton'])
        ;
        return $butons;
    }
    
        public function findBoutonById($id)
    {
        $query = <<<EOS
SELECT id_bouton, titre_bouton, photo_bouton , prix_bouton 
FROM bouton
WHERE id_bouton = :id
EOS;
        $dbTabBoutons = $this->db->fetchAssoc(
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
        return $dbTabBoutons;
    }
 
}
