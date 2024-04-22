<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VolunteeringController extends Controller
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
        $opportunities = $this->connect()->getReference('opportunities')->getSnapshot()->getValue();
        return view('opportunity-list')->with([
            'opportunities' => $opportunities

        ]);
    }
    public function store(Request $request)
    {
        $messages = [
            'op_name.required' => 'عنوان الفرصة التطوعية مطلوب.',
            'op_date.required' => 'تاريخ الفرصة التطوعية مطلوب.',
            'op_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'op_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'op_time.required' => 'وقت الفرصة التطوعية مطلوب.',
            'op_location.required' => 'موقع الفرصة التطوعية مطلوب.',
            'op_number.required' => 'عدد المتطوعين مطلوب.',
            'op_number.numeric' => 'يجب أن يكون عدد المتطوعين رقمًا.',
            'op_link.required' => 'رابط الفرصة التطوعية مطلوب.',
            'op_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];
        $validator = Validator::make($request->all(), [
           'op_name' => 'required',
            'op_date' => 'required|date|date_format:Y-m-d',
            'op_time' => 'required',
            'op_location' => 'required',
            'op_number' => 'required|numeric',
            'op_link' => 'required|url',
        ],$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $requestData = $request->except(['_token']);
        $requestData['timestamp'] = Carbon::now();


        $this->connect()->getReference('opportunities')->push($requestData);
        return redirect()->route('opportunities.index');
    }
    public function create(){
        return view('opportunity-form')->with([
            'id'=>null
        ]);

    }
    public function edit($id){
        $opportunity = $this->connect()->getReference('opportunities')->getChild($id)->getValue();
        return view('opportunity-form')->with([
            'opportunity' => $opportunity,
            'id' => $id
        ]);
    }
    public function update($id, Request $request)
    {
        $messages = [
            'op_name.required' => 'عنوان الفرصة التطوعية مطلوب.',
            'op_date.required' => 'تاريخ الفرصة التطوعية مطلوب.',
            'op_date.date' => 'يجب أن يكون التاريخ صالحًا.',
            'op_date.date_format' => 'يجب أن يكون تنسيق التاريخ Y-m-d.',
            'op_time.required' => 'وقت الفرصة التطوعية مطلوب.',
            'op_location.required' => 'موقع الفرصة التطوعية مطلوب.',
            'op_number.required' => 'عدد المتطوعين مطلوب.',
            'op_number.numeric' => 'يجب أن يكون عدد المتطوعين رقمًا.',
            'op_link.required' => 'رابط الفرصة التطوعية مطلوب.',
            'op_link.url' => 'يجب أن يكون الرابط صالحًا.',
        ];

        $validator = Validator::make($request->all(), [
            'op_name' => 'required',
            'op_date' => 'required|date|date_format:Y-m-d',
            'op_time' => 'required',
            'op_location' => 'required',
            'op_number' => 'required|numeric',
            'op_link' => 'required|url',
        ],$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $requestData = $request->except(['_token', '_method']);
        $requestData['timestamp'] = Carbon::now();


        $this->connect()->getReference('opportunities/' . $id)->update($requestData);
        return redirect()->route('opportunities.index');
    }
    public function destroy($id){
        $this->connect()->getReference('opportunities/' . $id)->remove();
         // Check if there are no items left
         $opportunities = $this->connect()->getReference('opportunities')->getSnapshot()->getValue();
    
         if ($opportunities === null) {
             // Set a placeholder value to keep the reference
             $this->connect()->getReference('opportunities')->set('placeholder');
         }
     
        return back();
    }
}