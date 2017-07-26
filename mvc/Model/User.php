<?php
namespace Model;

use App\Cnx;

class User
{ /**
 *
 * @var type 
 */
    private $id;
    
    /**
     *
     * @var type 
     */
    
    private $firstname;
    
    private $lastname; 
    
    private $email; 
    
    private $address; 
    
    
    public function __construct(
            $firstname = null ,
            $lastname = null, 
            $email = null, 
            $address = null, 
            $id = null) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->address = $address;
    }
    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setId(type $id) {
        $this->id = $id;
        return $this;
    }

    public function setFirstname(type $firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * Méthode qui retourne tous les utilisateurs enregistrés en bdd
     * @ return array un tableau d'objets User
     */
    
public static function findAll(){
    $pdo = Cnx::getInstance();
    $query = 'SELECT * FROM user ORDER BY id';
    $stmt = $pdo->query($query);
    $dbUsers = $stmt -> fetchAll();
    $users = [];
    
    
    foreach ($dbUsers as $dbUser){
        $user = new self(
                $dbUser['firstname'],
                $dbUser['lastname'],
                $dbUser['email'],
                $dbUser['address'],
                $dbUser['id']
        
                );
        $users[] = $user; 
    }
    
    return $users; 
    
      
    }
}