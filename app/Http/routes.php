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

Route::get('cargaEventos{id?}',[
    'uses'  => 'CalendarController@vereventos',
    'as'    => 'admin.calendars'
    ]);

Route::get('calendar',[
    'uses'  => 'CalendarController@publico',
    'as'    => 'front.calendar'
    ]);

Route::get('article/{slug}',[
    'uses'  => 'FrontController@viewArticle',
    'as'    => 'front.view.article'
]);

Route::group(['prefix'=>'profesor','middleware'=>'profesor'], function(){
    Route::get('calendar',[
        'uses'  => 'CalendarController@profesor',
        'as'    => 'profesor.calendar'
    ]);

    Route::get('home',[
        'uses'   => 'ProfesorController@home',
        'as'    => 'profesor.home'
    ]);

    Route::get('ProfesorEventos',[
        'uses'  => 'CalendarController@ProfesorEventos',
        'as'    => 'profesor.ProfesorEventos'
    ]);

    Route::resource('tareas','TareaController');
    Route::get('tareas/{id}/destroy',[
        'uses'   => 'TareaController@destroy',
        'as'    => 'profesor.tareas.destroy'
    ]);
});

Route::group(['prefix'=>'student','middleware'=>'student'],function(){
    Route::get('calendar',[
        'uses'  => 'CalendarController@student',
        'as'    => 'student.calendar'
    ]);

    Route::get('home',[
        'uses'   => 'StudentController@home',
        'as'    => 'student.home'
    ]);

    Route::get('cargaEventos{id?}',[
        'uses'  => 'CalendarController@vereventos',
        'as'    => 'admin.calendars'
    ]);

    Route::get('StudentEventos',[
        'uses'  => 'CalendarController@StudentEventos',
        'as'    => 'admin.StudentEventos'
    ]);

    Route::get('article/{slug}',[
        'uses'  => 'FrontController@viewArticle',
        'as'    => 'front.view.article'
    ]);
});    

Route::group(['prefix'=>'admin', 'middleware' => 'auth'],function(){

    Route::get('/index',['as' => 'admin.index', function () {
        return view('admin.index');
    }]);

    Route::get('cargaEventos{id?}',[
        'uses'  => 'CalendarController@vereventosColegio',
        'as'    => 'admin.calendars'
    ]);

    Route::get('article/{slug}',[
        'uses'  => 'FrontController@viewArticle',
        'as'    => 'front.view.article'
    ]);

    Route::resource('students','StudentController');
    Route::get('students/{id}/destroy',[
        'uses'   => 'StudentController@destroy',
        'as'    => 'students.destroy'
    ]);

    Route::resource('profesors','ProfesorController');
    Route::get('profesors/{id}/destroy',[
        'uses'   => 'ProfesorController@destroy',
        'as'    => 'profesors.destroy'
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

// Rutas login Estudiantes
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


// Rutas login Profesores
Route::get('profesor/auth/login', [
    'uses'  =>  'Auth\ProfesorAuthController@getLogin',
    'as'    =>  'profesor.auth.login'
    ]);

Route::post('profesor/auth/login', [
    'uses'  =>  'Auth\ProfesorAuthController@postLogin',
    'as'    =>  'profesor.auth.login'
]);

Route::get('profesor/auth/logout', [
    'uses'  =>  'Auth\ProfesorAuthController@getLogout',
    'as'    =>  'profesor.auth.logout'
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


Route::get('profesor/auth/login', ['uses' => 'Auth\profesorAuthController@getLogin']);
Route::controller('/profesor/password', 'Auth\profesorPasswordController');
Route::controller('/profesor', 'Auth\profesorAuthController');