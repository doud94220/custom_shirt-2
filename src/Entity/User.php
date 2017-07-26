<?php

namespace Entity;

use DateTime;

class User {
    /*     * ******* INSCRIPTION ********** */

    /**
     * @var int
     */
    private $id_user;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var DateTime
     */
    private $date_naissance;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var string
     */
    private $complement_adresse;

    /**
     * @var int
     */
    private $code_postal;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var int
     */
    private $tel;

    /**
     * @var string
     */
    private $sexe;

    /**
     * @var string
     */
    private $statut = 'user';

    /*     * ******* MESURES ******** */

    /**
     * @var int
     */
    private $taille;

    /**
     * @var int
     */
    private $poids;

    /**
     * @var int
     */
    private $tour_cou;

    /**
     * @var int
     */
    private $tour_poitrine;

    /**
     * @var int
     */
    private $tour_taille;

    /**
     * @var int
     */
    private $tour_bassin;

    /**
     * @var int
     */
    private $manche_droite;

    /**
     * @var int
     */
    private $manche_gauche;

    /**
     * @var int
     */
    private $poignet_droit;

    /**
     * @var int
     */
    private $poignet_gauche;

    /**
     * @var int
     */
    private $carrure;

    /**
     * @var int
     */
    private $dos;
    private $epaule_gauche;
    private $epaule_droite;

    /*     * ********** GETTERS ************** */

    public function getId_user() {
        return $this->id_user;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    /**
     *
     * @return DateTime
     */
//à verifier
   public function getDate_naissance() {
        return $this->date_naissance;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getComplement_adresse() {
        return $this->complement_adresse;
    }

    public function getCode_postal() {
        return $this->code_postal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getTel() {
        return $this->tel;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getTaille() {
        return $this->taille;
    }

    public function getPoids() {
        return $this->poids;
    }

    public function getTour_cou() {
        return $this->tour_cou;
    }

    public function getTour_poitrine() {
        return $this->tour_poitrine;
    }

    public function getTour_taille() {
        return $this->tour_taille;
    }

    public function getTour_bassin() {
        return $this->tour_bassin;
    }

    public function getManche_droite() {
        return $this->manche_droite;
    }

    public function getManche_gauche() {
        return $this->manche_gauche;
    }

    public function getPoignet_droit() {
        return $this->poignet_droit;
    }

    public function getPoignet_gauche() {
        return $this->poignet_gauche;
    }

    public function getCarrure() {
        return $this->carrure;
    }

    public function getDos() {
        return $this->dos;
    }

    public function getEpaule_gauche() {
        return $this->epaule_gauche;
    }

    public function getEpaule_droite() {
        return $this->epaule_droite;
    }

    /*     * ********SETTERS*************** */

    public function setId_user($id_user) {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @param string $nom
     * @return User
     */
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @param DateTime $date_naissance
     * @return User
     */
//à vérifier
        /*public function setDate_naissance(\DateTime::createFromFormat('d/m/Y', ['date_naissance']| $date_naissance))*/
        public function setDate_naissance(\DateTime $dateNaissance) {
        $this->date_naissance = $dateNaissance;
       return $this;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $adresse
     * @return User
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @param string $complement_adresse
     * @return User
     */
    public function setComplement_adresse($complement_adresse) {
        $this->complement_adresse = $complement_adresse;
        return $this;
    }

    /**
     * @param int $code_postal
     * @return User
     */
    public function setCode_postal($code_postal) {
        $this->code_postal = $code_postal;
        return $this;
    }

    /**
     * @param string $ville
     * @return User
     */
    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @param int $tel
     * @return User
     */
    public function setTel($tel) {
        $this->tel = $tel;
        return $this;
    }

    /**
     * @param string $sexe
     * @return User
     */
    public function setSexe($sexe) {
        $this->sexe = $sexe;
        return $this;
    }

    /**
     * @param string $statut
     * @return User
     */
    public function setStatut($statut) {
        $this->statut = $statut;
        return $this;
    }

    /* Mesures */

    public function setTaille($taille) {
        $this->taille = $taille;
        return $this;
    }

    public function setPoids($poids) {
        $this->poids = $poids;
        return $this;
    }

    public function setTour_cou($tour_cou) {
        $this->tour_cou = $tour_cou;
        return $this;
    }

    public function setTour_poitrine($tour_poitrine) {
        $this->tour_poitrine = $tour_poitrine;
        return $this;
    }

    public function setTour_taille($tour_taille) {
        $this->tour_taille = $tour_taille;
        return $this;
    }

    public function setTour_bassin($tour_bassin) {
        $this->tour_bassin = $tour_bassin;
        return $this;
    }

    public function setManche_droite($manche_droite) {
        $this->manche_droite = $manche_droite;
        return $this;
    }

    public function setManche_gauche($manche_gauche) {
        $this->manche_gauche = $manche_gauche;
        return $this;
    }

    public function setPoignet_droit($poignet_droit) {
        $this->poignet_droit = $poignet_droit;
        return $this;
    }

    public function setPoignet_gauche($poignet_gauche) {
        $this->poignet_gauche = $poignet_gauche;
        return $this;
    }

    public function setCarrure($carrure) {
        $this->carrure = $carrure;
        return $this;
    }

    public function setEpaule_gauche($epaule_gauche) {
        $this->epaule_gauche = $epaule_gauche;
        return $this;
    }

    public function setEpaule_droite($epaule_droite) {
        $this->epaule_droite = $epaule_droite;
        return $this;
    }
    
    public function setDos($dos) {
        $this->dos = $dos;
        return $this;
    }

    /*     * ****** RECUPERATION DU NOM COMPLET ****** */

    /**
     * @return string
     */
    public function getFullName() {
        return $this->prenom . ' ' . $this->nom;
    }

    /*     * ******** VERIFICATION DU STATUT ********* */

    /**
     *
     * @return bool
     */
    public function isAdmin() {
        return $this->statut == 'admin';
    }

}
