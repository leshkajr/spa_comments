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
        return view('main');
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
        Log::debug($_FILES["attachmentFiles"]);
        if (isset($_FILES["attachmentFiles"])) {
            Log::debug("Enter to upload attachments");
            $file = $request->file('attachmentFiles');
            $generatedName = $file->hashName();
            $comment['pathImage'] = 'storage/images/photos/'.$generatedName;
            Storage::putFile('storage/images/photos/',$file,$generatedName);
//            Storage::setVisibility('public/images/photos/' . $generatedName, Visibility::PUBLIC);
        }
        Log::debug("Comment",$comment);
        $response["success"] = true;
        return $response;
//        Comment::create();
    }
}
