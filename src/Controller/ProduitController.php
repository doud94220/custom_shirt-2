<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/07/2017
 * Time: 11:11
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Response;
use Service\BasketManager;
use Entity\Produit;

/**
 * Class IndexController
 * @package Controller
 */
class ProduitController extends ControllerAbstract
{


    public function ajaxApi()
    {

        $req = "SELECT p.*, t.type, ti.nom, ti.descr, ti.composition, ti.grammage, ti.tirage, ti.fil, t.categorie_id, c.categorie 
                FROM produit p
                JOIN type t ON p.type_id = t.id
                JOIN tissu ti ON p.tissu_id = ti.id
                JOIN categorie c ON t.categorie_id = c.id";

        if(!empty($_GET)) {
            $where = [];

            foreach($_GET as $key => $value){

                if(!empty($value)){

                    if($key == 'taille'){
                        $req .= " JOIN produit_taille p_t ON p.id = p_t.produit_id 
						  JOIN taille ta ON p_t.taille_id = ta.id";
                    }

                    if($key == 'categorie'){
                        $where[] = " c.categorie = '$value'";
                    }

                    elseif($key == 'type'){
                        $where[] = " t.type = '$value'";
                    }
                    elseif($key == 'tissu'){
                        $where[] = " ti.nom = '$value'";
                    }
                    elseif($key == 'taille'){
                        $where[] = " ta.taille = '$value'";
                    }
                    elseif($key == 'sexe'){
                        $where[] = " p.sexe = '$value'";
                    }
                    elseif($key == 'prix'){
                        $where[] = " p.prix <= $value AND p.prix >= $value-50";
                    }

                }
            }

            if (!empty($where)) {
                $req .= ' WHERE ' . implode(' AND ', $where);
            }

            if($_GET['range']==='price_up') {
                $req .= " ORDER BY p.prix ASC";
            }
            if($_GET['range']==='price_down') {
                $req .= " ORDER BY p.prix DESC";
            }

            if(!empty($_GET['nombre'])) {
                $req .= " LIMIT " . $_GET['nombre'];
            }
        }

        $results = $this->app['db']->fetchAll($req);

        $produits = [];

        foreach ($results as $result) {
            $produit = $this->app['produit.repository']->buildFromArray($result);
            $produits[] = $produit;
        }


        return $this->render('produit/list.html.twig', ['produits' => $produits]);
        //return $this->app->json($results);

    }

        public function ajaxApiAdmin()
    {

        $req = "SELECT p_t.stock
                FROM produit_taille p_t
                JOIN taille t ON p_t.taille_id=t.id
                JOIN produit p ON p_t.produit_id=p.id
                WHERE p_t.produit_id=:id
                AND t.taille=:taille";

        $results = $this->app['db']->fetchAssoc(
            $req,
            [':id' => $_GET['id'],
            ':taille' => $_GET['taille']]
            );

        return $this->app->json($results);


    }

    public function ajaxApiPanier()
    {

        $produit = $this->app['produit.repository']->findById($_POST['id']);
        $produit->setQuantite(1);
        $this->app['basket.manager']->putProductToBasket($produit);
        
        return new Response('');
    }

}