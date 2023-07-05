<?php

namespace App\Http\Controllers\front_end ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class departmentController extends Controller
{

 public function menu_departments(){

    $aided= DB::table('departments')->where('hod','=','Aided')->orwhere('hod','=','Aided (Language)')->orwhere('hod','=','Aided (Subsidiary)')->select('department','id')->get();
    $self= DB::table('departments')->where('hod','=','Self-Financing')->select('department','id')->get();
    $research= DB::table('departments')->where('hod','=','Research Centres')->select('department','id')->get();
	

                return view('front_end/menu_departmentsView',compact('aided','self','research'));
    }


    public function departments_details($id,$slug){
        
        $department= DB::table('departments')->where('id','=',$id)->get();
		
        $course= DB::table('course')->where('departments','=',$id)->get();
        //$faculity= DB::table('faculity')->where('department','=',$slug)->get();
		 $faculity= DB::select("select * from faculity Where department='$slug' order by position='HOD' desc");
        $events= DB::select("SELECT title,from_date,picture FROM fdp  Join picture on fdp.id=picture.fid WHERE '$id' in (fdp.dept) and eventtype='Recent' Order By fdp.from_date desc Limit 2");
        $upcoming= DB::select("SELECT title,from_date,picture FROM fdp Join picture on fdp.id=picture.fid WHERE '$id' in (fdp.dept) and eventtype='Upcoming' Order By fdp.from_date desc Limit 1");

         $deptid=$id;
                    return view('front_end/department_details',compact('department','course','faculity','events','upcoming','deptid'));
        }
		
		 public function event_details($id){
        $eventslist= DB::select("SELECT title,from_date,picture,to_date,description,venue FROM fdp  left Join picture on fdp.id=picture.fid WHERE '$id' in (fdp.dept) and eventtype='Recent'  group by picture.fid Order By fdp.from_date desc");
        $type='Recent Events List';
	   return view('front_end/department_events_list',compact('eventslist','type'));
        } 
		 public function event_details_upcoming($id){
        $eventslist= DB::select("SELECT title,from_date,picture,to_date,description,venue FROM fdp  left Join picture on fdp.id=picture.fid WHERE '$id' in (fdp.dept) and eventtype='Upcoming'  group by picture.fid Order By fdp.from_date desc");
        $type='Upcoming Events List';
	   return view('front_end/department_events_list',compact('eventslist','type'));
        } 
		 public function event_details_cell($id){
			
        $eventslist= DB::select("SELECT title,from_date,picture,to_date,description,venue FROM cell_events  left Join picture on cell_events.id=picture.fid WHERE cell_events.fid='$id' and cell_events.eventtype='Recent' group by picture.fid Order By cell_events.from_date desc");
        $type='Recent Events List';
	   return view('front_end/department_events_list',compact('eventslist','type'));
        } 
		 public function event_details_upcoming_cell($id){
        $eventslist= DB::select("SELECT title,from_date,picture,to_date,description,venue FROM cell_events  left Join picture on cell_events.id=picture.fid WHERE cell_events.fid='$id' and cell_events.eventtype='Upcoming' group by picture.fid Order By cell_events.from_date desc");
        $type='Upcoming Events List';
	   return view('front_end/department_events_list',compact('eventslist','type'));
        } 
		
public function infrastructure(){
	 $infra= DB::select("select * from cell where type='Infrastructure' or type='ICT' or type='ITFacility'");
	 $type='Infrastructure / ICT & IT Facility';
	  return view('front_end/infrastructure',compact('infra','type'));
	
}

public function committies(){
	 $infra= DB::select("select * from cell where type='Club' or type='WebCell' or type='Commities'");
	  $type='Clubs / Cells & Committees';
	  return view('front_end/infrastructure',compact('infra','type'));
	
}
public function greeninitiative(){
	 $green= DB::select("(select id,title,from_date,main_criteria from fdp WHERE main_criteria like '%,15,%' or main_criteria='15' or main_criteria like '15,%' or main_criteria like '%,15')
union all (select id,title,from_date,main_criteria from cell_events  WHERE main_criteria like '%,15,%' or main_criteria='15' or main_criteria like '15,%' or main_criteria like '%,15'  ) order by from_date desc");
	  $type='Green Initiative Activities';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function gender(){
	 $green= DB::select("(select id,title,from_date,main_criteria from fdp WHERE main_criteria like '%,1,%' or main_criteria='1' or main_criteria like '1,%' or main_criteria like '%,1')
union all (select id,title,from_date,main_criteria from cell_events  WHERE main_criteria like '%,1,%' or main_criteria='1' or main_criteria like '1,%' or main_criteria like '%,1'  ) order by from_date desc");
	  $type='Gender';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function ethics(){
	 $green= DB::select("(select id,title,from_date,main_criteria from fdp WHERE main_criteria like '%,6,%' or main_criteria='6' or main_criteria like '6,%' or main_criteria like '%,6')
union all (select id,title,from_date,main_criteria from cell_events  WHERE main_criteria like '%,6,%' or main_criteria='6' or main_criteria like '6,%' or main_criteria like '%,6' ) order by from_date desc");
	  $type='Ethics & HumanValues';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function environment(){
	 $green= DB::select("(select id,title,from_date,main_criteria from fdp WHERE main_criteria like '%,7,%' or main_criteria='7' or main_criteria like '7,%' or main_criteria like '%,7')
union all (select id,title,from_date,main_criteria from cell_events  WHERE main_criteria like '%,7,%' or main_criteria='7' or main_criteria like '7,%' or main_criteria like '%,7' ) order by from_date desc");
	  $type='Environment & Sustainability';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function skill(){
	 $green= DB::select("(select id,title,from_date,main_criteria from fdp WHERE main_criteria like '%,4,%' or main_criteria='4' or main_criteria like '4,%' or main_criteria like '%,4')
union all (select id,title,from_date,main_criteria from cell_events  WHERE main_criteria like '%,4,%' or main_criteria='4' or main_criteria like '4,%' or main_criteria like '%,4' ) order by from_date desc");
	  $type='Skill Development';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function seminar(){
	
	 $green= DB::select("(select id,title,from_date from fdp where category='Seminar' or category ='Workshop')
union (select id,title, from_date from cell_events  where category='Seminar' or category ='Workshop') order by from_date desc");
	  $type='Workshops & Seminars';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function extensionactivity(){
	
	 $green= DB::select("(select id,title,from_date from fdp where category='Extension & OutReach')
union (select id,title,from_date from cell_events  where category='Extension & OutReach')order by from_date desc");
	  $type='Extension & OutReach';
	  return view('front_end/greeninitiative',compact('green','type'));
	
}
public function bestpractice(){
 $experiantial= DB::select("(select id,title from fdp where practice='Experiancial')
union (select id,title from cell_events  where practice ='Experiancial')");
 $marginalised= DB::select("((select id,title from fdp where practice='Marginalised')
union (select id,title from cell_events  where practice ='Marginalised'))");
	  $type='Best Practice';
	  return view('front_end/bestpractice',compact('experiantial','type','marginalised'));
	
}

}