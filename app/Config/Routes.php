<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserRegisterController;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'role:admin'], function ($routes) {
    //Main Dashboard
    $routes->get('/admin', 'Home::index');

    //Requests Actions
    $routes->get( '/admin/requests', 'Home::requests');
    $routes->post('/admin/requests/approve', 'RequestsController::approve');
    $routes->post('/admin/requests/reject', 'RequestsController::reject');

    //Residents Act/admin/ions
    $routes->get( '/admin/residents', 'Home::residence');
    $routes->post('/admin/residents/add', 'UserRegisterController::store');
    $routes->post('/admin/residents/update', 'UserRegisterController::update');
    $routes->post('/admin/residents/delete', 'UserRegisterController::delete');
    $routes->post('/admin/residents/default', 'UserRegisterController::defaultPassword');

    //Population Actions
    $routes->get( '/admin/population', 'Home::population');
    $routes->post('/admin/population', 'PopulationController::store');
    $routes->post('/admin/population/update', 'PopulationController::update');
    $routes->post('/admin/population/delete', 'PopulationController::delete');


    //Fire Case Inc/admin/ident Actions
    $routes->get('/admin/fire-list', 'Home::fire_list');
    $routes->post('/admin/fire-list', 'FireCaseController::store');
    $routes->post('/admin/fire-list/update', 'FireCaseController::update');
    $routes->post('/admin/fire-list/delete', 'FireCaseController::delete');

});

$routes->group('', ['filter' => 'role:resident'], function($routes){

    $routes->get('/resident', 'ResidentController::user');
});

$routes->get('/logout', 'LoginController::logout');    

$routes->get('/', 'LoginController::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
