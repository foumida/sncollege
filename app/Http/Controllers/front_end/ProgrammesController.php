<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ProgrammesController extends Controller
{
 public function menu_programmes(){

    $ugpgm= DB::table('course')->where('course_type','=','UG')->select('course_name','id')->get();
    $pgpgm= DB::table('course')->where('course_type','=','PG')->select('course_name','id')->get();

                return view('front_end/menu_programmesView',compact('ugpgm','pgpgm'));
    }



}