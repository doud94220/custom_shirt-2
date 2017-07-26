<?php
namespace Repository;

use DateTime;
use Entity\Commande;
use Entity\User;
use Service\UserManager;
use Silex\Provider\SessionServiceProvider;

/**
 * Description of CommandeRepository
 *
 * @author Julien
 */
class CommandeRepository extends RepositoryAbstract
{
     public function getTable(){
        return 'commande';
    }
    
    /**
     * cette méthode sert à chercher en base l'ensemble des commandes réalisées par un utilisateur
     * @return Commande
     */
    public function findAllByUser(User $user){ 
        $query = <<<EOS
SELECT c.*
FROM commande c
JOIN user u ON c.user_id = u.id_user
WHERE c.user_id = :id_user
ORDER BY id_commande DESC
EOS;
        
        $dbCommandes = $this->db->fetchAll(
            $query,
            [':id_user' => $user->getId_user()]
        );
        $commandes = []; // le tableau dans lequel vont être stockées les entités Article
        
        foreach($dbCommandes as $dbCommande){
            $commande = $this->buildFromArray($dbCommande);
            
            $commandes[] = $commande;
        }
        
        return $commandes; 
    }
    
    public function findAll(){
        $query = <<<EOS
SELECT c.*
FROM commande c
ORDER BY id_commande DESC
EOS;
        
        $dbCommandes = $this->db->fetchAll($query);
        $commandes = [];
        
        foreach($dbCommandes as $dbCommande){
            $commande = $this->buildFromArray($dbCommande);
            
            $commandes[] = $commande;
        }
        
        return $commandes;
    }
    
    /**
     * 
     * @param int $id_commande
     * @return Commande
     */
    public function find($id_commande){
        $dbCommande = $this->db->fetchAssoc(
            'SELECT * FROM commande WHERE id_commande = :id_commande',
            [':id_commande' => $id_commande]
        );
        
        if(!empty($dbCommande)){
            return $this->buildFromArray($dbCommande);
        }
    }
    
    public function save(Commande $commande)
    {
        //Creation d'une date qui vaut la date du jour au bon format
        $date = new DateTime();
        $dateFormatee = $date->format('Y-m-d');
        
        $data = [
            'user_id' => $commande->getUser_id(),
            'prix_livraison' => $commande->getPrix_livraison(),
            'total' => $commande->getTotal(),
            'date_commande' => $dateFormatee,
            'etat' => $commande->getEtat()
        ];
        
        $where = !empty($commande->getId_commande())
            ? ['id_commande' => $commande->getId_commande()]
            : null
        ;
        
        $this->persist($data, $where);
    }
    
    
    public function getLastInsertId()
    {
       return $this->db->lastInsertId();
    }
    
    
    public function edit(Commande $commande){
        /*$data = [
            'etat' => $commande->getEtat()
        ];
        
        $where = !empty($commande->getId_commande())
            ? [
                'id_commande' => $commande->getId_commande()
              ]// modification
            : null // création
        ;
        
        $this->persist($data, $where);*/
        
        $this->app['db']->insert('commande', array(                                                                                                                                                                                                                                                         
            'etat' => $_POST['etat']));
    }
    
    public function delete(Commande $commande){
        $this->db->delete('commande', ['id_commande' => $commande->getId_commande()]);
    }
    
    /**
     * 
     * @param array $dbArticle
     * @return Article
     */
    public function buildFromArray(array $dbCommande){
        $commande = new Commande();
        
        $user = new User();
        
        $user
            ->setId_user($dbCommande['user_id'])
        ;
        
        $commande
            ->setId_commande($dbCommande['id_commande'])
            ->setUser_id($dbCommande['user_id'])    
            ->setPrix_livraison($dbCommande['prix_livraison'])
            ->setTotal($dbCommande['total'])
            ->setDate_commande(new DateTime($dbCommande['date_commande']))
            ->setEtat($dbCommande['etat'])
        ;
        
        return $commande;
    }
}
