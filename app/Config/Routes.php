<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','AdminController::log');
$routes->post('/login', 'AdminController::process');
// $routes->get('admin/gain', 'AdminController::accueil');
$routes->get('admin/gain', 'AdminController::calculatecommission');


$routes->get('/proprio', 'ProprietaireController::log');
$routes->post('/proprio/login', 'ProprietaireController::loginproprietaire');
$routes->get('/proprio/listebiens', 'ProprietaireController::listebiensbyproprietaire');
$routes->get('/proprio/location', 'ProprietaireController::listelocationnetbydatebyproprio');




$routes->get('/proprio/test', 'ProprietaireController::testgetchiffreaffaire');

$routes->get('/client', 'ClientController::index');
$routes->post('/client/login', 'ClientController::loginclient');
$routes->get('/client/listeloyer', 'ClientController::listeloyerbydatebyclient');


$routes->get('/client', 'ClientController::index');
$routes->post('/client/login', 'ClientController::loginclient');





// $routes->post('clientcontroller/authentification', 'ClientController::authentification');
// $routes->get('clientcontroller/listdevis', 'ClientController::listdevis');
// $routes->get('clientcontroller/newdevis', 'ClientController::newdevis');
// $routes->get('clientcontroller/insertdevis', 'ClientController::insertdevis');

// $routes->get('formcontroller/choix_login', 'FormController::choix_login');
// $routes->get('template/temple', 'Template::temple');
