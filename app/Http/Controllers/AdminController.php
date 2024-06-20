<?php

namespace App\Http\Controllers;
// use Auth;
 use Illuminate\Support\Facades\Auth;
 use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use Hash;

class AdminController extends Controller
{
    //
   
    public function login(){
        //echo Hash::make('admin');
        //exit();
        return view ('Admin.adminlogin');
    }
    public function makelogin(Request $request){
           $data=array(
               'email'=>$request->email,
               'password'=>$request->password,
               'role'=>'admin'

           );
           if(Auth::attempt($data)){
                      return redirect()->route('admin.dashboard');
           }
           else{
          return  back()->withErrors(['message'=>'incorrect login and password']);
           }
           
    }
    public function dashboard(){
         $userCount=User::count();
         $productCount=Product::count();

        return view('admin.dashboard',[
            'userCount'=>$userCount,
            'productCount'=>$productCount
        ]);
    }
    public function logout(){
        // session()->flush();
        Auth::logout();
        return redirect()->route('admin.adminlogin');
    }
}
