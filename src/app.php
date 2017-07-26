<?php

use Controller\Admin\CommandeController as AdminCommandeController;
use Controller\Admin\DetailCommandeController as AdminDetailCommandeController;
use Controller\Admin\ProduitController as AdminProduitController;
use Controller\Admin\StockController as AdminStockController;
use Controller\BasketController;
use Controller\CommandeController;
use Controller\CustomController;
use Controller\DetailCommandeController;
use Controller\IndexController;
use Controller\ProduitController;
use Controller\UserController;
use Repository\BoutonRepository;
use Repository\ColRepository;
use Repository\CoupeRepository;
use Repository\CommandeRepository;
use Repository\CustomRepository;
use Repository\DetailCommandeRepository;
use Repository\ProduitRepository;
use Repository\StockRepository;
use Repository\TissuRepository;
use Repository\TypeRepository;
use Repository\UserRepository;
use Service\BasketManager;
use Service\CustomManager;
use Service\UserManager;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\TwigServiceProvider;



$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new SwiftmailerServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addGlobal('user_manager', $app['user.manager']); // Global est une fonction de TWIG
    $twig->addGlobal('basket_manager', $app['basket.manager']);
    return $twig;
});

$app->register
(
    new DoctrineServiceProvider(), //On rajoute un service au framework
        [
            'db.options' => 
            [
                'driver'    => 'pdo_mysql',
                'host'      => 'localhost',
                'dbname'    => 'custom_shirt',
                'user'      => 'root',
                'password'  => '',
                'charset'   => 'utf8'

            ]
        ]
);

$app->register(new SessionServiceProvider()); //Permet d'utiliser $app['session']

/* Déclaration des MANAGERS */

$app['user.manager'] = function () use ($app)
{
    return new UserManager($app['session']);
};

$app['basket.manager'] = function() use ($app)
{
   return new BasketManager($app['session']);
};

$app['custom.manager'] = function() use ($app)
{
  return new CustomManager($app); //Modifié par Edouard pour avoir app dans une fonction du 'custom manager' avec session of course (il est dans app)
};
     
/* Déclaration des CONTROLERS */

$app['index.controller'] = function () use ($app) 
{
    return new IndexController($app);
};

$app['produit.controller'] = function () use ($app) 
{
    return new ProduitController($app);
};

$app['index.controller'] = function () use ($app) {

    return new IndexController($app);
};

/* Déclaration des contrôleurs en service */
/* FRONT */
$app['commande.controller'] = function () use ($app)
{
    return new CommandeController($app);
};

$app['detail.commande.controller'] = function () use ($app)
{
    return new DetailCommandeController($app);
};

$app['user.controller'] = function () use ($app){
    return new UserController($app);
};

$app['basket.controller'] = function() use ($app)
{
    return new BasketController($app);
};

$app['detail.commande.controller'] = function () use ($app){
    return new DetailCommandeController($app);
};

/* ADMIN */

$app['admin.produit.controller'] = function () use ($app) {

    return new AdminProduitController($app);
};

$app['admin.stock.controller'] = function () use ($app) {

    return new AdminStockController($app);
};

$app['admin.commande.controller'] = function () use ($app)
{
    return new AdminCommandeController($app);
};

$app['admin.detail_commande.controller'] = function () use ($app)
{
    return new AdminDetailCommandeController($app);
};

$app['custom.controller'] = function() use ($app)
{
    return new CustomController($app);
};

/* Déclaration des repositories en service */
$app['type.repository'] = function () use ($app) {
    return new TypeRepository($app['db']);
};

$app['tissu.repository'] = function () use ($app) {
    return new TissuRepository($app['db']);
};

$app['custom.repository'] = function() use ($app) {
    return new CustomRepository($app['db']);
};


$app['col.repository'] = function() use ($app)
{
    return new ColRepository($app['db']);
};

$app['coupe.repository'] = function() use ($app)
{
    return new CoupeRepository($app['db']);
};

$app['produit.repository'] = function () use ($app) 
{
    return new ProduitRepository($app['db']);
};

$app['bouton.repository'] = function () use ($app) 
{
    return new BoutonRepository($app['db']);
};


$app['commande.repository'] = function () use ($app)
{
    return new CommandeRepository($app['db']);
};

$app['produit.repository'] = function () use ($app) {

    return new ProduitRepository($app['db']);
};

$app['stock.repository'] = function () use ($app) {

    return new StockRepository($app['db']);
};

$app['detail.commande.repository'] = function () use ($app)
{
    return new DetailCommandeRepository($app['db']);
};

$app['detail.commande.repository'] = function () use ($app)
{
    return new DetailCommandeRepository($app['db']);
};


$app['user.repository'] = function () use ($app){
    return new UserRepository($app['db']);
};

$app['stock.repository'] = function () use ($app) {

    return new StockRepository($app['db']);
};

return $app;
