<?php

namespace Repository;

use DateTime;
use Entity\User;

class UserRepository extends RepositoryAbstract {

    public function getTable() {
        return 'user';
    }

    public function save(User $user){

        $data = [
            'prenom' => $user->getPrenom(),
            'nom' => $user->getNom(),
            'date_naissance'=> $user->getDate_naissance()->format('Y-m-d'),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'adresse' => $user->getAdresse(),
            'complement_adresse' => $user->getComplement_adresse(),
            'code_postal' => $user->getCode_postal(),
            'ville' => $user->getVille(),
            'tel' => $user->getTel(),
            'sexe' => $user->getSexe(),
            'statut' => $user->getStatut(),

        ];
        //var_dump($data);
        $where = !empty($user->getId_user())
            ? ['id_user' => $user->getId_user()]
            : null
        ;
        $this->persist($data, $where);

        if (empty($user->getId_user())) {
            $user->setId_user($this->db->lastInsertId());
        }
    }

    public function saveUserMeasure(User $user) {
        $data = [
                'taille' => $user->getTaille(),
                'poids' => $user->getPoids(),
                'tour_cou' => $user->getTour_cou(),
                'tour_poitrine' => $user->getTour_poitrine(),
                'tour_taille' => $user->getTour_taille(),
                'tour_bassin' => $user->getTour_bassin(),
                'manche_droite' => $user->getManche_droite(),
                'manche_gauche' => $user->getManche_gauche(),
                'poignet_droit' => $user->getPoignet_droit(),
                'poignet_gauche' => $user->getPoignet_gauche(),
                'epaule_gauche' => $user->getEpaule_gauche(),
                'epaule_droite' => $user->getEpaule_droite(),
                'carrure' => $user->getCarrure(),
                'dos' => $user->getDos()
        ];
        
        $where = !empty($user->getId_user()) ? ['id_user' => $user->getId_user()] : null
        ;
        $this->persist($data, $where);
    }

    

    public function findByEmail($email) {
        $dbUser = $this->db->fetchAssoc(
                'SELECT * FROM user WHERE email = :email', [':email' => $email]
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
    public function buildFromArray($dbUser) {
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

    public function findAllByUsers(){
        $query = <<<EOS
SELECT *
FROM user
ORDER BY id_user ASC 
EOS;

        $dbAllUsers = $this->db->fetchAll($query);
        $users = [];

        foreach($dbAllUsers as $key){
            $user = $this->buildFromArray($key);

            $users[] = $user;
        }

        return $users;
    }

    public function find($id_user){
        $dbUser = $this->db->fetchAssoc(
            'SELECT * FROM user WHERE id_user = :id_user',
            [':id_user' => $id_user]
        );

        if (!empty($dbUser)) {
            return $this->buildFromArray($dbUser);
        }

        return null;
    }

   /* public function removeUser($id_user){
       $dbuser = $this ->db->fetchAssoc(
           'DELETE id_user FROM user where id_user= :id_user',
           [':id_user' => $id_user]
       );

        if (!empty($dbUser)) {
            return $this->buildFromArray($dbUser);
        }

        return null;
    }*/


       /* public function removeUser($id)
        {

            ("DELETE FROM user WHERE id_user = :id_user");

        }*/

    public function removeUser(User $user)
    {
        $this->db->delete('user', ['id_user' => $user->getId_user()]);
    }

}
