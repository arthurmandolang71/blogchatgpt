<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

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
    return view('home', [
        'title' => 'Home',
        'active' => 'Home',
        
    ]);
});



Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'About',
        'name' => 'arthur mandolang',
        'email' => 'arthurmandolang@gmail.com',
        'images' => 'manado.png'
    ]);
});


Route::get('/blog', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, "show"]);

Route::get('/add', [PostController::class, "add"]);



Route::get('categories', function () {
        return view('categories', [
            'title' => 'Post Categoies',
            'active' => 'Blog',
            'categories'=> Category::all()
        ]);
});

// Route::get('login', [LoginController::class, 'index'])->middleware('guest')->name('login');
// Route::post('login', [LoginController::class, 'auth']);

// Route::post('logout', [LoginController::class, 'logout']);

// Route::get('register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('register', [RegisterController::class, 'store']);

// Route::get('dashboard', function() {
//     return view('dashboard.index',[
//         'title' => 'dashboard',
//     ]);

// })->middleware('auth');

// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');

