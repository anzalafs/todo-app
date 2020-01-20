<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Users;
use Auth;

class TodoController extends Controller
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
        $user = Users::where('api_token', $request->header('Authorization'))->first();
        $query = Todo::query();
        if($request->input('category')!=''){
           $query = $query->where('todo_details.cat_id', $request->input('category'));
        }
        if($request->input('status')!=''){
           $query = $query->where('todo_details.status', $request->input('status'));
        }
        $todo=$query->where('user_id',  $user->user_id)
                    ->select('todo_details.id', 'todo_details.name', 'todo_details.description', 'todo_details.time', 'todo_details.status', 'todo_category.category_name')
                    ->join('todo_category','todo_category.cat_id','=','todo_details.cat_id')->get();
        if(count($todo)==0){
          return response()->json(['status' => 'success','message' => "No data found"]);
        }else{
          return response()->json(['status' => 'success','result' => $todo]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
          'user_id' => 'required',
          'name' => 'required',
          'description' => 'required',
          'cat_id' => 'required'
         ]);
         $id = Todo::insert([
           'user_id'=>$request->input('user_id'),
           'name'=>$request->input('name'),
           'description'=>$request->input('description'),
           'time'=>$request->input('time'),
           'status'=>$request->input('status'),
           'cat_id'=>$request->input('cat_id')
         ]);
         if($id){
             return response()->json(['status' => 'success','message' => "Successfully created"]);
         }else{
             return response()->json(['status' => 'fail'],401);
         }

    }

    public function destroy($id){
        if(Todo::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }

}
