<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function createPostLike(Request $request){
        $data = $request->json()->all();

            $like = Like::create([
                "user_id" => $request->input("user_id"),
                "post_id" => $request->input("post_id")
            ]);
            return response()->json([$like], 201);
        
        
    }
    
    public function createCommentLike(Request $request){
        $data = $request->json()->all();
        $like = Like::create([
            "user_id" => $request->input("user_id"),
            "comment_id" => $request->input("comment_id")
        ]);
        return response()->json([$like], 201);
    }

    public function getPostsLike(){
        $likes = Like::all();
        return response()->json([$likes], 200);
    }

    public function getPostbyLike($id){
        $like = Like::find($id);
        return response()->json($like, 200);
    }

    public function getPostbyUserIDLike($id){
        $like = Like::where(["user_id" => $id])->get();
        return response()->json($like, 200);
    }

    public function getCommentsLike(){
        $likes = Like::all();
        return response()->json([$likes], 200);
    }

    public function getCommentbyLike($id){
        $like = Like::find($id);
        return response()->json($like, 200);
    }

    public function getCommentbyUserIDLike($id){
        $like = Like::where(["user_id" => $id])->get();
        return response()->json($like, 200);
    }

    public function getLikesNumberP($id){
        $likes=Like::where(["post_id"=>$id])->count();
        return response()->json($likes, 200);

    }
    public function getLikesNumberC($id){
        $likes=Like::where(["comment_id"=>$id])->count();
        return response()->json($likes, 200);

    }
    






   public function deletePostLike($id){
        $like = Like::find($id);
        $like->delete();
        return response()->json(["deleted"], 204);
    }

    public function deleteCommentLike($id){
        $like = Like::find($id);
        $like->delete();
        return response()->json(["deleted"], 204);
    }
}
