<?php
namespace Repository;

use Entity\Commande;
use Entity\Custom;
use Entity\DetailCommande;
use Entity\Produit;
use Entity\User;
/**
 * Description of DetailCommandeRepository
 *
 * @author Julien
 */
class DetailCommandeRepository extends RepositoryAbstract
{
     public function getTable(){
        return 'detail_commande';
    }
    
    /**
     * cette méthode récupère en base tous les détails d'une commande, ainsi que le titre des produits et des customs
     * @param \Repository\Commande $commande
     * @return array
     */
    public function findAllByCommande($id_commande){
        $query = <<<EOS
<<<<<<< HEAD
SELECT d.*, c.id_commande, cs.titre_custom, p.titre
=======
SELECT d.*, c.id_commande, cs.titre_custom, cs.prix, p.titre, p.prix
>>>>>>> master
FROM detail_commande d
JOIN commande c ON d.commande_id = c.id_commande
LEFT JOIN produit p ON d.produit_id = p.id
LEFT JOIN custom cs ON d.custom_id = cs.id_custom
WHERE d.commande_id = :id_commande
ORDER BY d.id_detail_commande DESC
EOS;
        
        $dbDetailCommandes = $this->db->fetchAll(
            $query,
            [':id_commande' => $id_commande]
        );
        $detail_commandes = []; // le tableau dans lequel vont être stockées les entités DetailCommande
        
        foreach($dbDetailCommandes as $dbDetailCommande){
            $detail_commande = $this->buildFromArray($dbDetailCommande);
            
            $detail_commandes[] = $detail_commande;
        }
        
        return $detail_commandes; 
    }
    
    public function save(DetailCommande $detail_commande){
        $data = [
            'commande_id' => $detail_commande->getCommande_id(),
            'produit_id' => $detail_commande->getProduit_id(),
            'custom_id' => $detail_commande->getCustom_id(),
            'quantite' => $detail_commande->getQuantite(),
            'prix' => $detail_commande->getPrix()
        ];
          
        $this->persist($data);
    }
    
    
    /**
     * 
     * @param array $dbDetailCommande
     * @return DetailCommande
     */
    public function buildFromArray(array $dbDetailCommande){
        $detail_commande = new DetailCommande();
        
        $commande = new Commande();
        
        $commande
            ->setId_commande($dbDetailCommande['commande_id'])
        ;
        
        $produit = new Produit();
        
        $produit
            ->setId($dbDetailCommande['produit_id'])
            ->setTitre($dbDetailCommande['titre'])
<<<<<<< HEAD
=======
            ->setPrix($dbDetailCommande['prix'])
>>>>>>> master
        ;

        $custom = new Custom();
        
        $custom
            ->setId_custom($dbDetailCommande['custom_id'])
<<<<<<< HEAD
            //->setTitre_custom($dbDetailCommande['titre_custom'])
=======
            ->setTitre_custom($dbDetailCommande['titre_custom'])
            ->setPrix($dbDetailCommande['prix'])
>>>>>>> master
        ;
        
        $detail_commande
            ->setId_detail_commande($dbDetailCommande['id_detail_commande'])
            ->setCommande_id($dbDetailCommande['commande_id'])
            ->setProduit_id($dbDetailCommande['produit_id'])
            ->setCustom_id($dbDetailCommande['custom_id'])
<<<<<<< HEAD
=======
            ->setCustom($custom)
            ->setProduit($produit)
>>>>>>> master
            ->setQuantite($dbDetailCommande['quantite'])
            ->setPrix($dbDetailCommande['prix'])
        ;
        
        return $detail_commande;
    }
}
