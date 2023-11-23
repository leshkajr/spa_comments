<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    function index(){
        return view('main');
    }

    function store(Request $request){
        $commentRequest = new CommentRequest();
        $this->validate($request, $commentRequest->rules(), $commentRequest->messages());
        return $request->all();
    }
}
