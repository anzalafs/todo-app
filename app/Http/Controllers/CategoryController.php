<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Category;
use App\Users;
use Auth;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
          'name' => 'required'
         ]);
         $id = Category::insert([
           'category_name'=>$request->input('name')
         ]);
         if($id){
             return response()->json(['status' => 'success','message' => "Successfully created category"]);
         }else{
             return response()->json(['status' => 'fail'],401);
         }

    }
}
