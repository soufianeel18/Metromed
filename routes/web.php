<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'Controller@index');

Route::get('/home', 'Controller@index');

Route::get('/home-stock', 'Controller@indexStock');

Route::get('/home-tech', 'Controller@indexTech');

Route::get('/home-comm', 'Controller@indexComm');

Route::get('/home-guest', 'Controller@indexGuest');

Route::get('/user', 'UserController@index');

Route::get('/user/create', 'UserController@create');

Route::post('/user', 'UserController@store');

Route::get('/user/{user}/history', 'UserController@history');

Route::get('/user/{user}/edit', 'UserController@edit');

Route::get('/user/{user}/password/edit', 'UserController@editPassword');

Route::get('/user/{user}/role/edit', 'UserController@editRole');

Route::patch('/user/{user}', 'UserController@update');

Route::patch('/user/{user}/password', 'UserController@updatePassword');

Route::patch('/user/{user}/role', 'UserController@updateRole');

Route::delete('/user/{user}', 'UserController@destroy');

Route::get('/commercial/{user}', 'CommercialController@show');

Route::get('/technicien/{user}', 'TechnicienController@show');

Route::get('/ticket', 'TicketController@index');

Route::post('/ticket/search', 'TicketController@search');

Route::get('/ticket-tech/{ticket}', 'TicketTechController@show');

Route::get('/ticket-admin/{ticket}', 'TicketAdminController@show');

Route::get('/ticket-comm/{ticket}', 'TicketCommController@show');

Route::get('/ticket-tech/{ticket}/history', 'TicketTechController@history');

Route::get('/ticket-admin/{ticket}/history', 'TicketAdminController@history');

Route::get('/ticket-comm/{ticket}/history', 'TicketCommController@history');

Route::get('/technicien/{user}/equipement/{equipement}/ticket-tech/create', 'TicketTechController@create');

Route::get('/commercial/{user}/client/{client}/ticket-comm/create', 'TicketCommController@create');

Route::post('/ticket-tech/{user}/{equipement}', 'TicketTechController@store');

Route::post('/ticket-admin/{user}', 'TicketAdminController@store');

Route::post('/ticket-comm/{user}/{client}', 'TicketCommController@store');

Route::patch('/ticket-tech/{ticket}', 'TicketTechController@update');

Route::patch('/ticket-tech/status/{ticket}', 'TicketTechController@updateStatus');

Route::patch('/ticket-tech/ressource/{ticket}', 'TicketTechController@updateRessource');

Route::patch('/ticket-admin/{ticket}', 'TicketAdminController@update');

Route::patch('/ticket-admin/status/{ticket}', 'TicketAdminController@updateStatus');

Route::patch('/ticket-admin/ressource/{ticket}', 'TicketAdminController@updateRessource');

Route::patch('/ticket-comm/{ticket}', 'TicketCommController@update');

Route::patch('/ticket-comm/status/{ticket}', 'TicketCommController@updateStatus');

Route::patch('/ticket-comm/ressource/{ticket}', 'TicketCommController@updateRessource');

Route::delete('/ticket-tech/{ticket}', 'TicketTechController@destroy');

Route::delete('/ticket-admin/{ticket}', 'TicketAdminController@destroy');

Route::delete('/ticket-comm/{ticket}', 'TicketCommController@destroy');

Route::post('/comment/{ticket}', 'CommentController@store');

Route::patch('/comment/{comment}', 'CommentController@update');

Route::get('/market', 'MarketController@index');

Route::get('/market/create', 'MarketController@create');

Route::post('/market', 'MarketController@store');

Route::get('/market/{market}/edit', 'MarketController@edit');

Route::get('/market/{market}', 'MarketController@show');

Route::patch('/market/{market}', 'MarketController@update');

Route::delete('/market/{market}', 'MarketController@destroy');

Route::get('/client-bon-de-commande', 'ClientController@index');

Route::get('/client-bon-de-commande/create', 'ClientController@create');

Route::post('/client-bon-de-commande', 'ClientController@store');

Route::get('/market/{market}/client/create', 'ClientController@create');

Route::post('/client/{market}', 'ClientController@store');

Route::get('/client/{client}/edit', 'ClientController@edit');

Route::get('/client/{client}/edit', 'ClientController@edit');

Route::get('/client/{client}', 'ClientController@show');

Route::patch('/client/{client}', 'ClientController@update');

Route::delete('/client/{client}', 'ClientController@destroy');

Route::get('/client/{client}/equipement/create', 'EquipementController@create');

Route::post('/equipement/{client}', 'EquipementController@store');

Route::get('/equipement/{equipement}/edit', 'EquipementController@edit');

Route::get('/equipement/{equipement}', 'EquipementController@show');

Route::patch('/equipement/{equipement}', 'EquipementController@update');

Route::delete('/equipement/{equipement}', 'EquipementController@destroy');

Route::get('/stock', 'EquipementStockController@index');

Route::get('/equipement-stock/create', 'EquipementStockController@create');

Route::post('/equipement-stock', 'EquipementStockController@store');

Route::get('/equipement-stock/{equipement_stock}/history', 'EquipementStockController@history');

Route::get('/equipement-stock/{equipement_stock}/edit', 'EquipementStockController@edit');

Route::patch('/equipement-stock/{equipement_stock}', 'EquipementStockController@update');

Route::delete('/equipement-stock/{equipement_stock}', 'EquipementStockController@destroy');

Route::get('/equipement-stock/{equipement_stock}/piece/create', 'PieceController@create');

Route::get('/equipement-stock/{equipement_stock}/piece/choose', 'PieceController@choose');

Route::post('/piece/{equipement_stock}', 'PieceController@store');

Route::post('/piece/{equipement_stock}/link', 'PieceController@link');

Route::get('/piece/{piece}/history', 'PieceController@history');

Route::get('/piece/{piece}/edit', 'PieceController@edit');

Route::get('/equipement-stock/{equipement_stock}/piece/{piece}/edit', 'PieceController@editQuantity');

Route::patch('/piece/{piece}', 'PieceController@update');

Route::patch('/equipement-stock/{equipement_stock}/piece/{piece}', 'PieceController@updateQuantity');

Route::delete('/piece/{piece}', 'PieceController@destroy');

Route::delete('/equipement-stock/{equipement_stock}/piece/{piece}', 'PieceController@unlink');

Route::get('/bon', 'BonController@index');

Route::post('/bon/search', 'BonController@search');

Route::get('/bon-sortie/create', 'BonSortieController@create');

Route::post('/bon-sortie', 'BonSortieController@store');

Route::get('/bon-sortie/{bon}', 'BonSortieController@show');

Route::get('/bon-sortie/{bon}/history', 'BonSortieController@history');

Route::patch('/bon-sortie/{bon}', 'BonSortieController@update');

Route::delete('/bon-sortie/{bon}', 'BonSortieController@destroy');

Route::get('/bon-entree/create', 'BonEntreeController@create');

Route::post('/bon-entree', 'BonEntreeController@store');

Route::get('/bon-entree/{bon}', 'BonEntreeController@show');

Route::get('/bon-entree/{bon}/history', 'BonEntreeController@history');

Route::patch('/bon-entree/{bon}', 'BonEntreeController@update');

Route::delete('/bon-entree/{bon}', 'BonEntreeController@destroy');

Route::get('/bon-livraison/pdf', 'BonController@printPDF');