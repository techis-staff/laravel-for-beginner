<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store($post_id, Request $request){
        $result = Comment::create([
            'context' => $request->input('context'),
            'post_id' => $post_id
        ]);

        $message = $result ? 'コメントの登録に成功しました' : 'コメントの登録に失敗しました';
        return redirect()->route('post.index')->with('message', $message);
    }
}
