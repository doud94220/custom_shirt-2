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
            ->setTitre($dbBouton['titre'])
            ->setStock($dbBouton['stock'])
            ->setDescription($dbBouton['description'])
            ->setPhoto($dbBouton['photo'])
            ->setPrix($dbBouton['prix'])
        ;
        return $butons;
    }
}
