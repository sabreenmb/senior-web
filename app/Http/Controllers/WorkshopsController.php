<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;//هنا

use Illuminate\Http\Request;

class WorkshopsController extends Controller
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
        $eventsWorkshopsDB = $this->connect()->getReference('eventsWorkshopsDB')->getSnapshot()->getValue();
        return view('eventsWorkshops-list')
        ->with([
            'eventsWorkshops' => $eventsWorkshopsDB
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'workshop_name.required' => 'عنوان الورشة مطلوب',
            'workshop_date.required' => 'تاريخ الورشة مطلوب.',
            'workshop_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'workshop_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'workshop_time.required' => 'وقت الورشة مطلوب.',
            'workshop_location.required' => 'موقع الدورة مطلوب.',
            'workshop_presenter.required' => 'اسم مقدم الدورة مطلوب.',
            'workshop_link.required' => 'رابط التسجيل مطلوب.',
            'workshop_link.url' => 'يجب أن يكون الرابط صالحًا.',
            'workshop_link.starts_with' => 'يجب أن يبدأ الرابط بـ http://',
        ];
        $validator = Validator::make($request->all(), [
            'workshop_name' => 'required',
             'workshop_date' => 'required|date|date_format:Y-m-d',
             'workshop_time' => 'required',
             'workshop_location' => 'required',
             'workshop_presenter' => 'required',
             'workshop_link' => 'required|url|starts_with:http://',
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $this->connect()->getReference('eventsWorkshopsDB')->push($request->except(['_token']));
        return redirect()->route('workshops.index');
    }
    public function create(){
        return view('eventsWorkshop-form')->with([
            'id'=>null
        ]);
    }

    public function edit($id){
        $workshop = $this->connect()->getReference('eventsWorkshopsDB')->getChild($id)->getValue();
        return view('eventsWorkshop-form')->with([
            'workshop' => $workshop,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'workshop_name.required' => 'عنوان الورشة مطلوب',
            'workshop_date.required' => 'تاريخ الورشة مطلوب.',
            'workshop_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'workshop_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'workshop_time.required' => 'وقت الورشة مطلوب.',
            'workshop_location.required' => 'موقع الدورة مطلوب.',
            'workshop_presenter.required' => 'اسم مقدم الدورة مطلوب.',
            'workshop_link.required' => 'رابط التسجيل مطلوب.',
            'workshop_link.url' => 'يجب أن يكون الرابط صالحًا.',
            'workshop_link.starts_with' => 'يجب أن يبدأ الرابط بـ http://',
        ];
        $validator = Validator::make($request->all(), [
            'workshop_name' => 'required',
             'workshop_date' => 'required|date|date_format:Y-m-d',
             'workshop_time' => 'required',
             'workshop_location' => 'required',
             'workshop_presenter' => 'required',
             'workshop_link' => 'required|url|starts_with:http://',
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $this->connect()->getReference('eventsWorkshopsDB/' . $id)->update($request->except(['_token', '_method']));
        return redirect()->route('workshops.index');
    }

    public function destroy($id){
        $this->connect()->getReference('eventsWorkshopsDB/' . $id)->remove();
        return back();
    }



}
