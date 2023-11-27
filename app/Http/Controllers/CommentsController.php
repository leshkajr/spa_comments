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
        $page = 1;
        return redirect()->route('main-comments',$page);
    }
    function comments(?int $page = 0){
        if($page === 0){
            return redirect()->route('main-comments',1);
        }
        $comments = array();
        $mainComments = Comment::where('isMain', 1)->get();
        foreach ($mainComments as $comment) {
            Comment::loadComments($comment, $comments);
        }
        $finishValue = $page * 25;
        $startValue = $finishValue - 25;
        $comments = array_slice($comments,$startValue, $finishValue);

        $countPages = ((int)(count(Comment::all()) / 25)) + 1;
        return view('main',['comments'=> $comments, 'countPages' => $countPages]);
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

        if($request->input('inputIsMain') === 'false'){
            $id_main_comment = $request->input('inputIdMain');
            $id_preview_comment = $request->input('inputIdPreviewComment');
            $comment['isMain'] = false;
            $comment['numberInCascade'] = Comment::where('id',$id_preview_comment)->get()[0]->numberInCascade + 1;
            $comment['idMainComment'] = (int)$id_main_comment;
            $comment['inputIdPreviewComment'] = (int)$id_preview_comment;
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

    function table(){
        $mainComments = Comment::where('isMain', 1);
        if(isset($_GET['sortBy'])){
            $sortBy = $_GET['sortBy'];
            if($sortBy === 'username' || $sortBy === 'email' || $sortBy === 'created_at'){
                if(isset($_GET['sortDirection'])){
                    $sortDirection = $_GET['sortDirection'];
                    if($sortDirection === 'desc'){
                        $mainComments = $mainComments->orderBy($sortBy,'DESC');
                    }
                    else{
                        $mainComments = $mainComments->orderBy($sortBy,'ASC');
                    }
                }
                else{
                    $mainComments = $mainComments->orderBy($sortBy,'ASC');
                }
            }
        }
        $mainComments = $mainComments->get();
        return view('table',['comments'=> $mainComments]);
    }
}
