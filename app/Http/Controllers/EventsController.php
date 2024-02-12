<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        // $opportunities = $this->connect()->getReference('opportunities')->getSnapshot()->getValue();
        return view('eventsCourses-list');
        // ->with([
        //     'opportunities' => $opportunities

        // ]);
    }
    public function show(string $id)
    {
        if($id=='courses'){
            return view('eventsCourses-list');
        }else if($id=='workshops'){
            return view('eventsWorkshops-list');
        }else if($id== 'conferences'){
            return view('eventsConferences-list');
        }else{
            return view('eventsOthers-list');
        }

    }
    public function create(){


    }




}
    
