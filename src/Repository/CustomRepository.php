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
       $data=[
              'id_custom' => $custom->getId_custom(),
              'tissu_id' => $custom->getTissu_id(),
              'bouton_id' => $custom->getButton_id(),
              'col_id' => $custom->getCol_id(),
              'coupe_id' => $custom->getCoupe_id(),
              'prix' => $custom->getPrix()
            ];
       $this->persist($data);
   }     
}
