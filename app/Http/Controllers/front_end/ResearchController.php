<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
class ResearchController extends Controller
{
 public function research_projects(){
                return view('front_end/menu_researchprojectsView');
    }

 public function research_papers(){
	 	$sw = DB::select("select fdp.title,faculity.department from fdp join faculity on fdp.fid=faculity.fid where fdp.category='Workshop' or fdp.category='Seminar' order by id desc limit 20");	
                return view('front_end/research_papersView',compact('sw'));
    }

	
}