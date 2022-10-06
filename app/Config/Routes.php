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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// $routes->get('api/program/(:any)', 'Api\Api_opd_program::program/$1');

$routes->group("api", function ($routes) {
    $routes->post("register", "Api\User\Register::index");
    $routes->post("login", "Api\User\Login::index");
    $routes->get("users", "Api\User\User::index", ['filter' => 'Api_filter']);

    // $routes->get("program/(:any)", "Api\Renstra\Api_opd_program::program/$1", ['filter' => 'Api_filter']);
    $routes->get("renstra/program/(:any)/(:any)", "Api\Renstra\Api_opd_program::program/$1/$2", ['filter' => 'Api_filter']);
    $routes->get("renstra/tujuan/(:any)/(:any)", "Api\Renstra\Api_opd_tujuan::tujuan/$1/$2", ['filter' => 'Api_filter']);

    $routes->get("rpjmd/visi", "Api\Rpjmd\Api_visi::visi", ['filter' => 'Api_filter']);
    $routes->get("rpjmd/tujuan", "Api\Rpjmd\Api_tujuan::tujuan", ['filter' => 'Api_filter']);
    $routes->get("rpjmd/sasaran", "Api\Rpjmd\Api_sasaran::sasaran", ['filter' => 'Api_filter']);
    $routes->get("rpjmd/strategi", "Api\Rpjmd\Api_strategi::strategi", ['filter' => 'Api_filter']);
    $routes->get("rpjmd/arah-kebijakan", "Api\Rpjmd\Api_arah_kebijakan::arah_kebijakan", ['filter' => 'Api_filter']);
});

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
