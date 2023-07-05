<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncubationcenterController extends Controller
{
 public function incubation_center(){
                return view('front_end/incubation_centerView');
    }
}