<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        // $opportunities = $this->connect()->getReference('opportunities')->getSnapshot()->getValue();
        return view('events-list');
        // ->with([
        //     'opportunities' => $opportunities

        // ]);
    }}
