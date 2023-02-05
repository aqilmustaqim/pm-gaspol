<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
//$routes->resource('usersapi');

//Routes API
//1.Routes Show Member
$routes->get('usersapi', 'UsersApi::index', ['filter' => 'auth']); //Filter Routersnya
//2. Routes Show Approve Member
$routes->get('userapprove', 'UsersApi::userApprove', ['filter' => 'auth']); //Filter Routersnya
//3. Routes Approve Member
$routes->post('approve/(:segment)', 'UsersApi::approve/$1', ['filter' => 'auth']);
//4. Routes Show Member By ID
$routes->get('usersapi/(:segment)', 'UsersApi::show/$1', ['filter' => 'auth']);
//5. Routes Register Member
$routes->post('register', 'UsersApi::register');
//6. Routes Login Member
$routes->post('login', 'AuthApi::login');
//7. Routes Create Team
$routes->post('createTeam', 'UsersApi::createTeam', ['filter' => 'auth']);
//8. Routes Show Team
$routes->get('listTeam', 'UsersApi::listTeam', ['filter' => 'auth']);
//9. Delete Team
$routes->delete('deleteTeam/(:segment)', 'UsersApi::deleteTeam/$1', ['filter' => 'auth']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// Api Register ( andorid bisa register melaui api yagn dibuat dari backend) - Selesai
// Api Show Approve
// Api Approve ( Aktivasi ) -> belum dibuat apinya
// Api Login
// Api ShowRoom Member
// Api ShowRoom Member By Id
// Api Create Team
// Api Show Team
