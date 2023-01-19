<?php

namespace Config;

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
$routes->setDefaultController('Pages');
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

$routes->get('/admin-login', 'Pages::adminLogin');
$routes->get('/employee-login', 'Pages::employeeLogin');
$routes->get('/bdo-login', 'Pages::bdoLogin');
$routes->get('/non-bdo-login', 'Pages::nonBdoLogin');
$routes->get('/bdo-register', 'Pages::bdoRegister');
$routes->post('/bdo-register/add', 'Pages::registerBdo');
$routes->get('/non-bdo-register', 'Pages::nonBdoRegister');
$routes->post('/non-bdo-register/add', 'Pages::registerNonBdo');

$routes->get('/user-type','Pages::userType');
$routes->get('/client-type','Pages::clientType');
$routes->get('/forgot-password', 'Pages::fpass');
$routes->get('/forgot-password/sent', 'Pages::fpass_send');
$routes->get('/forgot-password/(:any)', 'Pages::change_pass_form/$1');
$routes->get('/forgot-password-client', 'Pages::fpass_client');
$routes->get('/forgot-password-client/sent', 'Pages::fpass_send_client');
$routes->get('/forgot-password-client/(:any)', 'Pages::change_pass_form_client/$1');
$routes->post('/reset-password/(:any)', 'Pages::change_pass/$1');

$routes->get('/appointment', 'AppointmentCrud::index',['filter' => 'authGuard']);
$routes->get('/admin-appointment', 'AppointmentCrud::adminAppointment',['filter' => 'authGuard']);
$routes->post('/appointment/set-Appointment', 'AppointmentCrud::setAppt',['filter' => 'authGuard']);
$routes->get('/appointment/create', 'AppointmentCrud::create',['filter' => 'authGuard']);
$routes->post('/appointment/add', 'AppointmentCrud::store',['filter' => 'authGuard']);
$routes->post('/admin-appointment/add-to-calendar', 'FullCalendar::insertAppt',['filter' => 'authGuard']);
$routes->get('/appointment/(:num)', 'AppointmentCrud::singleAppt/$1',['filter' => 'authGuard']);
$routes->post('/appointment/update', 'AppointmentCrud::update',['filter' => 'authGuard']);
$routes->get('appointment/delete/(:num)', 'AppointmentCrud::delete/$1',['filter' => 'authGuard']);
$routes->post('/appointment/reject', 'AppointmentCrud::rejectAppt',['filter' => 'authGuard']);
$routes->post('/appointment/view', 'AppointmentCrud::view',['filter' => 'authGuard']);
$routes->post('/appointment/check-date', 'AppointmentCrud::checkDate',['filter' => 'authGuard']);

$routes->get('/serv', 'ServCrud::index',['filter' => 'authGuard']);
$routes->get('serv/create/view', 'ServCrud::create',['filter' => 'authGuard']);
$routes->post('serv/add', 'ServCrud::store',['filter' => 'authGuard']);
$routes->get('serv/(:num)', 'ServCrud::singleServ/$1',['filter' => 'authGuard']);
$routes->post('serv/update', 'ServCrud::update',['filter' => 'authGuard']);
$routes->get('serv/print', 'ServCrud::printServ',['filter' => 'authGuard']);
$routes->get('serv/delete/(:num)', 'ServCrud::delete/$1',['filter' => 'authGuard']);

$routes->get('/emp', 'EmpCrud::index',['filter' => 'authGuard']);
$routes->get('emp/create/view', 'EmpCrud::create',['filter' => 'authGuard']);
$routes->post('emp/add', 'EmpCrud::store',['filter' => 'authGuard']);
$routes->get('emp/(:num)', 'EmpCrud::singleEmp/$1',['filter' => 'authGuard']);
$routes->post('emp/update', 'EmpCrud::update',['filter' => 'authGuard']);
$routes->get('emp/print', 'EmpCrud::printEmp',['filter' => 'authGuard']);
$routes->get('emp/delete/(:num)', 'EmpCrud::delete/$1',['filter' => 'authGuard']);

