<?php

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

Route::get('/',['as' => 'principal.index', function () {
        return view('principal.index');
}]);

Route::get('articles/{slug}',[
    'uses'  => 'FrontController@viewArticle',
    'as'    => 'front.view.article'
]);

    Route::get('cargaEventos{id?}',[
        'uses'  => 'CalendarController@vereventos',
        'as'    => 'admin.calendars'
        ]);

    Route::get('calendar',[
        'uses'  => 'CalendarController@publico',
        'as'    => 'front.calendar'
        ]);

    Route::get('students/home',[
        'uses'   => 'StudentController@home',
        'as'    => 'students.home'
    ]);
    

Route::group(['prefix'=>'admin', 'middleware' => 'auth'],function(){

    Route::get('/index',['as' => 'admin.index', function () {
        return view('admin.index');
    }]);

    Route::resource('students','StudentController');
    Route::get('students/{id}/destroy',[
        'uses'   => 'StudentController@destroy',
        'as'    => 'students.destroy'
    ]);

    Route::resource('calendars','CalendarController');

    Route::resource('users','UsersController');
    Route::get('users/{id}/destroy',[
        'uses'   => 'UsersController@destroy',
        'as'    => 'admin.users.destroy'
    ]);

    Route::resource('categories','CategoriesController');
    Route::get('categories/{id}/destroy',[
        'uses'  =>  'CategoriesController@destroy',
        'as'    =>  'admin.categories.destroy'
    ]);

    Route::resource('tags','TagsController');
    Route::get('tags/{id}/destroy',[
        'uses'   => 'TagsController@destroy',
        'as'    => 'admin.tags.destroy'
    ]);

    Route::resource('articles','ArticlesController');
    Route::get('articles/{id}/destroy',[
        'uses'   => 'ArticlesController@destroy',
        'as'    => 'admin.articles.destroy'
    ]);

    Route::post('guardaEventos', array('as'=> 'guardaEventos','uses'=>'CalendarController@create'));

});

Route::get('admin/auth/login', [
    'uses'  =>  'Auth\AuthController@getLogin',
    'as'    =>  'admin.auth.login'
    ]);

Route::post('admin/auth/login', [
    'uses'  =>  'Auth\AuthController@postLogin',
    'as'    =>  'admin.auth.login'
]);

Route::get('admin/auth/logout', [
    'uses'  =>  'Auth\AuthController@getLogout',
    'as'    =>  'admin.auth.logout'
]);


Route::get('student/auth/login', [
    'uses'  =>  'Auth\StudentAuthController@getLogin',
    'as'    =>  'student.auth.login'
    ]);

Route::post('student/auth/login', [
    'uses'  =>  'Auth\StudentAuthController@postLogin',
    'as'    =>  'student.auth.login'
]);

Route::get('student/auth/logout', [
    'uses'  =>  'Auth\StudentAuthController@getLogout',
    'as'    =>  'student.auth.logout'
]);

/*
*   Otras rutas
*/

Route::get('/home', ['uses' => 'UsersController@getHome']);
Route::controller('/user', 'Auth\AuthController');
Route::controller('/password', 'Auth\PasswordController');
 
 
Route::get('student/auth/login', ['uses' => 'Auth\StudentAuthController@getLogin']);
Route::controller('/student/password', 'Auth\StudentPasswordController');
Route::controller('/student', 'Auth\StudentAuthController');
