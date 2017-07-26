<?php
/**
 * Created by PhpStorm.
 * User: Aha
 * Date: 23/07/2017
 * Time: 13:01
 */

namespace Repository;

use Entity\Produit;
use Entity\ProduitStock;
use Entity\Taille;


class StockRepository extends RepositoryAbstract
{

    public function getTable()
    {
        return 'produit_taille';
    }

    //Pour récupérer les données de la tables produit_taill avec objetss (voir 'buildFromArrayStock' plus bas)
    public function findStock($id)
    {
        $query = <<<EOS
SELECT p.*, t.id AS ta_id, t.taille, p_t.stock
FROM produit_taille p_t
JOIN taille t ON taille_id=t.id
JOIN produit p ON p_t.produit_id=p.id
WHERE p.id=:id;
EOS;

        $dbProduits = $this->db->fetchAll(
            $query,
            [':id' => $id]
        );

        $produits = [];

        foreach ($dbProduits as $dbProduit) {
            $produit = $this->buildFromArrayStock($dbProduit);

            $produits[] = $produit;
        }

        return $produits;

    }


    //Pour récupérer les données de la tables produit_taill avec objetss (voir 'buildFromArrayProduitStock' plus bas)
    public function findProduitTaille($id)
    {
        $query = <<<EOS
SELECT p_t.*
FROM produit_taille p_t
WHERE produit_id=:id;
EOS;

        $dbProduits = $this->db->fetchAll(
            $query,
            [':id' => $id]
        );

        $produits = [];

        foreach ($dbProduits as $dbProduit) {
            $produit = $this->buildFromArrayProduitTaille($dbProduit);

            $produits[] = $produit;
        }

        return $produits;

    }


    public function save($produits, $id)
    {
        foreach ($produits as $value) {//ce boucle va envoyer le $data un par à méthode 'persist' de RepositoryAbstract
            //pour la requete d'Update
            $data = [
                'produit_id' => $id,
                'taille_id' => $value->getTaille(),
                'stock' => $value->getStock(),
            ];

            $where = !empty($value->getProduit())
                ? ['produit_id' => $value->getProduit(),
                    'taille_id' => $value->getTaille()
                ] // modification
                : null // création
            ;

            $this->persist($data, $where);
        }

    }


    public function buildFromArrayStock(array $dbProduit)
    {

        $produit = new Produit();

        $produit_taille = new ProduitStock();

        $taille = new Taille();

        $produit
            ->setId($dbProduit['id'])
            ->setTitre($dbProduit['titre'])
            ->setDescription($dbProduit['description'])
            ->setPhoto($dbProduit['photo'])
            ->setSexe($dbProduit['sexe'])
            ->setPrix($dbProduit['prix'])
        ;

        $taille
            ->setId($dbProduit['ta_id'])
            ->setTaille($dbProduit['taille'])
        ;

        $produit_taille
            ->setProduit($produit)
            ->setTaille($taille)
            ->setStock($dbProduit['stock'])
        ;

        return $produit_taille;
    }


    public function buildFromArrayProduitTaille(array $dbProduit)
    {

        $produit_taille = new ProduitStock();

        $produit_taille
            ->setProduit($dbProduit['produit_id'])
            ->setTaille($dbProduit['taille_id'])
            ->setStock($dbProduit['stock'])
        ;

        return $produit_taille;
    }

}