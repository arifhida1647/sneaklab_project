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

$routes->get('/unit', 'Unit::index',['filter' => 'khususMember']);
$routes->post('unit/simpan', 'Unit::simpan',['filter' => 'khususMember']);
$routes->get('unit/edit/(:num)', 'Unit::edit/$1',['filter' => 'khususMember']);
$routes->get('unit/hapus/(:num)', 'Unit::hapus/$1',['filter' => 'khususMember']);


$routes->get('/kategori', 'Kategori::index',['filter' => 'khususMember']);
$routes->post('kategori/simpan', 'Kategori::simpan',['filter' => 'khususMember']);
$routes->get('kategori/edit/(:num)', 'Kategori::edit/$1',['filter' => 'khususMember']);
$routes->get('kategori/hapus/(:num)', 'Kategori::hapus/$1',['filter' => 'khususMember']);

$routes->get('/pelanggan', 'Pelanggan::index',['filter' => 'khususMember']);
$routes->post('pelanggan/simpan', 'Pelanggan::simpan',['filter' => 'khususMember']);
$routes->get('pelanggan/edit/(:num)', 'Pelanggan::edit/$1',['filter' => 'khususMember']);
$routes->get('pelanggan/hapus/(:num)', 'Pelanggan::hapus/$1',['filter' => 'khususMember']);

$routes->get('/stokin', 'Stokin::index',['filter' => 'khususMember']);
$routes->post('stokin/simpan', 'Stokin::simpan',['filter' => 'khususMember']);
$routes->get('stokin/edit/(:num)', 'Stokin::edit/$1',['filter' => 'khususMember']);
$routes->get('stokin/hapus/(:num)', 'Stokin::hapus/$1',['filter' => 'khususMember']);

$routes->get('/stokout', 'Stokout::index',['filter' => 'khususMember']);
$routes->post('stokout/simpan', 'Stokout::simpan',['filter' => 'khususMember']);
$routes->get('stokout/edit/(:num)', 'Stokout::edit/$1',['filter' => 'khususMember']);
$routes->get('stokout/hapus/(:num)', 'Stokout::hapus/$1',['filter' => 'khususMember']);

$routes->get('/keranjang', 'Keranjang::index',['filter' => 'khususMember']);
$routes->post('keranjang/simpan', 'Keranjang::simpan',['filter' => 'khususMember']);
$routes->get('keranjang/edit/(:num)', 'Keranjang::edit/$1',['filter' => 'khususMember']);
$routes->get('keranjang/hapus/(:num)', 'Keranjang::hapus/$1',['filter' => 'khususMember']);

$routes->get('/invoice', 'Invoice::index',['filter' => 'khususMember']);
$routes->get('/invoiceDetail/(:num)', 'Invoice::detail/$1',['filter' => 'khususMember']);
$routes->post('invoice/simpan', 'Invoice::simpan',['filter' => 'khususMember']);
$routes->post('invoice/generate', 'Invoice::generate',['filter' => 'khususMember']);
$routes->get('invoice/edit/(:num)', 'Invoice::edit/$1',['filter' => 'khususMember']);
$routes->get('invoice/hapus/(:num)', 'Invoice::hapus/$1',['filter' => 'khususMember']);

$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');
$routes->get('/logout', 'Logout::logout');


$routes->get('/admin', 'admin::index',['filter' => 'khususMember']);
$routes->post('admin/simpan', 'admin::simpan',['filter' => 'khususMember']);
$routes->get('admin/edit/(:num)', 'admin::edit/$1',['filter' => 'khususMember']);
$routes->get('admin/hapus/(:num)', 'admin::hapus/$1',['filter' => 'khususMember']);