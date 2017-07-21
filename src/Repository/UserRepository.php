<?php

namespace Repository;

use DateTime;
use Entity\User;

class UserRepository extends RepositoryAbstract
{
    public function getTable() 
    {
        return 'user';
    }
    
    public function save(User $user){
        $data = [
            'prenom' => $user->getPrenom(),
            'nom' => $user->getNom(),
            'date_naissance'=> $user->getDate_naissance()->format('d-m-Y'),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'adresse' => $user->getAdresse(),
            'complement_adresse' => $user->getComplement_adresse(),
            'code_postal' => $user->getCode_postal(),
            'ville' => $user->getVille(),
            'tel' => $user->getTel(),
            'sexe' => $user->getSexe(),
            'statut' => $user->getStatut()
        ];
        
        $where = !empty($user->getId_user())
            ? ['id' => $user->getId_user()]
            : null
        ;
        
        $this->persist($data, $where);
    }
    
    // Faire  une méthode avec UPDATE sur les champs tailles en
    //en récupérant les informations en session
    //https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/manipulation-de-donnees-stockees
 
    public function update(User $user)
    {
        $q = $this->_db->prepare('UPDATE user SET taille : taille, poids = :poids WHERE id_user = :id_user');
        
        $q->bindValue(":taille", $user->$_POST['taille'], PDO::PARAM_INT);
        $q->bindValue(':poids', $user->$_POST['poids'], PDO::PARAM_INT);
        $q->bindValue(':id_user', $user->$_POST['id_user'], PDO::PARAM_INT);
    
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
    
    //                'id_user' => $user->getUser(),
//                'taille' => $user->getTaille(),
//                'poids' => $user->getPoids(),
//                'tour_cou' => $user->getTour_cou(),
//                'tour_poitrine' => $user->getTour_poitrine(),
//                'tour_taille' => $user->getTour_taille(),
//                'tour_bassin' => $user->getTour_bassin(),
//                'manche_droite' => $user->getManche_droite(),
//                'manche_gauche' => $user->getManche_gauche(),
//                'poignet_droit' => $user->getPoignet_droit(),
//                'poignet_gauche' => $user->getPoignet_gauche(),
//                'carrure' => $user->getCarrure(),
//                'dos' => $user->getDos() 
    
    
    
    
    
    
    public function findByEmail($email){
        $dbUser = $this->db->fetchAssoc(
            'SELECT * FROM user WHERE email = :email',
            [':email' => $email]
        );

        if (!empty($dbUser)) {
            return $this->buildFromArray($dbUser);
        }

        return null;
    }


    /**
     * @param array $dbUser
     * @return User
     */
    public function buildFromArray($dbUser){
        $user = new User();

        $user
            ->setId_user($dbUser['id_user'])
            ->setNom($dbUser['nom'])
            ->setPrenom($dbUser['prenom'])
            ->setDate_naissance(new DateTime($dbUser['date_naissance']))
            ->setEmail($dbUser['email'])
            ->setPassword($dbUser['password'])
            ->setAdresse($dbUser['adresse'])
            ->setComplement_adresse($dbUser['complement_adresse'])
            ->setCode_postal($dbUser['code_postal'])
            ->setVille($dbUser['ville'])
            ->setTel($dbUser['tel'])
            ->setSexe($dbUser['sexe'])
            ->setStatut($dbUser['statut'])
        ;
        
        return $user;
    }
}
