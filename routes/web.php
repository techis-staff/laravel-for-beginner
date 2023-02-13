<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

// ① http://○○/firstというURLが入力されたときはview(画面)をそのまま返す。
Route::get('/first', function () {
    return view('first');
});

// ② http://○○/secondの場合はデータをview(画面)に渡してみましょう。
Route::get('/second', function () {
    // 名古屋の部分を変えてみて、http://○○/secondにアクセスした際に変わってるか確認してみましょう！
    $prefecture = '名古屋';

    // compactはviewに渡す変数(今回の場合は$prefecture)を明示してください。
    return view('second', compact('prefecture'));
});

// ③ http://○○/thirdの場合は外部のURL（今回はGoogle）の画面に遷移してみましょう。
Route::get('/third', function () {
    // 今回はviewsフォルダ内に準備してる画面ではなく、外部のURLに飛ばしたいのでviewではなくredirectを使う
    return redirect()->away('https://www.google.com');
});


// ④ 投稿一覧を表示させる際にコントローラーに処理をさせたいのでコントローラーを呼び出しましょう
Route::get('/', [PostController::class, 'index'])->name('post.index');

// ⑤ 投稿する際のルーティング
Route::post('/', [PostController::class, 'store'])->name('post.store');

// ⑤ コメントを投稿する際のルーティング
Route::post('/comment/post/{post_id}', [ CommentController::class, 'store' ])->name('comment.store');