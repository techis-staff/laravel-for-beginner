<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿一覧
    public function index()
    {
        $posts = Post::with('comments')->get();
        return view('post.index', compact('posts'));
    }

    // 投稿を登録
    public function store(Request $request)
    {
        $result =Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        $message = $result ? '登録に成功しました' : '登録に失敗しました';
        return redirect()->route('post.index')->with('message', $message);
    }
}
