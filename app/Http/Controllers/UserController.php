<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\facades\Auth;
use App\Models\Cart;

class UserController extends Controller
{
public function index(){
   $users=User::get(); 
   return view('Admin.user.index',compact('users'));
}
public function user_delete($id){
   
   $users=User::find($id);
   
        $users->delete();
        return redirect()->route('admin.user');
}
// public function user_product($id){
//    $productCount=Cart::count($id);
// }
}

