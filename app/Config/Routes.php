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
    $routes->post('/admin/requests/claim', 'RequestsController::claim');

    //Residents Actions
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


    //Fire Case Incident Actions
    $routes->get('/admin/fire-list', 'Home::fire_list');
    $routes->post('/admin/fire-list', 'FireCaseController::store');
    $routes->post('/admin/fire-list/update', 'FireCaseController::update');
    $routes->post('/admin/fire-list/delete', 'FireCaseController::delete');

    //View Reports
    $routes->get('/admin/view-reports', 'Home::viewReport');
    $routes->get('/admin/generate-reports', 'PdfMakerController::index');
    
    // Register ESP
    $routes->get('/admin/register', 'Home::viewRegister');
    $routes->get('/admin/update-system', '::viewRegister');

    //Send Alert in web
    // $routes->get('/admin/send-alert', 'RegisterESP::makeAlert');
    $routes->get('admin/check-fire-notifications', 'FireCaseController::checkFireNotifications');

});

$routes->group('', ['filter' => 'role:resident'], function($routes){

    $routes->get('/resident', 'ResidentController::user');
    $routes->get('/resident/profile', 'ResidentController::profile');
    $routes->post('/resident/profile/update', 'ResidentController::updateProfile');
    $routes->post('/resident/make-request', 'RequestsController::store');
    $routes->post('/resident/request/resubmit', 'RequestsController::reSubmit');
    $routes->post('/resident/request/cancel', 'RequestsController::cancel');
    $routes->post('/resident/update', 'RequestsController::update');
    $routes->get('/resident/check-notifications', 'ResidentController::checkNotifications');

});

$routes->get('/logout', 'LoginController::logout');    

$routes->get('/', 'LoginController::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->post('/signup', 'UserRegisterController::signup');


$routes->post('api/register', 'RegisterESP::registerESP');
$routes->post('api/make-alert', 'RegisterESP::makeAlert');
