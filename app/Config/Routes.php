<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserRegisterController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin/residence', 'Home::residence');
$routes->post('/admin/residence', 'UserRegisterController::store');
