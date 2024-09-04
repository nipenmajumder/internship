<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //put values in session
    session()->put('foo', 'bar');
    Session::put('baz', 'qux');
    session(['hello' => 'world']);


    //get values from session
    $foo = session('foo');
    $baz = Session::get('baz');
    $hello = Session::get('hello');
    return view('welcome');
});

Route::get('/set-cookie', function () {
//    $cookie = cookie('user_name', 'John Doe', 60); // Name, Value, Minutes
    $userData = [
        'name' => 'John Doe',
        'email' => 'john@example.com'
    ];
    $cookie = cookie('user_data', serialize($userData));
    return response('Cookie has been set')->cookie($cookie);
});

Route::get('/get-cookie',function (\Illuminate\Http\Request $request){
    dd($request->cookie('user_data' ));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
