<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// AUTH
$route['login'] = 'auth';
$route['registrasi'] = 'auth/registrasi';
$route['logout'] = 'auth/logout';

// DASHBOARD
$route['dashboard'] = 'admin/dashboard';

// BARANG
$route['barang'] = 'admin/barang';
$route['tambah_barang'] = 'admin/tambah_barang';
$route['edit_barang/(:any)'] = 'admin/edit_barang/$1';
$route['hapus_barang/(:any)'] = 'admin/hapus_barang/$1';

// BARANG MASUK
$route['barang_masuk'] = 'admin/barang_masuk';
$route['hitung_barang_masuk'] = 'admin/hitung_barang_masuk';
$route['tambah_barang_masuk'] = 'admin/tambah_barang_masuk';
$route['edit_barang_masuk/(:any)'] = 'admin/edit_barang_masuk/$1';
$route['hapus_barang_masuk/(:any)'] = 'admin/hapus_barang_masuk/$1';

// BARANG KELUAR
$route['barang_keluar'] = 'admin/barang_keluar';
$route['tambah_barang_keluar'] = 'admin/tambah_barang_keluar';
$route['edit_barang_keluar/(:any)'] = 'admin/edit_barang_keluar/$1';
$route['hapus_barang_keluar/(:any)'] = 'admin/hapus_barang_keluar/$1';

// PENJUALAN
$route['penjualan'] = 'admin/penjualan';
$route['tambah_penjualan'] = 'admin/tambah_penjualan';
$route['tambah_penjualan_baru'] = 'admin/tambah_penjualan_baru';
$route['edit_penjualan/(:any)'] = 'admin/edit_penjualan/$1';
$route['edit_penjualan_baru/(:any)'] = 'admin/edit_penjualan_baru/$1';
$route['detail_penjualan/(:any)'] = 'admin/detail_penjualan/$1';
$route['hapus_penjualan/(:any)'] = 'admin/hapus_penjualan/$1';

// LAPORAN BARANG MASUK
$route['laporan_barang_masuk'] = 'admin/laporan_barang_masuk';
$route['laporan_barang_masuk_pdf'] = 'admin/laporan_barang_masuk_pdf';
$route['laporan_barang_masuk_excel'] = 'admin/laporan_barang_masuk_excel';

// LAPORAN BARANG KELUAR
$route['laporan_barang_keluar'] = 'admin/laporan_barang_keluar';
$route['laporan_barang_keluar_pdf'] = 'admin/laporan_barang_keluar_pdf';
$route['laporan_barang_keluar_excel'] = 'admin/laporan_barang_keluar_excel';

// LAPORAN PENJUALAN
$route['laporan_penjualan'] = 'admin/laporan_penjualan';
$route['laporan_penjualan_pdf'] = 'admin/laporan_penjualan_pdf';
$route['laporan_penjualan_excel'] = 'admin/laporan_penjualan_excel';

// PROFILE
$route['profile'] = 'admin/profile';
$route['edit_profile/(:any)'] = 'admin/edit_profile/$1';
