<?php

namespace App\Http\Controllers\Office;
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
use Symfony\Component\HttpFoundation\Response;
use PDF;
class OfficeController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }  
	
	 ///GENERAL//////
    
     	    public function generalList(Request $request)
    {  
	   //$faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT general.* FROM  general order by id desc"); 
	    return view('admin.office.generalList',compact('list'));
    }
       public function deleteGeneral(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE general.* FROM  general where general.id='$id'  ");

	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
      	public function addGeneral(Request $request)
    {
             return view('admin.office.addGeneral');
    }
    		    public function saveGeneral(Request $request)
    {
       
       if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/general/';
            $file->move($filePath, $filename);
        } else
        {
            $filename='';
        }
       
		 $dataArray      =  array(
	"titlename" => $request->title,
	"title" => $request->stream,
	"from_date" => $request->datestart,
    "document" => $filename,

	
   );

        	$id  =   DB::table('general')->insertGetId($dataArray);

		          
	
	
	if($id){ 
                    	return response()->json(['success'=>' Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	    public function hodList(Request $request)
    {  
       
		$list = DB::select("SELECT * FROM `faculity` left join users on faculity.fid= users.profile_id where users.type='HOD'"); 
	    return view('admin.office.hodList',compact('list'));
	   
    }
	          public function fetchPaperValues(Request $request)
    {   	$id=$request->id;
  
        $fetch_paper = DB::select("SELECT * FROM `papers` where papers.id='$id'");
     
	
			$p_code=$fetch_paper[0]->p_code;
		    $p_name=$fetch_paper[0]->p_name;
		    $p_credit=$fetch_paper[0]->p_credit;
            $p_hourse=$fetch_paper[0]->p_hourse;
            $p_type=$fetch_paper[0]->p_type;
            $theory_subdivision=$fetch_paper[0]->theory_subdivision;
            $p_syllabus=$fetch_paper[0]->p_syllabus;
            $p_semester=$fetch_paper[0]->p_semester;
           
		 
		$data[] = array('p_code'=>$p_code,'p_name'=>$p_name,'p_credit'=>$p_credit,'p_hourse'=>$p_hourse,'p_type'=>$p_type,'theory_subdivision'=>$theory_subdivision,'p_syllabus'=>$p_syllabus,'p_semester'=>$p_semester);

		echo json_encode($data);
        
    }
	          	function updatePaper(Request $request)
    {
         if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/course/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
       $dataArray = array(
       
        'p_code' => $request->extpapercode,
        'p_name' => $request->pname,
        'p_credit' => $request->credit,
        'p_hourse' => $request->hours,
        'p_type' => $request->type,
        'theory_subdivision' => $request->subdivision,
         'p_semester' => $request->semester,
        'p_syllabus' => $filename,
        );
      
   $editid = $request->exteditid;
   $id= DB::table('papers')->where('id', $editid)->update($dataArray);

if($id!='')
{
    return response()->json(['success'=>'Paper Details has been uploaded']);
}
     
    }
	
	        public function CellEventList(Request $request)
    {  
       
		$list = DB::select("SELECT distinct cell_events.`id`,`eventtype`,cell_events.`fid`,`title`,faculity.name as facultyname,faculity.department as dept,`from_date`,`to_date`,cell_events.`category`,cell_events.`type`,indulgence_level,cell.name_of_the_cell as cell FROM `cell_events` LEFT join faculity on faculity.fid=cell_events.coordinator LEFT join cell on cell.id=cell_events.fid  group by cell_events.id"); 
	    return view('admin.office.cellEventList',compact('list'));
	   
    }
    
              public function exportCsvCellEventadmin(Request $request)
{
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT DISTINCT cell_events.`id`,cell_events.`title`,cell.name_of_the_cell as cell,cell_events.`from_date`,cell_events.`to_date`,cell_events.`venue`,cell_events.`agenda`,faculity.name as facultyname,faculity.department as dept,cell_events.`eventtype`,cell_events.`male_teacher`,cell_events.`female_teacher`,cell_events.`male_student`,cell_events.`female_student`,cell_events.`other_student`,cell_events.`specially_abled`,cell_events.`caste_sc`,cell_events.`caste_st`,cell_events.`caste_obc`,cell_events.`fid`,`title`,`from_date`,`to_date`,`venue`,cell_events.`type`,cell_events.`category` from cell_events LEFT join faculity on faculity.fid=cell_events.coordinator
LEFT join cell on cell.id=cell_events.fid order by cell_events.id desc");

 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','Faculty','Department','Cell','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Event Title']  = $task->title;
                $row['From Date']  = $task->from_date;
                $row['To Date']  = $task->to_date;
                 $row['Venue']  = $task->venue;
                 $row['Agenda']  = $task->agenda;
                 $row['Faculty']  = $task->facultyname;
                 $row['Department']  = $task->dept;
                 $row['Cell']  = $task->cell;
                 $row['Category']  = $task->category;
                  $row['No oF Male Teacher']  = $task->male_teacher;
                 $row['No oF FeMale Teacher']  = $task->female_teacher;
                 $row['No oF Male Student']  = $task->male_student;
                 $row['No oF FeMale Student']  = $task->female_student;
                 $row['Other Student']  = $task->other_student;
                 $row['Specially Abled']  = $task->specially_abled;
                 $row['SC']  = $task->caste_sc;
                $row['ST']  = $task->caste_st;
                $row['OBC']  = $task->caste_obc;
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['Faculty'],$row['Department'],$row['Cell'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
	
	    public function editHod(Request $request)
    {   
     
		$id=$request->id;
			if($id!='')
			{
		$facultyid=DB::select("SELECT `profile_id` FROM `users` WHERE id='$id'"); 
	 $fid= $facultyid[0]->profile_id;

		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
       
     $profile_edit= DB::select("SELECT * FROM `faculity` WHERE `fid`='$fid'");
     $department=$profile_edit[0]->department;
     $faculty= DB::select("SELECT * FROM `faculity` WHERE `department`='$department'");
  
     $profile_faculty= DB::select("SELECT * FROM `users` WHERE `profile_id`='$fid' and type='HOD'");

		return view('admin.office.editHod',compact('faculty','departments','profile_edit','profile_faculty'));
			}
		
    }
	  	public function hodUpdateInfo(Request $request)
    {
		
        	$newhodid = $request->profileid;
        	$oldhod = $request->hodid;
        	$profile_faculty= DB::select("SELECT name  FROM `faculity` WHERE `fid`='$newhodid'");
        	$newhodname=$profile_faculty[0]->name;
        		$dataArray      =  array(
	"name" => $newhodname,
	"profile_id" => $newhodid,
   
   );

		
       DB::table('users')->where('profile_id', $oldhod)->where('type', 'HOD')->update($dataArray);
		
        return response()->json('File uploaded successfully');
        
    }
	    public function dashboard(Request $request)
    {
        	$list = DB::select("SELECT count(id) as totlogbook from departments"); 
        	$faculty = DB::select("SELECT count(fid) as total from faculity"); 
        	$barchart=DB::select("SELECT (SELECT count(`fid`) FROM faculity WHERE department='Botany') as Botany, (SELECT count(`fid`) FROM faculity WHERE department='Arabic') as Arabic, (SELECT count(`fid`) FROM faculity WHERE department='Economics') as Economics, (SELECT count(`fid`) FROM faculity WHERE department='Aquaculture') as Aquaculture, 
        	 (SELECT count(`fid`) FROM faculity WHERE department='Malayalam') as Malayalam, (SELECT count(`fid`) FROM faculity WHERE department='Chemistry') as Chemistry, (SELECT count(`fid`) FROM faculity WHERE department='English') as English, 
        	 (SELECT count(`fid`) FROM faculity WHERE department='Hindi') as Hindi, (SELECT count(`fid`) FROM faculity WHERE department='History') as History , (SELECT count(`fid`) FROM faculity WHERE department='Biochemistry') as Biochemistry , 
        	 (SELECT count(`fid`) FROM faculity WHERE department='Computer Application') as ComputerApplication,(SELECT count(`fid`) FROM faculity WHERE department='Mass Communication') as MassCommunication,(SELECT count(`fid`) FROM faculity WHERE department='Physical Education') as PhysicalEducation,
        	 (SELECT count(`fid`) FROM faculity WHERE department='Mathematics') as Mathematics,(SELECT count(`fid`) FROM faculity WHERE department='Physics') as Physics,(SELECT count(`fid`) FROM faculity WHERE department='Psychology') as Psychology,
        	 (SELECT count(`fid`) FROM faculity WHERE department='Political Science') as PoliticalScience,(SELECT count(`fid`) FROM faculity WHERE department='Statistics') as Statistics,(SELECT count(`fid`) FROM faculity WHERE department='Zoology') as Zoology,
        	 (SELECT count(`fid`) FROM faculity WHERE department='Fish Processing Technology') as FishProcessingTechnology,(SELECT count(`fid`) FROM faculity WHERE department='Digital Film Production') as DigitalFilmProduction,(SELECT count(`fid`) FROM faculity WHERE department='Logistics Management') as LogisticsManagement,
        	 (SELECT count(`fid`) FROM faculity WHERE department='Tourism & Hospitality Management') as Tourism ,(SELECT count(`fid`) FROM faculity WHERE department='Commerce') as Commerce,(SELECT count(`fid`) FROM faculity WHERE department='Commerce and Management Studies') as CommerceManagementStudies,
             (SELECT count(`fid`) FROM faculity WHERE department='Library Science') as LibraryScience");
             $students=DB::select("SELECT(SELECT count(`id`) FROM students ) as totst, (SELECT count(`id`) FROM students WHERE gender='Male') as Malest, (SELECT count(`id`) FROM students WHERE gender='Female') as femalest");
            return view('admin.office.home',compact('list','faculty','barchart','students'));
    }
    	    public function logBook(Request $request)
    {  
       
	   //$faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT log_book.*,users.name as updatedby,students.name as stname FROM `log_book` left join users on users.id=log_book.updated_by left join students on students.id=log_book.student_id order by log_book.id desc"); 
	    return view('admin.office.logBook',compact('list'));
    }
   
	    public function facultyList(Request $request)
    {  
       
	   //$faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT * FROM `faculity` order by fid desc"); 
	    return view('admin.office.facultyList',compact('list'));
    }
	    public function nonfacultyList(Request $request)
    {  
        $type = Auth::user()->role;
	   if($type==1)
	   {
		   $faculty_id = Auth::user()->profile_id;
		 $list = DB::select("SELECT * FROM `non_teaching` where id='$faculty_id' order by id desc"); 
	    return view('admin.office.nonfacultyList',compact('list'));
	   }
	   else{
		$list = DB::select("SELECT * FROM `non_teaching` order by id desc"); 
	    return view('admin.office.nonfacultyList',compact('list'));
	   }
    }
    	   public function deleteNonFaculty(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE non_teaching.* FROM  non_teaching where non_teaching.id='$id'  ");
	 DB::delete("DELETE users.* FROM users  where users.profile_id='$id' and role='1' ");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
		    public function addFaculty(Request $request)
    {
           $departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
	       return view('admin.office.addFaculty',compact('departments'));
    }
	

    /************************ Non faculty Login Staff *****************************/
    		    public function loginStaff(Request $request)
    {
           $departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
	       return view('admin.office.loginStaff',compact('departments'));
    }
    
        public function saveLogininfo(Request $request)
    {
		  if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . 'A001'.'.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
		     if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . '001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2='';
        }
		      if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = time() . 'B001'.'.' . $request->file('file3')->extension();
            $filePath3 = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath3, $filename3);
        }
        else
        {
            $filename3='';
        }
		           if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = time() . 'C001'.'.' . $request->file('file4')->extension();
            $filePath4 = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath4, $filename4);
        }
        else
        {
            $filename4='';
        }
        if($request->hasFile('image')){
          $image = $request->file('image');
		 
          $picture = time() . '.' . $image->getClientOriginalExtension();
		     $image->move(public_path('uploads/nonfaculty'), $picture);
          
		  
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }else
        {
            $picture='';
        }
       
        
		 $dataArray      =  array(
	"name" => $request->name,
	"email_id" => $request->email,
	'password'=> $request->password,
    "dob" => $request->dateofbirth,
	"date_of_join" => $request->dateofjoining,
	"gender" => $request->gender,
	"phone_number" => $request->phonenum,
	
	"department" => $request->dept,
	"designation" => $request->designation,
	"name_of_section" => $request->section,
	"aided_temp" => $request->category,
	 'resume' => $filename,
	 'appointment_order' => $filename2,
	 'joining_memo' => $filename3,
	 'promotion_details' => $filename4,
	 'profile_picture' => $picture,
	
	
   );

        	$id  =   DB::table('non_teaching')->insertGetId($dataArray);
         $current_date_time = Carbon::now()->toDateTimeString();
             $password=$request->password;
			 $email=$request->email;
				  $loginvalues= array('name' => $request->name,
				                'email' => $request->email,
								 'role' => 1,
								 'password' => Hash::make($password),
								 'created_at' => $current_date_time,
								 'updated_at' => $current_date_time,
								 'profile_id'=> $id
								 );
			$result=DB::table('users')->insert($loginvalues);
	
	
	if($result==1){ 
                    $data[] =  array('password'=>$password, 'emailnew'=>$email);
		
                   return response()->json($data);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	
	  public function editNonFaculty(Request $request)
    {   
     
		$id=$request->id;
		
        $profile_edit= DB::select("SELECT * FROM `non_teaching` WHERE `id`='$id'");
    
		return view('admin.office.editNonFaculty',compact('profile_edit'));
		
    }
    	public function editNonFacultyinfo(Request $request)
    {
		
       	$faculty_id = $request->editid;
        if($request->file1)
		{
		    $file = $request->file('file1');
           
            $fileName = time().'.'.$request->file1->extension();  
            $file->move(public_path().'/uploads/nonfaculty/', $fileName);    
       // $fileName = time().'.'.$request->file1->extension();  
         
       // $request->file1->move(public_path('uploads/facultyresume'), $fileName);
			 
        }
		else{
			$fileName= $request->current_file;
		}
		     if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . '001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2=$request->current_file2;
        }
		      if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = time() . 'B001'.'.' . $request->file('file3')->extension();
            $filePath3 = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath3, $filename3);
        }
        else
        {
            $filename3=$request->current_file3;
        }
		           if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = time() . 'C001'.'.' . $request->file('file4')->extension();
            $filePath4 = public_path() . '/uploads/nonfaculty/';
            $file->move($filePath4, $filename4);
        }
        else
        {
            $filename4=$request->current_file4;
        }
		if($request->hasFile('image')){
		     $image = $request->file('image');
		 
          $picture = time() . '.' . $image->getClientOriginalExtension();
		     $image->move(public_path('uploads/nonfaculty'), $picture);
          
        }
        else{
		$picture=$request->current_file_img;
		}
		
		 $dataArray      =  array(
	"name" => $request->name,
	
    "dob" => $request->dateofbirth,
	"date_of_join" => $request->dateofjoining,
	"gender" => $request->gender,
	"phone_number" => $request->phonenum,
	
	"department" => $request->dept,
	"designation" => $request->designation,
	"name_of_section" => $request->section,
	"aided_temp" => $request->category,
	 'resume' => $fileName,
	 'appointment_order' => $filename2,
	 'joining_memo' => $filename3,
	 'promotion_details' => $filename4,
	 'profile_picture' => $picture,
	
	
   );
	
		
        DB::table('non_teaching')->where('id', $faculty_id)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
   /************************ Login Staff *****************************/
     public function editFaculty(Request $request)
    {   
     
		$id=$request->id;
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
        $profile_edit= DB::select("SELECT * FROM `faculity` WHERE `fid`='$id'");
    
		return view('admin.office.editFaculty',compact('profile_edit','departments'));
		
    }
    	public function editFacultyinfo(Request $request)
    {
		
       	$faculty_id = $request->editid;
        if($request->file1)
		{
		    $file = $request->file('file1');
           
            $fileName = time().'.'.$request->file1->extension();  
            $file->move(public_path().'/uploads/facultyresume/', $fileName);    
       // $fileName = time().'.'.$request->file1->extension();  
         
       // $request->file1->move(public_path('uploads/facultyresume'), $fileName);
			 
        }
		else{
			$fileName= $request->current_file;
		}
		     if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . '001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2=$request->current_file2;
        }
		      if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = time() . 'B001'.'.' . $request->file('file3')->extension();
            $filePath3 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath3, $filename3);
        }
        else
        {
            $filename3=$request->current_file3;
        }
		           if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = time() . 'C001'.'.' . $request->file('file4')->extension();
            $filePath4 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath4, $filename4);
        }
        else
        {
            $filename4=$request->current_file4;
        }
		if($request->hasFile('image')){
		    $products = DB::select("SELECT `picture` FROM `faculity` WHERE fid='$faculty_id'");
			  $path = public_path("uploads/facultyimg/" . $products[0]->picture);
			  if (file_exists($path)) {
              @unlink($path);
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/facultyimg'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
			  }
        }
        else{
		$picture=$request->current_file_img;
		}
		$users=$request->Position;
        $positiondata =  implode(', ',$users);
		$dataArray      =  array(
	"name" => $request->name,
	"guardian" => $request->guardianName,
    "dob" => $request->dateofbirth,
	"date_of_join" => $request->dateofjoining,
	"gender" => $request->gender,
	"phone_number" => $request->phonenum,
	"email_id" => $request->email,
	"academic_body" => $request->academicbody,
	"academic_institution" => $request->academic_institution,
	"department" => $request->department,
	"designation" => $request->designation,
	"position" =>  $positiondata,
	"address" => $request->address,
	"highest_edu" => $request->qualification,
	"description" => $request->description,
	 'resume' => $fileName,
	 'appointment_order' => $filename2,
	 'joining_memo' => $filename3,
	 'promotion_details' => $filename4,
	 'picture' => $picture,
	 
   );
	
		
        DB::table('faculity')->where('fid', $faculty_id)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
  	    public function saveFaculty(Request $request)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . 'A001'.'.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyresume/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
		     if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . '001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2='';
        }
		      if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = time() . 'B001'.'.' . $request->file('file3')->extension();
            $filePath3 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath3, $filename3);
        }
        else
        {
            $filename3='';
        }
		           if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = time() . 'C001'.'.' . $request->file('file4')->extension();
            $filePath4 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath4, $filename4);
        }
        else
        {
            $filename4='';
        }
        if($request->hasFile('image')){
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/facultyimg'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }else
        {
            $picture='';
        }
        
        $users=$request->Position;
        $positiondata = '';
        
// Check if the $users array is not empty
if (!empty($users)) {
    // If the array contains the value 'hod', store it in the $hodPosition variable
    if (in_array('HOD', $users)) {
        $hodPosition = 'HOD';
        
    $hodvalues = array(
        'name' => $request->name,
        'email' => $request->department . '@sn.org',
        'role' => 6,
        'password' => Hash::make('hod@123'), // Set the password directly to 'hod@123' for HOD
        'created_at' => $current_date_time,
        'updated_at' => $current_date_time,
        'profile_id' => $id,
        'type' =>'HOD'
    );

    $result = DB::table('users')->insert($hodvalues);
    } else {
        // If 'hod' is not present in the array, implode all positions into a comma-separated string
        $positiondata = implode(', ', $users);
    }
} else {
           $positiondata=''; 
        }
		 $dataArray      =  array(
	"name" => $request->name,
	"guardian" => $request->guardianName,
    "dob" => $request->dateofbirth,
	"date_of_join" => $request->dateofjoining,
	"gender" => $request->gender,
	"phone_number" => $request->phonenum,
	"email_id" => $request->email,
	"academic_body" => $request->academicbody,
	"academic_institution" => $request->university,
	"department" => $request->department,
	"designation" => $request->designation,
	"position" =>  $positiondata,
	"address" => $request->address,
	"highest_edu" => $request->qualification,
	"description" => $request->description,
	 'resume' => $filename,
	 'appointment_order' => $filename2,
	 'joining_memo' => $filename3,
	 'promotion_details' => $filename4,
	 'picture' => $picture,
	 'username'=> $request->email,
	 'password'=> 'faculty@123',
   );
	
        	$id  =   DB::table('faculity')->insertGetId($dataArray);

		          $password='faculty@123';
				  $loginvalues= array('name' => $request->name,
				                'email' => $request->email,
								 'role' => 2,
								 'password' => Hash::make($password),
								 'created_at' => $current_date_time,
								 'updated_at' => $current_date_time,
								 'profile_id'=> $id
								 );
			$result=DB::table('users')->insert($loginvalues);
	
	
	if($result==1){ 
                    	return response()->json(['success'=>'Faculty Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
    	   public function deleteFaculty(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE faculity.* FROM  faculity where faculity.fid='$id'  ");
	 DB::delete("DELETE users.* FROM users  where users.profile_id='$id' and role='2'");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
      	   public function deletelogBook(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE log_book.* FROM  log_book where log_book.id='$id'  ");
	
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
    //// department ////
    	    public function deptList(Request $request)
    {  
	    $type = Auth::user()->type;
		
	   if($type=='HOD')
	   {
	       
	      $facultyid= Auth::user()->profile_id;
	
	      $depart = DB::select("SELECT department FROM `faculity` where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
	     $list = DB::select("SELECT departments.*,faculity.name as fachod FROM `departments` left join faculity on departments.faculty_h=faculity.fid where departments.faculty_h=$facultyid"); 
	     return view('admin.office.deptList',compact('list'));
	   }else
	   {
		$list = DB::select("SELECT departments.*,faculity.name as fachod FROM `departments` left join faculity on departments.faculty_h=faculity.fid order by departments.id desc"); 
	    return view('admin.office.deptList',compact('list'));
	   }
    }
public function downloadDepartmentExcel(Request $request)
{
 
   $fileName = 'DepartmentList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT departments.*,faculity.name as fachod FROM `departments` left join faculity on departments.faculty_h=faculity.fid"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Department','Hod');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

             foreach ($tasks as $task) {
			  $row['Department']  = $task->department;
                $row['Hod']  = $task->fachod; 
		 fputcsv($file, array($row['Department'],$row['Hod']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	
    		    public function addDept(Request $request)
    {
           $departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
           $hod= DB::select("select * from faculity ORDER BY fid ASC"); 
	       return view('admin.office.addDept',compact('departments','hod'));
    }
		    public function saveDept(Request $request)
    {
       
      
        if($request->hasFile('image')){
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/department'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }else
        {
            $picture='';
        }
  
  
		 $dataArray      =  array(
	"department" => $request->name,
	"email" => $request->deptemail,
    "no_of_stu" => '',
	"hod" => $request->stream,
	"faculty_h" => $request->hod,
	"descn" => $request->description,
	"vision" => $request->vision,
	"mission" => $request->mission,
	 'picture' => $picture,
	
   );

        	$id  =   DB::table('departments')->insertGetId($dataArray);

		          
	
	
	if($id){ 
                    	return response()->json(['success'=>'Faculty Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
     public function editDept(Request $request)
    {   
     set_time_limit(0);
		$id=$request->id;
	    $hod= DB::select("select * from faculity ORDER BY fid ASC"); 
        $profile_edit= DB::select("SELECT * FROM `departments` WHERE `id`='$id'");
    
		return view('admin.office.editDept',compact('profile_edit','hod'));
		
    }
   
    	public function editDeptinfo(Request $request)
    {
		
       	$dept_id = $request->editid;
       
		if($request->hasFile('image')){
		    $products = DB::select("SELECT `picture` FROM `departments` WHERE id='$dept_id'");
		   
			  $path = public_path("uploads/department/" . $products[0]->picture);
			  if (file_exists($path)) {
              @unlink($path);
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/department'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
			  }
        }
        else{
		$picture=$request->current_file_img;
		}
	
		 $dataArray      =  array(
	"department" => $request->name,
	"email" => $request->deptemail,
    "no_of_stu" => '',
	"hod" => $request->stream,
	"faculty_h" => $request->hod,
	"descn" => $request->input('description'),
	"vision" => $request->input('vision'),
	"mission" => $request->input('mission'),
	 'picture' => $picture,
	 'updated_by' =>  Auth::user()->id
	
   );

		
        DB::table('departments')->where('id',$dept_id)->update($dataArray);
        
        return response()->json('Department Data updated successfully');
    }
      	   public function deleteDept(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE departments.* FROM  departments where departments.id='$id'  ");

	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
	
	/// tc////////////////////
	
		 	    public function tcList(Request $request)
    {  
	   //$faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT * FROM tc_report order by id desc"); 
	    return view('admin.officeadmin.tcList',compact('list'));
    }
	    public function editTc(Request $request)
    {   
   
		$id=$request->id;
	
        $profile_edit= DB::select("SELECT * FROM `tc_report` WHERE `id`='$id'");
   
		return view('admin.officeadmin.editTc',compact('profile_edit'));
		
    }
	
	   	public function editTcUpdate(Request $request)
    {
		
       	$tcid = $request->editid;
		
		
			 $dataArray      =  array(
	"dob" => $request->dateofbirth,
	"relegion" => $request->relegion,
	"reservation_category" => $request->caste,
    "class_date_of_admission" => $request->dateofadmission,
	"class_date_of_leaving" => $request->dateofleave,
	"course_completion" => $request->coursecomplete,
	"fees_paid" => $request->feesdue,
	"student_grade" => $request->result,
	"nationality" => $request->nationality,
	
   );
   
  	
        DB::table('tc_report')->where('id', $tcid)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
	   public function deleteTc(Request $request)
    {

      $id= $request->id;
    DB::delete("DELETE tc_report.* FROM  tc_report where tc_report.id='$id'  ");
    
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   }
	
    ////cell/////////////
   	public function exportCell(Request $request)
{
 
   $fileName = 'CellList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT cell.name_of_the_cell,users.email,cell.affiliated_with,cell.date_of_affiliation,cell.sub_cordinator,cell.boys,cell.girls,cell.others,cell.total,cell.num_of_unit,cell.type,faculity.name as cordinator FROM `cell` 
    join faculity on cell.cordinator=faculity.fid
    join users on cell.id=users.profile_id where users.role='4' "); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Name Of Cell','Email ID','Affliated With','Date Of Affliation','Coordinator','Sub Cooordinator','No of Boys','No of Girls','No of Others','Total','Unit Number','Type Of Cell');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

             foreach ($tasks as $task) {
			  $row['Name Of Cell']  = $task->name_of_the_cell;
              $row['Email ID']  = $task->email; 
			  $row['Affliated With']  = $task->affiliated_with; 
			  $row['Date Of Affliation']  = $task->date_of_affiliation; 
			  $row['Coordinator']  = $task->cordinator; 
			  $row['Sub Cooordinator']  = $task->sub_cordinator; 
			  $row['No of Boys']  = $task->boys; 
			  $row['No of Girls']  = $task->girls; 
			  $row['No of Others']  = $task->others; 
			  $row['Total']  = $task->total; 
			  $row['Unit Number']  = $task->num_of_unit; 
			   $row['Type Of Cell']  = $task->type; 
				
		 fputcsv($file, array($row['Name Of Cell'],$row['Email ID'],$row['Affliated With'],$row['Date Of Affliation'],$row['Coordinator'],$row['Sub Cooordinator'],$row['No of Boys'],$row['No of Girls'],$row['No of Others'],$row['Total'],$row['Unit Number'],$row['Type Of Cell']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
    	    public function cellList(Request $request)
    {  
	   //$faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT cell.*,users.email as cellemail FROM `cell` join users on cell.id=users.profile_id where users.role='4' order by id desc"); 
	    return view('admin.office.cellList',compact('list'));
    }
		
	
   
    		    public function addCell(Request $request)
    {
           $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
	       return view('admin.office.addCell',compact('departments','faculty'));
    }
    
    public function saveCell(Request $request)
    {
        
        if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/cell/';
            $file->move($filePath, $filename);
        } else
        {
            $filename='';
        }
        if($request->hasFile('image')){
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/cell'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }else
        {
            $picture='';
        }
           
		 $dataArray      =  array(
	"name_of_the_cell" => $request->name,
	"type" => $request->type,
	"date_of_affiliation" => $request->dateofaffliation,
    "unit_number" => $request->unitnumber,
	"num_of_unit" => $request->noofunit,
	"email" => $request->email,
	"boys" => $request->boys,
	"girls" => $request->girls,
	"others" => $request->others,
	"total" => $request->total,
	"department" => $request->department,
	"cordinator" => $request->coordinator,
	"sub_cordinator" => $request->subcordinator,
	"phone" => $request->phonenum,
	"address" => $request->address,
	"affiliated_with" => $request->affliated,
	"description" => $request->description,
	 "previous_report" => $filename,
	 "picture" => $picture,
	"password"=> 'cell@123',
   );
   
    if($request->type!='')
   {
       $type=$request->type;
   }
   else
   {
       $type='';
   }
	$current_date_time = Carbon::now()->toDateTimeString();
        	$id  =   DB::table('cell')->insertGetId($dataArray);

		          $password='cell@123';
				  $loginvalues= array('name' => $request->name,
				                'email' => $request->email,
								 'role' => 4,
								 'type' => $type,
								 'password' => Hash::make($password),
								 'created_at' => $current_date_time,
								 'updated_at' => $current_date_time,
								 'profile_id'=> $id
								 );
			$result=DB::table('users')->insert($loginvalues);
	
	
	if($result==1){ 
                    	return response()->json(['success'=>'Cell Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	    public function checkemail(Request $req)
{
$email = $req->email;

$emailcheck = DB::table('users')->where('email',$email)->count();
if($emailcheck > 0)
{
return response()->json(['success'=>'Email Already in Use']);
}
}

      public function editCell(Request $request)
    {   
     set_time_limit(0);
		$id=$request->id;
		 
	    $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
		
        $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
        $profile_edit= DB::select("SELECT * FROM `cell` WHERE `id`='$id'");
   
		return view('admin.office.editCell',compact('profile_edit','departments','faculty'));
		
    }
     	public function editCellinfo(Request $request)
    {
		
       	$cellid = $request->editid;
		
        if($request->file1)
		{   
		   
               $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
          
            $filePath = public_path() . '/uploads/cell/';
            $file->move($filePath, $filename);
      
			 
        }
		else{
			$filename= $request->current_file;
		}
		if($request->hasFile('image')){
		    $products = DB::select("SELECT `picture` FROM `cell` WHERE id='$cellid'");
			  $path = public_path("uploads/cell/" . $products[0]->picture);
			  if (file_exists($path)) {
              @unlink($path);
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/cell'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
			  }
        }
        else{
		$picture=$request->current_file_img;
		}
	
		
			 $dataArray      =  array(
	"name_of_the_cell" => $request->name,
	"type" => $request->type,
	"date_of_affiliation" => $request->dateofaffliation,
    "unit_number" => $request->unitnumber,
	"num_of_unit" => $request->noofunit,
	"email" => $request->email,
	"boys" => $request->boys,
	"girls" => $request->girls,
	"others" => $request->others,
	"total" => $request->total,
	"department" => $request->department,
	"cordinator" => $request->coordinator,
	"sub_cordinator" => $request->subcordinator,
	"phone" => $request->phonenum,
	"address" => $request->address,
	"affiliated_with" => $request->affliated,
	"description" => $request->input('description'),
	 "previous_report" =>$filename,
	 "picture" => $picture,
	"password"=> 'cell@123',
    "updated_by"=>Auth::user()->id
   );
   
  	
        DB::table('cell')->where('id', $cellid)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
      public function deleteCell(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE cell.* FROM  cell where cell.id='$id'  ");
     DB::delete("DELETE users.* FROM users  where users.profile_id='$id'  ");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
        public function deleteCourse(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE course.* FROM  course where course.id='$id'  ");
     DB::delete("DELETE papers.* FROM papers  where papers.course_id='$id'  ");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
        public function deletePaper(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE papers.* FROM  papers where papers.id='$id'  ");
   
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
    // couurse    ////////////////////
		
    		public function downloadProgramListExcel(Request $request)
{
 
   $fileName = 'ProgramList.csv';
 
   $tasks = DB::select("SELECT * FROM `course`"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Program','Program Code','Date of Introduction','Program Credit');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
				 $row['Program']  = $task->course_name;
                $row['Program Code']  = $task->course_code;
                $row['Date of Introduction']  = $task->date_of_intro; 
                $row['Program Credit']  = $task->course_credit;
                
                fputcsv($file, array($row['Program'],$row['Program Code'],$row['Date of Introduction'], $row['Program Credit']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
      public function courseList(Request $request)
    {  
	     $type = Auth::user()->type;
	   if($type=='HOD')
	   {
	       
	      $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT department FROM `faculity` where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
	     $list = DB::select("SELECT course.* FROM `departments` join course on departments.`id`=course.departments
join faculity on faculity.department=departments.`department`
where faculity.department='$deprtmentname' group by(course.id) order by course.id ASC"); 
	    return view('admin.office.courseList',compact('list'));
	   }
	   else
	   {
		$list = DB::select("SELECT * FROM `course` order by id DESC"); 
	    return view('admin.office.courseList',compact('list'));
	   }
    }
      public function addCourse(Request $request)
    {
           $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
	       return view('admin.office.addCourse',compact('departments','faculty'));
    }
   
     public function saveCourse(Request $request)
    {
        
        if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/course/';
            $file->move($filePath, $filename);
        } else
        {
            $filename='';
        }
        
        $facultie = $request->faculty;
        if($facultie!=''){
        $faculties = implode(',',$facultie);
        }
        else{$faculties=''; }
        $sub_division= $request->sub_division;
		if($sub_division==''){
			$sub_division="NA";
		}
           
		 $data = array(
        "course_name" => $request->coursename,
        "course_code" =>  $request->coursecode,
        "date_of_intro" =>  $request->dateofaffliation,
        "course_credit" =>  $request->coursecredit,
         "course_type" =>  $request->course_type,
         "sub_division" =>  $sub_division,
         "faculties" =>  $faculties,
         "tenure" => $request->tenure,
		   "maxintake" =>  $request->maxintake,
		   "syllabus" => $filename,
          'departments' =>  $request->department
        );
	$current_date_time = Carbon::now()->toDateTimeString();
        	$id  =   DB::table('course')->insertGetId($data);

	
	
	if($id){ 
                    	return response()->json(['success'=>'Course Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
       public function editCourse(Request $request)
    {   
     set_time_limit(0);
		$id=$request->id;
	     $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
        $profile_edit= DB::select("SELECT * FROM `course` WHERE `id`='$id'");
    
		return view('admin.office.editCourse',compact('profile_edit','departments','faculty'));
		
    }
      public function saveCourseinfo(Request $request)
    {
       $courseid = $request->editid;
        if($request->file1)
		{   
		   
               $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
          
            $filePath = public_path() . '/uploads/course/';
            $file->move($filePath, $filename);
      
			 
        }
		else{
			$filename= $request->current_file;
		}
        
        $facultie = $request->faculty;
        $faculties = implode(',',$facultie);
        $sub_division= $request->sub_division;
		if($sub_division==''){
			$sub_division="NA";
		}
           
		 $data = array(
        "course_name" => $request->coursename,
        "course_code" =>  $request->coursecode,
        "date_of_intro" =>  $request->dateofaffliation,
        "course_credit" =>  $request->coursecredit,
         "course_type" =>  $request->course_type,
         "sub_division" =>  $sub_division,
         "faculties" =>  $faculties,
       //  "tutor" =>  $request->tutor,
         "tenure" => $request->tenure,
		   "maxintake" =>  $request->maxintake,
		   "syllabus" => $filename,
          'departments' =>  $request->department,
          'updated_by' =>  Auth::user()->id
        );
	$current_date_time = Carbon::now()->toDateTimeString();
         $id= DB::table('course')->where('id', $courseid)->update($data);

	
	
	if($id){ 
                    	return response()->json(['success'=>'Course Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
    
           public function addPaper(Request $request)
    {   
    
		 $id=$request->id;
	    
        $list= DB::select("SELECT * FROM `papers` WHERE `course_id`='$id'");
    
		return view('admin.office.addPaper',compact('list','id'));
		
    }
     public function savePaper(Request $request)
    {
         $courseid=$request->editid;
       
        

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
             "course_id" => $courseid ,
             "p_code" =>$request->p_code[$i], 
             "p_name" =>$request->p_name[$i], 
             "p_credit" =>$request->p_credit[$i], 
             "p_hourse" =>$request->p_hourse[$i],
             "p_type" =>$request->p_type[$i],
             "theory_subdivision" =>$request->p_theory[$i],
             "p_syllabus" =>  $paperdoc ,
             "p_semester" =>$request->p_semester[$i]
    
             ); 
 
           $result=DB::table('papers')->insert($data1);
           

}

	
	if($result==1){ 
                    	return response()->json(['success'=>'Pape Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    
}
   public function researchList(Request $request)
    {  
	   	$list = DB::select("SELECT research_centres.*,departments.department FROM `research_centres` join departments on research_centres.affliated_dept=departments.id order by id desc"); 
	    return view('admin.office.researchList',compact('list'));
	   
    }
		
    		public function downloadResearchCentreExcel(Request $request)
{
 
   $fileName = 'ResearchCentreList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT research_centres.*,departments.department FROM `research_centres` join departments on research_centres.affliated_dept=departments.id order by id desc"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Type','Name of Research Centre','Department','Hod','Faculty');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
				 $row['Type']  = $task->type;
                $row['Name of Research Centre']  = $task->name_research_centre;
                $row['Department']  = $task->department; 
                $row['Hod']  = $task->hod;
                 $row['Faculty']  = $task->faculty;
              
               
                fputcsv($file, array($row['Type'],$row['Name of Research Centre'],$row['Department'], $row['Hod'],$row['Faculty']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	 public function addResearchCentre(Request $request)
    {
           $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
           $hod = DB::select("SELECT * FROM `faculity` WHERE FIND_IN_SET('HOD', `position`)");  
	       return view('admin.office.addResearchCenter',compact('departments','faculty','hod'));
    }
	       public function saveResearch(Request $request)
    {
       
        
        $facultie = $request->faculty;
        if($facultie!=''){
        $faculties = implode(',',$facultie);
        }
        else{$faculties=''; }
       $current_date_time = Carbon::now()->toDateTimeString();
           
		 $data = array(
		 "type" =>  $request->course_type,
         "name_research_centre" => $request->centrename,
         'affliated_dept' =>  $request->department,
         "hod" =>  $request->departmenthod,
         "faculty" =>  $faculties,
         "other_faculty" => $request->other,
		 "created_date" => $current_date_time,
		  );
	
        	$id  =   DB::table('research_centres')->insertGetId($data);

	
	
	if($id){ 
                    	return response()->json(['success'=>'Research Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	           public function   deleteResearchCenter(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE research_centres.* FROM  research_centres where research_centres.id='$id'  ");
     return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               

    }
	         public function  deleteResearchGuide(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE research_guide.* FROM  research_guide where research_guide.id='$id'  ");
     DB::delete("DELETE users.* FROM users  where users.profile_id='$id' and users.role='7'");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
	      public function deleteResearchFellow(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE research_fellow.* FROM  research_fellow where research_fellow.id='$id'  ");
     DB::delete("DELETE users.* FROM users  where users.profile_id='$id' and users.role='8'");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
	 public function addResearchGuide(Request $request)
    {
           $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
           $hod = DB::select("SELECT * FROM `faculity` WHERE FIND_IN_SET('HOD', `position`)");  
           $centers= DB::select("SELECT * from research_centres ORDER BY id desc"); 
	       return view('admin.office.addResearchGuide',compact('departments','faculty','hod','centers'));
    }
	   public function editResearchGuide(Request $request)
    {   
     
		   $id=$request->id;
    	   $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
           $hod = DB::select("SELECT * FROM `faculity` WHERE FIND_IN_SET('HOD', `position`)");  
           $centers= DB::select("SELECT * from research_centres ORDER BY id desc"); 
           $profile_edit= DB::select("SELECT * FROM `research_guide` WHERE `id`='$id'");
	       return view('admin.office.editResearchGuide',compact('departments','faculty','hod','centers','profile_edit'));
		
    }
	
	
	          public function editInfoResearchGuide(Request $request)
    {
       $editid=  $request->editid;
      
         if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . 'A001'.'.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyresume/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
           if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . '001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2=$request->current_file1;
        }

 if($request->hasFile('image')){
          $image = $request->file('image');
        
          $picture = time() . '.' . $image->getClientOriginalExtension();
          
           $image->move(public_path('uploads/facultyimg'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }
        else
        {
            $picture=$request->current_file_img;
        }
   
       
       $current_date_time = Carbon::now()->toDateTimeString();
           
		 $data = array(
		
         'supervisor_name' =>  $request->supervisor,
         "designation" =>  $request->designation,
         "parentinstitute" =>  $request->parentinst,
         "phone_number" => $request->phonenum,
         "is_belongs_to_faculty" => $request->facultybelong,
         "domain" => $request->domain,
         "subject" => $request->subject,
          "resume" => $filename,
         "guide_shiporder" => $filename2,
          "picture" => $picture,
		 "created_date" => $current_date_time,
		  );
	
        	$id  =   DB::table('research_guide')->where('id', $editid)->update($data) ;

	if($id){ 
                  
		       	 return response()->json(['id' => $id]);
                } 
                else{
                     return response('There is some issue', 200); 
                }

    }
	
              public function saveResearchGuide(Request $request)
    {
       
         if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . 'A001'.'.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyresume/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
           if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . '001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/facultyresume/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2='';
        }

      if($request->hasFile('image')){
          $image = $request->file('image');
          $picture = time() . '.' . $image->getClientOriginalExtension();
           $image->move(public_path('uploads/facultyresume/'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }
        {
            $picture='';
        }
         
       
       $current_date_time = Carbon::now()->toDateTimeString();
           
		 $data = array(
		 "research_centre_id" => $request->centername,
         "type" => $request->type,
         'supervisor_name' =>  $request->supervisor,
         "designation" =>  $request->designation,
         "parentinstitute" =>  $request->parentinst,
		  "phone_number" => $request->phonenum,
         "is_belongs_to_faculty" => $request->facultybelong,
         "domain" => $request->domain,
         "subject" => $request->subject,
          "email" => $request->email,
		  "resume" => $filename,
         "guide_shiporder" => $filename2,
          "picture" => $picture,
		 "created_date" => $current_date_time,
		  );
	
        	$id  =   DB::table('research_guide')->insertGetId($data);
if($request->facultybelong=='Yes')
  {
      $guide_unique_phno=$request->phonenum;
      $retrieving_phno=  DB::select("SELECT `fid` FROM `faculity` WHERE `phone_number`='$guide_unique_phno'");
      $facultyguideid=$retrieving_phno[0]->fid;
      $guideid=$id;
      	 $dataguidefaculty  =  array(
	"research_guide_id" => $guideid,
	"faculty_id" => $facultyguideid,
               ); 
    DB::table('fellow_guide_faculty_master')->insertGetId($dataguidefaculty);
  }else
  {      $guideid=$id;
       $dataguidefaculty  =  array(
	"research_guide_id" => $guideid,
               ); 
               
     DB::table('fellow_guide_faculty_master')->insertGetId($dataguidefaculty);           
  }
  
	    $password1='researchGuide@123';
		$string = preg_replace('/[^a-z]/i', '', $request->supervisor);
	    $randomString=$string.$id;
	  //  $randomString=trim($request->supervisor).$id;
         $email = $randomString.'@mes.org';
        
				  $loginvalues= array('name' => $request->supervisor,
				                'email' => $email,
								 'role' => 7,
								 'password' => Hash::make($password1),
								 'created_at' => $current_date_time,
								 'updated_at' => $current_date_time,
								 'profile_id'=> $id
								 );
			$result=DB::table('users')->insert($loginvalues);
	
	if($id){ 
                   $data[] =  array('password'=>$password1, 'emailnew'=>$email);
		
                   return response()->json($data);
                   
                   // return response()->json(['success'=>'Research Guide Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	    public function fetchResearch_type(Request $request)
    {
		$id= $request->idCenter;

       $categories = DB::select("SELECT type FROM research_centres where id ='$id' ");
	   $type  =$categories[0]->type;
	   $data[] = array('type'=>$type);
       echo json_encode($data);
    }
	      public function researchGuideList(Request $request)
    {  
	   	$list = DB::select("SELECT research_guide.*,research_centres.name_research_centre FROM research_guide join research_centres on research_guide.research_centre_id=research_centres.id order by id desc"); 
	    return view('admin.office.researchGuideList',compact('list'));
	   
    }
	    		public function downloadResearchGuideExcel(Request $request)
{
 
   $fileName = 'ResearchGuideList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT research_guide.*,research_centres.name_research_centre FROM research_guide join research_centres on research_guide.research_centre_id=research_centres.id order by id desc"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Type','Name of Research Centre','Supervisor Name','Designation','Parent Institute','Domain','Subject','Is Belong To Faculty','Phone No');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
				 $row['Type']  = $task->type;
                $row['Name of Research Centre']  = $task->name_research_centre;
                $row['Supervisor Name']  = $task->supervisor_name; 
                $row['Designation']  = $task->designation;
                 $row['Parent Institute']  = $task->parentinstitute;
				 $row['Domain']  = $task->domain;
				 $row['Subject']  = $task->subject;
				 $row['Is Belong To Faculty']  = $task->is_belongs_to_faculty;
				 $row['Phone No']  = $task->phone_number;
              
               
                fputcsv($file, array($row['Type'],$row['Name of Research Centre'],$row['Supervisor Name'], $row['Designation'],$row['Parent Institute'],$row['Domain'],$row['Subject'],$row['Is Belong To Faculty'],$row['Phone No']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	  		    public function addResearchFellow(Request $request)
    {
           $departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
           $researchCenters =  DB::select("SELECT `name_research_centre`,`id` from research_centres ORDER BY id ASC"); 
	       return view('admin.office.addResearchFellow',compact('departments','researchCenters'));
    }
	    public function fetchSupervisor(Request $request)
    {
		$id= $request->idSupervisor;
	
        $data['supervisor'] = DB::select("SELECT research_guide.`id`,research_guide.`supervisor_name` FROM `research_guide` join research_centres on research_guide.research_centre_id=research_centres.id where research_centres.id='$id'");
		
        return response()->json($data);
    }
	      public function fetchguide(Request $request)
    {
		$id= $request->idSupervisor;
	
      $supervisor = DB::select("SELECT research_guide.`id`,research_guide.`supervisor_name` FROM `research_guide` left join research_centres on research_guide.research_centre_id=research_centres.id where research_guide.id='$id'");
$data['id'] =$supervisor[0]->id;
$data['supervisor_name'] =$supervisor[0]->supervisor_name;
        return response()->json($data);
    }
	
	   public function editResearchFellow(Request $request)
    {   
     
		   $id=$request->id;
    	   $departments =  DB::select("SELECT * from departments ORDER BY id ASC"); 
           $faculty = DB::select("SELECT * from faculity ORDER BY fid ASC"); 
           $hod = DB::select("SELECT * FROM `faculity` WHERE FIND_IN_SET('HOD', `position`)");  
           $centers= DB::select("SELECT * from research_centres ORDER BY id desc"); 
           $profile_edit= DB::select("SELECT * FROM `research_fellow` WHERE `id`='$id'");
	       return view('admin.office.editResearchFellow',compact('departments','faculty','hod','centers','profile_edit'));
		
    }
	
	                public function editInfoResearchFellow(Request $request)
    {
       $editid=  $request->editid;
      
         if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . 'A001'.'.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
           if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = time() . 'B001'.'.' . $request->file('file2')->extension();
            $filePath2 = public_path() . '/uploads/student/';
            $file->move($filePath2, $filename2);
        }
        else
        {
            $filename2=$request->current_file2;
        }
            if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = time() . 'C001'.'.' . $request->file('file3')->extension();
            $filePath3 = public_path() . '/uploads/student/';
            $file->move($filePath3, $filename3);
        }
        else
        {
            $filename3=$request->current_file3;
        }
            if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = time() . 'D001'.'.' . $request->file('file4')->extension();
            $filePath4 = public_path() . '/uploads/student/';
            $file->move($filePath4, $filename4);
        }
        else
        {
            $filename4=$request->current_file4;
        }

 if($request->hasFile('image')){
          $image = $request->file('image');
        
          $picture = time() . '.' . $image->getClientOriginalExtension();
          
           $image->move(public_path('uploads/student'), $picture);
         // Image::make($image)->resize(300, 300)->save( public_path('/uploads/facultyimg' . $picture ) );
          
        }
        else
        {
            $picture=$request->current_file_img;
        }
   
       
       $current_date_time = Carbon::now()->toDateTimeString();
      
		 $dataArray      =  array(
	"name" => $request->name,
	"guardian" => $request->guardianName,
    "dob" => $request->dateofbirth,
	"date_of_join" => $request->dateofjoining,
	"gender" => $request->gender,
	"phone_number" => $request->phonenum,
	"email_id" => $request->email,
	"department" => $request->department_original,
	"research_centre" => $request->department,
	"guide_name" => $request->supervisor,
	"designation" => $request->designation,
	"research_title" => $request->titleresearch,
	"subject_one" => $request->subkeyword,
	"subject_two" => $request->subkeywordtwo,
	"subject_three" => $request->subkeywordthree,
	 "picture" => $picture,
	 "reg_award" => $filename,
	 "memo" => $filename2,
	 "pqe" => $filename3,
	 "research_award" => $filename4,
	 "is_belongs_to_faculty" => $request->facultybelong,
	 
   ); 
   
	
        	$id  =   DB::table('research_fellow')->where('id', $editid)->update($dataArray) ;

	if($id){ 
                  
		       	 return response()->json(['id' => $id]);
                } 
                else{
                     return response('There is some issue', 200); 
                }

    }
	
	
	
		    public function saveResearchFellow(Request $request)
    {
       $randomNumber = rand(15,999999);
        $randomNumber1 = rand(20,999999);
        $randomNumber2 = rand(25,999999);
        $randomNumber3 = rand(30,999999);
        $randomNumber4 = rand(35,999999);
     
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
            if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $file1 = $randomNumber1.time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $file1);
        }
        else
        {
            $file1='';
        }
		
		     if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $file2 = $randomNumber2.time() . '.' . $request->file('file2')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $file2);
        }
        else
        {
            $file2='';
        }
		       if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $file3 = $randomNumber3.time() . '.' . $request->file('file3')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $file3);
        }
        else
        {
            $file3='';
        }
		        if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $file4 = $randomNumber4.time() . '.' . $request->file('file4')->extension();
            $filePath = public_path() . '/uploads/student/';
            $file->move($filePath, $file4);
        }
        else
        {
            $file4='';
        }
        $current_date_time = Carbon::now()->toDateTimeString();
      
		 $dataArray      =  array(
	"name" => $request->name,
	"guardian" => $request->guardianName,
    "dob" => $request->dateofbirth,
	"date_of_join" => $request->dateofjoining,
	"gender" => $request->gender,
	"phone_number" => $request->phonenum,
	"email_id" => $request->email,
	"department" => $request->department_original,
	"research_centre" => $request->department,
	"guide_name" => $request->supervisor,
	"designation" => $request->designation,
	"research_title" => $request->titleresearch,
	"subject_one" => $request->subkeyword,
	"subject_two" => $request->subkeywordtwo,
	"subject_three" => $request->subkeywordthree,
	 "picture" => $picture,
	  "reg_award" => $file1,
	 "memo" => $file2,
	 "pqe" => $file3,
	 "research_award" => $file4,
	 "is_belongs_to_faculty" => $request->facultybelong,
	 
	 
   ); 
   
  $id  =   DB::table('research_fellow')->insertGetId($dataArray);
  if($request->facultybelong=='Yes')
  {
      $fellow_unique_phno=$request->phonenum;
      $retrieving_phno=  DB::select("SELECT `fid` FROM `faculity` WHERE `phone_number`='$fellow_unique_phno'");
      $facultyfellowid=$retrieving_phno[0]->fid;
      $fellowid=$id;
      	 $datafellowfaculty  =  array(
	"research_fellow_id" => $fellowid,
	"faculty_id" => $facultyfellowid,
               ); 
    DB::table('fellow_guide_faculty_master')->insertGetId($datafellowfaculty);
  }else
  {      $fellowid=$id;
       $datafellowfaculty  =  array(
	"research_fellow_id" => $fellowid,
               ); 
               
     DB::table('fellow_guide_faculty_master')->insertGetId($datafellowfaculty);           
  }
  
   $password1='researchFellow@123';
   $string = preg_replace('/[^a-z]/i', '', $request->name);
   $randomString=$string.$id;
  // $randomString=trim($request->name).$id;
    $email = $randomString.'@mes.org';
        
				  $loginvalues= array('name' => $request->name,
				                'email' => $email,
								 'role' => 8,
								 'password' => Hash::make($password1),
								 'created_at' => $current_date_time,
								 'updated_at' => $current_date_time,
								 'profile_id'=> $id
								 );
			$result=DB::table('users')->insert($loginvalues);
	
         if($result){ 
                    	$data[] =  array('password'=>$password1, 'emailnew'=>$email);
                    	return response()->json($data);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	     public function researchFellowList(Request $request)
    {  
	   	$list = DB::select("SELECT research_fellow.*,research_centres.name_research_centre,  research_guide.supervisor_name from research_fellow join research_centres
on research_fellow.research_centre=research_centres.id
left join research_guide on research_guide.id=research_fellow.guide_name
"); 
	    return view('admin.office.researchFellowList',compact('list'));
	   
    }
		    		public function downloadResearchFellowExcel(Request $request)
{
 
   $fileName = 'ResearchFellowList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT research_fellow.*,research_centres.name_research_centre,  research_guide.supervisor_name from research_fellow join research_centres
on research_fellow.research_centre=research_centres.id
left join research_guide on research_guide.id=research_fellow.guide_name"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Name of Research Centre','Research Guide','Research Fellow','Designation','Department','Research Title','Subject One','Subject Two','Subject Three','Is Belong To Faculty','Phone No','Date Of Birth','Date Of Join','Gender','Email ID');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
			  $row['Name of Research Centre']  = $task->name_research_centre;
                $row['Research Guide']  = $task->supervisor_name; 
				  $row['Research Fellow']  = $task->name; 
                $row['Designation']  = $task->designation;
                 $row['Department']  = $task->department;
				 $row['Research Title']  = $task->research_title;
				 $row['Subject One']  = $task->subject_one;
				 $row['Subject Two']  = $task->subject_two;
				 $row['Subject Three']  = $task->subject_three;
                 $row['Is Belong To Faculty']  = $task->is_belongs_to_faculty;
				 $row['Phone No']  = $task->phone_number;
				 $row['Date Of Birth']  = $task->dob;
				  $row['Date Of Join']  = $task->date_of_join;
				    $row['Gender']  = $task->gender;
					   $row['Email ID']  = $task->email_id;
               
                fputcsv($file, array($row['Name of Research Centre'],$row['Research Guide'],$row['Research Fellow'], $row['Designation'],$row['Department'],$row['Research Title'],$row['Subject One'],$row['Subject Two'], $row['Subject Three'],$row['Is Belong To Faculty'],$row['Phone No'],$row['Date Of Birth'],$row['Date Of Join'],$row['Gender'],$row['Email ID']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	///naaaccc///
	  		    public function addNaacKeyword(Request $request)
    {
        $list =  DB::select("SELECT keywordname,id from naac_keyword ORDER BY id ASC");
         return view('admin.office.addNaacKeyword',compact('list'));
    } 
             public function deleteNaackeyword(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE naac_keyword.* FROM  naac_keyword where naac_keyword.id='$id'  ");
     return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   }
        public function checkKeyword(Request $req)
{
$name = $req->name;

$keycheck = DB::table('naac_keyword')->where('keywordname',$name)->count();
if($keycheck > 0)
{
echo "1";
}
}
     public function saveNaacKeyword(Request $request)
    {
             $keywords= array('keywordname' => $request->name);
			$result=DB::table('naac_keyword')->insert($keywords);
	
	
	if($result==1){ 
                    	return response()->json(['success'=>'Naac Keyword Created Succesffully']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
}
