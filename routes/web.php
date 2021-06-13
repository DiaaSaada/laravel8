<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServic*eProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('post/create', [PostController::class, 'create'])
        ->middleware('auth')->name('post.create');

    Route::post('post/store', [PostController::class, 'store'])
        ->middleware('auth')->name('post.store');

    Route::get('post/index', [PostController::class, 'index'])
        ->middleware('auth')->name('post.index');

    Route::get('post/{slug}', [PostController::class, 'showBySlug'])
        ->name('posts.show');


    //-------------  Category Routes  --------------------------------
    //-------------------------------------------------------------
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');

    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');

    Route::get('category/index',  [CategoryController::class, 'index'])->name('category.index');

    Route::get('category/{slug}', [CategoryController::class, 'show'])->name('category.show');

});


//------------------------- GITHUB LOGIN --------------------------
Route::get('/login/github/callback', function () {
    $github_user = Socialite::driver('github')->user();

    //dd($github_user->user['bio']);


    $user = User::firstOrCreate(
        ['provider_id' => $github_user->getId(), 'provider' => 'github'],
        ['provider_id' => $github_user->getId()
            , 'provider' => 'github'
            , 'name' => $github_user->getName()
            // , 'bio' => $github_user->user['bio'] ?? ''
            , 'email' => $github_user->getEmail() ?? "{$github_user->getId()}@github.com"],
    );

    if ($user) {

        auth()->login($user, true);

        return redirect()->route('dashboard');
    } else {
        dd('error');
        return redirect('/');
    }
});

use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

//------------------------- END GITHUB LOGIN --------------------------
