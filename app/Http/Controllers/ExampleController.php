<?php

namespace App\Http\Controllers;

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
    public function index()
    {       
        return response()->json('{"hola mundo" : "nose"}', 200);
    }
    public function index2()
    {
         $user = new User();

         $user->name = "Gabriel";
         $user->email = "email@gmail.com";
         return response()->json([$user], 200);
       
    }
    public function index3(){
        $users=User::all();
        return response()->json([$users], 200);
    }



    //
}
