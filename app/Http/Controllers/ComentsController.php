<?php

namespace App\Http\Controllers;

use App\Coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ComentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  //create
    public function createComent(Request $request){
      $data = $request->json()->all();
      try{
        if($request->hasFile('imagen'))
        {
            if($request->file('imagen')->isValid())
            {
              $destinationPath="C:/Users/megat/Desktop/respaldo/Gabo/proyecto/proyecto/storage/images";
              $fileName = str_random(10);
              $extension = $request->file('imagen')->
                getClientOriginalExtension();
                $fileComplete=$fileName . "." . $extension;
                $coment= Coment::create([
                  "body"=> $request->input("body"),
                  "imagen_url"=> $fileComplete,
                  "user_id" => $request->input("user_id"),
                  "post_id" => $request->input("post_id"),
                ]);
                $request->file('imagen')->move($destinationPath,$fileName);
                return response()->json($coment, 201);
            }
            else{
              return response()->json(['algo anda mal'], 404);
            }
       }
       else{
         $coment= Coment::create([
           "body"=> $data["body"],
           "user_id" => $data["user_id"],
           "post_id" => $data["post_id"]
         ]);
         return response()->json($coment, 201);
       }
      }
      catch(\Illuminate\Database\QueryException $e)
      {
        $respuesta = array("error"=>$e->errorInfo, "codigo"=>500);
        return response()->json($respuesta, 500);
      }
    }
    //read
      public function getComentbyID($id){
        $coment=Coment::find($id);
        return response()->json($coment, 200);
      }
      public function getComent(){
        $coment=Coment::all();
        return response()->json([$coment], 200);
      }
      public function getComentbyUser_ID($id){
        $coment = Coment::where (['user_id' => $id])->get();
        return response()->json($coment, 200);
      }
      public function getComentbyPost_ID($id){
        $coments = Coment::where (['post_id' => $id])->get();
        return response()->json($coments, 200);
      }
    //update
      public function updateComent(Request $request,$id){
           $data = $request->json()->all();
             $coment=Coment::find($id);
             $coment->body = $data["body"];
             $coment->user_id = $data["user_id"];
             $coment->post_id = $data["post_id"];
             $coment->update();
           return response()->json($coment, 201);
        }
    //delete
      public function deleteComent($id){
          $coment=Coment::find($id);
          $coment-> delete();
          return response()->json(["deleted"], 200);
      }
}
