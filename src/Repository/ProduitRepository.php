<?php

namespace Repository;

use Entity\Produit;
use Entity\Categorie;
use Entity\Type;
use Entity\Tissu;

/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/07/2017
 * Time: 11:11
 */


class ProduitRepository extends RepositoryAbstract
{

    public function getTable()
    {
        return 'produit';
    }

    /**
     * @return array
     */
    //affichage des produits coté admin
    public function findAllforAdmin()
    {
        $query = <<<EOS

SELECT p.*, t.type, ti.nom, ti.descr, ti.composition, ti.grammage, ti.tirage, ti.fil, t.categorie_id, cat.categorie
FROM produit p
JOIN type t ON p.type_id=t.id
JOIN categorie cat ON cat.id=t.categorie_id
JOIN tissu ti ON p.tissu_id=ti.id
GROUP BY p.id;
EOS;

        $dbProduits = $this->db->fetchAll($query);
        $produits = []; // le tableau dans lequel vont être stockées les entités Article

        foreach ($dbProduits as $dbProduit) {
            $produit = $this->buildFromArray($dbProduit);

            $produits[] = $produit;
        }

        return $produits;

    }


    //affichage des produits coté user
    public function findAll()
    {
        $query = <<<EOS

SELECT p.*, t.type, ti.nom, ti.descr, ti.composition, ti.grammage, ti.tirage, ti.fil, t.categorie_id, cat.categorie
FROM produit p
JOIN type t ON p.type_id=t.id
JOIN categorie cat ON cat.id=t.categorie_id
JOIN tissu ti ON p.tissu_id=ti.id
JOIN produit_taille p_t ON p.id=p_t.produit_id
GROUP BY p.id;
EOS;

        $dbProduits = $this->db->fetchAll($query);
        $produits = []; // le tableau dans lequel vont être stockées les entités Article

        foreach ($dbProduits as $dbProduit) 
            {
            $produit = $this->buildFromArray($dbProduit);

            $produits[] = $produit;
        }

        return $produits;

    }

    public function findById($id)
    {
        $query = <<<EOS

SELECT p.*, t.type, ti.nom, ti.descr, ti.composition, ti.grammage, ti.tirage, ti.fil, t.categorie_id, cat.categorie 
FROM produit p
JOIN type t ON p.type_id=t.id
JOIN categorie cat ON cat.id=t.categorie_id
JOIN tissu ti ON p.tissu_id=ti.id
WHERE p.id = :id
EOS;

        $dbProduit = $this->db->fetchAssoc(
            $query,
            [':id' => $id]
        );

        if (!empty($dbProduit)) 
            {
            return $this->buildFromArray($dbProduit);
        }

        return null;
    }

    public function save(Produit $produit)
    {
        $data = [
            'type_id' => $produit->getType()->getId(),
            'tissu_id' => $produit->getTissu()->getId(),
            'titre' => $produit->getTitre(),
            'description' => $produit->getDescription(),
            'photo' => $produit->getPhoto(),
            'sexe' => $produit->getSexe(),
            'prix' => $produit->getPrix(),
        ];

        $where = !empty($produit->getId())
            ? ['id' => $produit->getId()] // modification
            : null // création
        ;

        $this->persist($data, $where);
    }

    public function delete(Produit $produit)
    {
        $this->db->delete('produit', ['id' => $produit->getId()]);
    }

    /**
     * @param array $dbArticle
     * @return Article
     */
    public function buildFromArray(array $dbProduit)
    {
        $produit = new Produit();

        $type = new Type();


        $tissu = new Tissu();


        $category = new Categorie();

        $type
            ->setId($dbProduit['type_id'])
            ->setCategorie($category)
            ->setType($dbProduit['type'])
        ;

        $tissu
            ->setId($dbProduit['tissu_id'])
            ->setNom($dbProduit['nom'])
            ->setComposition($dbProduit['composition'])
            ->setGrammage($dbProduit['grammage'])
            ->setDescr($dbProduit['descr'])
            ->setTirage($dbProduit['tirage'])
            ->setFil($dbProduit['fil'])
        ;

        $category
            ->setId($dbProduit['categorie_id'])
            ->setTitle($dbProduit['categorie'])
        ;

        $produit
            ->setId($dbProduit['id'])
            ->setTitre($dbProduit['titre'])
            ->setType($type)
            ->setTissu($tissu)
            ->setDescription($dbProduit['description'])
            ->setPhoto($dbProduit['photo'])
            ->setSexe($dbProduit['sexe'])
            ->setPrix($dbProduit['prix'])
        ;

        return $produit;
    }

}