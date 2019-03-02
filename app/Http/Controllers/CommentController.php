<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /*.CREATE.*/
    public function createComment(Request $request){
        $data = $request->json()->all();
        try{
            if($request->hasFile('imagen'))
            {
                if($request->file('imagen')->isValid())
                {
                    $destinationPath = "/API5A/proyecto/storage/imagesComment";
                    $fileName = str_random(10);
                    $extension = $request->file('imagen')->getClientOriginalExtension();
                    $fileComplete = $fileName . "." . $extension;
                    $comment = Comment::create([
                        "body" => $request->input('body'),
                        "imagen_url" => $fileComplete,
                        "user_id" => $request->input('user_id'),
                        "post_id" => $request->input('post_id')
                    ]);
                    $request->file('imagen')->move($destinationPath, $fileComplete);

                    return response()->json([$comment], 201);
                }
                else{
                    return response()->json(['algo malio sal'], 404);
                }
            }
            else{
                $comment = Comment::create([
                    "body" => $data["body"],
                    "user_id" => $data["user_id"],
                    "post_id" => $data["post_id"]
                ]);
                return response()->json([$comment], 201);
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo, "codigo" =>500);
            return response()->json($respuesta, 500);
        }
    }

    public function getComments(){
        $comments = Comment::all();
        return response()->json([$comments], 200);
    }

    public function getCommentbyID($id){
        $comment = Comment::find($id);
        return response()->json($comment, 200);
    }

    public function getCommentbyUserID($id){
        $comment = Comment::where(["user_id" => $id])->get();
        return response()->json($comment, 200);
    }

    public function updateComment(Request $request, $id){
        $data = $request->json()->all();
        $comment = Comment::find($id);
        $comment ->body = $data["body"];

        $comment->save();
        return response()->json($comment, 200);
    }

    public function deleteComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json(["deleted"], 204);
    }
}