$routes->get('/client', 'ClientCrud::index',['filter' => 'authGuard']);
$routes->get('client-users', 'ClientCrud::userClient',['filter' => 'authGuard']);
$routes->get('client-users/(:num)/(:any)', 'ClientCrud::updateStatus/$1/$2',['filter' => 'authGuard']);
$routes->get('client/create/view', 'ClientCrud::create',['filter' => 'authGuard']);
$routes->post('client/add', 'ClientCrud::store',['filter' => 'authGuard']);
$routes->get('client/(:num)', 'ClientCrud::singleClient/$1',['filter' => 'authGuard']);
$routes->post('client/update', 'ClientCrud::update',['filter' => 'authGuard']);
$routes->get('client/print', 'ClientCrud::printClient',['filter' => 'authGuard']);
$routes->get('client/delete/(:num)', 'ClientCrud::delete/$1',['filter' => 'authGuard']);

$routes->get('/user', 'UsersCrud::index',['filter' => 'authGuard']);
$routes->get('/user/activate/(:num)/(:any)', 'UsersCrud::activate/$1/$2',['filter' => 'authGuard']);
$routes->get('user/create/view', 'UsersCrud::create',['filter' => 'authGuard']);
$routes->post('user/add', 'UsersCrud::store',['filter' => 'authGuard']);
$routes->get('user/(:num)', 'UsersCrud::singleUser/$1',['filter' => 'authGuard']);
$routes->post('user/update/(:num)', 'UsersCrud::update/$1',['filter' => 'authGuard']);
$routes->get('user/print', 'UsersCrud::printUser',['filter' => 'authGuard']);
$routes->get('user/delete/(:num)', 'UsersCrud::delete/$1',['filter' => 'authGuard']);

$routes->get('/calllogs', 'CalllogsCrud::index',['filter' => 'authGuard']);
$routes->get('/calllogs/filtered', 'CalllogsCrud::getfilter',['filter' => 'authGuard']);
$routes->get('/calllogs/filtered/print/(:any)/(:any)/(:any)/(:any)', 'CalllogsCrud::printpdf/$1/$2/$3/$4',['filter' => 'authGuard']);
$routes->post('/calllogs/set-Calllogs', 'CalllogsCrud::setLog',['filter' => 'authGuard']);

$routes->get('calllogs/create/view', 'CalllogsCrud::create',['filter' => 'authGuard']);
$routes->post('/calllogs/add', 'CalllogsCrud::store',['filter' => 'authGuard']);
$routes->post('/calllogs/add-to-calendar', 'FullCalendar::insertCal',['filter' => 'authGuard']);
$routes->post('/calllogs/set-to-calendar', 'FullCalendar::setCal',['filter' => 'authGuard']);
$routes->get('calllogs/(:num)', 'CalllogsCrud::singleCL/$1',['filter' => 'authGuard']);
$routes->post('calllogs/update', 'CalllogsCrud::update',['filter' => 'authGuard']);
$routes->post('/calllogs/cancel', 'CalllogsCrud::cancel',['filter' => 'authGuard']);
$routes->get('calllogs/delete/(:num)', 'CalllogsCrud::delete/$1',['filter' => 'authGuard']);
$routes->post('/calllogs/view', 'CalllogsCrud::view',['filter' => 'authGuard']);

$routes->get('/aircon', 'AirconCrud::index',['filter' => 'authGuard']);
$routes->get('/aircon/create/view', 'AirconCrud::create',['filter' => 'authGuard']);
$routes->post('aircon/add', 'AirconCrud::store',['filter' => 'authGuard']);
$routes->get('aircon/(:num)', 'AirconCrud::singleAircon/$1',['filter' => 'authGuard']);
$routes->post('aircon/update', 'AirconCrud::update',['filter' => 'authGuard']);
$routes->get('aircon/delete/(:num)', 'AirconCrud::delete/$1',['filter' => 'authGuard']);
$routes->get('aircon/brand/(:any)', 'AirconCrud::show_aircon/$1',['filter' => 'authGuard']);

