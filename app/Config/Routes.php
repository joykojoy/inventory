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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'User\Login::index');
$routes->get('/tes', 'Tes::index');
// user
$routes->get('/user/login', 'User\Login::index');
$routes->post('/user/login/ceklogin', 'User\Login::ceklogin');
$routes->get('/user/login/logout', 'User\Login::logout');
$routes->get('/user/profile', 'User\Profile::index');
$routes->get('/user/rpassword', 'User\Rpassword::index');
$routes->post('/user/rpassword/updatepss', 'User\Rpassword::updatepss');
// admin manuser
$routes->get('/admin/manuser', 'Admin\Manuser::index');
$routes->get('/admin/manuser/nonaktifkan', 'Admin\Manuser::nonaktifkan');
$routes->get('/admin/manuser/aktifkan', 'Admin\Manuser::aktifkan');
$routes->get('/admin/manuser/edit', 'Admin\Manuser::edit');
$routes->post('/admin/manuser/update', 'Admin\Manuser::update');
$routes->get('/admin/manuser/tambah', 'Admin\Manuser::tambah');
$routes->post('/admin/manuser/simpan', 'Admin\Manuser::simpan');
$routes->get('/admin/manuser/fhapus', 'Admin\Manuser::fhapus');
$routes->post('/admin/manuser/delete', 'Admin\Manuser::delete');
// admin mansupplier
$routes->get('/admin/mansupplier', 'Admin\Mansupplier::index');
$routes->get('/admin/mansupplier/tambah', 'Admin\Mansupplier::tambah');
$routes->post('/admin/mansupplier/simpan', 'Admin\Mansupplier::simpan');
$routes->post('/admin/mansupplier/edit', 'Admin\Mansupplier::edit');
$routes->post('/admin/mansupplier/update', 'Admin\Mansupplier::update');
$routes->get('/admin/mansupplier/fhapus', 'Admin\Mansupplier::fhapus');
$routes->post('/admin/mansupplier/delete', 'Admin\Mansupplier::delete');
// admin manscustomer
$routes->get('/admin/mancustomer', 'Admin\Mancustomer::index');
$routes->get('/admin/mancustomer/tambah', 'Admin\Mancustomer::tambah');
$routes->post('/admin/mancustomer/simpan', 'Admin\Mancustomer::simpan');
$routes->post('/admin/mancustomer/edit', 'Admin\Mancustomer::edit');
$routes->post('/admin/mancustomer/update', 'Admin\Mancustomer::update');
$routes->get('/admin/mancustomer/fhapus', 'Admin\Mancustomer::fhapus');
$routes->post('/admin/mancustomer/delete', 'Admin\Mancustomer::delete');
// admin master barang
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('master_barang', 'Master_barang::index');
    $routes->post('master_barang/update', 'Master_barang::update');
    $routes->post('master_barang/tambah', 'Master_barang::tambah');
    $routes->post('master_barang/edit', 'Master_barang::edit');
    $routes->post('master_barang/simpan', 'Master_barang::simpan');
    $routes->post('master_barang/delete', 'Master_barang::delete');
    $routes->post('master_barang/aktifkan', 'Master_barang::aktifkan');
    $routes->post('master_barang/nonaktifkan', 'Master_barang::nonaktifkan');
    $routes->get('admin/barangkeluar/excel/(:any)/(:any)/(:any)', 'Admin\Barangkeluar::excel/$1/$2/$3');
    $routes->get('barangmasuk/excel/(:any)/(:any)/(:any)', 'Barangmasuk::excel/$1/$2/$3');
});
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->post('master_barang/fhapus', 'Admin\Master_barang::fhapus');
    $routes->post('master_barang/delete', 'Admin\Master_barang::delete');
});
$routes->get('/admin/master_barang/tambah', 'Admin\Master_barang::tambah');
$routes->get('/admin/master_barang/nonaktifkan', 'Admin\Master_barang::nonaktifkan');
$routes->get('/admin/master_barang/aktifkan', 'Admin\Master_barang::aktifkan');
$routes->get('/admin/master_barang/fhapus', 'Admin\Master_barang::fhapus');
$routes->post('/admin/master_barang/delete', 'Admin\Master_barang::delete');
// admin master satuan
$routes->get('/admin/master_satuan', 'Admin\Master_satuan::index');
$routes->get('/admin/master_satuan/tambah', 'Admin\Master_satuan::tambah');
$routes->post('/admin/master_satuan/simpan', 'Admin\Master_satuan::simpan');
$routes->post('/admin/master_satuan/edit', 'Admin\Master_satuan::edit');
$routes->post('/admin/master_satuan/update', 'Admin\Master_satuan::update');
$routes->get('/admin/master_satuan/nonaktifkan', 'Admin\Master_satuan::nonaktifkan');
$routes->get('/admin/master_satuan/aktifkan', 'Admin\Master_satuan::aktifkan');
$routes->get('/admin/master_satuan/fhapus', 'Admin\Master_satuan::fhapus');
$routes->post('/admin/master_satuan/delete', 'Admin\Master_satuan::delete');
// admin master group
$routes->get('/admin/mangroup', 'Admin\Mangroup::index');
$routes->get('/admin/mangroup/tambah', 'Admin\Mangroup::tambah');
$routes->post('/admin/mangroup/simpan', 'Admin\Mangroup::simpan');
$routes->post('/admin/mangroup/edit', 'Admin\Mangroup::edit');
$routes->post('/admin/mangroup/update', 'Admin\Mangroup::update');
$routes->get('/admin/mangroup/nonaktifkan', 'Admin\Mangroup::nonaktifkan');
$routes->get('/admin/mangroup/aktifkan', 'Admin\Mangroup::aktifkan');
$routes->get('/admin/mangroup/fhapus', 'Admin\Mangroup::fhapus');
$routes->post('/admin/mangroup/delete', 'Admin\Mangroup::delete');
// admin barang masuk
$routes->get('/admin/barangmasuk', 'Admin\Barangmasuk::index');
$routes->get('/admin/barangmasuk/tambah', 'Admin\Barangmasuk::tambah');
$routes->post('/admin/barangmasuk/datatemp', 'Admin\Barangmasuk::datatemp');
$routes->post('/admin/barangmasuk/detilbarang', 'Admin\Barangmasuk::detilbarang');
$routes->post('/admin/barangmasuk/simpan_detilbarang', 'Admin\Barangmasuk::simpan_detilbarang');
$routes->post('/admin/barangmasuk/load_temp', 'Admin\Barangmasuk::load_temp');
$routes->post('/admin/barangmasuk/delete_detilbarang', 'Admin\Barangmasuk::delete_detilbarang');
$routes->get('/admin/barangmasuk/cari_item', 'Admin\Barangmasuk::cari_item');
$routes->post('/admin/barangmasuk/simpan', 'Admin\Barangmasuk::simpan');
$routes->post('/admin/barangmasuk/detil_faktur', 'Admin\Barangmasuk::detil_faktur');
$routes->get('/admin/barangmasuk/fedit_faktur/(:any)', 'Admin\Barangmasuk::fedit_faktur/$1');
$routes->post('/admin/barangmasuk/databrgmasuk', 'Admin\Barangmasuk::databrgmasuk');
$routes->post('/admin/barangmasuk/delete_fedit_faktur', 'Admin\Barangmasuk::delete_fedit_faktur');
$routes->post('/admin/barangmasuk/simpan_fedit', 'Admin\Barangmasuk::simpan_fedit');
$routes->get('/admin/barangmasuk/cari_item_fedit', 'Admin\Barangmasuk::cari_item_fedit');
$routes->post('/admin/barangmasuk/return', 'Admin\Barangmasuk::return');
$routes->match(['get', 'post'], '/admin/barangmasuk/updateHarga', 'Admin\Barangmasuk::updateHarga');
$routes->post('/admin/barangmasuk/updateHarga', 'Admin\Barangmasuk::updateHarga');

