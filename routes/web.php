<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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

Route::get('/', function () {
    return view('index');
});


// **HOME ** //
Route::get('/home', 'HomeController@index')->name('home');
// **END HOME ** //


// **ROTAS DE LOGIN ** //
Auth::routes();
// **END ROTAS DE LOGIN ** //


// **ROTAS ACESSADAS PELO ADMIN ** //
Route::group(['middleware' => ['auth','admin']], function(){
    // **DASHBOARD USUARIO ADMIN** //
    Route::get('painel-admin', function () {
        return view('admin/painelAdmin');
    });
    // **END DASHBOARD USUARIO ADMIN** //

    // **SHOW ADMIN USERS ** //
    Route::get('admin-usuarios', 'UserController@index')->name('admin-users');
    // **END ADMIN PRODUCTS ** //
    
    // **DELETE USER** //
    // ação de apagar usuario
    Route::delete('admin/usuario/destroy/{user}', 'UserController@destroyUserAdmin')->name('user-destroy-admin');
    // **END DELETE USER ** //

    // **SHOW USER ** //
    Route::get('admin/show/{user}', 'UserController@showUserAdmin')->name('show-user-admin');
    // **END USER ** //

    Route::get('admin/show/userbadrating', function () {
        return view('admin/usuario/verUsuarioAdminBadRating');
    });

    Route::get('admin/show/usergoodrating', function () {
        return view('admin/usuario/verUsuarioAdminGoodRating');
    });
});
// **END ROTAS ACESSADAS PELO ADMIN  ** //


// **ACCESS DENIED PAGE ** //
Route::get('access-denied', function () {
    return view('admin/acessoNegado');
});
// **END ACCESS DENIED PAGE ** //


// **ROTAS USUARIOS** //
Route::prefix('usuario')->group(function(){
    // **SHOW USER ** //
    Route::get('{user}', 'UserController@show')->name('user');
    // **END USER ** //

    // **UPDATE PRODUCT** //
    // formulario de editar produto
    Route::get('editarform/{user}', 'UserController@editUserForm')->name('user-edit-form')->middleware('auth');

    // ação de editar produto
    Route::put('editar/{user}', 'UserController@updateUser')->name('user-edit');
    // **END UPDATE PRODUCT ** //

    // **DELETE USER** //
    // ação de apagar usuario
    Route::delete('destroy/{user}', 'UserController@destroyUser')->name('user-destroy');
    // **END DELETE USER ** //
});
// **END ROTAS USUARIOS** //


// **SEARCHBAR PRODUCT ** //
// ação de buscar
Route::get('buscar-produto', 'ProductController@search')->name('search-products-results')->middleware('auth');

// mostrar resultados da busca
Route::get('resultado-busca-produto', function () {
    return view('produto/resultadoBuscaProduto');
});
// **END SEARCHBAR PRODUCT ** //

// **SEARCHBAR USER ** //
// ação de buscar
Route::get('buscar-usuario', 'UserController@banUser')->name('search-user-results')->middleware('auth');

Route::get('buscar-usuario-admin', 'UserController@searchUser')->name('search-user-admin-results')->middleware('auth');

// mostrar resultados da busca
Route::get('resultado-busca-usuario', function () {
    return view('admin/usuario/resultadoBuscaUsuario');
});
// **END SEARCHBAR USER ** //

// **FILTER BAD RATING ** //
// ação de buscar
Route::get('buscar-avaliacoes-ruins', 'UserRatingController@filterBadRatings')->name('search-badrating-results')->middleware('auth');

// mostrar resultados da busca
Route::get('resultado-avaliacoes-ruins', function () {
    return view('admin/usuario/resultadoBuscaAvaliacaoRuim');
});
// **END FILTER BAD RATING ** //

// mostrar resultados da busca e banir usuario
Route::get('resultado-busca-bane-usuario', function () {
    return view('usuario/resultadoBuscarBanirUsuario');
});
// **END SEARCHBAR USER ** //

// buscar usuarios
Route::get('resultado-busca-usuario-admin', function () {
    return view('admin/usuario/resultadoBuscaAdminUsuario');
});
// **END SEARCHBAR USER ** //


// ** ROTAS PRODUTOS** //
// **SHOW PRODUCT** //
// listar todos os produtos
Route::get('produtos-cadastrados', 'ProductController@showAllProducts')->name('all-products')->middleware('auth');

// listar todos os produtos do usuario
Route::get('meus-produtos', 'ProductController@index')->name('products');

// mostrar detalhes de um produto
Route::get('ver-produto/{product}', 'ProductController@showOneProduct')->name('product-show-details')->middleware('auth');
// **END SHOW PRODUCT ** //


// **CREATE PRODUCT** //
// formulario de criar novo produto
Route::get('produto/novo', 'ProductController@create')->name('product-new')->middleware('auth');

// ação de criar e armazenar novo produto
Route::post('produto/store', 'ProductController@store')->name('product-store');
// **END CREATE PRODUCT ** //


// **UPDATE PRODUCT** //
// formulario de editar produto
Route::get('produto/editarform/{product}', 'ProductController@editProductForm')->name('product-edit-form');

// ação de editar produto
Route::put('produto/edit/{product}', 'ProductController@update')->name('product-edit');
// **END UPDATE PRODUCT ** //


// **DELETE PRODUCT** //
// ação de apagar produto
Route::delete('product-destroy/{id}', 'ProductController@destroy')->name('product-destroy');
// **END DELETE PRODUCT ** //


// **DASHBOARD USUARIO COMUM** //
Route::get('painel-usuario', function () {
    return view('usuario/painelUsuario');
})->name('user-pannel');
// **END DASHBOARD USUARIO COMUM** //

// **AVALIAR USUÁRIO** //
// formulario de avaliar usuario 
Route::get('rate-user', 'UserRatingController@create')->name('rate-user')->middleware('auth');

// ação de avaliar usuario 
Route::post('rate-user/store', 'UserRatingController@store')->name('rate-user-store');
// **END AVALIAR USUÁRIO** //


// **VER AVALIAÇÃO DOS USUÁRIOS** //
Route::get('user-ratings', 'UserRatingController@index')->name('user-ratings');
// **END VER AVALIAÇÃO DOS USUÁRIOS** //