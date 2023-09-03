<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'helloArray']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::prefix('/response/type')->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/named', function () {
    // return route('redirect-hello', ['name' => 'momo']);
    // return url()->route('redirect-hello', ['name' => 'momo']);
    return URL::route('redirect-hello', ['name' => 'momo']);
});
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

Route::middleware(['contoh:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });

    Route::get('/group', function () {
        return "GROUP";
    });
});

Route::get('/url/action', function () {
    // return action([FormController::class, 'form'], []);
    // return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form'], []);
});
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception('Sample Error');
});

Route::get('/error/manual', function () {
    report(new Exception('Sample Error'));
    return "OK";
});

Route::get('/error/validation', function () {
    throw new ValidationException('Validation Error');
});
