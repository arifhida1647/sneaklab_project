<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index',['filter' => 'khususMember']);

$routes->get('/items', 'Items::index',['filter' => 'khususMember']);
$routes->post('item/simpan', 'Items::simpan',['filter' => 'khususMember']);
$routes->get('item/edit/(:num)', 'Items::edit/$1',['filter' => 'khususMember']);
$routes->get('item/hapus/(:num)', 'Items::hapus/$1',['filter' => 'khususMember']);

$routes->get('/users', 'Users::index',['filter' => 'khususMember']);
$routes->post('users/simpan', 'Users::simpan',['filter' => 'khususMember']);
$routes->get('users/edit/(:num)', 'Users::edit/$1',['filter' => 'khususMember']);
$routes->get('users/hapus/(:num)', 'Users::hapus/$1',['filter' => 'khususMember']);

$routes->get('/log', 'Log::index',['filter' => 'khususMember']);

$routes->get('/orders', 'Orders::index',['filter' => 'khususMember']);
$routes->post('orders/simpan', 'Orders::simpan',['filter' => 'khususMember']);
$routes->get('orders/edit/(:num)', 'Orders::edit/$1',['filter' => 'khususMember']);

$routes->get('/inbox', 'Inbox::index',['filter' => 'khususMember']);

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');
$routes->get('/logout', 'Logout::logout');


$routes->get('/admin', 'admin::index',['filter' => 'khususMember']);
$routes->post('admin/simpan', 'admin::simpan',['filter' => 'khususMember']);
$routes->get('admin/edit/(:num)', 'admin::edit/$1',['filter' => 'khususMember']);
$routes->get('admin/hapus/(:num)', 'admin::hapus/$1',['filter' => 'khususMember']);