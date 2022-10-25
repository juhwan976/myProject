<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Post;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;

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

Route::get('/', function() {
    $posts = Post::orderBy('post_id', 'desc')->paginate(10);
    return view('list', ['posts'=>$posts]);
})->name('list');

// 게시글 보는 페이지
Route::get('/show/{id}', function($id) {
    $post = Post::where('post_id', $id)->first();
    return view('show', ['post'=>$post]);
})->name('show');

// 글쓰기 페이지
Route::get('/create', function() {
    return view('create');
})->name('create');

// 글쓰기 페이지에서 작성하기 클릭시
Route::post('/send', function(Request $request) {
    $validation = $request->validate([
        'content' => 'required'
    ]);

    $post = Post::create([
        'user_name'=>Auth::user()->name,
        'google_id'=>Auth::user()->google_id,
        'content'=>$validation['content'],
    ]);

    return redirect()->route('list');
})->name('send');

// 글 수정하기 페이지
Route::get('/edit', function(Request $request) {
    $id = request('id');
    $post = Post::where('post_id', $id)->first();

    return view('edit', ['post'=>$post]);
})->name('edit');

// 글 수정하기 페이지에서 수정하기 클릭시
Route::put('/update/{id}', function(Request $request, $id) {
    $validation = $request->validate([
        'content' => 'required'
    ]);

    $post = Post::where('post_id', $id)->first();
    $post->content = $validation['content'];
    $post->save();

    return redirect()->route('show', ['id'=>$id]);
})->name('update');

// 게시글 보는 페이지에서 글 삭제하기 클릭시
Route::get('/delete', function(Request $request) {
    $id = request('id');
    $post = Post::where('post_id', $id)->first();
    $post->delete();

    return redirect()->route('list');
})->name('delete');

// 로그인 클릭시
Route::get('/auth/login', function(){
    return view('login_select');
})->name('login_select');

// 로그아웃 클릭시
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout');

// 구글 로그인 관련
Route::get('/auth/login/google', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/login/google/callback', [LoginController::class, 'handleProviderCallback']);

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
