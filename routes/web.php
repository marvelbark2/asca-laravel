<?php
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

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

// Route::get('/map', function () {
//     return view('cities.map');
// });
// Route::get('/index', function () {
//     return view('cities.index');
// });
Route::get('acc', 'CitiesController@index')->name('auto-complete-city');
Route::get('acc/create', 'CitiesController@create')->name('auto-complete-city');

Route::get('report', 'CitiesController@pdf');
Route::get('report1', function () {
    return view('report');
});
Route::post('acc', 'CitiesController@store')->name('acc.store');
Route::get('/now', function () {
    return \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y');
});

// OAuth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirect');
Route::get('auth/{provider}/callback', 'Auth\AuthController@callback');

Auth::routes();
Route::view('/locked', 'auth.locked');

Route::get('login/locked', 'Auth\LoginController@locked')->middleware('auth')->name('login.locked');
Route::post('login/locked', 'Auth\LoginController@unlock')->name('login.unlock');

Route::middleware(['auth', 'auth.lock'])->group(function () {
    Route::get('/pending', function () {
    return view('pending');
    })->name('pending');
// YOUNES !! : Admin route + Authent
Route::group(["middleware" => "App\Http\Middleware\SuperAdmin"], function()
{
    Route::get('/admin/taches', 'TaskController@list')->name('list-tache');
    Route::put('/admin/tache/{tache}/mod', 'TaskController@updatig')->name('tache.updating');
    Route::resource('user', 'UserController');
    Route::get('/user/{id}/tache', 'UserController@tache');
    Route::get('/users/{id}/approuve', function ($id) {
       $appr = \App\User::find($id);
       $appr->type = 'user';
       $appr->save();
       return redirect('/user')->with('status', 'the user '.$appr->name.' Approved');
    })->name('user.approuve');

    Route::resource('tache', 'TaskController');
    Route::get('/deadline', 'TaskController@deadline')->name('deadline');
    Route::get('/admin/tache/{tache}/details', 'TaskController@admin_details')->name('tache.details.admin');
    Route::put('/tache/{tache}/reactiver', 'TaskController@reactiver')->name('tache.reactiver');
    Route::get('/admin/tache/{tache}/pdf', 'TaskController@pdf')->name('tache.pdf');

    //
});
Route::group(['middleware' => 'user.pend'], function () {

// YOUNES !! : Authent (Ordinary users)
    Route::resource('tache', 'TaskController')->except(['create' ,'edit', 'destroy', 'store']);
    Route::get('/mes-taches', 'TaskController@mes')->name('mes-tache');
    Route::get('/tache/{tache}/details', 'TaskController@details')->name('tache.details');
    Route::post('/tache/{tache}/details', 'TaskController@details_update')->name('tache.details');
    Route::put('/tache/{tache}/completed', 'TaskController@completed')->name('tache.completed');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});
});
