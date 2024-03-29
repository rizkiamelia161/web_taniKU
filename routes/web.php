<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukPageController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login
Route::get('/login', function () {
    return view('pengguna.login');
})->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');

// regis
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register/post', [LoginController::class, 'register_action'])->name('register.action');

// logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// hak akses
Route::group(['middleware' => ['auth','ceklevel:admin']], function() {
    
    Route::get('/dashboard',[KategoriController::class, 'index']);
    
    route::get('/halamansatu','BerandaController@halamansatu')->name('halamansatu');
    
    // produk
    Route::get('/produkpage', [ProdukPageController::class, 'index'])->name('/produkpage');
    Route::get('/addproduk', [ProdukController::class, 'index'])->name('addproduk');
    Route::post('/post-produk', [ProdukController::class, 'store'])->name('post-produk');
    Route::get('/edit-produk/{id}', [ProdukController::class, 'edit'])->name('get.produk');
    Route::get('/delete/produk/{id}', [ProdukController::class, 'delete'])->name('delete.produk');
    
    // view transaksi
    Route::get('/viewtransaksi', [BerandaController::class, 'viewtrans'])->name('viewtrans');
    
    // kategori
    Route::get('/dashboard/kategori/addkategori', [KategoriController::class, 'create'])->name('addkategori');
    Route::post('/dashboard/kategori/addkategori/postkategori', [KategoriController::class, 'store'])->name('postkategori');
    Route::get('/dashboard/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('deletekategori');
    
    
    // admin dashboard
    Route::get('/dashboard/produk',[BerandaController::class, 'produk'])->name('produk');
    Route::get('/dashboard/kategori',[BerandaController::class, 'kategori'])->name('kategori');

    // user dashboard
    Route::get('/dashboard/user', [BerandaController::class, 'getuser'])->name('getuser');

});


Route::group(['middleware' => ['auth','ceklevel:user']], function() {

    route::get('/halamansatu','BerandaController@halamansatu')->name('halamansatu');

});

// authcontroller
// github

Route::get('/auth/github/redirect',[authcontroller::class,'githubredirect'])->name('githublogin');
Route::get('/auth/github/callback',[authcontroller::class,'githubcallback']);

// google
Route::get('/auth/google/redirect',[authcontroller::class,'googleredirect'])->name('googlelogin');
Route::get('/auth/google/callback',[authcontroller::class,'googlecallback']);

// home
Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/beranda', [BerandaController::class,'showberanda']);


//produk


// Route::put('/rubahproduk/{id}', [ProdukController::class, 'rubahproduk'])->name('rubah_produk');


Route::get('/Artikel-kategori/{slug}', [ProdukPageController::class, 'showKategori'])->name('artikel.kategori');
// Route::get('/Artikel-kategori/{kategori}', 'ProdukPageController@artikel_kategori')->name('artikel.kategori');

// detailproduk
// Route::get('/detail-produk/{id}', [ProdukPageController::class, 'detailproduk'])->name('detail-produk');
Route::middleware(['auth'])->group(function () {
Route::get('/detail-produk/{id}', [DetailController::class, 'detailproduk'])->name('detail.produk');
});


// cart
Route::middleware(['auth'])->group(function () {
    Route::post('add-to-cart', [CartController::class, 'addProduct']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'viewcart']);

    // pesanan
    Route::get('pesanan', [HomeController::class, 'viewcart'])->name('pesanan');
    Route::get('/pay/{id}', [HomeController::class, 'pay'])->name('pay');
    
    // pesanan page
    Route::get('/pesanan-page', [HomeController::class, 'viewpesanan']);
    Route::get('/detail-pesanan/{id}', [HomeController::class, 'detailpesanan'])->name('detail.pesanan');
});
Route::post('delete-cart-item', [CartController::class, 'deletecart']);
Route::post('update-cart', [CartController::class, 'updatecart']);


// profil
Route::get('profil', [HomeController::class, 'showprofil']);

// about
Route::get('about', [HomeController::class, 'showabout']);

// checkout
Route::middleware(['auth'])->group(function () {
Route::get('checkout', [CheckoutController::class, 'index']);
});

// action-checkout with midtrans
Route::post('/order',[OrderController::class, 'checkout'])->name('order');

// getprovince
Route::get('province', [CheckoutController::class, 'get_province'])->name('province');
Route::get('/kota/{id}', [CheckoutController::class, 'get_kota'])->name('kota');
Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',[CheckoutController::class, 'get_ongkir']);


// invoice
Route::get('/invoice/{id}', [OrderController::class, 'invoice']);
Route::get('/sendinvoice/{id}', [OrderController::class, 'sendinvoice']);


// Route::post('/update-produk/{id}', [ProdukController::class, 'update'])->name('update-produk');
Route::post('/update-produk/{id}', [ProdukController::class, 'update']);

// // pesanan
// Route::post('/midtrans-callback', [OrderController::class, 'callback']);


// kategori
// route::get('kategori','KategoriController@index')->name('kategori');

// Route::resource('kategori', KategoriController::class@index);

// Route::get('kategori', [KategoriController::class, 'kategori'])->name('kategori')->middleware('auth');


// Route::post('/postlogi',[Login])

// Route::get('/index', 'BerandaController@halamansatu')->name('halaman-satu');
// Route::get('/dashboard', 'BerandaController@halamandua')->name('halaman-dua');