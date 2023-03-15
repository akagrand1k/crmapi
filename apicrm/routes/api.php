<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return [
        'app' => config('app.name'),
        'version' => '0.0.1',
    ];
});

Route::group(['middleware' => 'guest:api'], function ()
{
    Route::post('/auth/sign-in', 'cAuth@signIn');
    //Route::post('/auth/sign-up', 'cSign@up');
    //Route::post('/auth/sign-up', 'cSignTest@owner');

    Route::get('/test3',    'TestController@test3');
    Route::get('/maksdebug',    'cMaksDebug@test');
    Route::post('/maksdebug',    'cMaksDebug@test');
    Route::get('/exportdb', 'TestController@exportdb');

});

Route::group(['middleware' => 'auth:api'], function ()
{
    Route::post('/auth/sign-init', 'cAuth@initByTokens');
    //Route::post('/logo/user', 'LogoController@user');

    Route::post('/users/fake', 'cSign@fake');
    Route::post('/users/create', 'cSign@up');
    Route::post('/users', 'cUserSearch@getList');

    Route::post('/filials', 'cFilial@getList');
    Route::post('/filials/create', 'cFilial@create');
    Route::post('/filials/delete', 'cFilial@delete');
    Route::post('/filials/patch', 'cFilial@patch');

    Route::post('/places/create', 'cPlace@create');
    Route::post('/places/delete', 'cPlace@delete');
    Route::post('/places/patch', 'cPlace@patch');

    Route::post('/roles', 'cRole@getList');

    Route::post('/perms', 'cPerm@getList');
    Route::post('/perms/sync', 'cPerm@sync');

    //Route::post('/apps', 'cApps@installed');
    Route::post('/apps/menu', 'cApps@menu');

    Route::post('/students', 'cStudents@all');

    Route::post('/student/gangs', 'cStudents@gangs');
    Route::post('/student/attach/gang', 'cStudents@attachGang');
    Route::post('/student/detach/gang', 'cStudents@detachGang');

    Route::post('/subjects', 'cSubjects@all');
    Route::post('/subjects/create', 'cSubjects@create');
    Route::post('/subjects/patch', 'cSubjects@patch');
    Route::post('/subjects/delete', 'cSubjects@delete');

    Route::post('/subject/gangs', 'cSubjects@gangs');
    Route::post('/subject/attach/gang', 'cSubjects@attachGang');
    Route::post('/subject/detach/gang', 'cSubjects@detachGang');

    Route::post('/subject/teachers', 'cSubjects@teachers');
    Route::post('/subject/attach/teacher', 'cGangs@attachTeacher');
    Route::post('/subject/detach/teacher', 'cGangs@detachTeacher');

    Route::post('/teachers', 'cTeachers@all');

    Route::post('/teacher/subjects', 'cTeachers@subjects');
    Route::post('/teacher/attach/subject', 'cTeachers@attachSubject');
    Route::post('/teacher/detach/subject', 'cTeachers@detachSubject');

    Route::post('/gangs', 'cGangs@all');
    Route::post('/gangs/create', 'cGangs@create');
    Route::post('/gangs/patch', 'cGangs@patch');
    Route::post('/gangs/delete', 'cGangs@delete');

    Route::post('/gang/students', 'cGangs@students');
    Route::post('/gang/attach/student', 'cGangs@attachStudent');
    Route::post('/gang/detach/student', 'cGangs@detachStudent');

    Route::post('/gang/subjects', 'cGangs@subjects');
    Route::post('/gang/attach/subject', 'cGangs@attachSubject');
    Route::post('/gang/detach/subject', 'cGangs@detachSubject');

    Route::post('/test/test1', 'cSeeds@test1');
    Route::post('/test/test2', 'cSeeds@test2');
});


