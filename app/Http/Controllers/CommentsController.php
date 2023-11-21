<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    function index(){
        return view('main');
    }

    function store(CommentRequest $request){
//        $rules = ['captcha' => 'required|captcha'];
//        $validator = validator()->make(request()->all(), $rules);
//        if ($validator->fails()) {
//            echo '<p style="color: #ff0000;">Incorrect!</p>';
//        } else {
//            echo '<p style="color: #00ff30;">Matched :)</p>';
//        }
        $this->validate($request, $request->rules());
        return $request->all();
    }
}
