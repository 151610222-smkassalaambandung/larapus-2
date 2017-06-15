<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function coba()
    {
    	return view('index');
    }
}
