<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Validator;
use App\Rules\MatchOldPassword;
use DB;
use Carbon\Carbon;
use Session;
use App\Models\User;
use Auth;
use Symfony\Component\HttpFoundation\Response;

use Masterminds\HTML5;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
     $course =  DB::select("SELECT count(id) as program FROM `course`"); 
    
      $cell =  DB::select("SELECT count(id) as cell FROM `cell`"); 
       $department =  DB::select("SELECT count(id) as dept FROM `departments`"); 
         return view('admin.officeadmin.home',compact('course','cell','department'));
    }
    public function addStudent()
    {    $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
        $countrylist =  DB::select("SELECT country_id,country_name from country "); 
         return view('admin.officeadmin.addStudent',compact('course','countrylist'));
    }
    /**************************tc*********************/
	 public function addCertificate()
    { 
         return view('admin.officeadmin.addCertificate');
    }
    public function addTc()
    {    $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
         return view('admin.officeadmin.tcStudent',compact('course'));
    }
      public function autocompleteSearch(Request $request)
    {
          $query = $request->search;
          
          $filterResult = DB::select("SELECT id,admission_no,name,program,batch FROM students where `admission_no` LIKE '$query%' OR name LIKE '$query%' ");
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->admission_no.','.$val->name,
				"value" => $val->id,
				"name" => $val->name,
				"program" => $val->program,
			    "batch" => $val->batch
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
	 
	     public function autocompleteSearchstudent(Request $request)
    {
          $query = $request->search;
          $program =$request->program;
		
          $filterResult = DB::select("SELECT id,admission_no,name FROM students where program='$program' AND name LIKE '$query%' OR admission_no LIKE '$query%'");
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->admission_no.','.$val->name,
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
	 
	 public function downloadCertificate(Request $request) {
		 
		
			
			 		 $dataArray      =  array(
	"conduct_number" =>$request->conductnumber,
    "period_date" => $request->dateperiod,
	"name" => $request->name,
	"programme" => $request->program,
	"academic_year" => $request->year,
	"type" => $request->type,
	
	  );
	  
	$id  =   DB::table('conduct_certificate')->insertGetId($dataArray);
		 $list = DB::select("SELECT  * FROM `conduct_certificate` where id='$id'");
		//  return view('admin.officeadmin.conductpdf',compact('list'));
 $pdf = PDF::loadView('admin.officeadmin.conductpdf', compact('list'));
 return $pdf->download('conduct.pdf');
 
DB::delete("DELETE conduct_certificate.* FROM  conduct_certificate where id='$id'");
	 }
	 
      public function storeTc(Request $request) {
         $studentid=$request->editid;
        
         if($studentid=='')
         {
         $dataupdate      =  array(
            "name" => $request->studentname,
	        "tc_issued" => 'Y',
	        "admission_no" => $request->admissionno,
	
   );
   	$getid  =   DB::table('students')->insertGetId($dataupdate);
   	
   		 $dataArray      =  array(
	"student_id" => $getid,
	"tc_number" =>$request->tc,
    "created_date" => $request->datetoday,
	"name_of_student" => $request->studentname,
	"name_of_father" => $request->guardian,
	"dob" => $request->dobfigure,
	"admission_regno" => $request->admissionno,
	"nationality" => $request->Nationality,
	"relegion" => $request->Religion,
	"reservation_category" => $request->category,
	"class_date_of_admission" => $request->Admissiondate,
	"class_date_of_leaving" =>  $request->dateofLeaving,
	"subject_studied" => $request->program,
	"course_completion" => $request->coursecompleted,
	"fees_paid" => $request->feesPaid,
	 'university_examination_details' => $request->universityreg,
	 'university_name' => $request->university,
	 'student_grade'=> $request->studentgrade,
	 'reason_for_leaving'=> $request->leavingReason,
	 'character_conduct'=> $request->conductCharacter,
	  'date_of_applicationtc'=> $request->dateofapplication,
	  'date_of_issue'=> $request->dateofissue,
	  'updated_by' =>  Auth::user()->id
	  );
	  
	 	$id  =   DB::table('tc_report')->insert($dataArray);
	   $list = DB::select("SELECT  * FROM `tc_report` where `student_id`='$getid'");
 //return view('admin.officeadmin.pdf',compact('list'));
 $pdf = PDF::loadView('admin.officeadmin.pdf', compact('list'));
 return $pdf->download('tc.pdf');
         }else
         {
         $user= DB::table('tc_report')->where('student_id',$studentid)->first();
         if(!$user)
         {
         	 $dataArray      =  array(
	"student_id" => $request->editid,
	"tc_number" =>$request->tc,
    "created_date" => $request->datetoday,
	"name_of_student" => $request->studentname,
	"name_of_father" => $request->guardian,
	"dob" => $request->dobfigure,
	"admission_regno" => $request->admissionno,
	"nationality" => $request->Nationality,
	"relegion" => $request->Religion,
	"reservation_category" => $request->category,
	"class_date_of_admission" => $request->Admissiondate,
	"class_date_of_leaving" =>  $request->dateofLeaving,
	"subject_studied" => $request->program,
	"course_completion" => $request->coursecompleted,
	"fees_paid" => $request->feesPaid,
	 'university_examination_details' => $request->universityreg,
	  'university_name' => $request->university,
	 'student_grade'=> $request->studentgrade,
	 'reason_for_leaving'=> $request->leavingReason,
	 'character_conduct'=> $request->conductCharacter,
	  'date_of_applicationtc'=> $request->dateofapplication,
	  'date_of_issue'=> $request->dateofissue,
	  'updated_by' =>  Auth::user()->id

   );
   	 $dataupdate      =  array(
	"tc_issued" => 'Y',
	
   );
   
   if($request->statusgen == 2)
   {
	   $updtedid = $request->tcgennumber;
	   $updatednext = $updtedid+1; 
    $updtetc_randomnum      =  array(
	"gen_id" => $updatednext,
	);
   
   DB::table('self_generator')->where('id',1)->update($updtetc_randomnum);
   } 
    if($request->statusgen == 1){
	   $updtedid = $request->tcgennumber;
	   
	   $updatednext = $updtedid+1; 
	  
	    $updtetc_randlastest     =  array(
	  "gen_id" => $updatednext,
	);
  
   DB::table('aided_generator')->where('id',1)->update($updtetc_randlastest);
   }
   	//$result = DB::table('tc_report')->insert($dataArray);
     	$id  =   DB::table('tc_report')->insertGetId($dataArray);
     	DB::table('students')->where('id', $request->editid)->update($dataupdate);
	if($id)
	{
 $list = DB::select("SELECT  * FROM `tc_report` where `id`='$id'"); 
	//return view('admin.officeadmin.pdf',compact('list'));
 $pdf = PDF::loadView('admin.officeadmin.pdf', compact('list'));
 return $pdf->download('tc.pdf');
	}
         }
         else
         {
 $list = DB::select("SELECT  * FROM `tc_report` where `student_id`='$studentid'");
 
 //return view('admin.officeadmin.pdf',compact('list'));
 $pdf = PDF::loadView('admin.officeadmin.pdf', compact('list'));
 return $pdf->download('tc.pdf');
         }
         }
    }    
 public function fetchStates(Request $request)
    {
		$id= $request->country_id;
	
        $data['states'] = DB::select("SELECT * FROM state_province where country_id ='$id' ");
		
        return response()->json($data);
    }
     public function getStatebyid(Request $request)
    {
		$id= $request->stateid;
	
       // $data['states'] = DB::select("SELECT * FROM state_province where state_province_id ='$id' ");
$data = DB::table('state_province')->where('state_province_id', $id)->first();
          return response()->json($data);
    }
     public function getCityid(Request $request)
    {
		$id= $request->cityid;
	
       // $data['states'] = DB::select("SELECT * FROM state_province where state_province_id ='$id' ");
$data = DB::table('city')->where('id', $id)->first();
          return response()->json($data);
    }
     public function fetchCities(Request $request)
    {
		 $id= $request->state_id;
        $data['cities'] = DB::select("SELECT * FROM city where state_province_id ='$id' ");
        return response()->json($data);
    }
        public function fetchRecords(Request $request)
    {
           $studentid = $request->studentid;
         
         if($studentid==''||$studentid==0)
         {   $str='TC';
             	$data=array(); 
             	$pid='';
             	$tcnumber=$str.rand(1000, 9999).str_pad(00, 3, STR_PAD_LEFT);
             	$name= "";
			$parent_name= "";
			$dob="";
		    $dobword= "";
           	$admission=""; 
           	$nationality= "";   
           	$relegion= ""; 
           	$category= "";
           	$admissiondate= "";
           	$program= "";
           	$university_regno= "";
           	$created_date= "";
           	$class_date_of_leaving= "";
           	$course_completion= "";
           	$fees_paid= "";
           	$student_grade= "";
           	$reason_for_leaving= "";
           	$character_conduct= "";
           	$date_of_applicationtc= "";
           	$date_of_issue= "";
           	  $dataE = array( 'name'=>$name,'parent_name'=>$parent_name ,'pid'=>$pid,'tcnumber'=>$tcnumber,'dob'=>$dob,'dobword'=>$dobword,'admission'=>$admission,
            'nationality'=>$nationality,'relegion'=>$relegion,'category'=>$category,'admissiondate'=>$admissiondate,'program'=>$program,
            'university_regno'=>$university_regno,'created_date'=>$created_date,'class_date_of_leaving'=>$class_date_of_leaving,
            'course_completion'=>$course_completion,'fees_paid'=>$fees_paid,'student_grade'=>$student_grade,'reason_for_leaving'=>$reason_for_leaving,
            'character_conduct'=>$character_conduct,'date_of_applicationtc'=>$date_of_applicationtc,'date_of_issue'=>$date_of_issue
            );
         $data=array($dataE);
		echo json_encode($data);
             
         }else{
           $list = DB::select("select students.*,country.country_id,country.country_name from students left join country  on students.`Nationality`= country.country_id  where students.id='$studentid'"); 
         
              $tcissued=$list[0]->tc_issued;
         
             if($tcissued=='Y')
             {
                 $listtc=DB::select("SELECT * FROM `tc_report` where student_id='$studentid'");
                 	$data=array(); 
		foreach($listtc as $row){
	
			$pid=$row->student_id;
		    $tcnumber=strtoupper($row->tc_number);
		    $name= strtoupper($row->name_of_student);
			$parent_name= strtoupper($row->name_of_father);
			$dob=date('d-m-Y',strtotime($row->dob));
		    $dobword= Carbon::parse($dob)->format('M-D-Y');
           	$admission= $row->admission_regno; 
           	$nationality= strtoupper($row->nationality);   
           	$relegion= strtoupper($row->relegion); 
           	$category= strtoupper($row->reservation_category);
           	$admissiondate= date('d-m-Y',strtotime($row->class_date_of_admission));
           	$program= strtoupper($row->subject_studied);
           	$university_regno= strtoupper($row->university_examination_details);
           	$university_name= strtoupper($row->university_name);
           	$created_date= strtoupper($row->created_date);
           	$class_date_of_leaving= strtoupper($row->class_date_of_leaving);
           	$course_completion= strtoupper($row->course_completion);
           	$fees_paid= strtoupper($row->fees_paid);
           	$student_grade= strtoupper($row->student_grade);
           	$reason_for_leaving= strtoupper($row->reason_for_leaving);
           	$character_conduct= strtoupper($row->character_conduct);
           	$date_of_applicationtc= strtoupper($row->date_of_applicationtc);
           	$date_of_issue= strtoupper($row->date_of_issue);
           	
            $dataE = array( 'name'=>$name,'parent_name'=>$parent_name ,'pid'=>$pid,'tcnumber'=>$tcnumber,'dob'=>$dob,'dobword'=>$dobword,'admission'=>$admission,
            'nationality'=>$nationality,'relegion'=>$relegion,'category'=>$category,'admissiondate'=>$admissiondate,'program'=>$program,
            'university_regno'=>$university_regno,'university_name'=>$university_name,'created_date'=>$created_date,'class_date_of_leaving'=>$class_date_of_leaving,
            'course_completion'=>$course_completion,'fees_paid'=>$fees_paid,'student_grade'=>$student_grade,'reason_for_leaving'=>$reason_for_leaving,
            'character_conduct'=>$character_conduct,'date_of_applicationtc'=>$date_of_applicationtc,'date_of_issue'=>$date_of_issue
            );
			
		}
             }else
             { 
       
          
           	$i=1;
		$data=array(); 
		foreach($list as $row){
		  
			$pid=$row->id;
			 $department = DB::select("SELECT departments.hod FROM `course` join students  on students.program=course.course_name 
join departments on departments.id=course.departments where students.id='$pid'"); 
$departmenttc=$department[0]->hod;
$result = substr($departmenttc, 0, 5); 
if($result=='Aided')
 {  //202/2022-A
		   // $tcnumber=$str.rand(1000, 9999).str_pad($row->id, 3, STR_PAD_LEFT);
		   
		    $generatorid=DB::select("SELECT gen_id FROM `aided_generator`");
			$gennum=$generatorid[0]->gen_id;
		    $originalnumber=$gennum+1;
		
		      $str='-A';
          $curYear = date('Y'); 
          $str1='/';
		   $tcnumber=$originalnumber.$str1.str_pad($curYear, 2, STR_PAD_LEFT).$str;
		   $statusgen=1;
 } else
 {   
        $generatorid=DB::select("SELECT `gen_id` FROM `self_generator`");
		$gennum=$generatorid[0]->gen_id;
		$originalnumber=$gennum+1;
          $str='-S';
          $curYear = date('Y'); 
          $str1='/';
          $tcnumber=$originalnumber.$str1.str_pad($curYear, 2, STR_PAD_LEFT).$str;
		  $statusgen=2;
          //  $tcnumber=$str.rand(100, 9999).str_pad($row->id, 3, STR_PAD_LEFT);
 }
 
		    $name= strtoupper($row->name);
			$parent_name= strtoupper($row->parent_name);
			$dob=date('d-m-Y',strtotime($row->dob));
		
		    $dobword= Carbon::parse($dob)->format('M-D-Y');
           	$admission= $row->admission_no; 
           	$nationality= strtoupper($row->country_name);   
           	$relegion= strtoupper($row->relegion); 
           	$category= strtoupper($row->reservation_category);
           	$admissiondate= date('d-m-Y',strtotime($row->date_of_admission));
           	$program= strtoupper($row->program);
           	$university_regno= strtoupper($row->university_regno);
           //	$university= strtoupper($row->university);
            $dataE = array( 'name'=>$name,'parent_name'=>$parent_name ,'pid'=>$pid,'tcnumber'=>$tcnumber,'dob'=>$dob,'dobword'=>$dobword,'admission'=>$admission,'nationality'=>$nationality,'relegion'=>$relegion,'category'=>$category,'admissiondate'=>$admissiondate,'program'=>$program,'university_regno'=>$university_regno,'generatornum'=>$gennum,'stgen'=>$statusgen);
			
		}
             }
		$data=array($dataE);
		echo json_encode($data);
         } 
     
    }     
 /***********************************************/
       public function saveStudent(Request $request)
    {
   
        if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
        if($request->hasFile('image')){
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/student/'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }
         else
        {
            $picture='';
        }
        
        
        if($request->file('filecard')) 
		{ 
        
            $file = $request->file('filecard');
            $filenamecard = time() . '.' . $request->file('filecard')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $filenamecard);
        }
        else
        {
            $filenamecard='';
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
            $filenamecardcaste='';
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
            $filenamecardexam='';
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
            $filenamecardpassbook='';
        }
		
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
	"dob" => $request->dateofbirth,
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
	 'address'=> $request->address,
	 'Nationality'=> $request->country,
	 'state'=> $request->state,
	 'city'=> $request->city,
	 'pincode'=> $request->pincode,
	 'proof_doc'=> $filename,
	 'caste_income_upload'=> $filenamecardcaste,
	 'qualify_exam_certificate_upload'=> $filenamecardexam,
	 'bank_passbook_upload'=> $filenamecardpassbook,
	 'profile_pic'=> $picture,
	 'entry_card'=>$filenamecard,
	 'password'=> 'student@123',
   );
	$current_date_time = Carbon::now()->toDateTimeString();
        	$id  =   DB::table('students')->insertGetId($dataArray);

		          $password='student@123';
				  $loginvalues= array('name' => $request->name,
				                'email' => $request->email,
								 'role' => 5,
								 'password' => Hash::make($password),
								 'created_at' => $current_date_time,
								 'updated_at' => $current_date_time,
								 'profile_id'=> $id
								 );
			$result=DB::table('users')->insert($loginvalues);
	
	
	if($result==1){ 
                    	return response()->json(['success'=>'Student Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
    	    public function studentList(Request $request)
    {  
       
	   //$faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT * FROM `students` order by id desc"); 
	    return view('admin.officeadmin.studentList',compact('list'));
    }
	
		public function exportStudentList(Request $request)
{
 
   $fileName = 'StudentList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT * FROM `students`"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Name Of Student','Cap ID','Batch','Roll No','University Reg No','Admission No','Program','Gender','Religion','Reservation Category','Email','Date Of Admission','Tc Issued');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

             foreach ($tasks as $task) {
			  $row['Name Of Student']  = $task->name;
              $row['Cap ID']  = $task->cap_id; 
			  $row['Batch']  = $task->batch; 
			  $row['Roll No']  = $task->roll_no; 
			  $row['University Reg No']  = $task->university_regno; 
			  $row['Admission No']  = $task->admission_no; 
			  $row['Program']  = $task->program; 
			  $row['Gender']  = $task->gender; 
			   $row['Religion']  = $task->relegion; 
			  $row['Reservation Category']  = $task->reservation_category; 
			  $row['Email']  = $task->email; 
			  $row['Date Of Admission']  = $task->date_of_admission; 
			  $row['Tc Issued']  = $task->tc_issued;
				
		 fputcsv($file, array($row['Name Of Student'],$row['Cap ID'],$row['Batch'],$row['Roll No'], $row['University Reg No'],$row['Admission No'] ,$row['Program'],$row['Gender'],$row['Religion'],$row['Reservation Category'],$row['Email'],$row['Date Of Admission'],$row['Tc Issued']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
			public function exportScholarshipList(Request $request)
{
 
   $fileName = 'ScholarshipList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("select scholarship.*,students.name,students.admission_no,students.reservation_category,students.relegion from scholarship join students on students.id=scholarship.student_id"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Name Of Student','Admission No','Religion','Reservation Category','Scholarship Name','Date Of Sanction','Period','Amount Type','Date Of Application','Date Of Entry','Amount');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

             foreach ($tasks as $task) {
			  $row['Name Of Student']  = $task->name;
              $row['Admission No']  = $task->admission_no; 
			  $row['Religion']  = $task->relegion; 
			  $row['Reservation Category']  = $task->reservation_category; 
			   $row['Scholarship Name']  = $task->scholarship_name; 
			  $row['Date Of Sanction']  = $task->date_of_sanction; 
			  $row['Period']  = $task->period; 
			  $row['Amount Type']  = $task->amount_type; 
			  $row['Date Of Application']  = $task->date_of_application;
			  $row['Date Of Entry']  = $task->date_of_entry;
			   $row['Amount']  = $task->amount;
				
		 fputcsv($file, array($row['Name Of Student'],$row['Admission No'],$row['Religion'],$row['Reservation Category'],$row['Scholarship Name'],$row['Date Of Sanction'],$row['Period'],$row['Amount Type'], $row['Date Of Application'],$row['Date Of Entry'],$row['Amount']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	
    	    public function studentListscholarship(Request $request)
    {  
        $role = Auth::user()->role;
		if($role==2)
	   {
		   $courseid=$request->id;
		$course = DB::select("SELECT course_name FROM `course` where id='$courseid'"); 
	    $coursename=$course[0]->course_name;
	    $list = DB::select("SELECT * FROM `students` WHERE `program`='$coursename' order by id desc");
		   
	    return view('admin.officeadmin.scholorshipList',compact('list'));
	   }
	   else{
		    $list = DB::select("SELECT * FROM `students` order by id desc"); 
	    return view('admin.officeadmin.scholorshipList',compact('list'));
	   }
	   //$faculty_id = Auth::user()->profile_id;
		
    }
	
	
    	    public function studentListscholarshipAdmin(Request $request)
    {  
          $role = Auth::user()->role;
		 $list = DB::select("select scholarship.*,students.name,students.admission_no,students.reservation_category,students.relegion from scholarship join students on students.id=scholarship.student_id order by scholarship.id desc"); 
	    return view('admin.officeadmin.scholorshipListAdmin',compact('list'));
		
    }
          public function editStudent(Request $request)
    {   
     set_time_limit(0);
		$id=$request->id;
	    $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
	     $countrylist =  DB::select("SELECT country_id,country_name from country "); 
        $profile_edit= DB::select("SELECT * FROM `students` WHERE `id`='$id'");
    
		return view('admin.officeadmin.editStudent',compact('profile_edit','course','countrylist'));
		
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
     	   public function deleteStudent(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE students.* FROM  students where students.id='$id'  ");
	 DB::delete("DELETE users.* FROM users  where users.profile_id='$id'  ");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
               public function addScholarship(Request $request)
    {   
    
		 $id=$request->id;
	    
        $list= DB::select("SELECT * FROM `scholarship` WHERE `student_id`='$id'");
        $title= DB::select("SELECT * FROM `scholarship_title` ");
		return view('admin.officeadmin.addScholarship',compact('list','id','title'));
		
    }
      public function saveScholarship(Request $request)
    {
         $studentid=$request->editid;
        
       
        $current_date_time = Carbon::now()->toDateTimeString();

		 $count = count($request->p_name);
	
      for($i=0;$i<$count;$i++)
      {      
           
          if($request->hasfile('files')){
                         
                     $file = $request->file('files');
                    
                     $filepaper=$file[$i];
                      
            $paperdoc =  time().'.'.$filepaper->extension();
        
           $file[$i]->move(public_path().'/uploads/course/', $paperdoc);  
           
                } 
            else{
                $paperdoc  = '';
            }

		   $data1 = array(
             "student_id" => $studentid ,
             "scholarship_name" =>$request->p_name[$i], 
             "period" =>$request->p_period[$i], 
             "date_of_sanction" =>$request->p_date[$i],
             "amount_type" =>$request->p_type[$i],
             "document" =>  $paperdoc ,
             "date_of_application" =>$request->p_dateofApp[$i],
             "date_of_entry" =>$request->p_dateofentry[$i],
             "amount" =>$request->p_amt[$i],
             "created_date" =>$current_date_time,
             "created_by" =>Auth::user()->id,
             ); 
 
           $result=DB::table('scholarship')->insert($data1);
           

}

	
	if($result==1){ 
                    	return response()->json(['success'=>'Scholarship Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    
}
       public function deleteScholarship(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE scholarship.* FROM  scholarship where scholarship.id='$id'  ");
   
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
	
	// add scholarship title
	
		  		    public function addNaacKeyword(Request $request)
    {
        $list =  DB::select("SELECT keywordname,id from scholarship_title ORDER BY id DESC");
         return view('admin.officeadmin.addScholarshipTitle',compact('list'));
    } 
             public function deleteNaackeyword(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE scholarship_title.* FROM  scholarship_title where scholarship_title.id='$id'  ");
     return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   }
        public function checkKeyword(Request $req)
{
$name = $req->name;

$keycheck = DB::table('scholarship_title')->where('keywordname',$name)->count();
if($keycheck > 0)
{
echo "1";
}
}
     public function saveNaacKeyword(Request $request)
    {
             $keywords= array('keywordname' => $request->name);
			$result=DB::table('scholarship_title')->insert($keywords);
	
	
	if($result==1){ 
                    	return response()->json(['success'=>'Scholarship Title Created Succesffully']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
    
}
