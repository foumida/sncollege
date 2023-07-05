<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
 public function index(){
    $research= DB::table('departments')->where('hod','=','Research Centres')->select('department','id','picture')->get();
	 $studentsupport= DB::table('cell')->where('id','=','137')->select('id','picture')->get();
	 $fine= DB::table('cell')->where('id','=','136')->select('id','picture')->get();
      $alumni= DB::table('cell')->where('id','=','603')->select('id','picture')->get();
	   $infrastructure= DB::table('cell')->where('id','=','604')->select('id','picture')->get();
  $sports= DB::table('departments')->where('id','=','22')->select('department','id','picture')->get();
 
  $nirf= DB::table('cell')->where('id','=','141')->select('id','picture')->get();
  $iqac= DB::table('cell')->where('id','=','144')->select('id','picture')->get();
  $aishe= DB::table('cell')->where('id','=','152')->select('id','picture')->get();
  $notification =DB::select("select cell_events.*, cell.*,cell_events.description as descr,cell_events.id as cellid from cell left join cell_events on cell.id=cell_events.fid where cell_events.fid='129'
order by cell_events.from_date desc limit 6"); 

 $awards = DB::select("select cell_events.*, cell.*,cell_events.description as descr,cell_events.id as cellid from cell left join cell_events on cell.id=cell_events.fid where cell_events.fid='142'
order by cell_events.from_date desc limit 6"); 
  $exam= DB::select("select cell_events.*, cell.*,cell_events.description as descr,cell_events.id as cellid from cell left join cell_events on cell.id=cell_events.fid where cell_events.fid='131'
order by cell_events.from_date desc limit 6"); 
 $news= DB::select("select cell_events.*, cell.*,cell_events.description as descr,cell_events.id as cellid from cell left join cell_events on cell.id=cell_events.fid where cell_events.fid='130'
order by cell_events.from_date desc limit 6"); 

$recentevents =DB::select("select * from fdp where eventtype='Recent' order by from_date desc limit 6");
	   
$upcomingevents =DB::select("select * from fdp where eventtype='Upcoming'  order by from_date desc limit 6");	   
   $studentcount = DB::select("select count(id) as st from students");
   $departmentcount = DB::select("select count(id) as dt from departments");
   $coursecount = DB::select("select count(id) as cs from course");
   $facultycount = DB::select("select count(fid) as ft from faculity");
   return view('front_end/home',compact('research','nirf','iqac','aishe','fine','studentsupport','notification','awards','exam','news','recentevents','upcomingevents','alumni','sports','studentcount','departmentcount','coursecount','facultycount','infrastructure'));
    }


}