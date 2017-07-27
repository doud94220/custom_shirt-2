<?php

namespace Repository;

use Entity\Custom;

class CustomRepository extends RepositoryAbstract
{
   public function getTable()
   {
        return 'custom';
   }

   // Enregistrement des informations principales de configuration en base de donnée

   public function save(Custom $custom)
   {
        $data = [
              'titre_custom' => $custom->getTitre_custom(),
              'tissu_id' => $custom->getTissu_id(),
              'bouton_id' => $custom->getBouton_id(),
              'col_id' => $custom->getCol_id(),
              'coupe_id' => $custom->getCoupe_id(),
              'prix' => $custom->getPrix(),
            ];

        $where = !empty($custom->getId_custom())
            ? ['id_custom' => $custom->getId_custom()] // modification
            : null // création
        ;

        $this->persist($data, $where);
   }

      /****Recherche par ID récupéré en session les informations à afficher******/
   public function find($id_custom)
   {
           $dbCustom = $this->db->fetchAssoc(
            'SELECT * FROM custom WHERE id_custom = :id_custom',
            [':id_custom' => $id_custom]
        );
      
        if(!empty($dbCustom))
        {
            return $this->buildFromArray($dbCustom);
        }
   }
   public function buildFromArray(array $dbCustom){
        $custom = new Custom();
        
        $custom
            ->setTitre_custom($dbCustom['titre_custom'])
            ->setTissu_id($dbCustom['tissu_id'])
            ->setBouton_id($dbCustom['bouton_id'])
            ->setCol_id($dbCustom['col_id'])
            ->setCoupe_id($dbCustom['coupe_id'])
            ->setPrix($dbCustom['prix'])
            //->setQuantite($dbQuantite['quantite'])
        ;
        return $custom;
   }


    public function getLastInsertId()
    {
      return $this->db->lastInsertId();
    }

   /****Recherche par ID récupéré en session les informations à afficher******/
   
//   public function findCustomById($id_custom)
//   {
////        $query = <<<EOS
//////SELECT id_custom, titre_custom, tissu_id, bouton_id, col_id, coupe_id
//////FROM custom
//////WHERE id_custom = :id
//////EOS;               
//            $dbTabCustoms = $this->db->fetchAssoc(
//                $query,
//                ['id' => $id]
//                ); 
//        return $dbTabCustoms;
//    }


}
