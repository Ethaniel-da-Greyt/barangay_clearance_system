<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserRegisterController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/admin/residents', 'Home::residence');
$routes->post('/admin/residents', 'UserRegisterController::store');
$routes->post('/admin/residents/update', 'UserRegisterController::update');
$routes->post('/admin/residents/delete', 'UserRegisterController::delete');
$routes->post('/admin/residents/default', 'UserRegisterController::defaultPassword');

$routes->get('/admin/population', 'Home::population');
$routes->post('/admin/population', 'PopulationController::store');
$routes->post('/admin/population/update', 'PopulationController::update');
$routes->post('/admin/population/delete', 'PopulationController::delete');


$routes->get('/admin/fire-list', 'Home::fire_list');
