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
        $comments = array();
        $mainComments = Comment::where('isMain',1)->get();
        foreach($mainComments as $mainComment){
            $reviewComments = Comment::where('idMainComment',$mainComment->id)->orderBy('numberInCascade')->get();
            $comments[] = $mainComment;
            foreach ($reviewComments as $reviewComment){
                $comments[] = $reviewComment;
            }
        }

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
//        Log::debug("inputIsMain: ".$request->input('inputIsMain'));
//        Log::debug("inputIdMain: ".$request->input('inputIdMain'));
        if($request->input('inputIsMain') === 'false'){
            $id_main_comment = $request->input('inputIdMain');
            $id_preview_comment = $request->input('inputIdPreviewComment');
            $comment['isMain'] = false;
            $comment['numberInCascade'] = Comment::where('id',$id_preview_comment)->get()[0]->numberInCascade + 1;
            $comment['idMainComment'] = (int)$id_main_comment;
        }
        else{
            $comment['isMain'] = true;
            $comment['numberInCascade'] = 0;
        }
        Log::debug("Comment",$comment);


        $id = Comment::create($comment);
        Log::debug("Created comment: ".$id);
        if($id !== null){
            $response["success"] = true;
        }
        else {
            $response["success"] = false;
        }
        return $response;
    }
}
