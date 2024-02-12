<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//هنا




class ClinicController  extends Controller
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
        $clinicdb = $this->connect()->getReference('clinicdb')->getSnapshot()->getValue();
        return view('clinic-list')->with([
            'clinicdb' => $clinicdb

        ]);
    }
    public function store(Request $request)
    {
        $messages = [
            'cl_department.required' => 'حقل القسم مطلوب.',
            'cl_doctor.required' => 'حقل اسم الطبيب مطلوب.',
            'cl_date.required' => 'حقل التاريخ مطلوب.',
            'cl_time.required' => 'حقل الوقت مطلوب.',

        ];
        $validator = Validator::make($request->all(), [
            'cl_department' => 'required',
            'cl_doctor' => 'required',
            'cl_date' => 'required',
            'cl_time' => 'required',

        ],$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $this->connect()->getReference('clinicdb')->push($request->except(['_token']));
        return redirect()->route('clinic.index');
    }
    public function create(){
        return view('clinic-form')->with([
            'id'=>null
        ]);

    }
    public function edit($id){
        $clinic = $this->connect()->getReference('clinicdb')->getChild($id)->getValue();
        return view('clinicdb-form')->with([
            'clinic' => $clinic,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'cl_department.required' => 'الحقل مطلوب.',
            'cl_doctor.required' => 'الحقل مطلوب.',
            'cl_date.required' => 'الحقل مطلوب.',
            'cl_time.required' => 'الحقل مطلوب.',
        ];

        $validator = Validator::make($request->all(), [
            'cl_department' => 'required',
            'cl_doctor' => 'required',
            'cl_date' => 'required',
            'cl_time' => 'required',
        ],$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $this->connect()->getReference('clinicdb/' . $id)->update($request->except(['_token', '_method']));
        return redirect()->route('clinic.index');
    }
    public function destroy($id){
        $this->connect()->getReference('clinicdb/' . $id)->remove();
        return back();
    }
}