<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('dashboard',['filter' => 'login'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('/tree', 'Dashboard::tree');
    $routes->get('/get_data/(:any)', 'Dashboard::get_data/$1');
    $routes->get('/section/(:num)', 'Dashboard::section/$1');
});
$routes->group('users',['filter' => 'permission:user'], function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->post('user', 'Users::create');
    $routes->get('get_all', 'Users::get_all');
    $routes->get('user/(:num)', 'Users::show/$1');
    $routes->put('user/(:num)', 'Users::update/$1');
    $routes->delete('user/(:num)', 'Users::delete/$1');
});
$routes->group('roles',['filter' => 'permission:roles'], function ($routes) {
    $routes->get('/', 'Roles::index');
    $routes->post('role', 'Roles::create');
    $routes->get('get_all', 'Roles::get_all');
    $routes->get('role/(:num)', 'Roles::show/$1');
    $routes->put('role/(:num)', 'Roles::update/$1');
    $routes->delete('role/(:num)', 'Roles::delete/$1');
    $routes->post('permission', 'Roles::createpermission');
    $routes->get('get_all_permissions', 'Roles::get_all_permissions');
    $routes->get('permission/(:num)', 'Roles::showpermission/$1');
    $routes->put('permission/(:num)', 'Roles::updatepermission/$1');
    $routes->delete('permission/(:num)', 'Roles::deletepermission/$1');
    $routes->post('rolepermission', 'Roles::createrolepermission');
    $routes->get('get_all_rolepermissions', 'Roles::get_all_rolepermissions');
    $routes->get('rolepermission/(:num)', 'Roles::showrolepermission/$1');
    $routes->put('rolepermission/(:num)', 'Roles::updaterolepermission/$1');
    $routes->delete('rolepermission/(:num)/(:num)', 'Roles::deleteRolePermission/$1/$2');
});

$routes->get('/', 'Admin::index', ['filter' => 'permission:user']);


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
