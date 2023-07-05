<?php

namespace App\Http\Controllers\Cell;
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


class CellController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }  
	    public function dashboard(Request $request)
    {
		    $faculty_id =  Auth::user()->profile_id;
		 $list= DB::select("SELECT * FROM `cell` WHERE `id`='$faculty_id'");
	
         return view('admin.cell.home',compact('list'));
       
    }
	
	   public function editProfileImage($id='')
    {   
         $idd= Auth::user()->profile_id;
	     return view('admin.cell.profileImageEdit',compact('idd'));
    }

    	public function storeProfileImage(Request $request)
    {
     $validation = Validator::make($request->all(), [
      'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
     ]);
     if($validation->passes())
     {     
             $profileid = Auth::user()->profile_id;
			 
			 // $products = DB::select("SELECT `picture` FROM `cell` WHERE id='$profileid'");
			 // $path = public_path("uploads/cell/" . $products[0]->picture);
		
			  
      $image = $request->file('select_file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('uploads/cell'), $new_name);
	   $postArray = ['picture' => $new_name];
        DB::table('cell')->where('id',  $profileid)->update($postArray);
      return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="{{url(uploads/cell/'.$new_name.')}}" class="img-thumbnail" width="300" />',
	 
       'class_name'  => 'alert-success'
      ]);
			  
     }
     else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_image' => '',
       'class_name'  => 'alert-danger'
      ]);
     }
    }
	
   		    public function addEvent(Request $request)
    {
                
		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC");
		 return view('admin.cell.events',compact('collabrators','departments','cells','naac'));
    }
	
	 	    public function addwebEvent(Request $request)
    {
                
		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
			$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC");
		 return view('admin.cell.webevents',compact('collabrators','departments','cells','naac'));
    }
	
	       	    public function storewebevent(Request $request)
    {
        
        if($request->collabratorsdeptdata=='')
        {
          $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT `cordinator` FROM `cell` WHERE id='$cellid'"); 
          $id = $cordinator_id[0]->cordinator;
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
          $coldept=$departmentid[0]->id;
        }
		 else if($request->collabratorsdeptdata=='All')
          {
            $collabratingdept=  DB::select("SELECT id FROM `departments`"); 
            
            $locations = [];
foreach ($collabratingdept as $plocations)
{
    $locations[] = $plocations->id;
}
$coldept= implode(",",$locations);

          } else
          {
              $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT `cordinator` FROM `cell` WHERE id='$cellid'"); 
          $id = $cordinator_id[0]->cordinator;
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
          $array1=$departmentid[0]->id;
              
              $array2=$request->collabratorsdeptdata;
             $HiddenProducts = explode(',',$array2);
               if (in_array($array1, $HiddenProducts))
               {
              $coldept=$request->collabratorsdeptdata;
               }
              else
              {  
                   $arr=array($array1); 
                    $arr1= $request->collabratorsdeptdata;
                  $result_array=  array_map('intval', explode(',', $arr1));
                
 
                  $ordata= array_unique(array_merge($arr, $result_array)); 
                  $coldept = implode(',', $ordata);
                                       
                  
              }
          }
		  
          $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT * FROM `cell` WHERE id='$cellid'"); 
          $cordinator = $cordinator_id[0]->cordinator;
          $subcoordinator= $cordinator_id[0]->sub_cordinator;
		 $dataArray      =  array(
	"fid"=> Auth::user()->profile_id,
	"title" => $request->title,
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"description" => $request->description,
	"vurl" => $request->vurl,
	"surl" => $request->surl,
	 "instagram_url" => $request->insta,
	 "linkedin_url" => $request->linkedin,
	 "facebook_url" => $request->facebook,
   "practice" => $request->catlearn,
	"collaborators" => $request->collabratorsdata,
	"dept" => $coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"type" => 'Cell',
	"coordinator"=>$cordinator,
	"sub_cordinator"=>$subcoordinator,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('cell_events')->insertGetId($dataArray);
	if($id)
	{
		 return response()->json(['id' => $id]);
		
        //return response('Inserted Successfully.', 200); 
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
	
	  	 public function editwebEvent($id='',$type)
    {   
     
        $event_edit= DB::select("select cell_events.* from cell_events where cell_events.id='$id'");
       
        $collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC");
		if($type=='Cell')
		{
		   
		return view('admin.cell.editwebEvent',compact('event_edit','collabrators','departments','cells','naac'));
		}
	
    }
       	    public function store(Request $request)
    {
        
        if($request->collabratorsdeptdata=='')
        {
          $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT `cordinator` FROM `cell` WHERE id='$cellid'"); 
          $id = $cordinator_id[0]->cordinator;
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
          $coldept=$departmentid[0]->id;
        }
		 else if($request->collabratorsdeptdata=='All')
          {
            $collabratingdept=  DB::select("SELECT id FROM `departments`"); 
            
            $locations = [];
foreach ($collabratingdept as $plocations)
{
    $locations[] = $plocations->id;
}
$coldept= implode(",",$locations);

          } else
          {
              $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT `cordinator` FROM `cell` WHERE id='$cellid'"); 
          $id = $cordinator_id[0]->cordinator;
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
          $array1=$departmentid[0]->id;
              
              $array2=$request->collabratorsdeptdata;
             $HiddenProducts = explode(',',$array2);
               if (in_array($array1, $HiddenProducts))
               {
              $coldept=$request->collabratorsdeptdata;
               }
              else
              {  
                   $arr=array($array1); 
                    $arr1= $request->collabratorsdeptdata;
                  $result_array=  array_map('intval', explode(',', $arr1));
                
 
                  $ordata= array_unique(array_merge($arr, $result_array)); 
                  $coldept = implode(',', $ordata);
                                       
                  
              }
          }
          $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT * FROM `cell` WHERE id='$cellid'"); 
          $cordinator = $cordinator_id[0]->cordinator;
          $subcoordinator= $cordinator_id[0]->sub_cordinator;
		 
		 $dataArray      =  array(
	"fid"=> Auth::user()->profile_id,
	"title" => $request->title,
	"category" => $request->Category,
	"eventtype" => $request->eventtype,
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"venue" => $request->venue,
	"description" => $request->description,
	"agenda" => $request->agenda,
	"male_teacher" => $request->male_teacher,
	"female_teacher" => $request->female_teacher,
	"other_teacher" => $request->other_teacher,
	"no_teachers" => $request->total_teacher,
	"male_student" => $request->male_student,
	"female_student" => $request->female_student,
	"other_student" => $request->other_student,
	"no_students" => $request->total_student,
	"specially_abled" => $request->specially_abled,
	"caste_obc" => $request->caste_obc,
	"caste_sc" => $request->caste_sc,
	"caste_st" => $request->caste_st,
	"ews" => $request->ews,
	"promotors" => $request->promoter,
	"comm_name" => $request->com_name,
	"comm_details" => $request->com_det,
	"panchayath" => $request->panchayath,
	"ward" => $request->ward,
	"vurl" => $request->vurl,
	"surl" => $request->surl,
	 "instagram_url" => $request->insta,
	 "linkedin_url" => $request->linkedin,
	 "facebook_url" => $request->facebook,
	"no_male" => $request->nom,
	"no_female" => $request->nof,
	"practice" => $request->catlearn,
	"collaborators" => $request->collabratorsdata,
	"dept" => $coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"type" => 'Cell',
	"coordinator"=>$cordinator,
	"sub_cordinator"=>$subcoordinator,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('cell_events')->insertGetId($dataArray);
	if($id)
	{
		 return response()->json(['id' => $id]);
		
        //return response('Inserted Successfully.', 200); 
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
    
	public function storeMultiFile(Request $request)
    {
          $celleventid = $request->editid;
       $validatedData = $request->validate([
        //'files' => 'required',
        'files.*' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
 
        if($request->TotalFiles > 0)
        {
                
           for ($x = 0; $x < $request->TotalFiles; $x++) 
           {
 
               if ($request->hasFile('files'.$x)) 
                {
                    $file      = $request->file('files'.$x);
                   $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = time().'-'.date('His').'-'.$filename;
			 $file->move(public_path('uploads/faculty'), $picture);
            $postArray = ['picture' => $picture,'type'=>'cellevent','fid' => $celleventid];
            DB::table('picture')->insert($postArray);
              
                }
				 
           }
 
          
 
            return response()->json(['success'=>'Ajax Multiple fIle has been uploaded']);
 
          
        }
        else
        {
           return response()->json(["message" => "Please try again."]);
        }
	}
	public function updateFileUpload(Request $request)
    {
		
        $request->validate([
            'file' => 'mimes:doc,docx,pdf,zip,rar',
        ]);
        if($request->file)
		{
        $fileName = time().'.'.$request->file->extension();  
         
        $request->file->move(public_path('uploads/facultyfile'), $fileName);
        }
		else{
			$fileName= '';
		}
		$dataArray      =  array(
	  'uploadfile' => $fileName
	  );
		$celleventid = $request->editidf;
		
        DB::table('cell_events')->where('id',$celleventid)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
    
        public function eventList(Request $request)
    {  
       
          $type = Auth::user()->type;

	
	   $cell_id = Auth::user()->profile_id;
		$list = DB::select("SELECT DISTINCT cell_events.`id`,`eventtype`,cell_events.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,cell_events.`type`,cell_events.`category`,group_concat(departments.department) as dept,group_concat(cell.name_of_the_cell) as cell FROM `cell_events` LEFT join departments  ON FIND_IN_SET(departments.id, cell_events.dept) != 0
LEFT join faculity on faculity.fid=cell_events.coordinator
LEFT join cell on FIND_IN_SET(cell.id, cell_events.cell)!= 0
where cell_events.`fid`='$cell_id' group by cell_events.id order by cell_events.id desc"); 
	    return view('admin.cell.eventsList',compact('list'));
	   
    }
       public function deleteEvent(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE cell_events.* FROM cell_events  where cell_events.id='$id'  ");
	 DB::delete("DELETE picture.* FROM picture  where picture.fid='$id'  ");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
    
    	 public function editEvent($id='',$type)
    {   
      /*    if(auth()->user()->role==2)
        {
             
        $faculty_eventid=$id;
       
        } */
		
        $event_edit= DB::select("select cell_events.* from cell_events where cell_events.id='$id'");
    
        $collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC");
		if($type=='Cell')
		{
		   
		return view('admin.cell.editEvent',compact('event_edit','collabrators','departments','cells','naac'));
		}
	
    }
             	  public function updatewebEvent(Request $request)
    {
		  if($request->collabratorsdeptdata=='All')
          {
            $collabratingdept=  DB::select("SELECT id FROM `departments`"); 
            
            $locations = [];
foreach ($collabratingdept as $plocations)
{
    $locations[] = $plocations->id;
}
$coldept= implode(",",$locations);

          } else
          {
                $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT `cordinator` FROM `cell` WHERE id='$cellid'"); 
          $id = $cordinator_id[0]->cordinator;
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
          $array1=$departmentid[0]->id;
              
              $array2=$request->collabratorsdeptdata;
             $HiddenProducts = explode(',',$array2);
               if (in_array($array1, $HiddenProducts))
               {
              $coldept=$request->collabratorsdeptdata;
               }
              else
              {  
                   $arr=array($array1); 
                    $arr1= $request->collabratorsdeptdata;
                  $result_array=  array_map('intval', explode(',', $arr1));
                
 
                  $ordata= array_unique(array_merge($arr, $result_array)); 
                  $coldept = implode(',', $ordata);
                                       
                  
              }
          }
          
          
      
          
		 $dataArray      =  array(
	"fid"=> Auth::user()->profile_id,
	"title" => $request->title,
	"eventtype" => 'Cell',
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"description" => $request->description,
    "vurl" => $request->vurl,
	"surl" => $request->surl,
	 "instagram_url" => $request->insta,
	 "linkedin_url" => $request->linkedin,
	 "facebook_url" => $request->facebook,
	"practice" => $request->catlearn,
	"collaborators" => $request->collabratorsdata,
	"dept" => $coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	$editid=$request->editid;
	$result  =   DB::table('cell_events')->where('id', $editid)->update($dataArray);
	
	
	if($result)
	{
		
	return response()->json(['id' => $result]);
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
	 public function editImage($id='')
    {   
         $idd=$id;
	
        $list= DB::select("SELECT * FROM `picture` where picture.fid='$id' ORDER BY `pid` DESC");
       
		return view('admin.cell.eventsImageList',compact('list','idd'));
    }
    	   public function deleteEventImage(Request $request)
    {

    
      $id= $request->id;

	 
$result = 	DB::delete("DELETE picture.* FROM picture  where picture.pid='$id'  ");
	 return redirect()->back()->with('status', ' Images have been Deleted Successfully !!');

    }
     public function createPDF($id) {
		
      // retreive all records from db
       $event_edit= DB::select("select cell_events.* from cell_events where cell_events.id='$id'");
        $collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$list = DB::select("SELECT  * FROM `cell_events` where `id`='$id' order by id desc"); 
		$imagelist= DB::select("SELECT * FROM `picture` where picture.fid='$id' ORDER BY `pid` DESC");
    // return view('admin.faculty.pdf',compact('list','naac','collabrators','cells','departments','imagelist'));
     $pdf = PDF::loadView('admin.cell.pdf', compact('list','naac','collabrators','cells','departments','imagelist'));
     return $pdf->download('pdf_file.pdf');
    }
    	  public function updateEvent(Request $request)
    {
		  if($request->collabratorsdeptdata=='All')
          {
            $collabratingdept=  DB::select("SELECT id FROM `departments`"); 
            
            $locations = [];
foreach ($collabratingdept as $plocations)
{
    $locations[] = $plocations->id;
}
$coldept= implode(",",$locations);

          } else
          {
                $cellid = Auth::user()->profile_id;
          $cordinator_id = DB::select("SELECT `cordinator` FROM `cell` WHERE id='$cellid'"); 
          $id = $cordinator_id[0]->cordinator;
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
          $array1=$departmentid[0]->id;
              
              $array2=$request->collabratorsdeptdata;
             $HiddenProducts = explode(',',$array2);
               if (in_array($array1, $HiddenProducts))
               {
              $coldept=$request->collabratorsdeptdata;
               }
              else
              {  
                   $arr=array($array1); 
                    $arr1= $request->collabratorsdeptdata;
                  $result_array=  array_map('intval', explode(',', $arr1));
                
 
                  $ordata= array_unique(array_merge($arr, $result_array)); 
                  $coldept = implode(',', $ordata);
                                       
                  
              }
          }
          
          
      
          
		 $dataArray      =  array(
	"fid"=> Auth::user()->profile_id,
	"title" => $request->title,
	"category" => $request->Category,
	"eventtype" => 'Cell',
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"venue" => $request->venue,
	"description" => $request->description,
	"agenda" => $request->agenda,
	"male_teacher" => $request->male_teacher,
	"female_teacher" => $request->female_teacher,
	"other_teacher" => $request->other_teacher,
	"no_teachers" => $request->total_teacher,
	"male_student" => $request->male_student,
	"female_student" => $request->female_student,
	"other_student" => $request->other_student,
	"no_students" => $request->total_student,
	"specially_abled" => $request->specially_abled,
	"caste_obc" => $request->caste_obc,
	"caste_sc" => $request->caste_sc,
	"caste_st" => $request->caste_st,
	"ews" => $request->ews,
	"promotors" => $request->promoter,
	"comm_name" => $request->com_name,
	"comm_details" => $request->com_det,
	"panchayath" => $request->panchayath,
	"ward" => $request->ward,
	"vurl" => $request->vurl,
	"surl" => $request->surl,
	 "instagram_url" => $request->insta,
	 "linkedin_url" => $request->linkedin,
	 "facebook_url" => $request->facebook,
	"no_male" => $request->nom,
	"no_female" => $request->nof,
	"practice" => $request->catlearn,
	"collaborators" => $request->collabratorsdata,
	"dept" => $coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	$editid=$request->editid;
	$result  =   DB::table('cell_events')->where('id', $editid)->update($dataArray);
	
	
	if($result)
	{
		
	return response()->json(['id' => $result]);
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
    
    	public function editupdateFileUpload(Request $request)
    {
		
        $request->validate([
            'file' => 'mimes:doc,docx,pdf,zip,rar',
        ]);
        if($request->file)
		{ 
        $fileName = time().'.'.$request->file->extension();  
         
        $request->file->move(public_path('uploads/facultyfile'), $fileName);
        }
		else{
			$fileName= $request->current_file;
		}
		$dataArray      =  array(
	  'uploadfile' => $fileName
	  );
		$cellid = $request->editidf;
		
        DB::table('cell_events')->where('id',$cellid)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
        public function editFileImage($id='')
    {   
         $idd=$id;
	
        $list= DB::select("SELECT * FROM `cell_events` where cell_events.id='$id'");
     
		return view('admin.cell.eventsFileList',compact('list','idd'));
    }
        public function exportCsvcell(Request $request)
{
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT DISTINCT cell_events.`id`,faculity.department as dept,cell_events.`title`,cell_events.`from_date`,cell_events.`to_date`,cell_events.`venue`,cell_events.`agenda`,cell_events.`eventtype`,cell_events.`male_teacher`,cell_events.`female_teacher`,cell_events.`male_student`,cell_events.`female_student`,cell_events.`other_student`,cell_events.`specially_abled`,cell_events.`caste_sc`,cell_events.`caste_st`,cell_events.`caste_obc`,cell_events.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,cell_events.`type`,cell_events.`category`,group_concat(cell.name_of_the_cell) as cell FROM `cell_events` 
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
group by cell_events.id order by cell_events.id desc");
 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','Department','Faculty','EventType','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Event Title']  = $task->title;
                $row['From Date']  = $task->from_date;
                $row['To Date']  = $task->to_date;
                 $row['Venue']  = $task->venue;
                 $row['Agenda']  = strip_tags($task->agenda);
                  $row['Department']  = $task->dept;
                   $row['Faculty']  = $task->facultyname;
                 $row['EventType']  = $task->eventtype;
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
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['Department'],$row['Faculty'],$row['EventType'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
	  public function deleteReport(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE cell_report.* FROM cell_report  where cell_report.id='$id'  ");
     return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
	  		    public function addReport(Request $request)
    {
                
		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		 return view('admin.cell.report',compact('collabrators','departments','cells','naac'));
    }
         public function reportList(Request $request)
    {  
        $cell_id = Auth::user()->profile_id;
		$list = DB::select("SELECT * FROM `cell_report` WHERE `cell_id`='$cell_id'"); 
	    return view('admin.cell.reportList',compact('list'));
	   
    }
       public function saveReport(Request $request)
    {
   
        if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/faculty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
     
		 $dataArray      =  array(
	"title" => $request->title,
	"cell_id" => Auth::user()->profile_id,
    "author" => $request->author,
	"datestart" => $request->datestart,
	"dateend" => $request->dateend,
	"description" => $request->description,
	"document"=> $filename,
	
   );

    $id  =   DB::table('cell_report')->insertGetId($dataArray);
	if($id==1)
	      { 
        return response()->json(['success'=>'Cell Report has been uploaded']);
          } 
      else{
        return response()->json(["message" => "Please try again."]);
          }

    }
	    
}