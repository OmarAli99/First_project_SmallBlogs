<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        Comment::create($data);
        return back()->with('statuscomment', 'your comment inserted');

    }
}
