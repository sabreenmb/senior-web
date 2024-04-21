<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator; //ه
use Carbon\Carbon;

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
            'OEvent_location.required' => 'موقع الفعالية مطلوب.',
            'OEvent_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];
        $validator = Validator::make($request->all(), [
            'OEvent_name' => 'required',
            'OEvent_date' => 'required|date|date_format:Y-m-d',
            'OEvent_time' => 'nullable',
            'OEvent_location' => 'required',
            'OEvent_presenter' => 'nullable',
            'OEvent_link' => 'nullable|url',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->input('OEvent_time') == null) {
            $oEventTime = $request->input('OEvent_time');
            $oEventTime = '';
            $request->merge(['OEvent_time' => $oEventTime]);

        }
        if ($request->input('OEvent_link') == null) {
            $oEventLink = $request->input('OEvent_link');
            $oEventLink = '';
            $request->merge(['OEvent_link' => $oEventLink]);

        }
        if ($request->input('OEvent_presenter') == null) {
            $oEventPresenter = $request->input('OEvent_presenter');
            $oEventPresenter = '';
            $request->merge(['OEvent_presenter' => $oEventPresenter]);

        }

        $requestData = $request->except(['_token']);
        $requestData['timestamp'] = Carbon::now();

        $this->connect()->getReference('eventsOthersDB')->push($requestData);
        return redirect()->route('other.index');
    }
    public function create()
    {
        return view('eventsOthers-form')->with([
            'id' => null
        ]);
    }
    public function edit($id)
    {
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
            'OEvent_link.url' => 'يجب أن يكون الرابط صالحًا.',
            // 'course_link.starts_with' => 'يجب أن يبدأ الرابط بـ http://',
        ];
        $validator = Validator::make($request->all(), [
            'OEvent_name' => 'required',
            'OEvent_date' => 'required|date|date_format:Y-m-d',
            'OEvent_time' => 'nullable',
            'OEvent_location' => 'required',
            'OEvent_presenter' => 'nullable',
            'OEvent_link' => 'nullable|url',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Access the OEvent_time value from the request
        if ($request->input('OEvent_time') == null) {
            $oEventTime = $request->input('OEvent_time');
            $oEventTime = '';
            $request->merge(['OEvent_time' => $oEventTime]);

        }
        if ($request->input('OEvent_link') == null) {
            $oEventLink = $request->input('OEvent_link');
            $oEventLink = '';
            $request->merge(['OEvent_link' => $oEventLink]);

        }
        if ($request->input('OEvent_presenter') == null) {
            $oEventPresenter = $request->input('OEvent_presenter');
            $oEventPresenter = '';
            $request->merge(['OEvent_presenter' => $oEventPresenter]);

        }

        // $oEventLink = $request->input('OEvent_link');
        // $oEventPresenter = $request->input('OEvent_presenter');
        // // Modify the OEvent_time value as needed
        // $oEventTime = '';
        // $oEventLink = '';
        // $oEventPresenter = '';

        // // Set the modified OEvent_time value back to the request
        // $request->merge(['OEvent_link' => $oEventLink]);
        // $request->merge(['OEvent_presenter' => $oEventPresenter]);

        $requestData = $request->except(['_token', '_method']);
        $requestData['timestamp'] = Carbon::now();



        $this->connect()->getReference('eventsOthersDB/' . $id)->update($requestData);
        return redirect()->route('other.index');
    }
    public function destroy($id)
    {
        $this->connect()->getReference('eventsOthersDB/' . $id)->remove();
         // Check if there are no items left
         $eventsOthersDB = $this->connect()->getReference('eventsOthersDB')->getSnapshot()->getValue();
    
         if ($eventsOthersDB === null) {
             // Set a placeholder value to keep the reference
             $this->connect()->getReference('eventsOthersDB')->set('placeholder');
         }
     
        return back();
    }


}
