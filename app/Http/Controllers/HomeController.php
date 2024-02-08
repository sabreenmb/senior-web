<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//هنا




class HomeController extends Controller
{

    public function index() {
        return view("home");
    }
    public function volunteering()
    {
        return redirect()->route('opportunities.index');

    }
    public function offers()
    {
        return redirect()->route('offers.index');

    }
    public function clinic()
    {
        return redirect()->route('clinic.index');

    }
    public function events()
    {
        return redirect()->route('events.index');

    }
  
}