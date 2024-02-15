<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;//ه
class OthersController extends Controller
{
    private $firebase;
    public function connect()
    {
        $firebase = (new Factory)
        ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
        ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));
        
        return $firebase->createDatabase();

    }
    public function index()
    {
        $eventsOthersDB = $this->connect()->getReference('eventsOthersDB')->getSnapshot()->getValue();
        return view('eventsOthers-list')
        ->with([
            'eventsOthers' => $eventsOthersDB

        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'OEvent_name.required' => 'عنوان الفعالية مطلوب',
            'OEvent_date.required' => 'تاريخ الفعالية مطلوب.',
            'OEvent_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'OEvent_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            // 'course_time.required' => 'وقت الدورة مطلوب.',
            'OEvent_location.required' => 'موقع الفعالية مطلوب.',
            // 'course_presenter.required' => 'اسم مقدم الدورة مطلوب.',
            // 'course_link.required' => 'رابط التسجيل مطلوب.',
            // 'course_link.url' => 'يجب أن يكون الرابط صالحًا.',
            // 'course_link.starts_with' => 'يجب أن يبدأ الرابط بـ http://',
        ];
        $validator = Validator::make($request->all(), [
            'OEvent_name' => 'required',
             'OEvent_date' => 'required|date|date_format:Y-m-d',
            //  'OEvent_time' => 'required',
             'OEvent_location' => 'required',
            //  'OEvent_presenter' => 'required',
            //  'OEvent_link' => 'required|url|starts_with:http://',
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
      
        $this->connect()->getReference('eventsOthersDB')->push($request->except(['_token']));
        return redirect()->route('other.index');
    }
    public function create(){
        return view('eventsOthers-form')->with([
            'id'=>null
        ]);
    }
    public function edit($id){
        $OEvent = $this->connect()->getReference('eventsOthersDB')->getChild($id)->getValue();
        return view('eventsOthers-form')->with([
            'other' => $OEvent,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'OEvent_name.required' => 'عنوان الفعالية مطلوب',
            'OEvent_date.required' => 'تاريخ الفعالية مطلوب.',
            'OEvent_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'OEvent_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            // 'course_time.required' => 'وقت الدورة مطلوب.',
            'OEvent_location.required' => 'موقع الفعالية مطلوب.',
            // 'course_presenter.required' => 'اسم مقدم الدورة مطلوب.',
            // 'course_link.required' => 'رابط التسجيل مطلوب.',
            // 'course_link.url' => 'يجب أن يكون الرابط صالحًا.',
            // 'course_link.starts_with' => 'يجب أن يبدأ الرابط بـ http://',
        ];
        $validator = Validator::make($request->all(), [
            'OEvent_name' => 'required',
             'OEvent_date' => 'required|date|date_format:Y-m-d',
            //  'OEvent_time' => 'required',
             'OEvent_location' => 'required',
            //  'OEvent_presenter' => 'required',
            //  'OEvent_link' => 'required|url|starts_with:http://',
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $this->connect()->getReference('eventsOthersDB')->push($request->except(['_token']));
        return redirect()->route('other.index');
    }
    public function destroy($id){
        $this->connect()->getReference('eventsOthersDB/' . $id)->remove();
        return back();
    }


}
