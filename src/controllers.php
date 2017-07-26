<?php
use Controller\CustomController;
use Controller\UserController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Request::setTrustedProxies(array('127.0.0.1'));
/*HOMEPAGE*/


$app
    ->get('/', 'index.controller:homepage')
    ->bind('homepage')// nom de la route
;

$app
    ->match('/produit/stock/{id}', 'admin.stock.controller:editAction')
    ->bind('admin_stock_edit')
;

$app
    ->get('/template/{id}', 'index.controller:idAction')
    ->bind('show_product')// nom de la route
;

/* * *******************FRONT*************************** */


// Route du panier (basket en UK) en front
$app
    ->match('/basket', 'basket.controller:consultAction')
    ->bind('basket_consult');
$app
    ->match('/basket/incrementBasket/{idProduitEnSession}', 'basket.controller:incrementAction')
        //->value('idProduitEnSession')
    ->bind('basket_increment');
$app
      ->match('/basket/decrementBasket/{idProduitEnSession}', 'basket.controller:decrementAction')
      ->bind('basket_decrement');
$app

    ->match('/basket/delete/{idProduitEnSession}', 'basket.controller:deleteAction')
    ->bind('basket_delete');

//Celle d'Edouard, la seule utilisée (utilisée dans la vue du panier)
$app
    ->match('/basket/pay', 'basket.controller:payAction')
    ->bind('basket_pay');

////Celle de Julien (à virer)
//$app
//    ->match('/basket/paiement', 'basket.controller:payAction')
//    ->bind('basket_pay')
//;

$app
    ->post('/basket/charge', 'basket.controller:payChargeAction')
    ->bind('basket_charge')   
;

/* HOMEPAGE */


$app
    ->get('/', 'index.controller:homePage')
    ->bind('homepage')// nom de la route
;

$app
    ->get('/produits', 'index.controller:indexAction')
    ->bind('produits')// nom de la route
;

$app
    ->get('/template/{id}', 'index.controller:idAction')
    ->bind('show_product')// nom de la route
;

//Ajax---------------------------------------------
$app
    ->match('/contact', 'index.controller:contactAction')
    ->bind('contact')
;

$app
    ->get('/ajax_api', 'produit.controller:ajaxApi')
    ->bind('ajax_api')// nom de la route
;

$app
    ->match('/ajax_api_panier', 'produit.controller:ajaxApiPanier')
    ->bind('ajax_api_panier')// nom de la route
;

$app
    ->match('/ajax_api_produit_admin', 'produit.controller:ajaxApiAdmin')
    ->bind('ajax_api_produit_admin')// nom de la route
;

//Custom--------------------------------------------------
$app
    ->match('/custom', 'custom.controller:listTissu')
    ->bind('etape_1_tissu')

;
$app
    ->match('/custom_bouton', 'custom.controller:listBouton')
    ->bind('etape_2_bouton')
;

$app
    ->match('/custom_col', 'custom.controller:listCol')
    ->bind('etape_3_col')
;

$app
    ->match('/custom_coupe', 'custom.controller:listCoupe')
    ->bind('etape_4_coupe')
;

$app
    ->match('/custom_poidstaille', 'custom.controller:fillTaillePoids')
    ->bind('etape_5_poidstaille')
;

$app
    ->match('/custom_tronc', 'custom.controller:fillTailleTronc')
    ->bind('etape_5_tronc')
;

$app
    ->match('/custom_bras', 'custom.controller:fillTailleBras')
    ->bind('etape_5_bras')
;

$app
    ->match('/custom_carrure', 'custom.controller:fillMeasureCarrure')
    ->bind('etape_5_carrure')
;

//$app
//    ->match('/custom_recap', 'custom.controller:fillTitreCustom')
//    ->bind('custom_recap')
//;

$app
    ->match('/custom_recap', 'custom.controller:consultSession')
    ->bind('custom_recap')
;

