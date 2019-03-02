<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index(){
        $user=User::all();
        return response()->json([$user],201);
    }

    public function crateUser(Request $request){
        $data =$request->json()->all();
        try{
          $user= User::create([
              "name"=> $data["name"],
              "nickname"=> $data["nickname"],
              "email"=> $data["email"],
              "password" => Hash::make($data["password"]),
              "token" => str_random(60)
          ]);
          return response()->json($user, 201);
        }
        catch(\Illuminate\Database\QueryException$e)
        {
          $respuesta = array("error"=>$e->errorInfo, "codigo"=>500);
          return response()->json($respuesta, 500);
        }
    }

    public function getUser($id){
        $user = User::find($id);

        return response()->json($user, 200);
    }

    public function deleteUser($id){
        $user=User::find($id);
        $user-> delete();
        return response()->json(["deleted"], 200);
    }

    public function updateUser(Request $request,$id){
        $data = $request->json()->all();
        $user=User::find($id);

        $user->name = $data["name"];
        $user->nickname = $data["nickname"];
        $user->email = $data["email"];

        $user->save();
        return response()->json($user, 200);
    }

    public function login(Request $request){
        $data = $request->json()->all();
        $user = User::where (["nickname" => $data["nickname"]])->first();

        if($user){
            if(Hash::check($data["password"],$user->password)){
                return response()->json($user, 200);
            }
            else{
                $respuesta = array('error' => "El password no coincide", "codigo" => 404);
                return response()->json($user, 404);
            }
        }
        else{
            $respuesta = array('error' => "El usuario no coincide", "codigo" => 404);
            return response()->json($user, 404);
        }
    }
    public function nocb(Request $request){
     $data = $request->json()->all();

      $result = DB::select('SELECT * FROM users where nickname=:nickname'
      ,["nickname"=>$data["nickname"]]);

      return response()->json($result, 200);

    }

}
