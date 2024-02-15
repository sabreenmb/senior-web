<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//هنا

class CourseController extends Controller
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
        $eventsCoursesDB = $this->connect()->getReference('eventsCoursesDB')->getSnapshot()->getValue();
        return view('eventsCourses-list')
        ->with([
            'eventsCourses' => $eventsCoursesDB

        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'course_name.required' => 'عنوان الدورة مطلوب',
            'course_date.required' => 'تاريخ الدورة مطلوب.',
            'course_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'course_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'course_time.required' => 'وقت الدورة مطلوب.',
            'course_location.required' => 'موقع الدورة مطلوب.',
            'course_presenter.required' => 'اسم مقدم الدورة مطلوب.',
            'course_link.required' => 'رابط التسجيل مطلوب.',
            'course_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];
        $validator = Validator::make($request->all(), [
            'course_name' => 'required',
             'course_date' => 'required|date|date_format:Y-m-d',
             'course_time' => 'required',
             'course_location' => 'required',
             'course_presenter' => 'required',
             'course_link' => 'required|url',
         ],$messages);
    
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $this->connect()->getReference('eventsCoursesDB')->push($request->except(['_token']));
        return redirect()->route('courses.index');
    }
    public function create(){
        return view('eventsCourse-form')->with([
            'id'=>null
        ]);
    }

    public function edit($id){
        $courses = $this->connect()->getReference('eventsCoursesDB')->getChild($id)->getValue();
        return view('eventsCourse-form')->with([
            'course' => $courses,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'course_name.required' => 'عنوان الدورة مطلوب',
            'course_date.required' => 'تاريخ الدورة مطلوب.',
            'course_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'course_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'course_time.required' => 'وقت الدورة مطلوب.',
            'course_location.required' => 'موقع الدورة مطلوب.',
            'course_presenter.required' => 'اسم مقدم الدورة مطلوب.',
            'course_link.required' => 'رابط التسجيل مطلوب.',
            'course_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];
        $validator = Validator::make($request->all(), [
            'course_name' => 'required',
             'course_date' => 'required|date|date_format:Y-m-d',
             'course_time' => 'required',
             'course_location' => 'required',
             'course_presenter' => 'required',
             'course_link' => 'required|url',
         ],$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $this->connect()->getReference('eventsCoursesDB/' . $id)->update($request->except(['_token', '_method']));
        return redirect()->route('courses.index');
    }

    public function destroy($id){
        $this->connect()->getReference('eventsCoursesDB/' . $id)->remove();
        return back();
    }



}
    