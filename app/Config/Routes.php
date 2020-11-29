<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('/blog', 'Pages::blog');
$routes->get('/productsAndServices', 'Pages::productsAndServices');
$routes->get('/ourMainValue', 'Pages::ourMainValue');
$routes->get('/contact', 'Pages::contact');
$routes->post('/contact','Pages::send');
$routes->get('/detail', 'Pages::detail');
$routes->get('/blog/all', 'Pages::list');
$routes->get('/blog/detail', 'Pages::articleDetail');
$routes->get('/academy','Pages::academy');
$routes->get('/academy/list','Pages::academy_list');
$routes->get('/academy/detail','Pages::academy_detail');
$routes->post('/academy/detail','Pages::academy_daftar_send');
$routes->get('/academy/checkout','Pages::checkout');
$routes->post('/academy/checkout','Pages::checkout');
$routes->get('/regis', 'Pages::regis');
$routes->post('/regis', 'Pages::sendRegis');
$routes->get('/verifyAccount', 'Pages::verifyAccount');
$routes->post('/verifyAccount', 'Pages::sendVerifyAccount');
$routes->get('/login', 'Pages::login');
$routes->post('/login', 'Pages::sendLogin');
$routes->get('/passwordReset', 'Pages::confirmResetPassword');
$routes->post('/passwordReset', 'Pages::sendConfirmResetPassword');
$routes->post('/lupaPass', 'Pages::lupaPass');
$routes->get('/logout', 'Pages::logout');

$routes->get('/coba', 'Pages::coba');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
