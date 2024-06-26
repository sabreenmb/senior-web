<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;//ه
use Carbon\Carbon;
class ConferencesController extends Controller
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
        $eventsConferencesDB = $this->connect()->getReference('eventsConferencesDB')->getSnapshot()->getValue();
        return view('eventsConferences-list')
        ->with([
            'eventsConferences' => $eventsConferencesDB

        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'conference_name.required' => 'عنوان المؤتمر مطلوب',
            'conference_date.required' => 'تاريخ المؤتمر مطلوب.',
            'conference_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'conference_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'conference_time.required' => 'وقت المؤتمر مطلوب.',
            'conference_location.required' => 'موقع المؤتمر مطلوب.',
            'conference_link.required' => 'رابط التسجيل مطلوب.',
            'conference_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];
        $validator = Validator::make($request->all(), [
            'conference_name' => 'required',
             'conference_date' => 'required|date|date_format:Y-m-d',
             'conference_time' => 'required',
             'conference_location' => 'required',
             'conference_link' => 'required|url',
            ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $requestData = $request->except(['_token']);
        $requestData['timestamp'] = Carbon::now();

        $this->connect()->getReference('eventsConferencesDB')->push($requestData);
        return redirect()->route('conferences.index');
    }
    public function create(){
        return view('eventsConference-form')->with([
            'id'=>null
        ]);
    }
    public function edit($id){
        $conference = $this->connect()->getReference('eventsConferencesDB')->getChild($id)->getValue();
        return view('eventsConference-form')->with([
            'conference' => $conference,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'conference_name.required' => 'عنوان المؤتمر مطلوب',
            'conference_date.required' => 'تاريخ المؤتمر مطلوب.',
            'conference_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'conference_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'conference_time.required' => 'وقت المؤتمر مطلوب.',
            'conference_location.required' => 'موقع المؤتمر مطلوب.',
            'conference_link.required' => 'رابط التسجيل مطلوب.',
            'conference_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];
        $validator = Validator::make($request->all(), [
            'conference_name' => 'required',
             'conference_date' => 'required|date|date_format:Y-m-d',
             'conference_time' => 'required',
             'conference_location' => 'required',
            'conference_link' => 'required|url',
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $requestData = $request->except(['_token', '_method']);
        $requestData['timestamp'] = Carbon::now();

      
        $this->connect()->getReference('eventsConferencesDB/' . $id)->update($requestData);
        return redirect()->route('conferences.index');
    }
    public function destroy($id){
        $this->connect()->getReference('eventsConferencesDB/' . $id)->remove();
         // Check if there are no items left
         $eventsConferencesDB = $this->connect()->getReference('eventsConferencesDB')->getSnapshot()->getValue();
    
         if ($eventsConferencesDB === null) {
             // Set a placeholder value to keep the reference
             $this->connect()->getReference('eventsConferencesDB')->set('placeholder');
         }
     
        return back();
    }


}