$routes->get('/dashboard', 'Dashboard::dashboard',['filter' => 'authGuard']);
$routes->post('/dashboard/auto-done', 'Dashboard::autoDone',['filter' => 'authGuard']);
$routes->get('/client-dashboard', 'Dashboard::clientDashboard',['filter' => 'authGuard']);
$routes->get('/calendar', 'FullCalendar::index',['filter' => 'authGuard']);
$routes->get('/calendar/dates', 'FullCalendar::restrict_date',['filter' => 'authGuard']);
$routes->get('/calendar/dates-form', 'FullCalendar::restrict_form',['filter' => 'authGuard']);
$routes->post('/calendar/dates-add', 'FullCalendar::restrict_add',['filter' => 'authGuard']);
$routes->get('/calendar/dates-edit-form/(:num)', 'FullCalendar::restrict_form_edit/$1',['filter' => 'authGuard']);
$routes->post('/calendar/dates-edit/(:num)', 'FullCalendar::restrict_edit/$1',['filter' => 'authGuard']);
$routes->get('/calendar/dates-delete/(:num)', 'FullCalendar::restrict_delete/$1',['filter' => 'authGuard']);
$routes->post('/calendar/checkEmp', 'FullCalendar::checkEmp',['filter' => 'authGuard']);
$routes->get('/calendar/emp', 'FullCalendar::index1',['filter' => 'authGuard']);
$routes->get('/calendar/events', 'FullCalendar::event',['filter' => 'authGuard']);
$routes->post('/calendar/events/view', 'FullCalendar::view',['filter' => 'authGuard']);
$routes->post('/calendar/insert', 'FullCalendar::insert',['filter' => 'authGuard']);
$routes->get('/calendar/load', 'FullCalendar::load',['filter' => 'authGuard']);
$routes->post('/calendar/update', 'FullCalendar::update',['filter' => 'authGuard']);
$routes->get('calendar/count/(:any)', 'FullCalendar::countAircon/$1',['filter' => 'authGuard']);

$routes->get('/service-reports', 'ImageCrud::index',['filter' => 'authGuard']);
$routes->get('service-reports/upload', 'ImageCrud::create',['filter' => 'authGuard']);
$routes->post('service-reports/add', 'ImageCrud::store',['filter' => 'authGuard']);
$routes->get('/service-reports/edit/(:num)', 'ImageCrud::singleUpload/$1',['filter' => 'authGuard']);
$routes->post('service-reports/update/(:num)', 'ImageCrud::update/$1',['filter' => 'authGuard']);
$routes->get('service-reports/delete/(:num)', 'ImageCrud::delete/$1',['filter' => 'authGuard']);

$routes->get('/profile/(:num)', 'Dashboard::profile/$1',['filter' => 'authGuard']);
$routes->post('profile/update', 'Dashboard::update',['filter' => 'authGuard']);


$routes->get('/profile-bdo/(:num)', 'Dashboard::profileBdo/$1',['filter' => 'authGuard']);
$routes->post('profile-bdo/update', 'Dashboard::updateBdo',['filter' => 'authGuard']);
$routes->get('/forgot-password-bdo', 'Dashboard::fpass');


$routes->get('/logout', 'Dashboard::logout',['filter' => 'authGuard']);

$routes->get('/reports/accomplished', 'Reports::index',['filter' => 'authGuard']);
$routes->get('/reports/accomplished/filtered-daily', 'Reports::dailyAccomplish',['filter' => 'authGuard']);
$routes->get('/reports/accomplished/filtered-weekly', 'Reports::weeklyAccomplish',['filter' => 'authGuard']);
$routes->get('/reports/accomplished/filtered-monthly', 'Reports::monthlyAccomplish',['filter' => 'authGuard']);
$routes->get('/reports/accomplished/filtered-quarterly', 'Reports::quarterlyAccomplish',['filter' => 'authGuard']);
$routes->get('/reports/accomplished/filtered-yearly', 'Reports::yearlyAccomplish',['filter' => 'authGuard']);

$routes->get('/reports/exception', 'Reports::showException',['filter' => 'authGuard']);
$routes->get('/reports/exception/filtered-daily', 'Reports::dailyException',['filter' => 'authGuard']);
$routes->get('/reports/exception/filtered-weekly', 'Reports::weeklyException',['filter' => 'authGuard']);
$routes->get('/reports/exception/filtered-monthly', 'Reports::monthlyException',['filter' => 'authGuard']);
$routes->get('/reports/exception/filtered-quarterly', 'Reports::quarterlyException',['filter' => 'authGuard']);
$routes->get('/reports/exception/filtered-yearly', 'Reports::yearlyException',['filter' => 'authGuard']);

// $routes->get('/reports/exception/filtered', 'Reports::getException',['filter' => 'authGuard']);
// $routes->get('/reports/exception/filtered/print/(:any)/(:any)/(:any)/(:any)', 'Reports::printException/$1/$2/$3/$4',['filter' => 'authGuard']);


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
