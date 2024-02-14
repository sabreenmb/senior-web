<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;




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
            'cl_branch.required' => 'حقل الفرع مطلوب.',
            'cl_department.required' => 'حقل القسم مطلوب.',
            'cl_doctor.required' => 'حقل اسم الطبيب مطلوب.',
            'cl_date.required' => 'حقل التاريخ مطلوب.',
          'cl_start_time.required' => 'حقل وقت البدء مطلوب.',
        'cl_end_time.required' => 'حقل وقت الانتهاء مطلوب.',
        ];
        $validator = Validator::make($request->all(), [
            'cl_branch' => 'required',
            'cl_department' => 'required',
            'cl_doctor' => 'required',
            'cl_date' => 'required',
            'cl_start_time' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) {
                $startTime = Carbon::createFromFormat('H:i', $value);
                if ($startTime->format('H:i') < '08:00' || $startTime->format('H:i') > '15:00') {
                    $fail('The ' . $attribute . ' must be between 08:00 and 15:00.');
                }
            }],
            'cl_end_time' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) use ($request) {
                $startTime = Carbon::createFromFormat('H:i', $request->cl_start_time);
                $endTime = Carbon::createFromFormat('H:i', $value);
                if (!$endTime->greaterThan($startTime)) {
                    $fail('وقت الانتهاء يجب أن يكون بعد وقت البداية.');
                }
                if ($endTime->format('H:i') > '15:00') {
                    $fail('وقت الانتهاء يجب ألا يتجاوز الساعة 3:00 عصرًا.');
                }
            }],

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
        return view('clinic-form')->with([
            'clinic' => $clinic,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'cl_branch.required' => 'حقل الفرع مطلوب.',
            'cl_department.required' => 'حقل القسم مطلوب.',
            'cl_doctor.required' => 'حقل اسم الطبيب مطلوب.',
            'cl_date.required' => 'حقل التاريخ مطلوب.',
            'cl_start_time.required' => 'حقل وقت البدء مطلوب.',
            'cl_end_time.required' => 'حقل وقت الانتهاء مطلوب.',
        ];

        $validator = Validator::make($request->all(), [
            'cl_branch' => 'required',
            'cl_department' => 'required',
            'cl_doctor' => 'required',
            'cl_date' => 'required',
            'cl_start_time' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) {
                $startTime = Carbon::createFromFormat('H:i', $value);
                if ($startTime->format('H:i') < '08:00' || $startTime->format('H:i') > '15:00') {
                    $fail('The ' . $attribute . ' must be between 08:00 and 15:00.');
                }
            }],
            'cl_end_time' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) use ($request) {
                $startTime = Carbon::createFromFormat('H:i', $request->cl_start_time);
                $endTime = Carbon::createFromFormat('H:i', $value);
                if (!$endTime->greaterThan($startTime)) {
                    $fail('وقت الانتهاء يجب أن يكون بعد وقت البداية.');
                }
                if ($endTime->format('H:i') > '15:00') {
                    $fail('وقت الانتهاء يجب ألا يتجاوز الساعة 3:00 عصرًا.');
                }
            }],
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