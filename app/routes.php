<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */


Route::get('msg/create', array("uses" => "SMSController@create")); //function() {
//    $i = Input::all();
//    $data = array();
//    foreach ($i as $k => $v) {
//        $data[$k] = $v;
//    }
//    $app = SystemApplication::whereRaw('api_key = ? ', array($data["api_key"]))->first();
//    $sub = new SMS;
//    $sub->application = $app->id;
//    $sub->sender = $data['from'];
//    $sub->recipient = $data['to'];
//    $sub->message = $data['message'];
//    $sub->created_at = date('Y-m-d H:i:s');
//    $sub->updated_by = $app->id;
//    $sub->save();
//
//    return $app->id;
//});
Route::resource('appusers','UserController');
Route::get('/', array('uses' => 'HomeController@showHome'))->before('auth');
Route::get('scheduler/sendmessage', array('uses' => 'SchedulerController@sendMessage'));
Route::get('login', array('uses' => 'HomeController@showLogin'))->before('guest');
Route::post('login', array('uses' => 'HomeController@doLogin'));
Route::get('logout', array('uses' => 'HomeController@doLogout'))->before('auth');

Route::resource('sms','SMSController');
//Route::get('sms', function() {
//    $cats = SMS::all();
//    return View::make('sms.index')
//                    ->with('sms', $cats);
//});
Route::get('appsms/{id}', array('uses' => 'SMSController@searchByApplication'));
Route::get('smsi/respond/{id}/{app}', array('uses' => 'SMSController@respond'));
Route::get('smsi/search', array('uses' => 'SMSController@search'));
Route::resource('apps','SystemApplicationController');
Route::get('app/create', array('uses' => 'SystemApplicationController@showCreate'));





Blade::extend(function($value) {
    return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
});

App::missing(function($exception) {
    return Response::make("Page not found", 404);
});
