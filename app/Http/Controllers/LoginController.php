<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Validator;//ه
use Google\Cloud\Firestore\FirestoreClient;

// use Validator;
use Session;

class LoginController extends Controller
{

    /**
     * Initialize Cloud Firestore with default project ID.
     */
    private $firebase;
    // public function connect()
    // {
    //     $factory = (new Factory)
    //     ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
    //     ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));
    //     $firebase = $factory->createFirestore();
    //     $firestore = $firebase->database();
    
    //     return $firestore;
    // }
    public function connect()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();

    }
    public function index()
    {
        return view("login");
    }


    public function logout()
    {
        //logout the currently authenticated user
        // Auth::guard('user')->logout();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private");
        header("Pragma: no-cache");
        header("Vary: Cookie");
        header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("HTTP/1.1 200 OK");

        Session::flush();
        return redirect('/?'.uniqid());
        //redirect login page
        // Session::flash('logout', true);
        // return redirect('/');
    }
    public function login(Request $request)
    {
        $messages = [
            'email.required' => 'حقل الرقم الجامعي مطلوب.',
            'email.regex' => 'الرقم الجامعي غير صالح.',

            'password.required' => 'حقل كلمة المرور مطلوب.',
        ];
        $validator = Validator::make($request->all(), [
            "email" => "required|regex:/^\d{7}$/",
            "password" => "required",
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        try {
            $message='الرقم الجامعي او كلمة المرور غير صحيحة .';
            $firebaseAuth = Firebase::auth();
            
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($request->email . '@uj.edu.sa', $request->password);
            // Get user name
            $user = $signInResult->data();
            $email = $request->email;
        
            // Check user's role
            $adminRef = $this->connect()->getReference('Admins')->getChild($email);
            $isAdmin = $adminRef->getValue();
        
            if ($isAdmin) {
                // User is an admin
                // After successful authentication
                session(['user' => $isAdmin]);
                return view('home');
                
            } else {
                // User is not an admin, handle accordingly (e.g., show an error message or redirect to an unauthorized page)
                $message= 'هذا المسخدم غير مصرح له بالدخول.';
                Session::flash('error', $message);
                return back();
            }
        } catch (\Exception $e) {
            Session::flash('error',$message);
            return back();
        }

    }

}
