<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','BiElementController@index');

// Api For Data BiElement
Route::post('/api/bielement/all','BiElementController@all');
Route::post('/api/bielement/detail','BiElementController@detail');
Route::post('/api/bielement/search','BiElementController@search');

// Api For Data Knowage
Route::post('/api/knowage/all','BiKnowageController@all');
Route::post('/api/knowage/detail','BiKnowageController@detail');
Route::post('/api/knowage/search','BiKnowageController@search');

// Api For Engine
Route::get('api/engines','BiEngineController@all');
Route::get('api/engine/{eng_id}','BiEngineController@engine');

// Member Controller
Route::post('api/member/login','BiMemberController@member_login');
Route::post('api/member/collect','BiMemberController@collect');
Route::get('api/member/member_collection','BiMemberController@member_collection');
Route::post('api/member/register','BiMemberController@member_register');
Route::get('api/member/check_session','BiMemberController@check_session');
Route::get('api/member/logout','BiMemberController@member_logout');

// ================== Admin Route
Route::get('admin/login','BiAdminController@login');
Route::get('admin/logout','BiAdminController@logout');
Route::post('admin/login','BiAdminController@login_submit');
Route::get('admin/dashboard','BiAdminController@dashboard');

// ================== Admin Bielement Route
Route::get('admin/bielements','BiAdminElementsController@all');
Route::get('admin/bielement/add','BiAdminElementsController@add_form');
Route::post('admin/bielement/add','BiAdminElementsController@submit_add_form');
Route::get('admin/bielement/update/{id}','BiAdminElementsController@edit');
Route::post('admin/bielement/update/{id}','BiAdminElementsController@update');
Route::get('admin/bielement/delete/{id}','BiAdminElementsController@delete');

// ================== Admin Knowage Route
Route::get('admin/knowage','BiAdminKnowageController@index');
Route::get('admin/knowage/add','BiAdminKnowageController@create');
Route::post('admin/knowage/add','BiAdminKnowageController@store');
Route::get('admin/knowage/update/{id}','BiAdminKnowageController@edit');
Route::post('admin/knowage/update/{id}','BiAdminKnowageController@update');
Route::get('admin/knowage/delete/{id}','BiAdminKnowageController@destroy');

// ================== Admin Engine Route
Route::get('admin/engines','BiAdminEnginesController@index');
Route::get('admin/engine/add','BiAdminEnginesController@create');
Route::post('admin/engine/add','BiAdminEnginesController@store');
Route::get('admin/engine/update/{id}','BiAdminEnginesController@edit');
Route::post('admin/engine/update/{id}','BiAdminEnginesController@update');
Route::get('admin/engine/delete/{id}','BiAdminEnginesController@destroy');

// ================== Admin Member Route
Route::get('admin/members','BiAdminMembersController@index');
Route::get('admin/member/delete/{id}','BiAdminMembersController@delete');
