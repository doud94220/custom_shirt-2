<?php
namespace Repository;

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
    
    public function findAllByCommande(Commande $commande){
        $query = <<<EOS
SELECT d.*, cs.titre_custom, p.titre
FROM detail_commande d
JOIN commande c ON d.commande_id = c.id_commande
JOIN produit p ON d.produit_id = p.id
JOIN custom cs ON d.custom_id = cs.id_custom
WHERE d.commande_id = :id_commande
ORDER BY id_detail_commande DESC
EOS;
        
        $dbCommandes = $this->db->fetchAll(
            $query,
            [':id_commande' => $commande->getId_commande()]
        );
        $detail_commandes = []; // le tableau dans lequel vont être stockées les entités Article
        
        foreach($dbDetailCommandes as $dbDetailCommande){
            $detail_commande = $this->buildFromArray($dbDetailCommande);
            
            $detail_commandes[] = $detail_commande;
        }
        
        return $detail_commandes; 
    }

}
