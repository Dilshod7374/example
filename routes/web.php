<?php
/* salom */
/* salom */
/* salom */
/* salom */
/* hayr */
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

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

Route::get('/', [PageController::class, 'main'])->name('main');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'service'])->name('service');
Route::get('/project', [PageController::class, 'project'])->name('project');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_store'])->name('register.store');


Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
]);














/* route::get('posts', [PostController::class, 'index'])->name('posts.index');
route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
route::post('posts/create', [PostController::class, 'store'])->name('posts.store');
route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
route::put('posts/{post}/edit', [PostController::class, 'update'])->name('posts.update');
route::delete('posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete'); */




/* route::get('/users', [UserController::class, 'index']); // action
route::get('/users/create', [UserController::class, 'create']);
route::get('/users/{user}', [UserController::class, 'show']);
route::get('users/{user}/edit', [UserController::class, 'edit']);
route::post('/user-create', [UserController::class, 'store']); */
