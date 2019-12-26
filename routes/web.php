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

Route::get('/', function() {
    return view('welcome');
})->name('home');

Route::get('/employee/{id}',function ($id) {
    return view('employee-page',[
        'employee' => $id
    ]);
})->name('detail-employee');

Route::get('/employees/create','EmployeeController@create');

Route::get('/add-visit','VisitController@addVisit');

Route::prefix('api')->group(function() {
    Route::resource('employees','EmployeeController');
});
