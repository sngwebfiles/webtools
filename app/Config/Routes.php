<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

use App\Controllers\Pages;

use App\Controllers\Importdata;

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
// $routes->set404Override();


$routes->set404Override(function () {

    $title = "Dashboard";
    $name = "Abel Tobiaso";
    $content = "Test Content of ".$title;

    $data['title'] = $title;
    $data['name'] = ucfirst($name);
    $data['content'] = $content;

    return view('templates/header', $data)
            . view('pages/404')
            . view('templates/bottom');

});

$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');


// $routes->get('login', 'user::login');
// $routes->get('user/register', 'User::index');
// $routes->get('pages/dashboard', 'User::dashboard', ['filter' => 'authGuard']);
// $routes->get('logout', 'user::logout');
//  $routes->get('user/loginAuth', 'user::loginAuth');

$routes->get('/', 'Home::index');
$routes->get('/index', 'Home::index');

//  $routes->get('/', 'Register::index', ['filter' => 'guestFilter']);
 $routes->get('/register', 'Register::index', ['filter' => 'guestFilter']);
 $routes->post('/register', 'Register::register', ['filter' => 'guestFilter']);
  
 $routes->get('login', 'Login::index', ['filter' => 'guestFilter']);  //not logged
 $routes->post('login', 'Login::authenticate', ['filter' => 'guestFilter']);  // checking req
  
 $routes->get('/logout', 'Login::logout', ['filter' => 'authFilter']);

 $routes->get('dashboard', 'Dashboard::index', ['filter' => 'authFilter']);
 $routes->get('doclist', 'Doclist::index', ['filter' => 'authFilter']);
 $routes->get('notes', 'Notes::index', ['filter' => 'authFilter']);
 $routes->get('scms', 'Scms::index', ['filter' => 'authFilter']);
 $routes->get('execscript', 'Execscript::index', ['filter' => 'authFilter']);
 $routes->get('monitor', 'Monitor::index', ['filter' => 'authFilter']);
 $routes->get('publications', 'Publications::index', ['filter' => 'authFilter']);

 $routes->get('write-wp-digital-editions', 'DigitalEditions::write', ['filter' => 'authFilter']);

 $routes->post('importdata/upload', 'Importdata::write', ['filter' => 'authFilter']);


$routes->get('importdata', 'Importdata::index', ['filter' => 'authFilter']);
$routes->get('/importdata/delete/(:any)', 'Importdata::delete/$1');
$routes->get('/importdata/truncate', 'Importdata::truncate');
$routes->get('/importdata/post', 'Importdata::wppoststory', ['filter' => 'authFilter']);
$routes->get('importdata/deleteempty', 'Importdata::deleteempty', ['filter' => 'authFilter']);

$routes->post('importdata/deletesel', 'Importdata::deleteselected', ['filter' => 'authFilter']);
$routes->post('importdata/addpostsel', 'Importdata::addpostselected', ['filter' => 'authFilter']);

//  $routes->match(['get', 'post'], 'importxmldata/upload', [Importdata::class, 'write'], ['filter' => 'authFilter']);

$routes->post('publications/savepub', 'Publications::savepub', ['filter' => 'authFilter']);

//  $routes->post('savepub', 'Publications::savepub');
//  $routes->match(['get', 'post'], 'publications/savepub', 'Publications::savepub');

 
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);



  // custom create routes 
  // $routes->get('/', 'User::index');

  


 


 // $routes->get('/blank', 'Home::blank');




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
