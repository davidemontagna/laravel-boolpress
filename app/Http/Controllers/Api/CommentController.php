<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        //validation
        $validator = Validator::make($data, [
            'name' => 'nullable|string|max:50',
            'text' => 'string|required',
            'post_id' => 'exists:posts,id'
        ]);

        if($validator->fails()){
            return response()->json([
                "succes" => false,
                "errors" => $validator->errors(),
                "data" => $data
            ], 400);
        }

        $newComment = new Comment();
        if( !empty($data["name"])){
            $newComment->name = $data["name"];
        }
        $newComment->content = $data["text"];
        $newComment->post_id = $data["post_id"];
        $newComment->save();

        //restituisco una risposta
        return response()->json([
            "succes" => true
        ]);
    }
   
}