$app
    ->match('/custom_validate' , 'custom.controller:customValidateAction')
    ->bind('custom_validate')
;

/* UTILISATEUR */

$app
    ->match('/inscription', 'user.controller:registerAction')
    ->bind('register')
;

$app
    ->match('/connexion', 'user.controller:loginAction')
    ->bind('login')
;

$app
    ->get('/deconnexion', 'user.controller:logoutAction')
    ->bind('logout')
;

$app
    ->match('/profile', 'user.controller:showProfile')
    ->bind('profile')
;

$app
    ->match('profile/commande/detail', 'user.controller:showDetails')
    ->bind('detail_commande')
;

//$app
//    ->get('/profile', 'commande.controller:showAction')
//    ->bind('profile_commandes')
//;

$app
    ->get('/profile/suivi_commandes', 'commande.controller:followAction')
    ->bind('suivi_commande')
;

$app
    ->match('/profile/delete_commande/{id}', 'commande.controller:deleteAction')
    ->bind('delete_commande')
;

$app
    ->match('/profile/return_commande/{id}', 'commande.controller:returnAction')
    ->bind('return_commande')
;

$app
    ->match('/profile/modifier', 'user.controller:modifAction')
    ->bind('profile_edit')
;
//Rajouté par Edouard
$app
    ->match('/profile/create_command', 'commande.controller:createCommandAction')
    ->bind('create_command')
;

$app
    ->get('/produits', 'index.controller:indexAction')
    ->bind('produits')// nom de la route
;

/* * ******************* ADMIN ************************* */
// crée un groupe de routes pour la partie admin
$admin = $app['controllers_factory'];

//protection de l'accès au backoffice
$admin->before(function () use ($app) {
    if (!$app['user.manager']->isAdmin()) {
        $app->abort(403, 'Accès refusé');
    }
});

$app->mount('/admin', $admin);
// toutes les routes définies dans le groupe admin
// auront le préfixe /admin

//gestion des produits ----------------------------------------
$admin
    ->get('/produits', 'admin.produit.controller:listAction')
    ->bind('admin_produits')
;

$admin
    ->match('/produit/edition/{id}', 'admin.produit.controller:editAction')
    ->value('id', null)
    ->bind('admin_produit_edit')
;

$admin
    ->get('/produit/suppression/{id}', 'admin.produit.controller:deleteAction')
    ->bind('admin_produit_delete')
;

$admin
    ->get('/produit/stock/{id}', 'admin.stock.controller:listStock')
    ->bind('admin_stock')
;

$admin
    ->match('/produit/stock/{id}', 'admin.stock.controller:editAction')
    ->bind('admin_stock_edit')
;

// gestion des commandes --------------------------------------
$admin
    ->match('/commandes', 'admin.commande.controller:listAction')
    ->bind('admin_commandes')
;

$admin
    ->post('/commande/edit/{id}', 'admin.commande.controller:editAction')
    ->bind('admin_edit_commande')
;

$admin
    ->match('/commande/delete/{id}', 'admin.commande.controller:deleteAction')
    ->bind('admin_delete_commande')
;

$admin
    ->get('/commande/details/{id_commande}', 'admin.commande.controller:detailsByCommande')
    ->bind('admin_detail_commande')
;

//-------------------------------------Gestion des utilisateurs

$admin
    ->match('/user/panel', 'user.controller:showAllUsers')
    ->bind('admin_panel')
;

$admin
    ->match('/user/panel2/{id_user}', 'user.controller:AdminRemoveUser')
    ->bind('admin_panel2')
;

$admin
    ->match('/user/admin_clients/{id_user}', 'user.controller:AdminModifAction')
    ->bind('admin_cc')
;

//-------------------------------------------------------------------------//
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/' . $code . '.html.twig',
        'errors/' . substr($code, 0, 2) . 'x.html.twig',
        'errors/' . substr($code, 0, 1) . 'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
