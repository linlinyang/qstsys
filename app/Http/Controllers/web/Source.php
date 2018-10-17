<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Source extends Controller
{
    
	public function index($name = 'index',Request $request){

		
		return view('source/index')
				->with('_name',$name);

	}

}
