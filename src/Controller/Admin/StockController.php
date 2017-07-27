<?php
/**
 * Created by PhpStorm.
 * User: Aha
 * Date: 23/07/2017
 * Time: 13:03
 */

namespace Controller\Admin;

use Controller\ControllerAbstract;
use Entity\ProduitStock;


class StockController extends ControllerAbstract
{
    //affichage tous les stocks et tailles coreespondants
    public function listStock($id)
    {
        $produits = $this->app['stock.repository']->findStock($id);

        return $this->render(
            'admin/produit/stock.html.twig',
            ['produits' => $produits]
        );
    }

    //mise à jour de stock
    public function editAction($id = null)
    {

        $numeric_post = array_values($_POST);//pour transformer £_POST en array numérique


        $error = '';

        foreach ($numeric_post as $value) {

            if($value === '') { //on vérifie qu'il y ait pas de champs vides

                $error = 'Tous les champs doivent etre remplies';

            }

        }

        $produits = $this->app['stock.repository']->findProduitTaille($id);//recupérer le data qui correspond à $id -> retourne
        // un array consistant de 5 objets
        var_dump($produits);

        if(empty($produits)) {

            $produits = array();

            for($i=0; $i<5; $i++) {

                array_push($produits, new ProduitStock());
            }
        }

        var_dump($produits);

        $data = array();

        $counter = 0;

        for($i=0; $i<5; $i++) {//dans ce boucle on crée un array dans lequel on insere des subarrays qui eux contiennet
            //des valeurs couple 'taille' et 'stock'. Cela est nécessaire pour pouvoir transmettre ces couples une par une
            //dans un boucle à méthode persiste de RepositoryAbstract

            $sliced_data = array_slice($numeric_post, $counter, 2);//on récupère des couples 'taiile' et 'stock'

            array_push($data, $sliced_data);//on insere ces couples dans un array

            $counter += 2;//on incremente de 2 et on fait tourner le boucle 5 fois(chaque tour de boucle récupère 2 elements)
            // car on a 10 valeurs dans le POST
        }

        var_dump($data);

            $count = 0;

            foreach ($produits as $objet) {//on alimente les objets dans la variable $produits par $data(càd data de$_POST)

                if($objet->getProduit() === null) {//si le produit n'est pas dans la table 'produit_taille' (dans ce cas là
                    //$objet->getProduit() retournera 'null' car cet $objet fait partie de $produits qu'on a créé plus haut
                    //dans la boucle for - new ProduitStock(), alors on crée une nouvelle variable $set et on lui attribue null...

                    $set = null;

                } else {//...sinon on attribue à $set le id du produit (récupéré de l'URL)

                    $set = $id;
                }

                $objet
                    ->setProduit($set)//Si la requete de récupération des $produits (voir plus haut) retourne data du produit qui existe déjà dans la table
                    //produit_talle alors setProsuit aura la valeur correspondant à $id sinon null
                    ->setTaille($data[$count][0])
                    ->setStock($data[$count][1])
                ;

                $count+=1;

            }

        var_dump($produits);

        if (empty($error)) {//si pas de champs vides on anvoie les objets à méthode 'save'

            $this->app['stock.repository']->save($produits, $id);
            $this->addFlashMessage("Le stock a été mis à jour");



            return $this->redirectRoute('admin_produits');

        } else {//sinon on affiche un message d'ereur sur la meme page, on récupere le data $produits pour le reaficher sur la page actuelle

            $this->addFlashMessage($error, 'error');

            $produits = $this->app['stock.repository']->findStock($id);

            return $this->render(
                'admin/produit/stock.html.twig',
                ['produits' => $produits]
            );

            return $this->render(
                'admin/produit/stock.html.twig',
                [
                    'produits' => $produits
                ]
            );
        }

    }

}