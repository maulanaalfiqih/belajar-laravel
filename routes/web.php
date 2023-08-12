<?php

use App\Http\Controllers\HelloController;
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

Route::get('/momo', function () {
    return "Halo momo ganteng";
});

Route::redirect('/youtube', '/momo');

Route::fallback(function () {
    return "404";
});

Route::view('/hello', 'hello', ['name' => 'momo']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'ujang']);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'ujang']);
});

Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{items}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');

Route::get('/conflict/momo', function () {
    return "Conflict momo";
});

Route::get('/conflict/{name}', function ($nameId) {
    return "Conflict $nameId";
});

Route::get('/barang/{id}', function ($barangId) {
    $link = route('product.detail', ['id' => $barangId]);
    return "Link $link";
});

Route::get('/barang-redirect/{id}', function ($barangId) {
    return redirect()->route('product.detail', ['id' => $barangId]);
});

Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);
