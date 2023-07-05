<?php

namespace App\Http\Controllers\Hod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use App\Rules\MatchOldPassword;
use DB;
use Carbon\Carbon;
use Session;
use App\Models\User;
use Auth;
use Masterminds\HTML5;
use Barryvdh\DomPDF\Facade\Pdf;


class HodController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }  
	    public function dashboard(Request $request)
    {

		 return view('admin.hod.home');
    }
      public function courseListHod(Request $request)
    {  
       $type = Auth::user()->type;
	   if($type=='HOD')
	   {
	       
	      $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT department FROM `faculity` where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
	     $list = DB::select("SELECT course.course_name,course.id FROM `departments` join course on departments.`id`=course.departments
join faculity on faculity.department=departments.`department`
where faculity.department='$deprtmentname'  group by(course.id) order by id asc"); //and (course_type='UG' OR course_type='PG' OR course_type='PhD')
	     return view('admin.hod.programList',compact('list'));
	   }else
	   {
	       $facultyid= Auth::user()->profile_id; 
	       $list = DB::select("SELECT `course_id` as id,`course_name` FROM `paper_assign` WHERE `faculty_id`='$facultyid' group by `course_id` order by id asc"); //and (course_type='UG' OR course_type='PG' OR course_type='PhD')
	     return view('admin.hod.programList',compact('list'));
	   }
	   
	   
    }
	
	  //autocomplete Search
    
        public function autocompleteSearchPaper(Request $request)
    {
          $query = $request->search;
          
          $filterResult = DB::select("SELECT id,p_code,p_name FROM papers where `p_code` LIKE '$query%' OR p_name LIKE '$query%' ");
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->p_code.','.$val->p_name,
				"value" => $val->id,
			
			);
			} 
			}
			else
			{
			    $data = [
  'message'=> 'No Record Found'
] ;
			}
          return response()->json($data);
     } 
    
    
           public function autocompleteSearchBatch(Request $request)
    {
          $query = $request->search;
          
          $filterResult = DB::select("SELECT batch FROM students where `batch` LIKE '$query%' group by batch ");
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->batch,
				"value" => $val->batch,
			
			);
			} 
			}
			else
			{
			    $data = [
  'message'=> 'No Record Found'
] ;
			}
          return response()->json($data);
     } 
    
	           public function addPaperAssign(Request $request)
    {   
    
		$courseid=$request->id;
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
	    $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	    $faculty=DB::select("SELECT fid,name FROM `faculity` GROUP by fid");
	     $paper=DB::select("SELECT id,p_code FROM `papers` GROUP by id");
	    $list= DB::select("SELECT paper_assign.*,faculity.name as faculty,papers.p_code,papers.p_name FROM `paper_assign` left join faculity on paper_assign.faculty_id=faculity.fid
left join papers on papers.id=paper_assign.paper_id where paper_assign.`course_id`='$courseid'");
	    return view('admin.hod.paper_assign',compact('coursename','batch','courseid','coursename','faculty','list','paper'));
	  
    }
	 public function savePaperAssign(Request $request)
    {
         $coursename=$request->editid;
         $courseid=$request->editidcourse;
       
        

		 $count = count($request->p_name);
	
      for($i=0;$i<$count;$i++)
      {      
        

		   $data1 = array(
             "course_id" => $courseid ,
             "course_name" => $coursename ,
             "faculty_id" =>$request->p_name[$i], 
             "paper_id" =>$request->skillid[$i], 	
             "batch" =>$request->skillidbatch[$i],
             "semester" =>$request->p_semester[$i]
           ); 
 
           $result=DB::table('paper_assign')->insert($data1);
           

}

	
	if($result==1){ 
                    	return response()->json(['success'=>'Paper has been Assigned for Particular Faculty,Batch & Program']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    
}
          public function deletePaperAssign(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE paper_assign.* FROM  paper_assign where paper_assign.id='$id'  ");
   
	 
	 return redirect()->back()->with('status', ' Paper Assigned Record Deleted Successfully !!');
               
   

    }
	       public function editfetchmarks(Request $request)
    {   	$id=$request->id;
        $fetch_internalmarks = DB::select("SELECT * FROM `internal_marks` where internal_marks.id='$id'");
     
        
	
			$paper_code=$fetch_internalmarks[0]->paper_code;
		    $assignment=$fetch_internalmarks[0]->assignment;
		    $seminar=$fetch_internalmarks[0]->seminar;
            $test=$fetch_internalmarks[0]->test;
            $others=$fetch_internalmarks[0]->others;
            $sum=$fetch_internalmarks[0]->sum;
            $internalgrade=$fetch_internalmarks[0]->internalgrade;
            $percent=$fetch_internalmarks[0]->percent;
            $grade_point=$fetch_internalmarks[0]->grade_point;
            //$max_mark=$fetch_internalmarks[0]->max_mark;
		 
		$data[] = array('paper_code'=>$paper_code,'assignment'=>$assignment,'seminar'=>$seminar,'test'=>$test,'others'=>$others,'sum'=>$sum,'internalgrade'=>$internalgrade,'percent'=>$percent,'grade_point'=>$grade_point);

		echo json_encode($data);
        
    }
            public function editfetchmarks_external(Request $request)
    {   	$id=$request->id;
        $fetch_internalmarks = DB::select("SELECT * FROM `external_marks` where external_marks.id='$id'");
      
        
	
			$paper_code=$fetch_internalmarks[0]->paper_code;
		    $credits=$fetch_internalmarks[0]->credits;
		    $external_grade=$fetch_internalmarks[0]->external_grade;
            $internal_grade	=$fetch_internalmarks[0]->internal_grade;
            $total_grade=$fetch_internalmarks[0]->total_grade;
            $credit_point=$fetch_internalmarks[0]->credit_point;
            $status=$fetch_internalmarks[0]->status;
           
		 
		$data[] = array('paper_code'=>$paper_code,'credits'=>$credits,'external_grade'=>$external_grade,'internal_grade'=>$internal_grade,'total_grade'=>$total_grade,'credit_point'=>$credit_point,'status'=>$status);

		echo json_encode($data);
        
    }
              public function editfetchmarks_Overall(Request $request)
    {   	$id=$request->id;
        $fetch_internalmarks = DB::select("SELECT * FROM `overall_marks` where overall_marks.id='$id'");
      
		    $sgpa=$fetch_internalmarks[0]->sgpa;
		    $cgpa=$fetch_internalmarks[0]->cgpa;
            $grade=$fetch_internalmarks[0]->grade;
		 
		$data[] = array('sgpa'=>$sgpa,'cgpa'=>$cgpa,'grade'=>$grade);

		echo json_encode($data);
        
    }
	         	function updateInternalMarks(Request $request)
    {
       
       $dataArray = array(
       
        'assignment' => $request->intassignment,
         'seminar' => $request->intseminar,
        'test' => $request->inttest,
         'others' => $request->intothers,
        'sum' => $request->intsum,
         'internalgrade' => $request->intinternalgrade,
        'percent' => $request->intpercent,
        'grade_point' => $request->intgrade_point,
        
        );
   $editid = $request->inteditid;
   $id= DB::table('internal_marks')->where('id', $editid)->update($dataArray);

if($id!='')
{
    echo 'success';
}
     
    }
    
            	function updateOverallMarks(Request $request)
    {
       
       $dataArray = array(
       
        'sgpa' => $request->ovsgpa,
        'cgpa' => $request->ovcgpa,
        'grade' => $request->ovgrade,
        
        
        );
   $editid = $request->oveditid;
   $id= DB::table('overall_marks')->where('id', $editid)->update($dataArray);

if($id!='')
{
    echo 'success';
}
     
    }
    
           	function updateExternalMarks(Request $request)
    {
       
       $dataArray = array(
       
        'credits' => $request->extcredits,
        'external_grade' => $request->extexternalgrade,
        'internal_grade' => $request->extinternalgrade,
         'total_grade' => $request->exttotalgrade,
        'credit_point' => $request->extcreditpoint,
         'status' => $request->extexamstatus,
      
        );
   $editid = $request->exteditid;
   $id= DB::table('external_marks')->where('id', $editid)->update($dataArray);

if($id!='')
{
    echo 'successs';
}
     
    }
         public function semPaperView(Request $request)
    {   
     $type = Auth::user()->type;
	   if($type=='HOD')
	   {
		$courseid=$request->id;
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
	    $list = DB::select("SELECT * FROM `students` WHERE `program`='$coursename'");
	    $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	    return view('admin.hod.semViewList',compact('list','batch','courseid'));
	   }else
	   {
	       
	       	$facultyid= Auth::user()->profile_id;
	        $courseid=$request->id;
		
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
			
	    $list = DB::select("SELECT * FROM `students` join paper_assign on students.batch = paper_assign.batch and students.semester= paper_assign.semester and students.program=paper_assign.course_name WHERE paper_assign.faculty_id='$facultyid' AND course_name = '$coursename'");
		
	    $batch=DB::select("SELECT batch FROM `paper_assign` where paper_assign.faculty_id='$facultyid' GROUP by batch");
		
	    return view('admin.hod.semViewList',compact('list','batch','courseid'));
	    
	   
	   }

		
    }
	          public function editStudent(Request $request)
    {   
     set_time_limit(0);
		$id=$request->id;
	    $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
	     $countrylist =  DB::select("SELECT country_id,country_name from country "); 
        $profile_edit= DB::select("SELECT * FROM `students` WHERE `id`='$id'");
    
		return view('admin.hod.editStudent',compact('profile_edit','course','countrylist'));
		
    }
          public function editStudentinfo(Request $request)
    {
       $studentid = $request->editid;
       
       $rel=$request->relegion;
        if($rel!='')
        {
        if($rel=='Others')
        {
            $relecat=$request->otherrelegion;
        }else
        {
            $relecat=$request->relegion;
        }
        } else
        {
           $relecat=''; 
        }
         if($request->file1)
		{
		    $file = $request->file('file1');
           
            $fileName = time().'.'.$request->file1->extension();  
            $file->move(public_path().'/uploads/student/', $fileName);    
       // $fileName = time().'.'.$request->file1->extension();  
         
       // $request->file1->move(public_path('uploads/facultyresume'), $fileName);
			 
        }
		else{
			$fileName= $request->current_file;
		}
		
	
		
		 if($request->file('filecardcaste')) 
		{ 
        
            $file = $request->file('filecardcaste');
            $filenamecardcaste = time() . '.' . $request->file('filecardcaste')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $filenamecardcaste);
        }
        else
        {
            $filenamecardcaste=$request->current_file_income;
        }
         if($request->file('filecardexam')) 
		{ 
        
            $file = $request->file('filecardexam');
            $filenamecardexam = time() . '.' . $request->file('filecardexam')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $filenamecardexam);
        }
        else
        {
            $filenamecardexam=$request->current_file_exam;
        }
         if($request->file('filecardpassbook')) 
		{ 
        
            $file = $request->file('filecardpassbook');
            $filenamecardpassbook = time() . '.' . $request->file('filecardpassbook')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $filenamecardpassbook);
        }
        else
        {
            $filenamecardpassbook=$request->current_file_passbook;
        }
		
		if($request->hasFile('image')){
		    $products = DB::select("SELECT `profile_pic` FROM `students` WHERE id='$studentid'");
			  $path = public_path("uploads/student/" . $products[0]->profile_pic);
			  if (file_exists($path)) {
              @unlink($path);
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/student'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
			  }
        }
        else{
		$picture=$request->current_file_img;
		}
		 $dataArray      =  array(
	"name" => $request->name,
	"cap_id" => $request->capid,
    "academic_year" => $request->academic,
	"batch" => $request->batch,
	"roll_no" => $request->rollnum,
	"university_regno" => $request->universityreg,
	"admission_no" => $request->admission,
	"program" => $request->program,
	"semester" => $request->p_semester,
	"relegion" => $relecat,
	"caste" => $request->caste,
	"minority_category" => $request->mcat,
	"reservation_category" => $request->reservationcat,
	"gender" => $request->gender,
	"whats_app" =>  $request->whatsapp,
	"contact_number" => $request->phonenum,
	"email" => $request->email,
	"parent_name" => $request->guardianname,
	 'parent_phonenum' => $request->guardianphone,
	 'parent_whatsapp'=> $request->guardianwhatsapp,
	 'language'=> $request->language,
	 'proof_type'=> $request->prooftype,
	 'Proof_no'=> $request->proofno,
	  'proof_doc' => $fileName,
	  'caste_income_upload'=> $filenamecardcaste,
	 'qualify_exam_certificate_upload'=> $filenamecardexam,
	 'bank_passbook_upload'=> $filenamecardpassbook,
	 'profile_pic' => $picture,
	 'address'=> $request->address,
	 'Nationality'=> $request->country,
	 'state'=> $request->state,
	 'city'=> $request->city,
	 'pincode'=> $request->pincode,
	
   );
	$current_date_time = Carbon::now()->toDateTimeString();
         $id= DB::table('students')->where('id', $studentid)->update($dataArray);

	
	
	if($id){ 
                    	return response()->json(['success'=>'Student Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
         public function markSheet(Request $request)
    {   
    
		$courseid=$request->id;
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
	   // $list = DB::select("SELECT * FROM `students` WHERE `program`='$coursename'");
	    $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	    return view('admin.hod.markSheet',compact('coursename','batch','courseid'));

		
    }
           public function addTutor(Request $request)
    {   
    
		$courseid=$request->id;
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
	    $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	    $faculty=DB::select("SELECT name FROM `faculity` GROUP by name");
	    $list= DB::select("SELECT * FROM `tutor_assign` WHERE `course_id`='$courseid'");
	    return view('admin.hod.addTutor',compact('coursename','batch','courseid','coursename','faculty','list'));
	  
    }
             public function assignSem(Request $request)
    {   
    
		$courseid=$request->id;
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
	    $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	    $faculty=DB::select("SELECT name FROM `faculity` GROUP by name");
	    $list= DB::select("SELECT * FROM `tutor_assign` WHERE `course_id`='$courseid'");
	    $semlist=DB::select("SELECT batch,semester FROM `students` WHERE `program`='$coursename' GROUP BY batch");
	    return view('admin.hod.assignSem',compact('coursename','batch','courseid','coursename','faculty','list','semlist'));
	  
    }
       public function updateSemester(Request $request)
    {
       $data = array(
      'semester' => $request->semester,
         );
   $program=$request->program;
   $batch=$request->batch;
   
   DB::table('students')->where('program',$program)->where('batch',$batch)->update($data);


    Session::flash('status', 'Update semester has been added '); 
      return response()->json([
       'success'  => 'Update semester has been added',

      ]);
     
}

           public function deleteTutor(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE tutor_assign.* FROM  tutor_assign where tutor_assign.id='$id'  ");
   
	 
	 return redirect()->back()->with('status', ' Tutor Assigned Record Deleted Successfully !!');
               
   

    }
      public function saveTutor(Request $request)
    {
         $coursename=$request->editid;
         $courseid=$request->editidcourse;
       
        

		 $count = count($request->p_name);
	
      for($i=0;$i<$count;$i++)
      {      
        

		   $data1 = array(
             "course_id" => $courseid ,
             "course_name" => $coursename ,
             "tutor" =>$request->p_name[$i], 
             "batch" =>$request->p_type[$i],
             "semester" =>$request->p_semester[$i]
    
             ); 
 
           $result=DB::table('tutor_assign')->insert($data1);
           

}

	
	if($result==1){ 
                    	return response()->json(['success'=>'Tutor has been Assigned for Particular Batch & Program']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    
}
         public function searchMarksheet(Request $request)
    {  
	   $coursename = $request->coursename;
	   $courseid = $request->courseid;
	   $selbatch= $request->batch;
	   $semester= $request->semester;
	    $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	   $list = DB::select("SELECT * FROM `internal_marks` WHERE `program`='$coursename' and batch='$selbatch' and `Semester`='$semester'"); 
	   
	   $paper = DB::select("SELECT DISTINCT `paper_code`,`name_of_paper` FROM `internal_marks` WHERE `program`='$coursename' and batch='$selbatch' and `Semester`='$semester' order by paper_code ASC"); 
	 
	   $studentdetails = DB::select("SELECT DISTINCT `stid`,`stname`,`name_of_paper` FROM `internal_marks` WHERE `program`='$coursename' and batch='$selbatch' and `Semester`='$semester' order by name_of_paper ASC"); 
	// $empdetail=array();
	 $empdetail = []; 
	    $papers = []; 
	 foreach($studentdetails as $userdata){
	     $studentid=$userdata->stid;
	     $subjects=$userdata->name_of_paper;
	     
	      $checkpaper = DB::select("SELECT grade_point,name_of_paper,stname,paper_code FROM `internal_marks` WHERE `stid`='$studentid'and `program`='$coursename' and batch='$selbatch' and `Semester`='$semester' order by paper_code"); 
	      
	      $i=0;
	     foreach($checkpaper as $paperdata){
	         
	         $papers[$paperdata->paper_code]=$paperdata->paper_code.''.$paperdata->name_of_paper;
	           //$papers[$paperdata->name_of_paper]=$paperdata->name_of_paper;
	        $empdetail[$studentid]['stname']= $paperdata->stname;
	        $empdetail[$studentid]['paper'.$i]= $paperdata->grade_point;
	     
	        
	   $i++;      
	 } 
	 
	 }

/*$table='<table border="1">';
$table.='<th>Student Name</th>';
foreach($papers as $pkey=>$p_val)
{
    $table.='<th>'.$p_val.'</th>';
}

	foreach($empdetail as $key=>$val)
			{
			   $size=  sizeof($empdetail[$key]);
			  $table.= '<tr><td>'.$val['stname'].'</td>';
			  for($i=0;$i<$size-1;$i++)
			  {
			      $table.= '<td>'.$val['paper'.$i].'</td>';
			  }
			   $table.= '</tr>';
			}
			  $table.= '</table>';
echo $table;*/
	     return view('admin.hod.markSheet',compact('list','selbatch','courseid','paper','batch','coursename','empdetail','papers'));
	   
    }
          public function searchList(Request $request)
    { 
        if($request->filter == 'refine'){	
	   $courseid = $request->courseid;
	   $course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	   $coursename=$course[0]->course_name;
	   $selbatch= $request->batch;
	   $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	   $semester= $request->semester;
	   $list = DB::select("SELECT * FROM `students` WHERE `program`='$coursename' and batch='$selbatch'"); 
	     return view('admin.hod.semViewList',compact('list','batch','courseid'));
		  }
		    if($request->filter == 'download'){
    
        $fileName = 'student.csv';
         $courseid = $request->courseid;
	   $course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	   $coursename=$course[0]->course_name;
	   $selbatch= $request->batch;
	   $batch=DB::select("SELECT batch FROM `students` GROUP by batch");
	   $semester= $request->semester;
	   $list = DB::select("SELECT * FROM `students` WHERE `program`='$coursename' and batch='$selbatch'"); 
    $tasks = DB::select("SELECT `name`,`cap_id`,`academic_year`,`batch`,`roll_no`,`university_regno`,`admission_no`,`program`,`semester`,`gender`,`relegion`,`reservation_category`,`dob`,`email`,`date_of_admission`,`caste` FROM `students` WHERE `program`='$coursename' and batch='$selbatch'");
 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name','CAP ID','Academic Year','Batch','Roll No','University RegNo','Admission No','Program','Semester','Gender','Relegion','Reservation Category','Date Of Birth','Email','Date Of Admission','Caste');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Name']  = $task->name;
                $row['CAP ID']  = $task->cap_id;
                $row['Academic Year']  = $task->academic_year;
                 $row['Batch']  = $task->batch;
                 $row['Roll No']  = $task->roll_no;
                 $row['University RegNo']  = $task->university_regno;
                 $row['Admission No']  = $task->admission_no;
                  $row['Program']  = $task->program;
                 $row['Semester']  = $task->semester;
                 $row['Gender']  = $task->gender;
                 $row['Relegion']  = $task->relegion;
                 $row['Reservation Category']  = $task->reservation_category;
                 $row['Date Of Birth']  = $task->dob;
                 $row['Email']  = $task->email;
                $row['Date Of Admission']  = $task->date_of_admission;
                $row['Caste']  = $task->caste;
               
                fputcsv($file, array($row['Name'],$row['CAP ID'],$row['Academic Year'],$row['Batch'],$row['Roll No'],$row['University RegNo'],$row['Admission No'],$row['Program'],$row['Semester'],$row['Gender'],$row['Relegion'],$row['Reservation Category'],$row['Date Of Birth'],$row['Email'],$row['Date Of Admission'],$row['Caste']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
      return view('admin.hod.semViewList',compact('list','batch','courseid')); 
			}
    }
        public function studentProgression(Request $request)
    {   
     
		  $type = Auth::user()->type;
	   if($type=='HOD')
	   {
		//$rollno=$request->id;
		//$studentid= DB::select("SELECT id FROM `students` WHERE `roll_no`='$rollno'");
		//$id=$studentid[0]->id;
		$id = $request->id;
		$batch=$request->batch;
		 $students = DB::select("SELECT * FROM `students` WHERE `id`='$id'"); 
		 
		 $program=$students[0]->program;
		 $courselist = DB::select("SELECT id FROM `course` WHERE `course_name`='$program'"); 
		 $courseid=$courselist[0]->id;
		 $papername=DB::select("SELECT 	p_name FROM `papers` WHERE `course_id`='$courseid'"); 
		 $complimentry=DB::select("SELECT p_name FROM `papers` where `theory_subdivision`='Complimentery' OR `theory_subdivision`='firstlanguage' OR `theory_subdivision`='secondlanguage'"); 
		 $complimentrycode=DB::select("SELECT p_code FROM `papers` where `theory_subdivision`='Complimentery' OR `theory_subdivision`='Complimentery' OR `theory_subdivision`='firstlanguage' OR `theory_subdivision`='secondlanguage'"); 
		 $papercode=DB::select("SELECT 	p_code FROM `papers` WHERE `course_id`='$courseid'");
		 $name=$students[0]->name;
    	$internalmarks = DB::select("SELECT * FROM `internal_marks` where internal_marks.stid='$id' and type='Main' order by `Semester`");
    
    	$commarks = DB::select("SELECT * FROM `internal_marks` where internal_marks.stid='$id' and (type='Complimentery' OR type='Firstlanguage' OR type='Secondlanguage')");
		$externalmarks = DB::select("SELECT * FROM `external_marks` where external_marks.stid='$id' and type='Main'");
		$externalmarkscompliment = DB::select("SELECT * FROM `external_marks` where external_marks.stid='$id'and (type='Complimentery' OR type='Firstlanguage' OR type='Secondlanguage')");
		$overall = DB::select("SELECT * FROM `overall_marks` where overall_marks.stid='$id'");
		$project = DB::select("SELECT * FROM `project_internship` where project_internship.stid='$id'");
		$field = DB::select("SELECT * FROM `industry_marks` where  industry_marks.stid='$id'");
		return view('admin.hod.studentProgression',compact('id','batch','program','name','internalmarks','papercode','papername','externalmarks','overall','project','field','commarks','complimentry','complimentrycode','externalmarkscompliment'));
	   }
	   else
	   {
	       $facultyid= Auth::user()->profile_id; 
	       $rollno=$request->id;
		$studentid= DB::select("SELECT id FROM `students` WHERE `roll_no`='$rollno'");
		$id=$studentid[0]->id;
		$batch=$request->batch;
		 $students = DB::select("SELECT * FROM `students` WHERE `id`='$id'"); 
		 
		 $program=$students[0]->program;
		 $courselist = DB::select("SELECT id FROM `course` WHERE `course_name`='$program'"); 
		 $courseid=$courselist[0]->id;
	
		 $papername=DB::select("SELECT p_name FROM `papers`  join paper_assign on paper_assign.paper_id=papers.id where paper_assign.faculty_id='$facultyid' and paper_assign.course_id='$courseid'"); 
		 $complimentry=DB::select("SELECT p_name FROM `papers`  join paper_assign on paper_assign.paper_id=papers.id where paper_assign.faculty_id='$facultyid' and paper_assign.course_id='$courseid'and (papers.`theory_subdivision`='Complimentery' OR papers.`theory_subdivision`='firstlanguage' OR papers.`theory_subdivision`='secondlanguage')"); 
		 $complimentrycode=DB::select("SELECT p_code FROM `papers` join paper_assign on paper_assign.paper_id=papers.id where paper_assign.faculty_id='$facultyid' and paper_assign.course_id='$courseid' and (papers.`theory_subdivision`='Complimentery' OR papers.`theory_subdivision`='firstlanguage' OR papers.`theory_subdivision`='secondlanguage')"); 
		 $papercode=DB::select("SELECT 	p_code FROM `papers` join paper_assign on paper_assign.paper_id=papers.id where paper_assign.faculty_id='$facultyid' and paper_assign.course_id='$courseid'");
		 $name=$students[0]->name;
    	$internalmarks = DB::select("SELECT * FROM `internal_marks` where internal_marks.stid='$id' and type='Main' order by `Semester`");
    
    	$commarks = DB::select("SELECT * FROM `internal_marks` where internal_marks.stid='$id' and (type='Complimentery' OR type='Firstlanguage' OR type='Secondlanguage')");
		$externalmarks = DB::select("SELECT * FROM `external_marks` where external_marks.stid='$id' and type='Main'");
		$externalmarkscompliment = DB::select("SELECT * FROM `external_marks` where external_marks.stid='$id'and (type='Complimentery' OR type='Firstlanguage' OR type='Secondlanguage')");
		$overall = DB::select("SELECT * FROM `overall_marks` where overall_marks.stid='$id'");
		$project = DB::select("SELECT * FROM `project_internship` where project_internship.stid='$id'");
		$field = DB::select("SELECT * FROM `industry_marks` where  industry_marks.stid='$id'");
		return view('admin.hod.studentProgression',compact('id','batch','program','name','internalmarks','papercode','papername','externalmarks','overall','project','field','commarks','complimentry','complimentrycode','externalmarkscompliment'));
	   }
			
		
    }
         public function individualMarks(Request $request)
    {   
     
		    $id=$request->id;
		
			// $students = DB::select("SELECT * FROM `students` WHERE `id`='$id'"); 
			$students = DB::select("SELECT * FROM `students` WHERE `roll_no`='$id'"); 
		 $program=$students[0]->program;
		 $name=$students[0]->name;
		 $stid=$students[0]->id;
		 
		 $courselist = DB::select("SELECT id FROM `course` WHERE `course_name`='$program'"); 
		 $courseid=$courselist[0]->id;
		$batch=$request->batch;
	
		 	$externalmarks = DB::select("SELECT * FROM `external_marks` where external_marks.stid='$stid' and type='Main'");
		return view('admin.hod.individualMarks',compact('stid','batch','program','name','courseid'));
	}
          public function autocompleteSearch(Request $request)
    {
          $query = $request->search;
          
          $filterResult = DB::select("SELECT fid,name FROM faculity where `name` LIKE '$query%' OR name LIKE '$query%'");
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->name,
				"value" => $val->fid,
			
			);
			} 
			}
			else
			{
			    $data = [
  'message'=> 'No Record Found'
] ;
			}
          return response()->json($data);
     } 
       public function deleteMarks(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE internal_marks.* FROM  internal_marks where id='$id'  ");
     
	return redirect()->back()->with('status', ' Internal Marks has been deleted successfully !!');
   

    }
        
       public function deleteExternalMarks(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE external_marks.* FROM  external_marks where id='$id'  ");
     
	return redirect()->back()->with('status', ' External Marks has been deleted successfully !!');
   

    } 
          public function deleteOverallMarks(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE overall_marks.* FROM  overall_marks where id='$id'  ");
     
	return redirect()->back()->with('status', 'Overall Marks has been deleted successfully !!');
   

    } 
           public function deleteProjectMarks(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE project_internship.* FROM  project_internship where id='$id'  ");
     
	return redirect()->back()->with('status', 'Project Marks has been deleted successfully !!');
   

    } 
              public function deleteIndustryMarks(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE industry_marks.* FROM  industry_marks where id='$id'  ");
     
	return redirect()->back()->with('status', 'IndustryVisit/FieldWork Marks has been deleted successfully !!');
   

    } 
     	function saveIndustryMarks(Request $request)
    {
       $data = array(
        'program' => $request->programfield,
        'batch' => $request->batchfield,
        'stname' => $request->stnamefield,
        'stid' => $request->stidfield,
        'Semester' => $request->Semesterfield,
        'title_industry' => $request->industrial_visit,
         'supervising_teacher' => $request->supervising_teacher_field,
        'no_of_days' => $request->num_of_days,
         'name_of_industry_visited' => $request->name_of_industry,
        'period' => $request->period_field,
         'course_related' => $request->course_paper,
       
        );
   
   $insertId= DB::table('industry_marks')->insertGetId( $data);


    Session::flash('status', 'Industry Marks has been added '); 
      return response()->json([
       'success'  => 'Industry Marks has been added',
       'insertId'=>$insertId
      ]);
     
    }
    
      	function saveInternalMarks(Request $request)
    {
       
       $data = array(
        'program' => $request->program,
        'batch' => $request->batch,
        'stname' => $request->stname,
        'stid' => $request->stid,
         'Semester' => $request->Semester,
        'name_of_paper' => $request->name_of_paper,
         'paper_code' => $request->paper_code,
        'assignment' => $request->assignment,
         'seminar' => $request->seminar,
        'test' => $request->test,
         'others' => $request->others,
        'sum' => $request->sum,
         'internalgrade' => $request->internalgrade,
        'percent' => $request->percent,
        'grade_point' => $request->gradepoint,
        	'type'=>$request->type
        );
   
   $insertId= DB::table('internal_marks')->insertGetId( $data);


    Session::flash('status', 'Internal Marks has been added '); 
      return response()->json([
       'success'  => 'Internal Marks has been added',
       'insertId'=>$insertId
      ]);
     
    }
    
         	function saveProjectMarks(Request $request)
    {
       $data = array(
        'program' => $request->programproject,
        'batch' => $request->batchproject,
        'stname' => $request->stnameproject,
        'stid' => $request->stidproject,
         'Semester' => $request->Semesterproject,
        'title_project' => $request->project,
         'supervising_teacher' => $request->supervising_teacher,
        'name_of_institution' => $request->name_of_instituition,
         'internship_note' => $request->intership_note,
        'Period' => $request->Period,
       
        );
   
   $insertId= DB::table('project_internship')->insertGetId( $data);


    Session::flash('status', 'Project Marks has been added '); 
      return response()->json([
       'success'  => 'Project Marks has been added',
       'insertId'=>$insertId
      ]);
     
    }
      	function saveOverallMarks(Request $request)
    {
       $data = array(
        'program' => $request->programoverall,
        'batch' => $request->batchoverall,
        'stname' => $request->stnameoverall,
        'stid' => $request->stidoverall,
         'Semester' => $request->Semesteroverall,
        'sgpa' => $request->sgpa,
         'grade' => $request->gradeov,
        'cgpa' => $request->cgpa,
        
        );
   
   $insertId= DB::table('overall_marks')->insertGetId( $data);


    Session::flash('status', 'Overall Marks has been added '); 
      return response()->json([
       'success'  => 'Overall Marks has been added',
       'insertId'=>$insertId
      ]);
     
    }
    
    
       	function saveExternalMarks(Request $request)
    {
       $data = array(
        'program' => $request->programexternal,
        'batch' => $request->batchexternal,
        'stname' => $request->stnameexternal,
        'stid' => $request->stidexternal,
         'Semester' => $request->Semesterexternal,
        'name_of_paper' => $request->name_of_paper_external,
         'paper_code' => $request->paper_code_external,
        'credits' => $request->credits,
         'external_grade' => $request->externalgrade,
        'internal_grade' => $request->internalgrade_exteranl,
         'total_grade' => $request->totalgrade_external,
        'credit_point' => $request->creditpoint,
         'status' => $request->status_external,
         	'type'=>$request->type
        );
   
   $insertId= DB::table('external_marks')->insertGetId( $data);


    Session::flash('status', 'External Marks has been added '); 
      return response()->json([
       'success'  => 'External Marks has been added',
       'insertId'=>$insertId
      ]);
     
    }
    public function fetchSem(Request $request)
    {
        $batch = $request->id;
		
    //     //$academicyear=date('Y').'-'.(date('Y')+1);
    //     $currentYear=date("Y");
    //      $currentMonth=date("m"); 
    //     if($currentMonth >="06") 
    //   $academicyear= ($currentYear).'-'.($currentYear + 1);
    //   if($currentMonth < "06")
    //     $academicyear= ($currentYear-1).'-'.($currentYear);
      
    //      $month = date('m');
         $semarray= DB::select("SELECT `semester` FROM `students` WHERE  batch='$batch' GROUP BY batch"); 
         if($semarray[0]->semester!='')
         {
         $semname=$semarray[0]->semester;
         } else
         {
             $semname='';
         }
       	$data[] = array("semname"=>$semname);
	   	echo json_encode($data);
    }
      public function fetchPapername(Request $request)
    {
        $type = $request->id;
        $data['complimentry'] = DB::select("SELECT * FROM `papers` where `theory_subdivision`='$type'"); 
        return response()->json($data);
    }
        public function fetchExternal_marksheet(Request $request)
    {
        
            $semester = $request->semester;
			$batch = $request->batch;
			$studentid = $request->studentid;
	        $coursename = $request->coursename;
			
           $result_set = DB::select("SELECT external_marks.* FROM `external_marks` where `external_marks`.stid='$studentid' and `external_marks`.batch='$batch' and `external_marks`.Semester='$semester' order by id ASC");
         
           $overallMarks = DB::select("SELECT overall_marks.*,students.roll_no FROM `overall_marks` left join students on students.id= overall_marks.stid where `overall_marks`.stid='$studentid' and `overall_marks`.batch='$batch' and `overall_marks`.Semester='$semester'");
 
             $regno=$overallMarks[0]->roll_no;
             $examination=$overallMarks[0]->Semester .'-'. $overallMarks[0]->program;
              $name=$overallMarks[0]->stname;
                 $sgpa=$overallMarks[0]->sgpa;
             $grade=$overallMarks[0]->grade;
              $cgpa=$overallMarks[0]->cgpa;
        
         $result_html = '';
        foreach($result_set as $result){
	     $papercode=$result->paper_code; 
	     $papername=$result->name_of_paper;
	    $credits= $result->credits ;
        $extgrade=$result->external_grade;
        $intgrade= $result->internal_grade ;
        $totgrade=$result->total_grade;
       $creditpoint=$result->credit_point;
         $passed=$result->status;
        
        $result_html .= '
            <tr>
                <td>' . $papercode . '</td>,
                <td>' . $papername . '</td>,
                <td>' .  $credits . '</td>,
                <td>' . $extgrade . '</td>,
                <td>' . $intgrade . '</td>,
                <td>' . $totgrade . '</td>,
                <td>' . $creditpoint . '</td>,
                 <td>' . $passed . '</td>,
            </tr>';          
	   
            
        
    }
  $data= array( 'regno'=>$regno,'examination'=>$examination ,'name'=>$name,'sgpa'=>$sgpa,'grade'=>$grade,'cgpa'=>$cgpa,'result'=>$result_html);
        
		
    echo json_encode($data);
        
        
    }
    
}