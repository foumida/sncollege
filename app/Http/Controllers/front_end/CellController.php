<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CellController extends Controller
{

 public function index($id){

    //$cell= DB::table('cell')->join('faculity', 'faculity.fid', '=', 'cordinator')->where('id','=',$id)->get();
	$cell= DB::select("select cell.*,cell.picture as cellpicture,faculity.*,cell.description as descr  from cell  join faculity on faculity.fid = cell.cordinator where id='$id'");

    $events= DB::select("SELECT * FROM cell_events Join picture on cell_events.id=picture.fid WHERE cell_events.fid = '$id' and eventtype='Recent' group by id Order By from_date desc Limit 2");
    $upcoming= DB::select("SELECT * FROM cell_events Join picture on cell_events.id=picture.fid WHERE cell_events.fid = '$id' and eventtype='Upcoming' group by id Order By from_date desc Limit 1");
	
    $reports= DB::table('cell_report')->where('cell_id','=',$id)->get();
	$infra= DB::select("select * from cell where type='Infrastructure' or type='ICT' or type='ITFacility'");
   
   $incubationkeyword= DB::select("(select id,title from fdp WHERE main_criteria like '%,11,%' or main_criteria='11' or main_criteria like '11,%' or main_criteria like '%,11')
union (select id,title from cell_events  WHERE main_criteria like '%,11,%' or main_criteria='11' or main_criteria like '11,%' or main_criteria like '%,11')");
   
    $cellid= $id;
	
    return view('front_end/cell_details',compact('cell','events','upcoming','reports','infra','cellid','incubationkeyword'));
    }

public function events($id){

    //$cell= DB::table('cell')->join('faculity', 'faculity.fid', '=', 'cordinator')->where('id','=',$id)->get();
	$eventdata= DB::select("select * from fdp where id='$id'");
     $events= DB::select("SELECT picture FROM fdp Join picture on fdp.id=picture.fid WHERE fdp.id='$id' and eventtype='Recent' Order By fdp.from_date desc Limit 2");
     $upcoming= DB::select("SELECT picture FROM fdp Join picture on fdp.id=picture.fid WHERE fdp.id= '$id' and eventtype='Upcoming' Order By fdp.from_date desc Limit 1");
   // $reports= DB::table('cell_report')->where('cell_id','=',$id)->get();

                return view('front_end/event_details',compact('eventdata','events','upcoming'));
    }
	
		
   

}