// admin history routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('historystock', 'Historystock::index');
    $routes->post('historystock/his_brg/', 'Historystock::his_brg');
    $routes->get('historystock/his_brg_pdf/(:any)/(:any)', 'Historystock::his_brg_pdf/$1/$2');
    $routes->get('historystock/barangmasuk', 'Historystock::barangmasuk');
    $routes->get('historystock/barangkeluar', 'Historystock::barangkeluar');
    $routes->get('historystock/ready', 'Historystock::ready');
    $routes->get('historystock/listpdf', 'Historystock::listpdf');
    $routes->get('historystock/incomingpdf', 'Historystock::incomingpdf');
    $routes->get('admin/barangkeluar/excel/(:any)/(:any)/(:any)', 'Admin\Barangkeluar::excel/$1/$2/$3');
    $routes->get('historystock/excel/(:any)/(:any)', 'Historystock::excel/$1/$2');

    // Add these new routes
    $routes->get('historykeluar/excel', 'Barangkeluar::excel');
    $routes->get('historykeluar/excel/(:any)/(:any)', 'Barangkeluar::excel/$1/$2');
    $routes->get('historykeluar/excel/(:segment)/(:segment)/(:segment)', 'Barangkeluar::excel/$1/$2/$3');
    $routes->get('admin/barangkeluar/excel/(:any)/(:any)/(:any)', 'Admin\Barangkeluar::excel/$1/$2/$3');
});

