<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Visibility;

class CommentsController extends Controller
{
    function index(){
        $comments = Comment::all();
        return view('main',['comments'=> $comments]);
    }

    function store(Request $request){
        $commentRequest = new CommentRequest();
        $this->validate($request, $commentRequest->rules(), $commentRequest->messages());
        $response = array();
        $comment = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'homepage' => $request->input('homepage'),
            'comment' => $request->input('comment'),
        ];
        if (isset($_FILES["attachmentFiles"])) {
            Log::debug("Enter to upload attachments");
            $file = $request->file('attachmentFiles');
            $generatedName = $file->hashName();
            $comment['pathImage'] = 'storage/images/photos/'.$generatedName;
            Storage::putFileAs('public/images/photos/',$file,$generatedName);
        }
        $comment['isMain'] = true;
//        Log::debug("Comment",$comment);


        $id = Comment::create($comment);
        Log::debug("Id: ".$id);
        if($id !== null){
            $response["success"] = true;
        }
        else {
            $response["success"] = false;
        }
        return $response;
    }
}
