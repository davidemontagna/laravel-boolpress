<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

    //$posts = Post::all();
    //$posts_filtered = Post::where("category_id",1)->get();
    
    $posts = Post::with(["category", "tags"])->get();

    return response()->json($posts);

    }


    public function show($slug){

        $post = Post::where("slug", $slug)->with(["category", "tags"])->first();

        //404
        if(empty($post)){
            return response()->json(["message" => "Post Not Found"], 404);
        }
       
    
        return response()->json($post);
    
        }

    
}
