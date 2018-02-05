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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','adminController@index');
Route::get('/logout', 'adminController@getLogout');

//User
Route::get('/user','userController@index');
Route::get('/userResp','userController@userResp');
Route::get('/user/create','userController@create');
Route::get('/user/edit/id={id}','userController@edit');
Route::get('/user/deactivate/id={id}','userController@destroy');
Route::get('/user/soft','userController@soft');
Route::get('/user/reactivate/id={id}','userController@reactivate');

Route::post('/user/post','userController@store');
Route::post('/user/update/id={id}','userController@update');

//category
Route::get('/category','categoryController@index');
Route::get('/categoryResp','categoryController@categoryResp');
Route::get('/category/create','categoryController@create');
Route::get('/category/edit/id={id}','categoryController@edit');
Route::get('/category/deactivate/id={id}','categoryController@destroy');
Route::get('/category/soft','categoryController@soft');
Route::get('/category/reactivate/id={id}','categoryController@reactivate');

Route::post('/category/post','categoryController@store');
Route::post('/category/update/id={id}','categoryController@update');

//post
Route::get('/post','postController@index');
Route::get('/postResp/{id}','postController@postResp');
Route::get('/postGenre/{id}','postController@postGenre');
Route::get('/postTuts','postController@postTuts');
Route::get('/postFaqs','postController@faqs');
Route::get('/post/create','postController@create');
Route::get('/post/edit/id={id}','postController@edit');
Route::get('/post/deactivate/id={id}','postController@destroy');
Route::get('/post/soft','postController@soft');
Route::get('/post/reactivate/id={id}','postController@reactivate');

Route::post('/post/post','postController@store');
Route::post('/post/update/id={id}','postController@update');

//FAQ's
Route::get('/faqs','faqsController@index');
Route::get('/faqsResp','faqsController@faqsResp');
Route::get('/faqs/create','faqsController@create');
Route::get('/faqs/edit/id={id}','faqsController@edit');
Route::get('/faqs/deactivate/id={id}','faqsController@destroy');
Route::get('/faqs/soft','faqsController@soft');
Route::get('/faqs/reactivate/id={id}','faqsController@reactivate');

Route::post('/faqs/post','faqsController@store');
Route::post('/faqs/update/id={id}','faqsController@update');

//Tuts
Route::get('/Tutorials','TutorialController@index');
Route::get('/Tutorials','TutorialController@faqsResp');
Route::get('/Tutorials/create','TutorialController@create');
Route::get('/Tutorials/edit/id={id}','TutorialController@edit');
Route::get('/Tutorials/deactivate/id={id}','TutorialController@destroy');
Route::get('/Tutorials/soft','TutorialController@soft');
Route::get('/Tutorials/reactivate/id={id}','TutorialController@reactivate');

Route::post('/Tutorials/post','TutorialController@store');
Route::post('/Tutorials/update/id={id}','TutorialController@update');