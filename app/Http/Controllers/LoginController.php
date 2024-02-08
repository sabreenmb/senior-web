<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;
// use Validator;
use Session;

class LoginController extends Controller
{
    public function index() {
        return view("login");
    }



    // public function checkLogin(Request $request) {
    //  $$this->validate($request,[
    //                 "email"=> "required|email",
    //                 "password"=> "required|min:3",
    //                 ]);
    //     $user_data=array(
    //         "email"=> $request->get('email'),
    //         'password'=> $request->get('password'),
    //     );

    //     if(Auth::attempt($user_data)) {
    //         return redirect('main/successlogin');
    //     }   else {   
    //         return back()->with('error','unathurised user');
        
    //     }

    // }
    public function successlogin() {
        return redirect()->route('opportunities.index');
    }

    public function logout() {
        //logout the currently authenticated user
        Auth::logout();

        //redirect login page
        return redirect('main');
    }
    public function login(Request $request){
        //validate login from form 
        $validator= $request->validate([
            "email"=> "required|email",
            "password"=> "required|min:3",
            ]);

            try{
                // if(Auth::attempt(["email"=> $request->email], $request->password)){
                $firebaseAuth=Firebase::auth();
                $signInResult=$firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);
                //get user name
                $user=$signInResult->data();
                //return the home view with user's name 
                return view('home', ['user'=>$user["email"]]);
                // }
                // Session::flash('error', 'login faild. please try again.');

            }catch(\Exception $e){
                Session::flash('error', 'login faild. please try again.');
                //  return back()->with('error','unathurised user');
                 return back();

            }

    }

}
