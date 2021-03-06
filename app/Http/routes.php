<?php
use App\User;
use App\Client;
use App\Network;
use App\Category;
use App\Packet;
use App\Ticket;

//use Auth;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/', function () {
//    return view('front.main');
//});



// front




















//Route::auth();

//Route::get('/home', 'HomeController@index');




 //auth
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);


Route::group(array('middleware' => array('auth'), 'prefix' => 'controll'), function() {


    Route::get('/dashboard', function () {
      $users     =User::count();//here we get  the users numbers
      $clients   =Client::count();
      $networks  =Network::count();
      $categorys =Category::count();
      $packets   =Packet::count();
      $ticket   =Ticket::count();

      
      //dd($clients);
        return view('dashboard',compact('users','clients','networks','categorys','packets','ticket'));
    });



    //dashboard
    Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('clients', 'ClientController');
    Route::resource('packets', 'PacketController');
    Route::get('my-ticket', 'TicketController@myTicket');
    Route::resource('tickets', 'TicketController');
    Route::resource('networks', 'NetworkController');

    Route::post('save-ticket', 'TicketController@saveTicket');
    Route::post('change-type', 'TicketController@changeType');
    Route::post('change-status', 'TicketController@changeStatus');
//  Route::post('change-status-supports', 'TicketController@changeStatusSupports');



//export excel sheet

    Route::get('importExport', 'MaatwebsiteDemoController@importExport');
    Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
    Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');










});
