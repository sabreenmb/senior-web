<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {
        // $opportunities = $this->connect()->getReference('opportunities')->getSnapshot()->getValue();
        return view('offers-list');
        // ->with([
        //     'opportunities' => $opportunities

        // ]);
    }
}
