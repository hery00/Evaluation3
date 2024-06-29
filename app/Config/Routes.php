<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','AdminController::log');
$routes->post('/login', 'AdminController::process');
$routes->get('/accueil', 'AdminController::accueil');



// $routes->post('clientcontroller/authentification', 'ClientController::authentification');
// $routes->get('clientcontroller/listdevis', 'ClientController::listdevis');
// $routes->get('clientcontroller/newdevis', 'ClientController::newdevis');
// $routes->get('clientcontroller/insertdevis', 'ClientController::insertdevis');

// $routes->get('formcontroller/choix_login', 'FormController::choix_login');
// $routes->get('template/temple', 'Template::temple');
