<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 20/07/2017
 * Time: 11:02
 */

namespace Controller\Admin;

use Controller\ControllerAbstract;
use Entity\Produit;
use Entity\Type;
use Entity\Tissu;

class ProduitController extends ControllerAbstract
{

    public function listAction()
    {
        $produits = $this->app['produit.repository']->findAllforAdmin();

        return $this->render(
            'admin/produit/list.html.twig',
            ['produits' => $produits]
        );
    }

    public function editAction($id = null)
    {

        $types = $this->app['type.repository']->findAllTypes();

        $tissus = $this->app['tissu.repository']->findAllTissu();

        if (!empty($id)) {
            $produit = $this->app['produit.repository']->findById($id);
        } else {
            $produit = new Produit();
            $produit->setType(new Type());
            $produit->setTissu(new Tissu());
            $photo_bd = '';//pour éviter l'erreur 'undefined variable'
        }

        if(!empty($_FILES['photo']['name']))
        {
            $nom_photo = $_POST['titre'] . '_' . $_FILES['photo']['name'];
            $photo_dossier = '/custom_shirt-2/web/img/' . $nom_photo;
            move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $photo_dossier);

            $photo_bd = $nom_photo;

        } else {

            if(isset($_POST['photo_actuelle'])) { $photo_bd = $_POST['photo_actuelle'];}
        }

        if (!empty($_POST)) {
            $produit
                ->setTitre($_POST['titre'])
                ->setDescription($_POST['description'])
                ->setPhoto($photo_bd)
                ->setSexe($_POST['sexe'])
                ->setPrix($_POST['prix'])
            ;

            $produit->getType()->setId($_POST['type']);//$_POST['type'] est un id de type (voir attribut value de type dans edit.html)
            $produit->getTissu()->setId($_POST['tissu']);//$_POST['tissu'] est un id de tissu (voir attribut value de tissu dans edit.html)

            if (empty($_POST['type'])) {
                $errors['type'] = "Le type est obligatoire";
            }

            if (empty($_POST['tissu'])) {
                $errors['tissu'] = 'Le tissu est obligatoire';
            }

            if (empty($_POST['titre'])) {
                $errors['titre'] = 'Le titre est obligatoire';
            }

            if (empty($_POST['description'])) {
                $errors['description'] = 'La description est obligatoire';
            }

            if (empty($_POST['sexe'])) {
                $errors['sexe'] = 'Le sexe est obligatoire';
            }

            if (empty($_POST['prix'])) {
                $errors['prix'] = 'Le prix est obligatoire';
            }

            if (empty($photo_bd)) {
                $errors['photo'] = 'Une photo est obligatoire';
            }

            if (empty($errors)) {
                $this->app['produit.repository']->save($produit);
                $this->addFlashMessage("Le produit est enregistré");

                return $this->redirectRoute('admin_produits');
            } else {
                $message = '<b>Le Formulaire contient des erreurs</b>';
                $message .= '<br>' . implode('<br>', $errors);
                $this->addFlashMessage($message, 'error');
            }
        }

        return $this->render(
            'admin/produit/edit.html.twig',
            [
                'produit' => $produit,
                'types' => $types,
                'tissus' => $tissus,
            ]
        );
    }

    public function deleteAction($id)
    {
        $produit = $this->app['produit.repository']->findById($id);

        $this->app['produit.repository']->delete($produit);

        $this->addFlashMessage("Le produit a été supprimé");

        return $this->redirectRoute('admin_produits');
    }

}