<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\dashboard\EmailController;

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
    return view('redirect');
    // return redirect('/places');
});

Route::get('/places', function () {
    $visited = DB::select('select * from places where visited = ?', [1]); 
    $togo = DB::select('select * from places where visited = ?', [0]);
  
    return view('travel_list', ['visited' => $visited, 'togo' => $togo ] );
});

Route::get('/email', [EmailController::class, 'index']);