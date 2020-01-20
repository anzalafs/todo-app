<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Users;
class UsersController extends Controller{
  public function __construct()
   {
     //  $this->middleware('auth:api');
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function authenticate(Request $request){
     $this->validate($request, [
                                     'email' => 'required',
                                     'password' => 'required'
                                  ]);
     $user = Users::where('email', $request->input('email'))->first();
     if(!$user){
      return response()->json(['status' => 'fail', 'message' => 'No user exists'],401);
    }else{
      if(md5($request->input('password')) == $user->password){
           $api_token = base64_encode(random_bytes(10));
           // $api_token = 'key123';
           Users::where('email', $request->input('email'))->update(['api_token' => "$api_token"]);
           return response()->json(['status' => 'success','api_key' => $api_token]);
       }else{
           return response()->json(['status' => 'fail', "message"=>"Invalid login details"],401);
       }
    }
   }

   public function logout(Request $request){
     $this->validate($request, [
                                     'email' => 'required'
                                  ]);
     $user = Users::where('email', $request->input('email'))->first();
     if(!$user){
      return response()->json(['status' => 'fail', 'message' => 'No user exists'],401);
    }else{
      Users::where('email', $request->input('email'))->update(['api_token' => ""]);
      return response()->json(['status' => 'success','message' => "Successfully logged out"]);
    }
   }

   public function register(Request $request){
     $this->validate($request, [
                                     'email' => 'required|unique:users,email',
                                     'password' => 'required'
                                ]);
      $api_token = base64_encode(random_bytes(10));
      // $api_token = 'key123';
      $id = Users::insert([
        'f_name'=>$request->input('f_name'),
        'l_name'=>$request->input('l_name'),
        'email'=>$request->input('email'),
        'password'=>md5($request->input('password')),
        'mobile'=>$request->input('mobile'),
        'gender'=>$request->input('gender'),
        'b_day'=>$request->input('b_day'),
        'api_token'=>$api_token
      ]);
      // $id = Users::insert($request->all());
      if($id){
          return response()->json(['status' => 'success','message' => "Successfully registered", 'api_token'=>$api_token]);
      }else{
          return response()->json(['status' => 'fail'],401);
      }

   }

   public function test(){
     echo "Welcome to test function";
     $user = Users::where('api_token', 'key123')->first(); echo $user;
   }

}
?>
