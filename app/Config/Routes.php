<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserRegisterController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/admin/residence', 'Home::residence');
$routes->post('/admin/residence', 'UserRegisterController::store');
$routes->post('/admin/residence/update', 'UserRegisterController::update');
$routes->post('/admin/residence/delete', 'UserRegisterController::delete');
$routes->post('/admin/residents/default', 'UserRegisterController::defaultPassword');

$routes->get('/admin/population', 'Home::population');

$routes->get('/admin/fire-list', 'Home::fire_list');

