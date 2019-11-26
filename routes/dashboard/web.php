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
Route::group(
        [
 'prefix' => LaravelLocalization::setLocale(),
'middleware' => 
[ 
'localeSessionRedirect', 
'localizationRedirect', 
'localeViewPath' 
]]
, function()
{ 
  Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group( function ()
   {
  route::get('/index','dashboardcontroller@index')->name('index');
//users route
   route::resource('users','UserController')->except(['show']);
   
   //category routes
   route::resource('categories','CategoryController')->except(['show']);
      //products routes
      route::resource('products','productController')->except(['show']);
      //Client routes
      Route::resource('clients', 'ClientController')->except(['show']);

      
   });

});//end of dashboard routes
