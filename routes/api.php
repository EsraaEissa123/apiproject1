<?php

use App\Http\Controllers\CourseController;
use App\Http\Resources\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

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
//routes/api.php

/**
 * 
 */
Route::post('register','ApiAuthController@handleRegister');
Route::post('login','ApiAuthController@handleLogin');
// Route::get('/courses', 'CourseController@index');
// Route::get('/courses', function () {
//     return new Collection(Course::all());
// });
Route::resource('courses','CourseController');
// Route::get('/courses/show/{id}', function ($id) {
//     return new Courses(course::findOrFail($id));
// });
// Route::get('/courses/show/{id}', 'CourseController@show');
Route::post('/courses/store', 'CourseController@store');
Route::post('/courses/update/{id}', 'CourseController@update');
Route::get('/courses/delete/{id}', 'CourseController@delete');

//add this middleware to ensure that every request is authenticated
Route::middleware('auth:api')->group(function(){
    Route::post('logout','ApiAuthController@handleLogout');

    // Route::get('user', [ApiAuthController::class,'authenticatedUserDetails']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
