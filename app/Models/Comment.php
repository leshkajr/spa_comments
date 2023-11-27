<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function loadComments($object, &$array): array
    {
        $tmp_object = $object;
        if($object->isMain === 0){
            $reviewComment = self::where('id', $object->inputIdPreviewComment)->first();
            $tmp_object['reviewComment'] = $reviewComment;
        }
        $array[] = $tmp_object;
        $comments = self::where('inputIdPreviewComment', $object->id)->get();
        if (count($comments) !== 0) {
            foreach ($comments as $value) {
                self::loadComments($value, $array);
            }
        }
        return $array;
    }

}
