<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //create
    public function createLike(Request $request){
      $data = $request->json()->all();
        if($request->has('coment_id')){
          $like= Like::create([
               "coment_id"=> $data["coment_id"],
               "user_id" => $data["user_id"]
             ]);
              return response()->json($like, 201);
        }
        else{
          $like= Like::create([
               "post_id"=> $data["post_id"],
               "user_id" => $data["user_id"]
             ]);
              return response()->json($like, 201);
        }
  }

    public function getLikebyID($id){
      $like=Like::find($id);
      return response()->json($like, 200);
    }
    public function getLike(){
      $like=Like::all();
      return response()->json([$like], 200);
    }
    public function getLikebyUser_ID($id){
      $like = Like::where (['user_id' => $id])->get();
      return response()->json($like, 200);
    }
    public function getLikebyPost_ID($id){
      $like = Like::where (['post_id' => $id])->get();
      return response()->json($like, 200);
    }
    public function getLikebyComent_ID($id){
      $like = Like::where (['coment_id' => $id])->get();
      return response()->json($like, 200);
    }

    public function updateLike(Request $request,$id){
        $data = $request->json()->all();

        $like=Like::find($id);
        if($request->has('coment_id')){
          $like->post_id = $data["coment_id"];
          $like->save();
          return response()->json($like, 200);
        }
        else{
            $like->coment_id = $data["post_id"];
            $like->save();
            return response()->json($like, 200);
        }
    }

    public function deleteLike($id){
        $like=Like::find($id);
        $like-> delete();
        return response()->json(["deleted"], 200);
    }
}
