<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','UserController::log');
$routes->get('inscrir', 'UserController::inscrir');
$routes->post('inscription', 'UserController::register');

$routes->get('/log', 'UserController::log');
$routes->post('/login', 'UserController::process');
$routes->get('/accueil', 'UserController::accueil');

$routes->get('adIndex', 'Admin::index');

$routes->get('/admin', 'EtapesController::etapesCourseAdmin');
$routes->get('dashboard', 'CoursesController::dash_admin');

$routes->get('formulaire', 'ParticipationController::index');
$routes->post('form', 'ParticipationController::create');
$routes->get('/formupdatearrivee', 'ParticipationController::formupdatearrivee');
$routes->get('/updatearrivee', 'ParticipationController::updateArrivee');

$routes->get('import','ImportController::index');
$routes->post('importcsv', 'ImportController::importcsv');

$routes->get('linkPoint','ImportController::link_point');
$routes->post('importPoint', 'ImportController::import_points');

$routes->get('/generatecategories', 'CoureurCategorieController::insert');

$routes->get('/resetables', 'ResetData_Controller::resetdata');

$routes->get('/generatepdf', 'PdfController::generate_pdf');

$routes->get('/equipeaccueil', 'EquipeController::index');
$routes->get('/coureur/equipe', 'CoureurController::getCoureurByEquipe');
$routes->get('/listecoureur', 'EtapesController::getCoureurEtape');
$routes->get('/etapeparticipation', 'EtapesController::getEtapesdetails');
$routes->get('/listetapeadmin', 'EtapesController::getEtapesdetailsAdmin');
$routes->get('/assignercoureur', 'ChoixCoureurController::assignerParticipant');


$routes->get('/classementgeneral', 'PointClassementGeneraleController::classementgeneral');
$routes->get('/filtreClassement', 'PointClassementGeneraleController::filtreClassement');
$routes->get('/classementequipe', 'PointClassementGeneraleController::classementequipe');
$routes->get('/filtreclassementequipe', 'PointClassementGeneraleController::filtreClassementEquipe');


$routes->get('/listpenalite', 'PenaliteController::getallpenalite');
$routes->get('/forminsert', 'PenaliteController::forminsert');
$routes->get('deletepenalité', 'PenaliteController::delete');
// $routes->post('clientcontroller/authentification', 'ClientController::authentification');
// $routes->get('clientcontroller/listdevis', 'ClientController::listdevis');
// $routes->get('clientcontroller/newdevis', 'ClientController::newdevis');
// $routes->get('clientcontroller/insertdevis', 'ClientController::insertdevis');

// $routes->get('formcontroller/choix_login', 'FormController::choix_login');
// $routes->get('template/temple', 'Template::temple');