// admin dashboard
$routes->get('/admin/dashboard', 'Admin\Dashboard::index');  // changed from Dashboard to dashboard

// admin barang keluar routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    // Barang Keluar Routes
    $routes->get('barangkeluar', 'Barangkeluar::index');
    $routes->get('barangkeluar/tambah', 'Barangkeluar::tambah');
    $routes->post('barangkeluar/datatemp', 'Barangkeluar::datatemp');
    $routes->post('barangkeluar/detilbarang', 'Barangkeluar::detilbarang');
    $routes->post('barangkeluar/simpan_detilbarang', 'Barangkeluar::simpan_detilbarang');
    $routes->post('barangkeluar/delete_detilbarang', 'Barangkeluar::delete_detilbarang');
    $routes->get('barangkeluar/cari_item', 'Barangkeluar::cari_item');
    $routes->post('barangkeluar/simpan', 'Barangkeluar::simpan');
    $routes->post('barangkeluar/detil_do', 'Barangkeluar::detil_do');
    $routes->get('barangkeluar/fedit_do/(:any)', 'Barangkeluar::fedit_do/$1');
    $routes->post('barangkeluar/dtemp_dofedit', 'Barangkeluar::dtemp_dofedit');
    $routes->post('barangkeluar/delete_fedit_do', 'Barangkeluar::delete_fedit_do');
    $routes->post('barangkeluar/simpan_fedit', 'Barangkeluar::simpan_fedit');
    $routes->get('barangkeluar/cari_item_fedit', 'Barangkeluar::cari_item_fedit');
    $routes->post('barangkeluar/return', 'Barangkeluar::return');
    $routes->post('barangkeluar/getHistory', 'Barangkeluar::getHistory');
    $routes->post('barangkeluar/getBarangNama', 'Barangkeluar::getBarangNama');
    $routes->get('barangkeluar/excel/(:any)/(:any)/(:any)', 'Barangkeluar::excel/$1/$2/$3');
    
});

// sales
$routes->get('/sales/pesanan', 'Sales\Pesanan::index');
$routes->group('pegawai', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    // Add stock report routes
    $routes->get('historystock', 'Historystock::index');
    $routes->get('historystock/barangmasuk', 'Historystock::barangmasuk');
    $routes->get('historystock/barangkeluar', 'Historystock::barangkeluar');
    $routes->get('historystock/ready', 'Historystock::ready');
    $routes->get('historystock/listpdf', 'Historystock::listpdf');
    $routes->post('historystock/his_brg', 'Historystock::his_brg');
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
