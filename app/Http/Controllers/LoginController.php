<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Validator;//ه

// use Validator;
use Session;

class LoginController extends Controller
{
    public function index() {
        return view("login");
    }

    public function successlogin() {
        return redirect()->route('opportunities.index');
    }

    public function logout() {
        //logout the currently authenticated user
        Auth::logout();

        //redirect login page
        return redirect()->route('main.index');
    }
    public function login(Request $request){
        $messages = [
            'email.required' => 'حقل الرقم الجامعي مطلوب.',
            'email.regex' => 'الرقم الجامعي غير صالح.',
     
            'password.required' => 'حقل كلمة المرور مطلوب.',
        ];
        $validator = Validator::make($request->all(), [
            "email"=> "required|regex:/^\d{7}$/",
            "password"=> "required",
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            

            try{
                $firebaseAuth=Firebase::auth();
                
                $signInResult=$firebaseAuth->signInWithEmailAndPassword($request->email .'@uj.edu.sa', $request->password);
                //get user name
                $user=$signInResult->data();
                //return the home view with user's name 
                // return redirect()->route('home')->with([
                //     'user' => $user["email"]
        
                // ]);;

                return view('home', ['user'=>$user["email"]]);

            }catch(\Exception $e){
                Session::flash('error', 'الرقم الجامعي او كلمة المرور غير صحيحة.');
                 return back();

            }

    }

}
