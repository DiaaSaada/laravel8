<?php

use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('post/create', [PostController::class, 'create'])
    ->middleware('auth')->name('post.create');
Route::post('post/store', [PostController::class, 'store'])
    ->middleware('auth')->name('post.store');

Route::get('post/show', [PostController::class, 'show'])
    ->middleware('auth')->name('post.show');

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



