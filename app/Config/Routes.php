<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','AdminController::log');
$routes->post('/login', 'AdminController::process');
$routes->get('admin/gainfinal', 'AdminController::getcommissionfinal');
$routes->get('admin/gainmois', 'AdminController::getcommissionmois');
$routes->get('admin/resetables', 'ResetData_Controller::resetdata');
$routes->post('admin/logout', 'AdminController::logout');
$routes->get('admin/formulairelocation','AdminController::link_formulaireLocation');

$routes->get('location/createlocation','LocationController::create');

$routes->get('admin/import','ImportController::index');
$routes->post('importcsv', 'ImportController::importcsv');

$routes->get('/proprio', 'ProprietaireController::log');
$routes->post('/proprio/login', 'ProprietaireController::loginproprietaire');
$routes->get('/proprio/listebiens', 'ProprietaireController::listebiensbyproprietaire');
$routes->get('/proprio/camois', 'ProprietaireController::getchiffreaffairemois');
$routes->get('/proprio/cafinal', 'ProprietaireController::getchiffreaffairefinal');
$routes->post('/proprio/logout', 'ProprietaireController::logout');

$routes->get('/proprio/test', 'ProprietaireController::testgetchiffreaffaire');

$routes->get('/client', 'ClientController::index');
$routes->post('/client/login', 'ClientController::loginclient');
$routes->get('/client/listeloyer', 'ClientController::listeloyerbydatebyclient');
$routes->get('/client/logout', 'ClientController::logout');

$routes->get('/client', 'ClientController::index');
$routes->post('/client/login', 'ClientController::loginclient');





// $routes->post('clientcontroller/authentification', 'ClientController::authentification');
// $routes->get('clientcontroller/listdevis', 'ClientController::listdevis');
// $routes->get('clientcontroller/newdevis', 'ClientController::newdevis');
// $routes->get('clientcontroller/insertdevis', 'ClientController::insertdevis');

// $routes->get('formcontroller/choix_login', 'FormController::choix_login');
// $routes->get('template/temple', 'Template::temple');
