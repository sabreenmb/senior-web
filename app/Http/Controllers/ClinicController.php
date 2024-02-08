<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        // $opportunities = $this->connect()->getReference('opportunities')->getSnapshot()->getValue();
        return view('clinic-list');
        // ->with([
        //     'opportunities' => $opportunities

        // ]);
    }}
