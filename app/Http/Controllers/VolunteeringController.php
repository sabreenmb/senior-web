<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;

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
        $this->connect()->getReference('opportunities')->push($request->except(['_token']));
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
        $this->connect()->getReference('opportunities/' . $id)->update($request->except(['_token', '_method']));
        return redirect()->route('opportunities.index');
    }
    public function destroy($id){
        $this->connect()->getReference('opportunities/' . $id)->remove();
        return back();
    }
}