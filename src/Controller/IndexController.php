<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/07/2017
 * Time: 15:25
 */

namespace Controller;


/**
 * Class IndexController
 * @package Controller
 */
class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $produits = $this->app['produit.repository']->findAll();

        return $this->render('index.html.twig', ['produits' => $produits]);
    }

    public function idAction($id)
    {
        $produits = $this->app['produit.repository']->findById($id);

        return $this->render('produit/produit.html.twig', ['produits' => $produits]);
    }
}

