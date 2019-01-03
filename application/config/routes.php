<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Pencairanpoin/(:any)/detail'] = 'Pencairanpoin/pencairanpoin_detail/$1';
$route['gallery/(:any)/detail'] = 'Gallery/gallery_detail/$1';

$route['produk/(:any)/detail'] = 'Kategori_produk/produk_detail/$1';

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
