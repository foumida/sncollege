<?php

namespace App\Http\Controllers\Faculty;
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



class FacultyController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }  
	    public function dashboard(Request $request)
    {
          $faculty_id =  Auth::user()->profile_id;
		$list= DB::select("SELECT * FROM `faculity` WHERE `fid`='$faculty_id'");
		$profile_list = DB::select("SELECT * FROM `fdp` WHERE `fid`='$faculty_id' order by id DESC limit 3");
		 $barchart=DB::select("SELECT (SELECT count(id) FROM fdp where `category`='Seminar' and fid='$faculty_id') as Seminar, (SELECT count(id) FROM fdp where `category`='Workshop' and fid='$faculty_id') as Workshop, (SELECT count(id) FROM fdp where `category`='Tour' and fid='$faculty_id') as StudyTour, (SELECT count(id) FROM fdp where `category`='Symposium' and fid='$faculty_id') as Symposium, (SELECT count(id) FROM fdp where `category`='Conference' and fid='$faculty_id') as Conference, (SELECT count(id) FROM fdp where `category`='Webinar' and fid='$faculty_id') as Webinar, (SELECT count(id) FROM fdp where `category`='programs' and fid='$faculty_id') as PublicPrograms, (SELECT count(id) FROM fdp where `category`='StudentExecutive' and fid='$faculty_id') as StudentExecutive, (SELECT count(id) FROM fdp where `category`='Other' and fid='$faculty_id') as Other ");
  $piechart=DB::select("SELECT (SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('3',`main_criteria`) and fid='$faculty_id') as Criterion1, (SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('4',`main_criteria`) and fid='$faculty_id') as Criterion2, (SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('5',`main_criteria`) and fid='$faculty_id') as Criterion3, (SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('6',`main_criteria`) and fid='$faculty_id') as Criterion4, (SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('7',`main_criteria`) and fid='$faculty_id') as Criterion5, (SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('8',`main_criteria`) and fid='$faculty_id') as Criterion6,(SELECT count(fid) FROM `fdp` WHERE FIND_IN_SET('9',`main_criteria`) and fid='$faculty_id') as Criterion7 ");
  
  $columnchart=DB::select("SELECT id as events,`male_student` as male,female_student as female,other_student as other FROM fdp where fid='$faculty_id'");

		 return view('admin.faculty.home',compact('list','profile_list','barchart','piechart','columnchart'));
    }
	//Student Progression
	   public function addStudentProgression()
    {  
	$course =  DB::select("SELECT course_name,id from course ORDER BY id ASC");
         return view('admin.faculty.addStudentProgression',compact('course'));
    }
               public function saveStudentProgression(Request $request)
    {
		
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/general/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
    
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(
	"category" => $request->category,	     
	"student_id" => $request->skillid,
	"from_date" => $request->year,
    "graduated_from" => $request->graduated,
	"institution_employer" => $request->institution,
	"name_of_pgm" =>$request->name_of_pgm,
	"package" => $request->package,
	"posted_faculty_id" => Auth::user()->profile_id,
    "upload_document" => $filename,
   
   );

    $id  =   DB::table('student_progression')->insertGetId($dataArray);

	if($id==1){ 
                    	return response()->json(['success'=>'Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    } 
	
	public function downloadStudentProgressionExcel(Request $request)
{
 
   $fileName = 'StudentProgressionList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("select student_progression.*,students.name as studentname,students.admission_no from student_progression left join students on students.id=student_progression.student_id
join faculity on faculity.fid=student_progression.posted_faculty_id"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Name Of Student','Admission NO','Category','Graduated From','Institution Or Employer','Name of Program','Package','Year');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

             foreach ($tasks as $task) {
			  $row['Name Of Student']  = $task->studentname;
              $row['Admission NO']  = $task->admission_no; 
			  $row['Category']  = $task->category; 
			  $row['Graduated From']  = $task->graduated_from; 
			  $row['Institution Or Employer']  = $task->institution_employer; 
			  $row['Name of Program']  = $task->name_of_pgm; 
			  $row['Package']  = $task->package; 
			  $row['Year']  = $task->from_date; 
				
		 fputcsv($file, array($row['Name Of Student'],$row['Admission NO'],$row['Category'],$row['Graduated From'],$row['Institution Or Employer'],$row['Name of Program'],$row['Package'],$row['Year']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	
       public function studentProgressionList(Request $request)
    {  if(Auth::user()->role=='3')
		{
			$list=DB::select("select student_progression.*,students.name as studentname from student_progression left join students on students.id=student_progression.student_id
join faculity on faculity.fid=student_progression.posted_faculty_id");
	    
	    return view('admin.faculty.studentProgressionList',compact('list'));
		}
	else{
        $faculty_id =  Auth::user()->profile_id;
   
		$department= DB::select("SELECT department FROM `faculity` WHERE fid='$faculty_id'"); 
	    $departmentname=$department[0]->department;
		
	    if($departmentname!='')
	    {
	    $list = DB::select("select student_progression.*,students.name as studentname from student_progression  join students on students.id=student_progression.student_id
join faculity on faculity.fid=student_progression.posted_faculty_id
where  faculity.department='$departmentname'");
	    }else
	    {
	   $list=DB::select("select student_progression.*,students.name as studentname from student_progression left join students on students.id=student_progression.student_id
join faculity on faculity.fid=student_progression.posted_faculty_id
where posted_faculty_id='$faculty_id'");
	    }
	    return view('admin.faculty.studentProgressionList',compact('list'));
	}
    }
    
          	   public function deleteStudentProgression(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE student_progression.* FROM student_progression  where student_progression.id='$id'");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
     	 public function editStudentProgression(Request $request)
    {   
     
		$id=$request->id;
	    $profile_edit= DB::select("SELECT student_progression.*,students.name FROM `student_progression` join students on student_progression.student_id= students.id WHERE student_progression.`id`='$id'");
         return view('admin.faculty.editStudentProgression',compact('profile_edit'));
		
    }
    
           public function editInfoStudentProgression(Request $request)
    {
		$editid=$request->editid;
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/general/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(

   	"category" => $request->category,	     
	
	"from_date" => $request->year,
    "graduated_from" => $request->graduated,
	"institution_employer" => $request->institution,
	"name_of_pgm" =>$request->name_of_pgm,
	"package" => $request->package,
	"posted_faculty_id" => Auth::user()->profile_id,
    "upload_document" => $filename,

   );

    $id  =    DB::table('student_progression')->where('id', $editid)->update($dataArray) ;

	if($id==1){ 
                    	return response()->json(['success'=>'Student Progression Details has been updated']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
    
    
    
    
    
	
	// Report Generation
	 public function section1List()
    {    
	     $type = Auth::user()->type;
	   if($type=='HOD')
	   {
		    $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT department FROM `faculity` where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
		  $departid= DB::select("SELECT `id` FROM `departments` WHERE `department`='Botany'"); 
		  $deprtmentid=$departid[0]->id;
		  $course= DB::select("SELECT * FROM `course` WHERE `departments`='$deprtmentid'"); 
		  $result = array();
		 foreach ($course as $items) {
		$course_name=$items->course_name;
		 $result[]=DB::select("SELECT program,batch,count(id) as stcount FROM `students` WHERE `program`='$course_name' group by batch"); 
			 
		 }
		$data_programs = $result;
		$faculity_details=DB::select("SELECT name,designation,highest_edu FROM `faculity` WHERE department='$deprtmentname';"); 
		$non_teaching= DB::select("SELECT name,designation,aided_temp from non_teaching"); 
         return view('admin.faculty.section1List',compact('data_programs','faculity_details','non_teaching'));
	   }
    }
public function generateSection1(Request $request)
{
    $count = count($request->input('program'));
    $countfacultydetails = count($request->input('facname'));
    $countnonteaching = count($request->input('teachname'));
	$department = $request->input('department');
	$establishment = $request->input('establishment');
	$category = $request->input('category');
	
	$html = '<div style="text-align:center;" class="text-center">';
	$html .= '<img src="' . asset('theme/admin/assets/images/meslogo.jpg') . '">';
	$html .= '<h2 style="text-align:center;font-size:20px;"> THE COUNCIL OF PRINCIPALS OF COLLEGES IN KERALA </h2>';
	$html .= '<h3 style="text-align:center;font-size:14px;"> FORMAT FOR ACADEMIC & ADMINSTRATIVE AUDIT FOR ARTS AND SCIENCE COLLEGES </h3>';
	$html .= '<h1 style="text-align:center;font-size:25px;"> PROFORMA FOR DEPARTMENT </h1>';
	$html .= '<p style="text-align:center;font-size:17px;"> Academic Year 2020-21 </p>';
	$html .= '<p style="text-align:center;font-size:12px;"><i> (Fill carefully and add more rows and space if needed) </i></p>';
	$html .= '</div>';
	
	$html .= '<p>Name of the Department: ' . $department . '</p>';
	$html .= '<p>Year of Establishment: ' . $establishment . '</p>';
	$html .= '<p>Aided/Self Financing Specify: ' .$category . '</p>';
    $html .= '<table style="border-collapse: collapse; margin-bottom: 50px; width:100%;font-size:12px;font-weight:400;">
                <tr>
                    <th colspan="7" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Table 1: Program Details</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Sl No</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Batch</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">No of Students Admitted</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Current Strength</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Student-Teacher Ratio</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Drop out ratio</th>
                </tr>';

    // Loop for the first table
    for ($i = 0; $i < $count; $i++) {
        $program = $request->input('program')[$i];
        $batch = $request->input('batch')[$i];
        $stcount = $request->input('stcount')[$i];
        $current_strength = $request->input('current_strength')[$i];
        $st_ratio = $request->input('st_ratio')[$i];
        $drop_ratio = $request->input('drop_ratio')[$i];

        // Generate the row HTML content
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . $i . '</td>
                        <td style="border: 1px solid black;">' . $program . '</td>
                        <td style="border: 1px solid black;">' . $batch . '</td>
                        <td style="border: 1px solid black;">' . $stcount . '</td>
                        <td style="border: 1px solid black;">' . $current_strength . '</td>
                        <td style="border: 1px solid black;">' . $st_ratio . '</td>
                        <td style="border: 1px solid black;">' . $drop_ratio . '</td>
                    </tr>';

        $html .= $rowHtml;
    }

    $html .= '</table>';

    // Second table
    $html2 = '<table style="border-collapse: collapse; margin-bottom: 30px; width:100%;font-size:12px;font-weight:400;">
                <tr>
                    <th colspan="6" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Table 2: Faculty Details</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Sl No</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Name</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Permanent/temporary/Visiting</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Designation</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Qualification</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Experience</th>
                </tr>';

    // Loop for the second table
    for ($i = 0; $i < $countfacultydetails; $i++) {
        $facname = $request->input('facname')[$i] ?? null;
        $type = $request->input('type')[$i] ?? null;
        $facdesig = $request->input('facdesig')[$i] ?? null;
        $highest_edu = $request->input('highest_edu')[$i] ?? null;
        $experience = $request->input('experience')[$i] ?? null;
		
		  $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . $i . '</td>
                        <td style="border: 1px solid black;">' . $facname . '</td>
                        <td style="border: 1px solid black;">' . $type . '</td>
                        <td style="border: 1px solid black;">' . $facdesig . '</td>
                        <td style="border: 1px solid black;">' . $highest_edu . '</td>
                        <td style="border: 1px solid black;">' . $experience . '</td>
                    </tr>';

        $html2 .= $rowHtml;
    }

    $html2 .= '</table>';

    // Third table
    $html3 = '<table style="border-collapse: collapse; margin-top: 50px; width:100%;font-size:12px;font-weight:400;">
                <tr>
                    <th colspan="6" style="border: 1px solid black; text-align: center;">Table 3: Non-Teaching Staff Details</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Sl No</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Name</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Qualification</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Designation</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Experience</th>
                    <th style="border: 1px solid black;background-color:#d1cfcf;">Permanent/Temporary</th>
                </tr>';

    // Loop for the third table
    for ($i = 0; $i < $countnonteaching; $i++) {
        $teachname = $request->input('teachname')[$i] ?? null;
        $qualification = $request->input('qualification')[$i] ?? null;
        $teacdesig = $request->input('teacdesig')[$i] ?? null;
        $teachexperience = $request->input('teachexperience')[$i] ?? null;
        $aided_temp = $request->input('aided_temp')[$i] ?? null;

        // Generate the row HTML content
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . $i . '</td>
                        <td style="border: 1px solid black;">' . $teachname . '</td>
                        <td style="border: 1px solid black;">' . $qualification . '</td>
                        <td style="border: 1px solid black;">' . $teacdesig . '</td>
                        <td style="border: 1px solid black;">' . $teachexperience . '</td>
                        <td style="border: 1px solid black;">' . $aided_temp . '</td>
                    </tr>';

        $html3 .= $rowHtml;
    }

    $html3 .= '</table>';
    $no_teachers = $request->input('no_teachers');
    $no_phd = $request->input('no_phd');
    $work_load = $request->input('work_load');
    $teaching_post = $request->input('teaching_post');
    $current_vac = $request->input('current_vac');

    $html4 = '<p>Number of teachers awarded Ph.D. during the year: ' . $no_teachers . '</p>';
    $html4 .= '<p>No of teachers doing Ph.D.: ' . $no_phd . '</p>';
    $html4 .= '<p>Actual work load: ' . $work_load . '</p>';
    $html4 .= '<p>Number of Sanctioned Teaching Posts: ' . $teaching_post . '</p>';
    $html4 .= '<p>Current Vacancy: ' . $current_vac . '</p>';
    // Generate the final HTML content combining all tables
      $finalHtml = $html . $html2 . $html3 . $html4;

    // Generate PDF using Dompdf
    $pdf = PDF::loadHTML($finalHtml);

    // Save the generated PDF or send it as a response
    // $pdf->save('path/to/save/generated_pdf.pdf');
    // Or return the PDF as a response
    return $pdf->stream();
}
	 public function section2List()
    {    $type = Auth::user()->type;
	   if($type=='HOD')
	   { 
         $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT department FROM `faculity` where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
		  $departid= DB::select("SELECT `id` FROM `departments` WHERE `department`='$deprtmentname'"); 
		  $deprtmentid=$departid[0]->id;
		  $addon= DB::select("select * from course where departments='$deprtmentid' and (course_type='Certificate' or course_type='AddOn')");
		  $journal=DB::select("SELECT *
FROM (
    SELECT journal_publication.*, faculity.name, 'Faculty' AS category, faculity.department
    FROM journal_publication
    JOIN faculity ON faculity.fid = journal_publication.publisherid
    WHERE journal_publication.publisherwhom = '1'
    
    UNION
    
    SELECT journal_publication.*, research_fellow.name, 'ResearchFellowFaculty' AS category, faculity.department
    FROM journal_publication
    JOIN research_fellow ON research_fellow.id = journal_publication.publisherid
    JOIN fellow_guide_faculty_master ON fellow_guide_faculty_master.research_fellow_id = journal_publication.publisherid
    JOIN faculity ON faculity.fid = fellow_guide_faculty_master.faculty_id
    WHERE journal_publication.publisherwhom = '5'
    
    UNION
    
    SELECT journal_publication.*, research_guide.supervisor_name AS name, 'ResearchGuideFaculty' AS category, faculity.department
    FROM journal_publication
    JOIN research_guide ON research_guide.id = journal_publication.publisherid
    JOIN fellow_guide_faculty_master ON fellow_guide_faculty_master.research_guide_id = journal_publication.publisherid
    JOIN faculity ON faculity.fid = fellow_guide_faculty_master.faculty_id
    WHERE journal_publication.publisherwhom = '6'
) xx
WHERE xx.department = '$deprtmentname'
ORDER BY xx.id DESC
");
 $book=DB::select("SELECT *
FROM (
  SELECT book_publication.*, faculity.name, 'Faculty' AS category, faculity.department
    FROM book_publication
    JOIN faculity ON faculity.fid = book_publication.publisherid
    WHERE book_publication.publisherwhom = '1'
    
    UNION

   SELECT book_publication.*, research_fellow.name, 'ResearchFellowFaculty' AS category, faculity.department
    FROM book_publication
    JOIN research_fellow ON research_fellow.id = book_publication.publisherid
    JOIN fellow_guide_faculty_master ON fellow_guide_faculty_master.research_fellow_id = book_publication.publisherid
    JOIN faculity ON faculity.fid = fellow_guide_faculty_master.faculty_id
    WHERE book_publication.publisherwhom = '5'
    UNION

    SELECT book_publication.*, research_guide.supervisor_name AS name, 'ResearchGuideFaculty' AS category, faculity.department
    FROM book_publication
    JOIN research_guide ON research_guide.id = book_publication.publisherid
    JOIN fellow_guide_faculty_master ON fellow_guide_faculty_master.research_guide_id = book_publication.publisherid
    JOIN faculity ON faculity.fid = fellow_guide_faculty_master.faculty_id
    WHERE book_publication.publisherwhom = '6'
) xx
WHERE xx.department = '$deprtmentname'
ORDER BY xx.id DESC");
  $fdp= DB::select("SELECT fdp.*, faculity.name, faculity.department
FROM fdp
JOIN faculity ON faculity.fid = fdp.fid
WHERE faculity.department = '$deprtmentname' 
  AND YEAR(fdp.from_date) = YEAR(CURDATE())
  AND YEAR(fdp.to_date) = YEAR(CURDATE())
ORDER BY fdp.id DESC;");
		 $course= DB::select("SELECT * FROM `course` WHERE `departments`='$deprtmentid'"); 
		 $result = array();
		  foreach ($course as $items) {
		$course_name=$items->course_name;
		 $result[]=DB::select("SELECT students.batch, students.program, overall_marks.semester,
       COUNT(DISTINCT students.id) AS total_students,
       COUNT(CASE WHEN overall_marks.grade = 'A+' THEN 1 END) AS A_plus_count,
       COUNT(CASE WHEN overall_marks.grade = 'A' THEN 1 END) AS A_count,
       COUNT(CASE WHEN overall_marks.grade = 'B+' THEN 1 END) AS B_plus_count,
       COUNT(CASE WHEN overall_marks.grade = 'B' THEN 1 END) AS B_count,
       COUNT(CASE WHEN overall_marks.grade = 'C+' THEN 1 END) AS C_plus_count,
       COUNT(CASE WHEN overall_marks.grade = 'C' THEN 1 END) AS C_count,
       COUNT(CASE WHEN overall_marks.grade = 'E' THEN 1 END) AS E_count,
       COUNT(CASE WHEN overall_marks.grade = 'O' THEN 1 END) AS O_count,
        COUNT(CASE WHEN overall_marks.grade = 'D' THEN 1 END) AS D_count,
       COUNT(CASE WHEN overall_marks.grade = 'PASSED' THEN 1 END) AS passed_grade,
       COUNT(CASE WHEN overall_marks.grade = 'FAILED' THEN 1 END) AS failed_grade,
       COUNT(CASE WHEN overall_marks.grade IN ('A+', 'A', 'B+', 'B', 'C+', 'C', 'E', 'O', 'PASSED') THEN 1 END) AS total_pass_count,
        ROUND((COUNT(CASE WHEN overall_marks.grade NOT IN ('FAILED') THEN 1 END) / COUNT(DISTINCT students.id)) * 100,2) AS pass_percentage
FROM students
JOIN overall_marks ON overall_marks.stid = students.id
WHERE students.program = '$course_name'
GROUP BY students.batch, students.program, overall_marks.semester"); 
		  }
$overall_marks = $result;
         return view('admin.faculty.section2List',compact('addon','journal','overall_marks','book','fdp'));
		  
	   }
    }
	
public function generateSection2(Request $request)
{
    $department = $request->input('department');
    $establishment = $request->input('establishment');
    $category = $request->input('category');
    $curriculam = $request->input('curriculam');
	$demandPrograms = count($request->input('demandprogram'));
    $valueaddedcourse = count($request->input('val_add_course'));
	$resultanalysis = count($request->input('overallpgm'));
	$programoutcome = count($request->input('pg'));
	$classengagement = count($request->input('course'));
	$internalevaluation = count($request->input('continuouscourse'));
	$tutorialsystem = count($request->input('class'));
	$bridgecourse = count($request->input('bridgeclass'));
	$remedialcourse = count($request->input('remedialclass'));
	$advancelearners = count($request->input('advanceprogram'));
	$slowlearners = count($request->input('slowprogram'));
	$fdp = count($request->input('eventtitle'));
	$publications = count($request->input('pubtitle'));
	$books = count($request->input('booktitle'));
	$facactivities = count($request->input('topic'));
      $reforms = $request->input('reforms');
	  $consultancy = $request->input('consultancy');
       $outreach = $request->input('outreach');
	   
	$html = '<div style="text-align:center;" class="text-center">';
	$html .= '<img src="' . asset('theme/admin/assets/images/meslogo.jpg') . '">';
	$html .= '<h2 style="text-align:center;font-size:20px;"> THE COUNCIL OF PRINCIPALS OF COLLEGES IN KERALA </h2>';
	$html .= '<h3 style="text-align:center;font-size:14px;"> FORMAT FOR ACADEMIC & ADMINSTRATIVE AUDIT FOR ARTS AND SCIENCE COLLEGES </h3>';
	$html .= '<h1 style="text-align:center;font-size:25px;"> PROFORMA FOR DEPARTMENT </h1>';
	$html .= '<p style="text-align:center;font-size:17px;"> Academic Year 2020-21 </p>';
	$html .= '<p style="text-align:center;font-size:12px;"><i> (Fill carefully and add more rows and space if needed) </i></p>';
	$html .= '</div>';
	
	
    $html .= '<p>Name of the Department: ' . $department . '</p>';
    $html .= '<p>Year of Establishment: ' . $establishment . '</p>';
    $html .= '<p>Aided/Self Financing Specify: ' . $category . '</p>';
    $html .= '<p>Curriculum design (New programme) and Restructuring of syllabi, if any : ' . $curriculam . '</p>';

    $html .= '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Demand Ratio and Unit Cost</th>
                </tr>
                    <tr>
                        <th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Unit Cost of Education</th>
                        <th colspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Admission Eligibility Mark %</th>
                        <th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Demand Ratio</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black;background-color:#d1cfcf;">Top Rank</th>
                        <th style="border: 1px solid black;background-color:#d1cfcf;">Last Rank</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $demandPrograms; $i++) {
		$demandprogram = $request->input('demandprogram')[$i] ?? null;
        $demandunitcost = $request->input('demandunitcost')[$i]?? null;
        $toprank = $request->input('toprank')[$i]?? null;
        $lastrank = $request->input('lastrank')[$i]?? null;
        $demandratio = $request->input('demandratio')[$i]?? null;
      
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $demandprogram . '</td>
                        <td style="border: 1px solid black;">' . $demandunitcost . '</td>
                        <td style="border: 1px solid black;">' . $toprank . '</td>
                        <td style="border: 1px solid black;">' . $lastrank . '</td>
                        <td style="border: 1px solid black;">' . $demandratio . '</td>
                    </tr>';
        $html .= $rowHtml;
    }

    $html .= '</tbody></table>';


 $html1 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Details of Value Added Courses (Certificate, Diploma etc. ) Conducted by the department</th>
                </tr>
                    <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Value Added Courses (Certificate, Diploma etc. )</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Curriculum designed by</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Duration</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Names of Faculty Engaged</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Number of students participated</th>
                    </tr>
                 
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $valueaddedcourse; $i++) {
		$val_add_course = $request->input('val_add_course')[$i] ?? null;
        $designedby = $request->input('designedby')[$i]?? null;
        $tenure = $request->input('tenure')[$i]?? null;
        $facultyeng = $request->input('facultyeng')[$i]?? null;
        $stpart = $request->input('stpart')[$i]?? null;
      
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $val_add_course . '</td>
                        <td style="border: 1px solid black;">' . $designedby . '</td>
                        <td style="border: 1px solid black;">' . $tenure . '</td>
                        <td style="border: 1px solid black;">' . $facultyeng . '</td>
                        <td style="border: 1px solid black;">' . $stpart . '</td>
                    </tr>';
        $html1 .= $rowHtml;
    }

    $html1 .= '</tbody></table>';
	$html2 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="18" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Result Analysis</th>
                </tr>
                   <tr>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Sl No</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Batch</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Semester</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Number of students appeared</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Number of students passed (Eligible For Higher Studies</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Percentage of pass</th>
											<th colspan="10" style="border: 1px solid black;background-color:#d1cfcf;">Grade</th>
											<th rowspan="2" style="border: 1px solid black;background-color:#d1cfcf;">Remarks</th>
										</tr>
                 <tr>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">P</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">A+</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">A</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">B+</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">B</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">C</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">D</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">E</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">O</th>
											<th  style="border: 1px solid black;background-color:#d1cfcf;">F</th>
										</tr>
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $resultanalysis; $i++) {
		$overallpgm = $request->input('overallpgm')[$i] ?? null;
        $overallbatch = $request->input('overallbatch')[$i]?? null;
        $overallsemester = $request->input('overallsemester')[$i]?? null;
        $total_students = $request->input('total_students')[$i]?? null;
        $total_pass_count = $request->input('total_pass_count')[$i]?? null;
		 $pass_percentage = $request->input('pass_percentage')[$i]?? null;
        $passed_grade = $request->input('passed_grade')[$i]?? null;
        $A_plus_count = $request->input('A_plus_count')[$i]?? null;
        $A_count = $request->input('A_count')[$i]?? null;
		$B_plus_count = $request->input('B_plus_count')[$i]?? null;
        $B_count = $request->input('B_count')[$i]?? null;
        $C_count = $request->input('C_count')[$i]?? null;
		
        $D_count = $request->input('D_count')[$i]?? null;
		$E_count = $request->input('E_count')[$i]?? null;
        $O_count = $request->input('O_count')[$i]?? null;
        $failed_grade = $request->input('failed_grade')[$i]?? null;
		$remarks = $request->input('remarks')[$i]?? null;
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $overallpgm . '</td>
                        <td style="border: 1px solid black;">' . $overallbatch . '</td>
                        <td style="border: 1px solid black;">' . $overallsemester . '</td>
                        <td style="border: 1px solid black;">' . $total_students . '</td>
                        <td style="border: 1px solid black;">' . $total_pass_count . '</td>
						 <td style="border: 1px solid black;">' . $pass_percentage . '</td>
                        <td style="border: 1px solid black;">' . $passed_grade . '</td>
                        <td style="border: 1px solid black;">' . $A_plus_count . '</td>
                        <td style="border: 1px solid black;">' . $A_count . '</td>
                        <td style="border: 1px solid black;">' . $B_plus_count . '</td>
						 <td style="border: 1px solid black;">' . $B_count . '</td>
                        <td style="border: 1px solid black;">' . $C_count . '</td>
                        <td style="border: 1px solid black;">' . $D_count . '</td>
                        <td style="border: 1px solid black;">' . $E_count . '</td>
                        <td style="border: 1px solid black;">' . $O_count . '</td>
						 <td style="border: 1px solid black;">' . $failed_grade . '</td>
                        <td style="border: 1px solid black;">' . $remarks . '</td>
                    </tr>';
        $html2 .= $rowHtml;
    }

    $html2 .= '</tbody></table>';
	$html3 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="5" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Programme outcome details</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme Outcome (PO)</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme Specific Outcome (PSO)</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Analysis</th>
						
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $programoutcome; $i++) {
		$pg = $request->input('pg')[$i] ?? null;
        $po = $request->input('po')[$i]?? null;
        $pso = $request->input('pso')[$i]?? null;
        $analysis = $request->input('analysis')[$i]?? null;
       
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $pg . '</td>
                        <td style="border: 1px solid black;">' . $po . '</td>
                        <td style="border: 1px solid black;">' . $pso . '</td>
                        <td style="border: 1px solid black;">' . $analysis . '</td>
                        
                    </tr>';
        $html3 .= $rowHtml;
    }

    $html3 .= '</tbody></table>';
	$html4 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="7" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Class engagement details of the department .</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Course (including OC, courses for programmes of other departments)</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Semester</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total hours allotted</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total hours engaged</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Extra hours taken in addition to total allotted hours</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Remedial Classes taken</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $classengagement; $i++) {
		$course = $request->input('course')[$i] ?? null;
        $semester = $request->input('semester')[$i]?? null;
        $tothours = $request->input('tothours')[$i]?? null;
        $toteng = $request->input('toteng')[$i]?? null;
        $extrahrs = $request->input('extrahrs')[$i]?? null;
        $remedial = $request->input('remedial')[$i]?? null;
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $course . '</td>
                        <td style="border: 1px solid black;">' . $semester . '</td>
                        <td style="border: 1px solid black;">' . $tothours . '</td>
                        <td style="border: 1px solid black;">' . $toteng . '</td>
                          <td style="border: 1px solid black;">' . $extrahrs . '</td>
                        <td style="border: 1px solid black;">' . $remedial . '</td>
                    </tr>';
        $html4 .= $rowHtml;
    }

    $html4 .= '</tbody></table>';
	
	
		$html5 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="11" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Continuous Internal Evaluation Details.</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Course (including courses for programmes of other departments)</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Semester</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No. of students having shortage of attendance</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No. of assignments given to each student</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">No. of Seminars presented By Each student</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No. of Internal Examinations Conducted</th>
						  <th  style="border: 1px solid black;background-color:#d1cfcf;"> No. of Projects given</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No. of Students failed in internal evaluation</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No. of Students grievances received</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No. of grievances redressed</th>
                      
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $internalevaluation; $i++) {
		$continuouscourse = $request->input('continuouscourse')[$i] ?? null;
        $csem = $request->input('csem')[$i]?? null;
        $attendance = $request->input('attendance')[$i]?? null;
        $assignments = $request->input('assignments')[$i]?? null;
        $Seminars = $request->input('Seminars')[$i]?? null;
        $Internal = $request->input('Internal')[$i]?? null;
		 $Projects = $request->input('Projects')[$i]?? null;
        $evaluation = $request->input('evaluation')[$i]?? null;
        $grievances = $request->input('grievances')[$i]?? null;
        $redressed = $request->input('redressed')[$i]?? null;
       
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $continuouscourse . '</td>
                        <td style="border: 1px solid black;">' . $csem . '</td>
                        <td style="border: 1px solid black;">' . $attendance . '</td>
                        <td style="border: 1px solid black;">' . $assignments . '</td>
                          <td style="border: 1px solid black;">' . $Seminars . '</td>
                        <td style="border: 1px solid black;">' . $Internal . '</td>
						 <td style="border: 1px solid black;">' . $Projects. '</td>
                        <td style="border: 1px solid black;">' . $evaluation . '</td>
                        <td style="border: 1px solid black;">' . $grievances . '</td>
                        <td style="border: 1px solid black;">' . $redressed . '</td>
                  
                    </tr>';
        $html5 .= $rowHtml;
    }

    $html5 .= '</tbody></table>';
	
    $html6 = '<p>Brief description of Reforms introduced in Continues Internal Evaluation (CIE): ' . $reforms . '</p>';
	$html7 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Tutorial System</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Class</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Tutor</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total No. of Tutorial Hours during the year</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Major Discussions in the Tutorial Hour</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Tutorial Report Submitted or Not</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $tutorialsystem; $i++) {
		$class = $request->input('class')[$i] ?? null;
        $tutor = $request->input('tutor')[$i]?? null;
        $tutorialhrs = $request->input('tutorialhrs')[$i]?? null;
        $discussions = $request->input('discussions')[$i]?? null;
        $report = $request->input('report')[$i]?? null;
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $class . '</td>
                        <td style="border: 1px solid black;">' . $tutor . '</td>
                        <td style="border: 1px solid black;">' . $tutorialhrs . '</td>
                        <td style="border: 1px solid black;">' . $discussions . '</td>
                         <td style="border: 1px solid black;">' . $report . '</td>
                    </tr>';
        $html7 .= $rowHtml;
    }

    $html7 .= '</tbody></table>';
	
	$html8 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Details of Bridge Courses Conducted and its Outcome</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Class</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total No of Classes Conducted </th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of students attended</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of Students Benefitted</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Remarks</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $bridgecourse; $i++) {
		$bridgeclass = $request->input('bridgeclass')[$i] ?? null;
        $bridgeclass_nos = $request->input('bridgeclass_nos')[$i]?? null;
        $st_attend = $request->input('st_attend')[$i]?? null;
        $st_benefit = $request->input('st_benefit')[$i]?? null;
        $brremarks = $request->input('brremarks')[$i]?? null;
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $bridgeclass . '</td>
                        <td style="border: 1px solid black;">' . $bridgeclass_nos . '</td>
                        <td style="border: 1px solid black;">' . $st_attend . '</td>
                        <td style="border: 1px solid black;">' . $st_benefit . '</td>
                         <td style="border: 1px solid black;">' . $brremarks . '</td>
                    </tr>';
        $html8 .= $rowHtml;
    }

    $html8 .= '</tbody></table>';
	$html9 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Details of Remedial Classes conducted and its Outcome</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Class</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total No of Classes Conducted </th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of students attended</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of Students Benefitted</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Outcome</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $remedialcourse; $i++) {
		$remedialclass = $request->input('remedialclass')[$i] ?? null;
        $totremedial = $request->input('totremedial')[$i]?? null;
        $remedialstudents = $request->input('remedialstudents')[$i]?? null;
        $studentsbenefit = $request->input('studentsbenefit')[$i]?? null;
        $outcome = $request->input('outcome')[$i]?? null;
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $remedialclass . '</td>
                        <td style="border: 1px solid black;">' . $totremedial . '</td>
                        <td style="border: 1px solid black;">' . $remedialstudents . '</td>
                        <td style="border: 1px solid black;">' . $studentsbenefit . '</td>
                         <td style="border: 1px solid black;">' . $outcome . '</td>
                    </tr>';
        $html9 .= $rowHtml;
    }

    $html9 .= '</tbody></table>';
	$html10 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="5" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Details of Programmes for Advanced Learners and Outcome</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of students attended</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of Students Benefitted</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Outcome</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $advancelearners; $i++) {
		$advanceprogram = $request->input('advanceprogram')[$i] ?? null;
        $advancest = $request->input('advancest')[$i]?? null;
        $advancebenefit = $request->input('advancebenefit')[$i]?? null;
        $advanceoutcome = $request->input('advanceoutcome')[$i]?? null;
        
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $advanceprogram . '</td>
                        <td style="border: 1px solid black;">' . $advancest . '</td>
                        <td style="border: 1px solid black;">' . $advancebenefit . '</td>
                        <td style="border: 1px solid black;">' . $advanceoutcome . '</td>
                       
                    </tr>';
        $html10 .= $rowHtml;
    }

    $html10 .= '</tbody></table>';
	$html11 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="5" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Details of Programmes for Slow Learners and Outcome</th>
                </tr>
                   <tr>
                         <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of students attended</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">No of Students Benefitted</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Outcome</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $slowlearners; $i++) {
		$slowprogram = $request->input('slowprogram')[$i] ?? null;
        $slowsts = $request->input('slowsts')[$i]?? null;
        $slowbenefit = $request->input('slowbenefit')[$i]?? null;
        $slowoutcome = $request->input('slowoutcome')[$i]?? null;
        
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $slowprogram . '</td>
                        <td style="border: 1px solid black;">' . $slowsts . '</td>
                        <td style="border: 1px solid black;">' . $slowbenefit . '</td>
                        <td style="border: 1px solid black;">' . $slowoutcome . '</td>
                       
                    </tr>';
        $html11 .= $rowHtml;
    }

    $html11 .= '</tbody></table>';
	
    $html12 = '<p> Consultancy : ' . $consultancy . '</p>';
	$html13 = '<p> Details of Extension/ Out-reach programmes organised: ' . $outreach . '</p>';
	
	$html14 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="12" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Details of Seminars, Workshops, FDP, Training Programmes, Skill enrichment programmes, Fests, camps, invited talks, Association activities etc. organised by the dept.</th>
                </tr>
                   <tr>
                         <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Title of the programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Category</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Department</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Dates</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;"> No of Participants</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">From college</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">From Outside</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Funding Agency With fund sanctioned</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Fund enerated from any other sources</th>
						 <th  style="border: 1px solid black;background-color:#d1cfcf;">Total funds received</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Total expenditure</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $fdp; $i++) {
		$eventtitle = $request->input('eventtitle')[$i] ?? null;
        $eventcat = $request->input('eventcat')[$i]?? null;
        $eventdept = $request->input('eventdept')[$i]?? null;
        $eventfromdate = $request->input('eventfromdate')[$i]?? null;
        $eventsts = $request->input('eventsts')[$i] ?? null;
        $college = $request->input('college')[$i]?? null;
        $outside = $request->input('outside')[$i]?? null;
        $fundingagency = $request->input('fundingagency')[$i]?? null;
		 $othersource = $request->input('othersource')[$i] ?? null;
        $totfunds = $request->input('totfunds')[$i]?? null;
        $totexp = $request->input('totexp')[$i]?? null;
     
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $eventtitle . '</td>
                        <td style="border: 1px solid black;">' . $eventcat . '</td>
                        <td style="border: 1px solid black;">' . $eventdept . '</td>
                        <td style="border: 1px solid black;">' . $eventfromdate . '</td>
						 <td style="border: 1px solid black;">' . $eventsts . '</td>
                        <td style="border: 1px solid black;">' . $college . '</td>
                        <td style="border: 1px solid black;">' . $outside . '</td>
                        <td style="border: 1px solid black;">' . $fundingagency . '</td>
						 <td style="border: 1px solid black;">' . $othersource . '</td>
                        <td style="border: 1px solid black;">' . $totfunds . '</td>
                        <td style="border: 1px solid black;">' . $totexp . '</td>
                       
                    </tr>';
        $html14 .= $rowHtml;
    }

    $html14 .= '</tbody></table>';
	$html15 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="9" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Publications of Faculty in journals,Articles etc.</th>
                </tr>
                   <tr>
                         <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Title </th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Name of the Journal</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Type</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Department</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Impact Factor</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">ISSN/ISBN No.</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Volume,Page No., Year</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Authorship</th>
						
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $publications; $i++) {
		$pubtitle = $request->input('pubtitle')[$i] ?? null;
        $journalname = $request->input('journalname')[$i]?? null;
        $typepublication = $request->input('typepublication')[$i]?? null;
        $pubdept = $request->input('pubdept')[$i]?? null;
        $impactfactor = $request->input('impactfactor')[$i] ?? null;
        $issn = $request->input('issn')[$i]?? null;
        $vol = $request->input('vol')[$i]?? null;
        $author = $request->input('author')[$i]?? null;
		
     
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $pubtitle . '</td>
                        <td style="border: 1px solid black;">' . $journalname . '</td>
                        <td style="border: 1px solid black;">' . $typepublication . '</td>
                        <td style="border: 1px solid black;">' . $pubdept . '</td>
						 <td style="border: 1px solid black;">' . $impactfactor . '</td>
                        <td style="border: 1px solid black;">' . $issn . '</td>
                        <td style="border: 1px solid black;">' . $vol . '</td>
                        <td style="border: 1px solid black;">' . $author . '</td>
						 
                       
                    </tr>';
        $html15 .= $rowHtml;
    }

    $html15 .= '</tbody></table>';
	$html16 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="9" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Publications of Faculty in Books,Book Chapters etc.</th>
                </tr>
                   <tr>
                         <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Title </th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Name of the Paper</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Type</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Department</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Impact Factor</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">ISSN/ISBN No.</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Volume,Page No., Year</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Authorship</th>
						
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $books; $i++) {
		$booktitle = $request->input('booktitle')[$i] ?? null;
        $papername = $request->input('papername')[$i]?? null;
        $booktype = $request->input('booktype')[$i]?? null;
        $bookdept = $request->input('bookdept')[$i]?? null;
        $bookfactor = $request->input('bookfactor')[$i] ?? null;
        $bookissn = $request->input('bookissn')[$i]?? null;
        $bookvol = $request->input('bookvol')[$i]?? null;
        $bookauthor = $request->input('bookauthor')[$i]?? null;
		
     
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $booktitle . '</td>
                        <td style="border: 1px solid black;">' . $papername . '</td>
                        <td style="border: 1px solid black;">' . $booktype . '</td>
                        <td style="border: 1px solid black;">' . $bookdept . '</td>
						 <td style="border: 1px solid black;">' . $bookfactor . '</td>
                        <td style="border: 1px solid black;">' . $bookissn . '</td>
                        <td style="border: 1px solid black;">' . $bookvol . '</td>
                        <td style="border: 1px solid black;">' . $bookauthor . '</td>
						 
                       
                    </tr>';
        $html16 .= $rowHtml;
    }

    $html16 .= '</tbody></table>';
	$html17 = '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="7" style="border: 1px solid black;background-color:#d1cfcf; text-align: center;">Faculty as Invited speaker/Resource persons/ Paper presenter etc.</th>
                </tr>
                   <tr>
                         <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Title of topic </th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Details of Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Name Of Faculty</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Date</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Organised by</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Invited Speaker/Resource person</th>
				
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $facactivities; $i++) {
		$topic = $request->input('topic')[$i] ?? null;
        $speakerdept = $request->input('speakerdept')[$i]?? null;
        $namfac = $request->input('namfac')[$i]?? null;
        $datecon = $request->input('datecon')[$i]?? null;
        $organisedby = $request->input('organisedby')[$i]?? null;
		$resourseperson = $request->input('resourseperson')[$i]?? null;
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $topic . '</td>
                        <td style="border: 1px solid black;">' . $speakerdept . '</td>
                        <td style="border: 1px solid black;">' . $namfac . '</td>
                        <td style="border: 1px solid black;">' . $datecon . '</td>
                         <td style="border: 1px solid black;">' . $organisedby . '</td>
                        <td style="border: 1px solid black;">' . $resourseperson . '</td>
                    </tr>';
        $html17 .= $rowHtml;
    }

    $html17 .= '</tbody></table>';
	
    $finalHtml = $html . $html1 .$html2 .$html3 .$html4 .$html5 .$html6 .$html7 .$html8 .$html9 .$html10 .$html11. $html12. $html13. $html14. $html15. $html16. $html17;

    // Generate PDF using Dompdf
    $pdf = PDF::loadHTML($finalHtml);

    // Save the generated PDF or send it as a response
    // $pdf->save('path/to/save/generated_pdf.pdf');
    // Or return the PDF as a response
    return $pdf->stream();
}
	 public function section3List()
    {     $type = Auth::user()->type;
	   if($type=='HOD')
	   { 
    $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT department FROM `faculity` where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
		  $departid= DB::select("SELECT `id` FROM `departments` WHERE `department`='Botany'"); 
		  $deprtmentid=$departid[0]->id;
		  $course= DB::select("SELECT * FROM `course` WHERE `departments`='$deprtmentid'"); 
		  $result = array();
		  $teaching_method=array();
		  $scholar_details=array();
		  $progression_details=array();
		  $ict_details=array();
		 foreach ($course as $items) {
		$course_name=$items->course_name;
		 $result[]=DB::select("select* from(SELECT batch,program,count(*) as project,0 as industry  FROM `project_internship`  group by batch, program  union 
SELECT batch,program,0 as project,count(*) as industry FROM `industry_marks`  group by batch, program) xx where xx.program='$course_name'

"); 
		 $teaching_method[]=DB::select("select * from teaching_method where program='$course_name'"); 	

         $scholar_details[]=DB::select("SELECT scholarship_name, batch, COUNT(student_id) AS studentcount,program FROM scholarship
JOIN students ON students.id = scholarship.student_id
WHERE students.program = '$course_name'
GROUP BY scholarship_name, batch order BY batch ASc"); 		

	 $progression_details[]=DB::select("SELECT category,batch, COUNT(student_id) AS studentcount,program FROM student_progression
JOIN students ON students.id = student_progression.student_id
WHERE students.program = '$course_name'
GROUP BY category, batch 
order BY batch ASc");
 $ict_details[]=DB::select("select title,program,batch,ict.semester as sem,faculity.name as faculty from ict join faculity on faculity.fid=ict.faculty_id where program='$course_name' group by batch,program");
		 }
		$projects = $result;
		$methods =$teaching_method;
		$scholarship=$scholar_details;
		$progression=$progression_details;
	    $ict=$ict_details;
        return view('admin.faculty.section3List',compact('projects','methods','scholarship','progression','ict'));
	   }
    }
	public function generateSection3(Request $request)
	{
	$department = $request->input('department');
    $establishment = $request->input('establishment');
    $category = $request->input('category');	
	$placement_data = $request->input('placement_data');
	$projects = count($request->input('pjbatch'));
	$methods = count($request->input('teachpgm'));
	$scholarship = count($request->input('schpgm'));
	$pta=count($request->input('ptaprogram'));
	$alumni=count($request->input('alprogram'));

	
	$html = '<div style="text-align:center;" class="text-center">';
	$html .= '<img src="' . asset('theme/admin/assets/images/meslogo.jpg') . '">';
	$html .= '<h2 style="text-align:center;font-size:20px;"> THE COUNCIL OF PRINCIPALS OF COLLEGES IN KERALA </h2>';
	$html .= '<h3 style="text-align:center;font-size:14px;"> FORMAT FOR ACADEMIC & ADMINSTRATIVE AUDIT FOR ARTS AND SCIENCE COLLEGES </h3>';
	$html .= '<h1 style="text-align:center;font-size:25px;"> PROFORMA FOR DEPARTMENT </h1>';
	$html .= '<p style="text-align:center;font-size:17px;"> Academic Year 2020-21 </p>';
	$html .= '<p style="text-align:center;font-size:12px;"><i> (Fill carefully and add more rows and space if needed) </i></p>';
	$html .= '</div>';
	
	
    $html .= '<p>Name of the Department: ' . $department . '</p>';
    $html .= '<p>Year of Establishment: ' . $establishment . '</p>';
    $html .= '<p>Aided/Self Financing Specify: ' . $category . '</p>';
	$html .= '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Details of Internship, Apprenticeship, Industrial Visit, Study tour, OJT, Student Projects etc.</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Batch</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total no. of Student projects (Attach details separately)</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Total no. of Internship/Apprentice ship/ Industrial Visit/ OJT (Attach details separately)</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">No of students not submitted report in time</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $projects; $i++) {
		$pjbatch = $request->input('pjbatch')[$i] ?? null;
        $pjpgm = $request->input('pjpgm')[$i]?? null;
        $prj = $request->input('prj')[$i]?? null;
        $industry = $request->input('industry')[$i]?? null;
        $notsubmit = $request->input('notsubmit')[$i]?? null;
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $pjbatch . '</td>
                        <td style="border: 1px solid black;">' . $pjpgm . '</td>
                        <td style="border: 1px solid black;">' . $prj . '</td>
                        <td style="border: 1px solid black;">' . $industry . '</td>
                        <td style="border: 1px solid black;">' . $notsubmit . '</td>
                    </tr>';
        $html .= $rowHtml;
    }

    $html .= '</tbody></table>';
	$html .= '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="3" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Student Centric and Innovative teaching methods.</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                       
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                       
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Student Centric teaching & Learning & Innovative methods introduced by the departments</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $methods; $i++) {
		$teachpgm = $request->input('teachpgm')[$i] ?? null;
        $teachmtd = $request->input('teachmtd')[$i]?? null;
        
		
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $teachpgm . '</td>
                        <td style="border: 1px solid black;">' . $teachmtd . '</td>
                       
                    </tr>';
        $html .= $rowHtml;
    }

    $html .= '</tbody></table>';
	$html .= '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="5" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Student Centric and Innovative teaching methods.</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                       
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Batch</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Name of the scholarship, Free ship, Financial Support</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Number ofstudents Receiving</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $scholarship; $i++) {
		$schpgm = $request->input('schpgm')[$i] ?? null;
        $schbatch = $request->input('schbatch')[$i]?? null;
        $schname = $request->input('schname')[$i]?? null;
		$schcount = $request->input('schcount')[$i]?? null;
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $schpgm . '</td>
                        <td style="border: 1px solid black;">' . $schbatch . '</td>
                        <td style="border: 1px solid black;">' . $schname . '</td>
					    <td style="border: 1px solid black;">' . $schcount . '</td>
                    </tr>';
        $html .= $rowHtml;
    }

    $html .= '</tbody></table>';
	$html .= '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="5" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Details of Class PTA Conducted.</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                       
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Programme</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Number of Class PTA Conducted with Dates</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Number of Parents Participated</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">No of parents not participated</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $pta; $i++) {
		$ptaprogram = $request->input('ptaprogram')[$i] ?? null;
        $classconduct = $request->input('classconduct')[$i]?? null;
        $parentspart = $request->input('parentspart')[$i]?? null;
		$notparticipate = $request->input('notparticipate')[$i]?? null;
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $ptaprogram . '</td>
                        <td style="border: 1px solid black;">' . $classconduct . '</td>
                        <td style="border: 1px solid black;">' . $parentspart . '</td>
					    <td style="border: 1px solid black;">' . $notparticipate . '</td>
                    </tr>';
        $html .= $rowHtml;
    }

    $html .= '</tbody></table>';
	$html .= '<table style="border-collapse: collapse; margin-bottom: 20px; width:100%;font-size:12px;font-weight:400;">
                <thead>
				 <tr>
                    <th colspan="6" style="border: 1px solid black; background-color:#d1cfcf;text-align: center;">Details of Department/Class Alumni Organised.</th>
                </tr>
                   <tr>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;"> Sl No</th>
                       
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Dept./Class Alumni</th>
                        <th  style="border: 1px solid black;background-color:#d1cfcf;">Date</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Number of Alumni Participated</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Number of Faculty members participated</th>
						<th  style="border: 1px solid black;background-color:#d1cfcf;">Remarks including Alumni Support</th>
                    </tr>
               
                </thead>
                <tbody>';

    // Loop through the demand programs and generate table rows
    for ($i = 0; $i < $alumni; $i++) {
		$alprogram = $request->input('alprogram')[$i] ?? null;
        $aldate = $request->input('aldate')[$i]?? null;
        $alpart = $request->input('alpart')[$i]?? null;
		$facmem = $request->input('facmem')[$i]?? null;
		$alrem = $request->input('alrem')[$i]?? null;
        $rowHtml = '<tr>
                        <td style="border: 1px solid black;">' . ($i + 1). '</td>
                        <td style="border: 1px solid black;">' . $alprogram . '</td>
                        <td style="border: 1px solid black;">' . $aldate . '</td>
                        <td style="border: 1px solid black;">' . $alpart . '</td>
					    <td style="border: 1px solid black;">' . $facmem . '</td>
						 <td style="border: 1px solid black;">' . $alrem . '</td>
                    </tr>';
        $html .= $rowHtml;
    }

    $html .= '</tbody></table>';
	$html .= '<p> Details of Placement and Recruitment drives (Both internal & External): ' . $placement_data . '</p>';
	  $finalHtml = $html;

    // Generate PDF using Dompdf
    $pdf = PDF::loadHTML($finalHtml);

    // Save the generated PDF or send it as a response
    // $pdf->save('path/to/save/generated_pdf.pdf');
    // Or return the PDF as a response
    return $pdf->stream();	
	}
	
	 public function section4List()
    {    
         return view('admin.faculty.section4List');
    }
	 public function section2Add()
    {    
         return view('admin.faculty.section2Add');
    }
	 public function section3Add()
    {    
         return view('admin.faculty.section3Add');
    }
	 public function section4Add()
    {    
         return view('admin.faculty.section4Add');
    }
	
	 public function addPhdProgress()
    {    
         return view('admin.faculty.addPhdProgress');
    }
	     
          public function savePhdprogress(Request $request)
    {
//	$profileid=	Auth::user()->profile_id;

		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = "A".time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
       if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = "B".time() . '.' . $request->file('file2')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename2);
        }
        else
        {
            $filename2='';
        }
        if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = "C".time() . '.' . $request->file('file3')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename3);
        }
        else
        {
            $filename3='';
        }
      if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = "D".time() . '.' . $request->file('file4')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename4);
        }
        else
        {
            $filename4='';
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(
    "publisherwhom" => $request->publisherwhom,
	"publisherid" => Auth::user()->profile_id,
    "date_coursewrk" => $request->dateOfcw,
	"coursewrk_status" => $request->coursestatus,
	"date_coursewrk_completion" => $request->coursecompletedate,
	"rac_progress" =>$request->racprogress,
	"date_rac" => $request->daterac,
	"date_viva" => $request->vivadate,
	"date_thesis" => $request->thesisdate,
	"date_opendefence" => $request->defencedate,
	"upload_certificate" => $filename,
	"upload_progress" => $filename2,
	"upload_document" => $filename3,
	"upload_activity" => $filename4,
	"progress_name" => $request->progress,
	"title_event" => $request->eventtitle,
    "from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "organiser" => $request->organiser,
	"status" => $request->status,
   );

    $id  =   DB::table('phd_progress')->insertGetId($dataArray);

	if($id==1){ 
                    	return response()->json(['success'=>'Phd Progress has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
    
    	   public function deletePhdprogress(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE phd_progress.* FROM phd_progress  where phd_progress.id='$id'");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
    
                  public function editPhdprogress(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `phd_progress` WHERE `id`='$id'");
    
		return view('admin.faculty.editPhdprogress',compact('profile_edit'));
		
    }
          public function editInfoPhdprogress(Request $request)
    {
		$editid=$request->editid;
		
      
      
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = "A".time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
       if($request->file('file2')) 
		{ 
        
            $file = $request->file('file2');
            $filename2 = "B".time() . '.' . $request->file('file2')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename2);
        }
        else
        {
            $filename2=$request->current_file2;
        }
        if($request->file('file3')) 
		{ 
        
            $file = $request->file('file3');
            $filename3 = "C".time() . '.' . $request->file('file3')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename3);
        }
        else
        {
            $filename3=$request->current_file3;
        }
      if($request->file('file4')) 
		{ 
        
            $file = $request->file('file4');
            $filename4 = "D".time() . '.' . $request->file('file4')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename4);
        }
        else
        {
            $filename4=$request->current_file4;
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(
  "publisherwhom" => $request->publisherwhom,
	"publisherid" => Auth::user()->profile_id,
    "date_coursewrk" => $request->dateOfcw,
	"coursewrk_status" => $request->coursestatus,
	"date_coursewrk_completion" => $request->coursecompletedate,
	"rac_progress" =>$request->racprogress,
	"date_rac" => $request->daterac,
	"date_viva" => $request->vivadate,
	"date_thesis" => $request->thesisdate,
	"date_opendefence" => $request->defencedate,
	"upload_certificate" => $filename,
	"upload_progress" => $filename2,
	"upload_document" => $filename3,
	"upload_activity" => $filename4,
	"progress_name" => $request->progress,
	"title_event" => $request->eventtitle,
    "from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "organiser" => $request->organiser,
	"status" => $request->status,

   );

    $id  =    DB::table('phd_progress')->where('id', $editid)->update($dataArray) ;

	if($id==1){ 
                    	return response()->json(['success'=>'Phd Progress Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	  public function PhdprogressList(Request $request)
    {  
           $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		   	$list = DB::select("select * from(

SELECT phd_progress.*,research_fellow.name,'ResearchFellow' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='2'  UNION    

              
SELECT phd_progress.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='5'  
     
) xx order by xx.id desc"); 
	   return view('admin.faculty.progressList',compact('list'));
	   }else
	   {
      $faculty_id = Auth::user()->profile_id;
     
$list = DB::select("select * from(

SELECT phd_progress.*,research_fellow.name,'ResearchFellow' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='2' and publisherid='$faculty_id' UNION    

              
SELECT phd_progress.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='5' and publisherid='$faculty_id' 
     
) xx order by xx.id desc"); 

	    return view('admin.faculty.progressList',compact('list'));
	   }
    }
	
		public function downloadPhdProgressList(Request $request)
{
 
   $fileName = 'PhdProgressList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("select * from(

SELECT phd_progress.*,research_fellow.name,'ResearchFellow' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='2' and publisherid='$faculty_id' UNION    

              
SELECT phd_progress.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='5' and publisherid='$faculty_id' 
     
) xx order by xx.id desc"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Publisher Name','Category','Date Of CourseWork','Coursework Status','Coursework Completion','Rac Progress','Date Rac','Date Viva','Date Thesis','Date OpenDefence','Progress Name','Title Event','From Date','To Date','Organiser','Status');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
				 $row['Publisher Name']  = $task->name;
                $row['Category']  = $task->category;
                $row['Date Of CourseWork']  = $task->date_coursewrk; 
                $row['Coursework Status']  = $task->coursewrk_status;
                 $row['Coursework Completion']  = $task->date_coursewrk_completion;
                 $row['Rac Progress']  = $task->rac_progress;
                  $row['Date Rac']  = $task->date_rac;
                $row['Date Viva']  = $task->date_viva;
                  $row['Date Thesis']  = $task->date_thesis;
                 $row['Date OpenDefence']  = $task->date_opendefence;
                 $row['Progress Name']  = $task->progress_name;
                 $row['Title Event']  = $task->title_event;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                 $row['Organiser']  = $task->organiser;
				 $row['Status']  = $task->status;
               
                fputcsv($file, array($row['Publisher Name'],$row['Category'],$row['Date Of CourseWork'], $row['Coursework Status'],$row['Coursework Completion'],$row['Rac Progress'],$row['Date Rac'],$row['Date Viva'],$row['Date Thesis'],$row['Date OpenDefence'],$row['Progress Name'],$row['Title Event'],$row['From Date'],$row['To Date'],$row['Organiser'],$row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
    		public function downloadPhdProgressListAdmin(Request $request)
{
 
   $fileName = 'PhdProgressList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("select * from(

SELECT phd_progress.*,research_fellow.name,'ResearchFellow' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='2'  UNION    

              
SELECT phd_progress.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `phd_progress` join research_fellow on research_fellow.id=phd_progress.`publisherid` where phd_progress.publisherwhom='5' 
     
) xx order by xx.id desc"); 
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Publisher Name','Category','Date Of CourseWork','Coursework Status','Coursework Completion','Rac Progress','Date Rac','Date Viva','Date Thesis','Date OpenDefence','Progress Name','Title Event','From Date','To Date','Organiser','Status');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
				 $row['Publisher Name']  = $task->name;
                $row['Category']  = $task->category;
                $row['Date Of CourseWork']  = $task->date_coursewrk; 
                $row['Coursework Status']  = $task->coursewrk_status;
                 $row['Coursework Completion']  = $task->date_coursewrk_completion;
                 $row['Rac Progress']  = $task->rac_progress;
                  $row['Date Rac']  = $task->date_rac;
                $row['Date Viva']  = $task->date_viva;
                  $row['Date Thesis']  = $task->date_thesis;
                 $row['Date OpenDefence']  = $task->date_opendefence;
                 $row['Progress Name']  = $task->progress_name;
                 $row['Title Event']  = $task->title_event;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                 $row['Organiser']  = $task->organiser;
				 $row['Status']  = $task->status;
               
                fputcsv($file, array($row['Publisher Name'],$row['Category'],$row['Date Of CourseWork'], $row['Coursework Status'],$row['Coursework Completion'],$row['Rac Progress'],$row['Date Rac'],$row['Date Viva'],$row['Date Thesis'],$row['Date OpenDefence'],$row['Progress Name'],$row['Title Event'],$row['From Date'],$row['To Date'],$row['Organiser'],$row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	 	   public function deletefapiAcademicBody(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE fapi_academic_body.* FROM fapi_academic_body  where fapi_academic_body.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
	       			    public function editfapiAcademicBody(Request $request)
    {

		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
			$id=$request->id;
	       $profile_edit= DB::select("SELECT * FROM `fapi_academic_body` WHERE `id`='$id'");
		 return view('admin.faculty.editAcademicFapi',compact('collabrators','departments','cells','naac','profile_edit'));
    }
         public function editInfofapiAcademicBody(Request $request)
    {
	$editid = $request->editid;
	
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"name_academic_body" => $request->title,  //Name of Academic Bodies
	"type" => $request->Category,  //Type
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"name_recognised_body" => $request->venue, //Name of Reconised Body
	"designation" => $request->level,  //designation
     "recognition_category" => $promoter,  //Recognition Category
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =    DB::table('fapi_academic_body')->where('id', $editid)->update($dataArray) ;
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
	    public function fapiAcademicBodyList(Request $request)
    {   $type = Auth::user()->type;
    if($type=='HOD')
	   {
	       
	      $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentid=$depart[0]->id;
	      $departmentname= $depart[0]->department;
	      $list = DB::select("SELECT fapi_academic_body.`id`,fapi_academic_body.`faculty_id`,faculity.name as facultyname,faculity.department as dept,fapi_academic_body.`name_academic_body`,fapi_academic_body.type,fapi_academic_body.from_date,fapi_academic_body.to_date, fapi_academic_body.`name_recognised_body`,fapi_academic_body.`designation`,fapi_academic_body.recognition_category FROM `fapi_academic_body` 
LEFT join faculity on faculity.fid=fapi_academic_body.`faculty_id` where faculity.department='$departmentname'
 group by fapi_academic_body.id "); 
	   return view('admin.faculty.fapiAcademicBodyList',compact('list'));
	   }
        elseif ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT fapi_academic_body.`id`,fapi_academic_body.`faculty_id`,faculity.name as facultyname,faculity.department as dept,fapi_academic_body.`name_academic_body`,fapi_academic_body.type,fapi_academic_body.from_date,fapi_academic_body.to_date, fapi_academic_body.`name_recognised_body`,fapi_academic_body.`designation`,fapi_academic_body.recognition_category FROM `fapi_academic_body` LEFT join faculity on faculity.fid=fapi_academic_body.`faculty_id` group by fapi_academic_body.id"); 
	   return view('admin.faculty.fapiAcademicBodyList',compact('list'));
	   }else
	   {
	   $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT fapi_academic_body.`id`,fapi_academic_body.`faculty_id`,faculity.name as facultyname,faculity.department as dept,fapi_academic_body.`name_academic_body`,fapi_academic_body.type,fapi_academic_body.from_date,fapi_academic_body.to_date, fapi_academic_body.`name_recognised_body`,fapi_academic_body.`designation`,fapi_academic_body.recognition_category FROM `fapi_academic_body` 
LEFT join faculity on faculity.fid=fapi_academic_body.`faculty_id` where faculity.fid='$faculty_id'
 group by fapi_academic_body.id "); 
	    return view('admin.faculty.fapiAcademicBodyList',compact('list'));
	   }
    }
	
	          public function exportCsvfapiAcademicfac(Request $request)
{
   $fileName = 'FapiAcademicBodyFacultyList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT fapi_academic_body.`id`,fapi_academic_body.`faculty_id`,faculity.name as facultyname,faculity.department as dept,fapi_academic_body.`name_academic_body`,fapi_academic_body.type,fapi_academic_body.from_date,fapi_academic_body.to_date, fapi_academic_body.`name_recognised_body`,fapi_academic_body.`designation`,fapi_academic_body.recognition_category FROM `fapi_academic_body` 
LEFT join faculity on faculity.fid=fapi_academic_body.`faculty_id` where faculity.fid='$faculty_id'
 group by fapi_academic_body.id");

 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Academic Body','Type','From Date','To Date','Name Of Recognised Body','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
                $row['Department']  = $task->dept;
                $row['Name Of Academic Body']  = $task->name_academic_body;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                 $row['Name Of Recognised Body']  = $task->name_recognised_body;
                  $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Academic Body'],$row['Type'],$row['From Date'],$row['To Date'],$row['Name Of Recognised Body'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }  
        public function exportCsvfapiAcademichod(Request $request)
{
   $fileName = 'FapiAcademicBodyDepartment.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT fapi_academic_body.`id`,fapi_academic_body.`faculty_id`,faculity.name as facultyname,faculity.department as dept,fapi_academic_body.`name_academic_body`,fapi_academic_body.type,fapi_academic_body.from_date,fapi_academic_body.to_date, fapi_academic_body.`name_recognised_body`,fapi_academic_body.`designation`,fapi_academic_body.recognition_category FROM `fapi_academic_body` 
LEFT join faculity on faculity.fid=fapi_academic_body.`faculty_id` where faculity.department='$departmentname'
 group by fapi_academic_body.id");

 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Academic Body','Type','From Date','To Date','Name Of Recognised Body','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
                $row['Department']  = $task->dept;
                $row['Name Of Academic Body']  = $task->name_academic_body;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                 $row['Name Of Recognised Body']  = $task->name_recognised_body;
                  $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Academic Body'],$row['Type'],$row['From Date'],$row['To Date'],$row['Name Of Recognised Body'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }  
              public function exportCsvfapiAcademicadmin(Request $request)
{
   $fileName = 'FapiAcademicBodiesList.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT fapi_academic_body.`id`,fapi_academic_body.`faculty_id`,faculity.name as facultyname,faculity.department as dept,fapi_academic_body.`name_academic_body`,fapi_academic_body.type,fapi_academic_body.from_date,fapi_academic_body.to_date, fapi_academic_body.`name_recognised_body`,fapi_academic_body.`designation`,fapi_academic_body.recognition_category FROM `fapi_academic_body` LEFT join faculity on faculity.fid=fapi_academic_body.`faculty_id` group by fapi_academic_body.id");

 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Academic Body','Type','From Date','To Date','Name Of Recognised Body','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
                $row['Department']  = $task->dept;
                $row['Name Of Academic Body']  = $task->name_academic_body;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                 $row['Name Of Recognised Body']  = $task->name_recognised_body;
                  $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Academic Body'],$row['Type'],$row['From Date'],$row['To Date'],$row['Name Of Recognised Body'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }  
	
      public function exportCsv(Request $request)
{
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,group_concat(departments.department) as dept,group_concat(cell.name_of_the_cell) as cell,fdp.indulgence_level,fdp.practice,naac_keyword.keywordname FROM `fdp` LEFT join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
LEFT join naac_keyword on naac_keyword.id=fdp.main_criteria
where fdp.`fid`='$faculty_id' and (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id order by fdp.id desc");
 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','EventType','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC','Indulgence','Best Practise','Naac Keyword');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Event Title']  = $task->title;
                $row['From Date']  = $task->from_date;
                $row['To Date']  = $task->to_date;
                 $row['Venue']  = $task->venue;
                 $row['Agenda']  = $task->agenda;
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
				 $row['Indulgence']  = $task->indulgence_level;
				  $row['Best Practise']  = $task->practice;
				   $row['Naac Keyword']  = $task->keywordname;
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['EventType'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC'],$row['Indulgence'],$row['Best Practise'],$row['Naac Keyword']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
      public function exportCsvadmin(Request $request)
{
	
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
   //$tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,group_concat(departments.department) as dept,group_concat(cell.name_of_the_cell) as cell FROM `fdp` LEFT join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0
//LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
//LEFT join faculity on faculity.fid=fdp.fid
//where  (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id order by fdp.id desc");
  $tasks = DB::select("SELECT DISTINCT fdp.`id`,faculity.department as dept,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,group_concat(cell.name_of_the_cell) as cell,fdp.indulgence_level,fdp.practice,naac_keyword.keywordname FROM `fdp` 
LEFT join naac_keyword on naac_keyword.id=fdp.main_criteria
 LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where  (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id order by fdp.id desc");
 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','Department','Faculty','EventType','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC','Indulgence','Best Practise','Naac Keyword');

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
				 $row['Indulgence']  = $task->indulgence_level;
				  $row['Best Practise']  = $task->practice;
				   $row['Naac Keyword']  = $task->keywordname;
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['Department'],$row['Faculty'],$row['EventType'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC'],$row['Indulgence'],$row['Best Practise'],$row['Naac Keyword']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
          public function exportCsvfapiadmin(Request $request)
{
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
 //  $tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category` from fdp where  fdp.type='fapi' order by id desc");
  $tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,faculity.name as facultyname,faculity.department as dept,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,fdp.indulgence_level,fdp.practice,naac_keyword.keywordname from fdp 
LEFT join naac_keyword on naac_keyword.id=fdp.main_criteria
LEFT join faculity on faculity.fid=fdp.fid where  fdp.type='fapi' order by id desc");
 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','Faculty','Department','EventType','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC','Indulgence','Best Practise','Naac Keyword');

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
				$row['Indulgence']  = $task->indulgence_level;
				  $row['Best Practise']  = $task->practice;
				   $row['Naac Keyword']  = $task->keywordname;
               
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['Faculty'],$row['Department'],$row['EventType'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC'],$row['Indulgence'],$row['Best Practise'],$row['Naac Keyword']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
        public function exportCsvfapifac(Request $request)
{
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,fdp.indulgence_level,fdp.practice,naac_keyword.keywordname from fdp left join naac_keyword on naac_keyword.id=fdp.main_criteria where  fdp.type='fapi' and fdp.fid='$faculty_id' order by id desc");

 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','EventType','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC','Indulgence','Best Practise','Naac Keyword');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Event Title']  = $task->title;
                $row['From Date']  = $task->from_date;
                $row['To Date']  = $task->to_date;
                 $row['Venue']  = $task->venue;
                 $row['Agenda']  = $task->agenda;
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
				 $row['Indulgence']  = $task->indulgence_level;
				  $row['Best Practise']  = $task->practice;
				   $row['Naac Keyword']  = $task->keywordname;
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['EventType'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC'],$row['Indulgence'],$row['Best Practise'],$row['Naac Keyword']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
        public function exportCsvhod(Request $request)
{
     $type = Auth::user()->type;
	   if($type=='HOD')
	   {
	       
	      $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT departments.id FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->id;
	   }
   $fileName = 'event.csv';
  $faculty_id =  Auth::user()->profile_id;
   $tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,fdp.`eventtype`,
   fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,
   fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,faculity.name as facultyname,departments.department as dept ,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,fdp.indulgence_level,fdp.practice,naac_keyword.keywordname FROM `fdp` LEFT join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
LEFT join naac_keyword on naac_keyword.id=fdp.main_criteria
where fdp.dept='$deprtmentname' and (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id");
 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','EventType','Category','Faculty','Department','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC','Indulgence','Best Practise','Naac Keyword');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Event Title']  = $task->title;
                $row['From Date']  = $task->from_date;
                $row['To Date']  = $task->to_date;
                 $row['Venue']  = $task->venue;
                 $row['Agenda']  = $task->agenda;
                 $row['EventType']  = $task->eventtype;
                 $row['Category']  = $task->category;
				 $row['Faculty']  = $task->facultyname;
				 $row['Department']  = $task->dept;
                  $row['No oF Male Teacher']  = $task->male_teacher;
                 $row['No oF FeMale Teacher']  = $task->female_teacher;
                 $row['No oF Male Student']  = $task->male_student;
                 $row['No oF FeMale Student']  = $task->female_student;
                 $row['Other Student']  = $task->other_student;
                 $row['Specially Abled']  = $task->specially_abled;
                 $row['SC']  = $task->caste_sc;
                $row['ST']  = $task->caste_st;
                $row['OBC']  = $task->caste_obc;
                $row['Indulgence']  = $task->indulgence_level;
                $row['Best Practise']  = $task->practice;
                $row['Naac Keyword']  = $task->keywordname;
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['EventType'],$row['Category'],$row['Faculty'],$row['Department'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC'],$row['Indulgence'],$row['Best Practise'],$row['Naac Keyword']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
	    			    public function addFapiAcademicBody(Request $request)
    {

		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
		 return view('admin.faculty.addAcademicFapi',compact('collabrators','departments','cells','naac'));
    }
	
	 public function storefapiAcademicBody(Request $request)
    {
	
	
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
  		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"name_academic_body" => $request->title,  //Name of Academic Bodies
	"type" => $request->Category,  //Type
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"name_recognised_body" => $request->venue, //Name of Reconised Body
	"designation" => $request->level,  //designation
     "recognition_category" => $promoter,  //Recognition Category
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
 $id  =   DB::table('fapi_academic_body')->insertGetId($dataArray);

	if($id!='')
	{
		 return response()->json(['id' => $id]);
		
        //return response('Inserted Successfully.', 200); 
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
    public function createPDF($id) {
		
      // retreive all records from db
       $event_edit= DB::select("select fdp.* from fdp where fdp.id='$id'");
        $collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$list = DB::select("SELECT  * FROM `fdp` where `id`='$id' order by id desc"); 
		$imagelist= DB::select("SELECT * FROM `picture` where picture.fid='$id' ORDER BY `pid` DESC");
    // return view('admin.faculty.pdf',compact('list','naac','collabrators','cells','departments','imagelist'));
     $pdf = PDF::loadView('admin.faculty.pdf', compact('list','naac','collabrators','cells','departments','imagelist'));
     return $pdf->download('pdf_file.pdf');
    }
     public function fetchBarchart(Request $request)
    {   
     $faculty_id =  Auth::user()->profile_id;
	  $year =	$request->year;
	  $iparr =  explode("-", $year);        //split ("\-", $year);
	  $year1 = $iparr[0];
	  $year2 = $iparr[1];
	   $data=DB::select("SELECT(SELECT count(id) FROM fdp where `category`='Seminar' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31' )) as Seminar, (SELECT count(id) FROM fdp where `category`='Workshop' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as Workshop, (SELECT count(id) FROM fdp where `category`='Tour' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as StudyTour, (SELECT count(id) FROM fdp where `category`='Symposium' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31' )) as Symposium, (SELECT count(id) FROM fdp where `category`='Conference' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as Conference, (SELECT count(id) FROM fdp where `category`='Webinar' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as Webinar, (SELECT count(id) FROM fdp where `category`='programs' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as PublicPrograms, (SELECT count(id) FROM fdp where `category`='StudentExecutive' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as StudentExecutive, (SELECT count(id) FROM fdp where `category`='Other' and fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31')) as Other ");
	
	  // return respo;
	  echo json_encode($data);
    }
	 public function fetchLinechart(Request $request)
    {   
     $faculty_id =  Auth::user()->profile_id;
	  $year =	$request->year;
	  $iparr =  explode("-", $year);        //split ("\-", $year);
	  $year1 = $iparr[0];
	  $year2 = $iparr[1];
	   $data=DB::select("SELECT id as events,`male_student` as male,female_student as female,other_student as other FROM fdp where fid='$faculty_id' and (`to_date` BETWEEN '$year1-06-01' AND '$year2-03-31' )");
	
	  // return respo;
	  echo json_encode($data);
    }
     public function editProfileImage($id='')
    {   
         $idd= Auth::user()->profile_id;
		
	     return view('admin.faculty.profileImageEdit',compact('idd'));
    }
    	public function storeProfileImage(Request $request)
    {
		
     $validation = Validator::make($request->all(), [
      'select_file' => 'required|image|mimes:jpeg,png,jpg,gif'
     ]);
     if($validation->passes())
     {   

   $profileid = Auth::user()->profile_id;
			 
			 // $products = DB::select("SELECT `picture` FROM `cell` WHERE id='$profileid'");
			 // $path = public_path("uploads/cell/" . $products[0]->picture);
		
			  
      $image = $request->file('select_file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('uploads/facultyimg'), $new_name);
	   $postArray = ['picture' => $new_name];
        DB::table('faculity')->where('fid',  $profileid)->update($postArray);
      return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="{{url(uploads/facultyimg/'.$new_name.')}}" class="img-thumbnail" width="300" />',
	 
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
	 public function editProfile()
    {   
     
		$faculty_id = Auth::user()->profile_id;
        $profile_edit= DB::select("SELECT * FROM `faculity` WHERE `fid`='$faculty_id'");
    
		return view('admin.faculty.editProfile',compact('profile_edit'));
		
    }
	 public function editEvent($id='',$type)
    {   
      /*    if(auth()->user()->role==2)
        {
             
        $faculty_eventid=$id;
       
        } */
		
        //$event_edit= DB::select("select fdp.* from fdp where fdp.id='$id'");
		  $event_edit= DB::select("select fdp.*,mou.id as mouid,mou.title as moutitle from fdp left join mou on mou.id=fdp.mou_id where fdp.id='$id'");
        $collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
		if($type=='Recent')
		{
		return view('admin.faculty.editEvent',compact('event_edit','collabrators','departments','cells','naac'));
		}
		else{ 
		return view('admin.faculty.editUpcomingEvent',compact('event_edit','collabrators','departments','cells','naac'));
		}
    }
    	 public function editFdp($id='',$type)
    {   
      /*    if(auth()->user()->role==2)
        {
             
        $faculty_eventid=$id;
       
        } */
		
        $event_edit= DB::select("select fdp.* from fdp where fdp.id='$id'");
        $collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
	    $naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
	
		return view('admin.faculty.editFdp',compact('event_edit','collabrators','departments','cells','naac'));
		
    }
    
	 public function editImage($id='')
    {   
         $idd=$id;
	
        $list= DB::select("SELECT * FROM `picture` where picture.fid='$id' ORDER BY `pid` DESC");
       
		return view('admin.faculty.eventsImageList',compact('list','idd'));
    }
	  public function editFileImage($id='')
    {   
         $idd=$id;
	
        $list= DB::select("SELECT * FROM `fdp` where fdp.id='$id'");
     
		return view('admin.faculty.eventsFileList',compact('list','idd'));
    }
	              public function exportCsvfapihod(Request $request)
{
   $fileName = 'event.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
   $tasks = DB::select("SELECT DISTINCT fdp.`id`,fdp.`title`,fdp.`from_date`,fdp.`to_date`,fdp.`venue`,fdp.`agenda`,faculity.name as facultyname,departments.department as dept,fdp.`eventtype`,fdp.`male_teacher`,fdp.`female_teacher`,fdp.`male_student`,fdp.`female_student`,fdp.`other_student`,fdp.`specially_abled`,fdp.`caste_sc`,fdp.`caste_st`,fdp.`caste_obc`,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,fdp.indulgence_level,fdp.practice,naac_keyword.keywordname from fdp 
   LEFT join faculity on faculity.fid=fdp.fid 
   left join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0 
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join naac_keyword on naac_keyword.id=fdp.main_criteria
   where faculity.department='$deprtmentname' and  fdp.type='fapi' group by fdp.id");

 
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Event Title','From Date','To Date','Venue','Agenda','Faculty','Department','EventType','Category','No oF Male Teacher','No oF FeMale Teacher','No oF Male Student','No oF FeMale Student','Other Student','Specially Abled','SC','ST','OBC','Indulgence','Best Practice','Naac Keyword');

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
				 $row['Indulgence']  = $task->indulgence_level;
                $row['Best Practice']  = $task->practice;
                $row['Naac Keyword']  = $task->keywordname;
               
                fputcsv($file, array($row['Event Title'],$row['From Date'],$row['To Date'],$row['Venue'],$row['Agenda'],$row['Faculty'],$row['Department'],$row['EventType'],$row['Category'],$row['No oF Male Teacher'],$row['No oF FeMale Teacher'],$row['No oF Male Student'],$row['No oF FeMale Student'],$row['Other Student'],$row['Specially Abled'],$row['SC'],$row['ST'],$row['OBC'],$row['Indulgence'],$row['Best Practice'],$row['Naac Keyword']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
	    public function eventList(Request $request)
    {  
	   
          $type = Auth::user()->type;
	   if($type=='HOD')
	   {
	       
		    $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT departments.id FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->id;
	     $list = DB::select(" SELECT fdp.`id`,`eventtype`,faculity.name as facultyname,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,departments.department as dept ,cell.name_of_the_cell as cell FROM `fdp` left join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0 
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where fdp.dept='$deprtmentname' and (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id"); 
	   return view('admin.faculty.eventsList',compact('list'));
		   
	  /*    $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT departments.id FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->id;
	     $list = DB::select(" SELECT fdp.`id`,fdp.dept,`eventtype`,faculity.name as facultyname,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,departments.department as dept ,cell.name_of_the_cell as cell FROM `fdp` left join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0 
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where $deprtmentname IN(fdp.dept ) and (fdp.type='Upcoming' OR fdp.type='Recent')"); 
	   return view('admin.faculty.eventsList',compact('list'));*/
	   }
	   elseif ($type=='superadmin' || $type=='sub' || $type=='superdup') {
	        $faculty_id = Auth::user()->profile_id;
		$list=DB::select("SELECT DISTINCT fdp.`id`,`eventtype`,fdp.`fid`,faculity.name as facultyname,faculity.department as dept,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`, group_concat(cell.name_of_the_cell) as cell FROM `fdp`
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where  (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id order by fdp.id desc ");
	    return view('admin.faculty.eventsList',compact('list'));
	   }
	   else
	   {
	   $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT DISTINCT fdp.`id`,`eventtype`,fdp.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,group_concat(departments.department) as dept,group_concat(cell.name_of_the_cell) as cell FROM `fdp` LEFT join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where fdp.`fid`='$faculty_id' and (fdp.type='Upcoming' OR fdp.type='Recent') group by fdp.id order by fdp.id desc"); 
	    return view('admin.faculty.eventsList',compact('list'));
	   }
    }
    	    public function fdpList(Request $request)
    {  
	  $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		//$list = DB::select("SELECT distinct fdp.`id`,`eventtype`,`fid`,`title`,`from_date`,`to_date`,`category`,fdp.`type`,indulgence_level,cell.name_of_the_cell as cell FROM `fdp` LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0  where fdp.type='fapi' group by fdp.id order by fdp.id desc"); 
			$list = DB::select("SELECT distinct fdp.`id`,`eventtype`,fdp.`fid`,`title`,faculity.name as facultyname,faculity.department as dept,`from_date`,`to_date`,fdp.`category`,fdp.`type`,indulgence_level,cell.name_of_the_cell as cell FROM `fdp` LEFT join faculity on faculity.fid=fdp.fid LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0 where fdp.type='fapi' group by fdp.id "); 
	   return view('admin.faculty.fdpList',compact('list'));
	   }
	    elseif($type=='HOD')
	   {
	       
		    $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->department;
		
	     $list = DB::select(" SELECT fdp.`id`,`eventtype`,faculity.name as facultyname,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,fdp.	indulgence_level,departments.department as dept ,cell.name_of_the_cell as cell FROM `fdp` left join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0 
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where faculity.department='$deprtmentname' and (fdp.type='fapi') group by fdp.id"); 
	   return view('admin.faculty.fdpList',compact('list'));
	   }else
	   {
	   $faculty_id = Auth::user()->profile_id;
	//	$list = DB::select("SELECT fdp.`id`,`eventtype`,`fid`,`title`,`from_date`,`to_date`,`category`,indulgence_level,`type`,cell.name_of_the_cell as cell  FROM `fdp` LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0 where `fid`='$faculty_id' and fdp.type='fapi' group by fdp.id  order by fdp.id desc"); 
		$list = DB::select("SELECT fdp.`id`,`eventtype`,fdp.`fid`,`title`,faculity.name as facultyname,faculity.department as dept,`from_date`,`to_date`,fdp.`category`,indulgence_level,fdp.`type`,cell.name_of_the_cell as cell  FROM `fdp` LEFT join faculity on faculity.fid=fdp.fid LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0 where fdp.`fid`='$faculty_id' and fdp.type='fapi' group by fdp.id  order by fdp.id desc"); 
	    return view('admin.faculty.fdpList',compact('list'));
	   }
    }
        public function eventdateList(Request $request)
    {  
	 /*  $faculty_id = Auth::user()->profile_id;
	   $from_date= $request->from_date;
	   $to_date= $request->to_date;
		if(($from_date!='')&& ($to_date!=''))
	  {
	    $list = DB::select("SELECT `id`,`eventtype`,`fid`,`title`,`from_date`,`to_date`,`venue`,`type` FROM `fdp` where `fid`='3' and (`to_date` BETWEEN '$from_date' AND '$to_date' ) order by id desc"); 
	    return view('admin.faculty.eventsList',compact('list'));
	  }*/
	  
	       
          
          $type = Auth::user()->type;
	   if($type=='HOD')
	   {
	       $from_date= $request->from_date;
	      $to_date= $request->to_date; 
	      $facultyid= Auth::user()->profile_id;
	      $depart = DB::select("SELECT departments.id FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $deprtmentname=$depart[0]->id;
	      if(($from_date!='')&& ($to_date!=''))
	  {
	     $list = DB::select(" SELECT fdp.`id`,fdp.dept,`eventtype`,faculity.name as facultyname,fdp.`fid`,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,departments.department as dept ,cell.name_of_the_cell as cell FROM `fdp` left join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0 
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where $deprtmentname IN(fdp.dept ) and (fdp.type='Upcoming' OR fdp.type='Recent') and (`to_date` BETWEEN '$from_date' AND '$to_date' )"); 
	   return view('admin.faculty.eventsList',compact('list'));
	  }
	   }
	   elseif ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
	         $from_date= $request->from_date;
	   $to_date= $request->to_date;
	     if(($from_date!='')&& ($to_date!=''))
	  {
		$list = DB::select("SELECT DISTINCT fdp.`id`,`eventtype`,fdp.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,group_concat(departments.department) as dept,group_concat(cell.name_of_the_cell) as cell FROM `fdp` LEFT join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where  (fdp.type='Upcoming' OR fdp.type='Recent') and (`to_date` BETWEEN '$from_date' AND '$to_date' ) group by fdp.id order by fdp.id desc"); 
	    return view('admin.faculty.eventsList',compact('list'));
	  }
	   }
	   else
	   {
	   $faculty_id = Auth::user()->profile_id;
	    $from_date= $request->from_date;
	   $to_date= $request->to_date;
	     if(($from_date!='')&& ($to_date!=''))
	  {
		$list = DB::select("SELECT DISTINCT fdp.`id`,`eventtype`,fdp.`fid`,faculity.name as facultyname,`title`,`from_date`,`to_date`,`venue`,fdp.`type`,fdp.`category`,group_concat(departments.department) as dept,group_concat(cell.name_of_the_cell) as cell FROM `fdp` LEFT join departments  ON FIND_IN_SET(departments.id, fdp.dept) != 0
LEFT join cell on FIND_IN_SET(cell.id, fdp.cell)!= 0
LEFT join faculity on faculity.fid=fdp.fid
where fdp.`fid`='$faculty_id' and (fdp.type='Upcoming' OR fdp.type='Recent') and (`to_date` BETWEEN '$from_date' AND '$to_date' ) group by fdp.id order by fdp.id desc"); 
	    return view('admin.faculty.eventsList',compact('list'));
	  }
	   }
        
	   
    }
		    public function addEvent(Request $request)
    {

		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
		 return view('admin.faculty.events',compact('collabrators','departments','cells','naac'));
    }
			    public function addUpcominEvent(Request $request)
    {

		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
		 return view('admin.faculty.up_coming_events',compact('collabrators','departments','cells','naac'));
    }
    			    public function addFdp(Request $request)
    {

		$collabrators =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
		$cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
		//$naac =  DB::select("SELECT id,name FROM `nach` ORDER BY id ASC"); 
		$naac =  DB::select("SELECT id,keywordname as name FROM `naac_keyword` ORDER BY id ASC"); 
		 return view('admin.faculty.addFdp',compact('collabrators','departments','cells','naac'));
    }
    	    public function store(Request $request)
    {
		  
        if($request->collabratorsdeptdata=='')
        {
          $id = Auth::user()->profile_id;
		
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
               $id = Auth::user()->profile_id;
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
	"eventtype" => 'Recent',
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
	"dept" =>$coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"type" => 'Recent',
	"mou_id" => $request->skillid,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('fdp')->insertGetId($dataArray);
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
	  	    public function storeevent_upcoming(Request $request)
    {
		
        if($request->collabratorsdeptdata=='')
        {
          $id = Auth::user()->profile_id;
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
               $id = Auth::user()->profile_id;
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
	"eventtype" => 'Upcoming',
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"venue" => $request->venue,
	"description" => $request->description,
	"agenda" => $request->agenda,
	"mou_id" => $request->skillid,
	"dept" => $coldept,
	"type" => 'Upcoming',
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('fdp')->insertGetId($dataArray);
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
		  	    public function storefdp(Request $request)
    {
		if($request->papertitle)
		{
		    $papertitle=$request->papertitle;
		}
		else
		{
		    $papertitle='';
		}
			if($request->theme)
		{
		    $theme=$request->theme;
		}
		else
		{
		    $theme='';
		}
				if($request->abstract)
		{
		    $abstract=$request->abstract;
		}
		else
		{
		    $abstract='';
		}
				if($request->awardname)
		{
		    $awardname=$request->awardname;
		}
		else
		{
		    $awardname='';
		}
				if($request->agency)
		{
		    $agency=$request->agency;
		}
		else
		{
		    $agency='';
		}
			if($request->awarddate)
		{
		    $awarddate=$request->awarddate;
		}
		else
		{
		    $awarddate='';
		}
				if($request->promoter)
		{
		    $promoter=$request->promoter;
		}
		else
		{
		    $promoter='';
		}
			if($request->eventdtl)
		{
		    $eventdtl=$request->eventdtl;
		}
		else
		{
		    $eventdtl='';
		}
         	    if($request->collabratorsdeptdata=='')
        {
          $id = Auth::user()->profile_id;
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
               $id = Auth::user()->profile_id;
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
	"eventtype" => '',
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"venue" => $request->venue,
	"description" => $request->description,
	"agenda" => $request->agenda,
	"collaborators" => $request->collabratorsdata,
	"dept" => $coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"indulgence_level" => $request->level,
	"paper_title" => $papertitle,
	"paper_theme" => $theme,
	"paper_abstract" =>  $abstract,
	"award_name" => $awardname,
	"awarddate" => $awarddate,
	"agency" => $agency,
	"awrd_promoter" => $promoter,
	"eventdtl" => $eventdtl,
	"type" => 'fapi',
    "vurl" => $request->vurl,
	"surl" => $request->surl,
	 "instagram_url" => $request->insta,
	 "linkedin_url" => $request->linkedin,
	 "facebook_url" => $request->facebook,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('fdp')->insertGetId($dataArray);
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
                $id = Auth::user()->profile_id;
				
          $departmentname =  DB::select("SELECT `department` FROM `faculity` WHERE fid='$id'"); 
          $department = $departmentname[0]->department;
		//  print_r($department); exit;
          $departmentid= DB::select("SELECT id FROM `departments` WHERE `department`='$department'"); 
		 // print_r($departmentid); exit;
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
	"eventtype" => 'Recent',
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
	"mou_id" => $request->skillid,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	$editid=$request->editid;
	$result  =   DB::table('fdp')->where('id', $editid)->update($dataArray);
	
	
	if($result)
	{
		
	return response()->json(['id' => $result]);
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
	
	public function updateProfile(Request $request)
    {
		
        $request->validate([
            'file' => 'mimes:doc,docx,pdf,zip,rar',
        ]);
        if($request->file)
		{
        $fileName = time().'.'.$request->file->extension();  
         
        $request->file->move(public_path('uploads/facultyresume'), $fileName);
        }
		else{
			$fileName= $request->current_file;
		}
		$dataArray      =  array(
	  "name" => $request->name,
	"phone_number" => $request->phone,
	"address" => $request->address,
	"highest_edu" => $request->qualification,
	"dob" => $request->dob,
	"date_of_join" => $request->doj,
	"department" => $request->dept,
	"description" => $request->description,
	"resume" => $fileName,
	);
		$faculty_id = Auth::user()->profile_id;
		
        DB::table('faculity')->where('fid', $faculty_id)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
	  public function updateUpcomingEvent(Request $request)
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
             $id = Auth::user()->profile_id;
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
	"eventtype" => 'Upcoming',
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"venue" => $request->venue,
	"description" => $request->description,
	"agenda" => $request->agenda,
	"mou_id" => $request->skillid,
	
	"dept" =>$coldept,
	
	"main_criteria" => $request->naacdata,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	$editid=$request->editid;
	$result  =   DB::table('fdp')->where('id', $editid)->update($dataArray);
	
	
	if($result)
	{
		
	return response()->json(['id' => $result]);
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
    	  public function updateFdp(Request $request)
    {
		$editid=$request->editid;
         
			if($request->papertitle)
		{
		    $papertitle=$request->papertitle;
		}
		else
		{
		    $papertitle='';
		}
			if($request->theme)
		{
		    $theme=$request->theme;
		}
		else
		{
		    $theme='';
		}
				if($request->abstract)
		{
		    $abstract=$request->abstract;
		}
		else
		{
		    $abstract='';
		}
				if($request->awardname)
		{
		    $awardname=$request->awardname;
		}
		else
		{
		    $awardname='';
		}
				if($request->agency)
		{
		    $agency=$request->agency;
		}
		else
		{
		    $agency='';
		}
			if($request->awarddate)
		{
		    $awarddate=$request->awarddate;
		}
		else
		{
		    $awarddate='';
		}
				if($request->promoter)
		{
		    $promoter=$request->promoter;
		}
		else
		{
		    $promoter='';
		}
			if($request->eventdtl)
		{
		    $eventdtl=$request->eventdtl;
		}
		else
		{
		    $eventdtl='';
		}
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
              $id = Auth::user()->profile_id;
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
	"eventtype" => '',
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
	"venue" => $request->venue,
	"description" => $request->description,
	"agenda" => $request->agenda,
	"collaborators" => $request->collabratorsdata,
	"dept" => $coldept,
	"cell" => $request->collabratorscelldata,
	"main_criteria" => $request->naacdata,
	"indulgence_level" => $request->level,
	"paper_title" => $papertitle,
	"paper_theme" => $theme,
	"paper_abstract" =>  $abstract,
	"award_name" => $awardname,
	"awarddate" => $awarddate,
	"agency" => $agency,
	"awrd_promoter" => $promoter,
	"eventdtl" => $eventdtl,
	"type" => 'fapi',
    "vurl" => $request->vurl,
	"surl" => $request->surl,
	 "instagram_url" => $request->insta,
	 "linkedin_url" => $request->linkedin,
	 "facebook_url" => $request->facebook,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	
	$result  =   DB::table('fdp')->where('id', $editid)->update($dataArray);
	
	
	if($result)
	{
		
	return response()->json(['id' => $result]);
	}
	else
	{
		 return response('There is some issue', 200); 
	}
    }
    public function storeMultiFile(Request $request)
    {
        $facultyid = $request->editid;
         
        $validatedData = $request->validate([
            'files.*' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
     
        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension(); // Get the file extension
                    $picture = time() . '-' . date('His') . '-' . $filename; // Append the extension
                    $file->move(public_path('uploads/faculty'), $picture);
                    
                    $postArray = ['picture' => $picture, 'type' => 'faculty', 'fid' => $facultyid];
                    DB::table('picture')->insert($postArray);
                }
            }
     
            return response()->json(['success' => 'Ajax Multiple File has been uploaded']);
        } else {
            return response()->json(["message" => "Please try again."]);
        }
    }
    
	
	   public function deleteEvent(Request $request)
    {

    
      $id= $request->id;

	 DB::delete("DELETE fdp.* FROM fdp  where fdp.id='$id'  ");
	 DB::delete("DELETE picture.* FROM picture  where picture.fid='$id'  ");
	 
	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
               
   

    }
	   public function deleteEventImage(Request $request)
    {

      $id= $request->id;

	 
$result = 	DB::delete("DELETE picture.* FROM picture  where picture.pid='$id'  ");
	 return redirect()->back()->with('status', ' Images have been Deleted Successfully !!');

    }
	
	 public function changePassword()
{
   return view('admin.faculty.change-password');
}
public function updatePassword(Request $request)
{
    $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
       $result = User::find(auth()->User()->id)->update(['password'=> Hash::make($request->new_password)]);
	  if($result==1){
        $faculty_id = Auth::user()->profile_id;
		$dataArray      =  array(
	    "password" => $request->new_confirm_password
	      );
		DB::table('faculity')->where('fid', $faculty_id)->update($dataArray);
	  }
       return back()->with("status", "Password changed successfully!");
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
		$facultyid = $request->editidf;
		
        DB::table('fdp')->where('id',$facultyid)->update($dataArray);
        
        return response()->json('File uploaded successfully');
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
		$facultyid = $request->editidf;
		
        DB::table('fdp')->where('id',$facultyid)->update($dataArray);
        
        return response()->json('File uploaded successfully');
    }
        public function facultyIndividualList(Request $request)
    {  
       
	   $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT * FROM `faculity` where fid='$faculty_id' order by fid desc"); 
	    return view('admin.faculty.facultyList',compact('list'));
    }
     public function editFaculty(Request $request)
    {   
     
		$id=$request->id;
	
		$departments =  DB::select("SELECT department,id from departments ORDER BY id ASC"); 
        $profile_edit= DB::select("SELECT * FROM `faculity` WHERE `fid`='$id'");
        
		return view('admin.faculty.editFaculty',compact('profile_edit','departments'));
		
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
	 //add journal publication
    
     public function addJournalPublication()
    {    
         return view('admin.faculty.addJournalPublication');
    }
      public function addBookChapter()
    {   
         return view('admin.faculty.addBookChapter');
    } 
        public function addPatentFilled()
    {   
         return view('admin.faculty.addPatentFilled');
    }
    
        public function autocompleteSearchResearchPerson(Request $request)
    {
        $type = $request->type;
        $query = $request->search;
        if($type=='1')
        {
			
          $filterResult =  DB::select("SELECT fid as id,name FROM faculity where `name` LIKE '$query%' OR phone_number LIKE '$query%'"); 
        }
        else if($type=='4')
        {
          $filterResult =  DB::select("SELECT id,name FROM students where `roll_no` LIKE '$query%' OR name LIKE '$query%'"); 
        }
        else if($type=='2' || $type=='5')
        {
         $filterResult =  DB::select("SELECT research_fellow.id,research_fellow.name FROM research_fellow join fellow_guide_faculty_master on research_fellow.id=fellow_guide_faculty_master.research_fellow_id where research_fellow.phone_number LIKE '$query%' OR research_fellow.name LIKE '$query%'");
        }
        else
        {
         $filterResult =  DB::select("SELECT research_guide.id,research_guide.supervisor_name as name FROM research_guide join fellow_guide_faculty_master on research_guide.id=fellow_guide_faculty_master.research_guide_id where research_guide.phone_number LIKE '$query%' OR research_guide.supervisor_name LIKE '$query%'");   
        }
     //   DB::select("SELECT id,admission_no,name FROM students where `admission_no` LIKE '$query%' OR name LIKE '$query%' ");
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->name,
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
     
          public function saveJournal(Request $request)
    {
		
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(
	"publisherwhom" => $request->publisherwhom,
	"publisherid" => Auth::user()->profile_id,
    "typepublication" => $request->typepublication,
	"journaltype" => $request->journaltype,
	"author" => $request->Author,
	"title" => $request->title,
	"year" => $request->year,
	"journalname" => $request->journalname,
	"volume" => $request->volume,
	"url" =>$request->url,
	"issn" => $request->issn,
	"impactfactor" => $request->impactfactor,
	"document" => $filename,

   );

    $id  =   DB::table('journal_publication')->insertGetId($dataArray);

	if($id==1){ 
                    	return response()->json(['success'=>'Journal Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
           public function saveBookChapter(Request $request)
    {
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(
	"publisherwhom" => $request->publisherwhom,
	"publisherid" => Auth::user()->profile_id,
    "booktype" => $request->booktype,
	"author" => $request->Author,
	"title" => $request->title,
	"year" => $request->year,
	"papername" => $request->papername,
	"volume" => $request->volume,
	"url" =>$request->url,
	"issn" => $request->issn,
	"document" => $filename,

   );

    $id  =   DB::table('book_publication')->insertGetId($dataArray);

	if($id==1){ 
                    	return response()->json(['success'=>'Book Chapter Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
      public function journalList(Request $request)
    {  
         $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		   	$list = DB::select("select * from(SELECT journal_publication.*,faculity.name,'Faculty' as category FROM `journal_publication` join faculity on faculity.fid=journal_publication.`publisherid` where journal_publication.publisherwhom='1'  UNION 

SELECT journal_publication.*,students.name,'Student' as category FROM `journal_publication` join students on students.id=journal_publication.`publisherid` where journal_publication.publisherwhom='4'  UNION
  
SELECT journal_publication.*,research_fellow.name,'ResearchFellow' as category FROM `journal_publication` join research_fellow on research_fellow.id=journal_publication.`publisherid` where journal_publication.publisherwhom='2'  UNION    
              
SELECT journal_publication.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `journal_publication` join research_guide on research_guide.id=journal_publication.`publisherid` where journal_publication.publisherwhom='3'  UNION  
              
SELECT journal_publication.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `journal_publication` join research_fellow on research_fellow.id=journal_publication.`publisherid` where journal_publication.publisherwhom='5'  UNION 
              
SELECT journal_publication.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `journal_publication` join research_guide on research_guide.id=journal_publication.`publisherid` where journal_publication.publisherwhom='6'           
) xx order by xx.id desc"); 
	   return view('admin.faculty.journalList',compact('list'));
	   }else
	   {
       $faculty_id = Auth::user()->profile_id;
     
$list = DB::select("select * from(SELECT journal_publication.*,faculity.name,'Faculty' as category FROM `journal_publication` left join faculity on faculity.fid=journal_publication.`publisherid` where journal_publication.publisherwhom='1' and publisherid='$faculty_id' UNION 

SELECT journal_publication.*,students.name,'Student' as category FROM `journal_publication` left join students on students.id=journal_publication.`publisherid` where journal_publication.publisherwhom='4' and publisherid='$faculty_id' UNION
  
SELECT journal_publication.*,research_fellow.name,'ResearchFellow' as category FROM `journal_publication` left join research_fellow on research_fellow.id=journal_publication.`publisherid` where journal_publication.publisherwhom='2' and publisherid='$faculty_id' UNION    
              
SELECT journal_publication.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `journal_publication` left join research_guide on research_guide.id=journal_publication.`publisherid` where journal_publication.publisherwhom='3' and publisherid='$faculty_id' UNION  
              
SELECT journal_publication.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `journal_publication` left join research_fellow on research_fellow.id=journal_publication.`publisherid` where journal_publication.publisherwhom='5' and publisherid='$faculty_id' UNION 
              
SELECT journal_publication.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `journal_publication` left join research_guide on research_guide.id=journal_publication.`publisherid` where journal_publication.publisherwhom='6' and publisherid='$faculty_id'           
) xx order by xx.id desc"); 

	    return view('admin.faculty.journalList',compact('list'));
	   }
	   
    }
       public function savePatent(Request $request)
    {  
     if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
        	 $dataArray      =  array(
	"publisherwhom" => $request->publisherwhom,
	"publisherid" => Auth::user()->profile_id,
    "typepublication" => $request->typepublication,
     "author" => $request->Author,
	"title" => $request->title,
	"type" => $request->type,
	"datefilling" => $request->datefilling,
	"dateaward" => $request->dateaward,
	"collaborator" => $request->collaborator,
	"url" =>$request->url,
	"patentno" => $request->patentno,
	"document" => $filename,
	

   );

    $id  =   DB::table('patent')->insertGetId($dataArray);

	if($id==1){ 
                    	return response()->json(['success'=>'Patent Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

	   
    }
     
    	   public function deleteJournal(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE journal_publication.* FROM journal_publication  where journal_publication.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
    
         public function bookList(Request $request)
    {  
	       $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
	   	$list = DB::select("select * from(SELECT book_publication.*,faculity.name,'Faculty' as category FROM `book_publication` join faculity on faculity.fid=book_publication.`publisherid` where book_publication.publisherwhom='1'  UNION 

SELECT book_publication.*,students.name,'Student' as category FROM `book_publication` join students on students.id=book_publication.`publisherid` where book_publication.publisherwhom='4'  UNION
  
SELECT book_publication.*,research_fellow.name,'ResearchFellow' as category FROM `book_publication` join research_fellow on research_fellow.id=book_publication.`publisherid` where book_publication.publisherwhom='2'  UNION    
              
SELECT book_publication.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `book_publication` join research_guide on research_guide.id=book_publication.`publisherid` where book_publication.publisherwhom='3'  UNION  
              
SELECT book_publication.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `book_publication` join research_fellow on research_fellow.id=book_publication.`publisherid` where book_publication.publisherwhom='5'  UNION 
              
SELECT book_publication.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `book_publication` join research_guide on research_guide.id=book_publication.`publisherid` where book_publication.publisherwhom='6'           
) xx order by xx.id desc"); 
	    return view('admin.faculty.bookList',compact('list'));
        }
        else
	   {
       $faculty_id = Auth::user()->profile_id;
$list = DB::select("select * from(SELECT book_publication.*,faculity.name,'Faculty' as category FROM `book_publication` left join faculity on faculity.fid=book_publication.`publisherid` where book_publication.publisherwhom='1' and publisherid='$faculty_id'  UNION 

SELECT book_publication.*,students.name,'Student' as category FROM `book_publication` left join students on students.id=book_publication.`publisherid` where book_publication.publisherwhom='4' and publisherid='$faculty_id' UNION
  
SELECT book_publication.*,research_fellow.name,'ResearchFellow' as category FROM `book_publication` left join research_fellow on research_fellow.id=book_publication.`publisherid` where book_publication.publisherwhom='2' and publisherid='$faculty_id' UNION    
              
SELECT book_publication.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `book_publication` left join research_guide on research_guide.id=book_publication.`publisherid` where book_publication.publisherwhom='3' and publisherid='$faculty_id' UNION  
              
SELECT book_publication.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `book_publication` left join research_fellow on research_fellow.id=book_publication.`publisherid` where book_publication.publisherwhom='5' and publisherid='$faculty_id' UNION 
              
SELECT book_publication.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `book_publication` left join research_guide on research_guide.id=book_publication.`publisherid` where book_publication.publisherwhom='6' and publisherid='$faculty_id'          
) xx order by xx.id desc"); 

	    return view('admin.faculty.bookList',compact('list'));
	   }
    } 
    
       	   public function deleteBook(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE book_publication.* FROM book_publication  where book_publication.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
    
            public function patentList(Request $request)
    {  
        $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	   	$list = DB::select("select * from(SELECT patent.*,faculity.name,'Faculty' as category FROM `patent` join faculity on faculity.fid=patent.`publisherid` where patent.publisherwhom='1'  UNION 

SELECT patent.*,students.name,'Student' as category FROM `patent` join students on students.id=patent.`publisherid` where patent.publisherwhom='4'  UNION
  
SELECT patent.*,research_fellow.name,'ResearchFellow' as category FROM `patent` join research_fellow on research_fellow.id=patent.`publisherid` where patent.publisherwhom='2'  UNION    
              
SELECT patent.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `patent` join research_guide on research_guide.id=patent.`publisherid` where patent.publisherwhom='3'  UNION  
              
SELECT patent.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `patent` join research_fellow on research_fellow.id=patent.`publisherid` where patent.publisherwhom='5'  UNION 
              
SELECT patent.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `patent` join research_guide on research_guide.id=patent.`publisherid` where patent.publisherwhom='6'           
) xx order by xx.id desc"); 
	    return view('admin.faculty.patentList',compact('list'));
        }else
        {
             $faculty_id = Auth::user()->profile_id;
             $list = DB::select("select * from(SELECT patent.*,faculity.name,'Faculty' as category FROM `patent` left join faculity on faculity.fid=patent.`publisherid` where patent.publisherwhom='1' and patent.publisherid='$faculty_id'  UNION 

SELECT patent.*,students.name,'Student' as category FROM `patent` left join students on students.id=patent.`publisherid` where patent.publisherwhom='4' and patent.publisherid='$faculty_id' UNION
  
SELECT patent.*,research_fellow.name,'ResearchFellow' as category FROM `patent` left join research_fellow on research_fellow.id=patent.`publisherid` where patent.publisherwhom='2' and patent.publisherid='$faculty_id' UNION    
              
SELECT patent.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `patent` left join research_guide on research_guide.id=patent.`publisherid` where patent.publisherwhom='3' and patent.publisherid='$faculty_id' UNION  
              
SELECT patent.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `patent` left join research_fellow on research_fellow.id=patent.`publisherid` where patent.publisherwhom='5' and patent.publisherid='$faculty_id' UNION 
              
SELECT patent.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `patent` left join research_guide on research_guide.id=patent.`publisherid` where patent.publisherwhom='6' and patent.publisherid='$faculty_id'         
) xx order by xx.id desc"); 

       return view('admin.faculty.patentList',compact('list'));
        }
	   
    } 
	                public function editJournal(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `journal_publication` WHERE `id`='$id'");
    
		return view('admin.faculty.editJournal',compact('profile_edit'));
		
    }
	
	      public function editInfoJournal(Request $request)
    {
		$editid=$request->editid;
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(

    "typepublication" => $request->typepublication,
	"journaltype" => $request->journaltype,
	"author" => $request->Author,
	"title" => $request->title,
	"year" => $request->year,
	"journalname" => $request->journalname,
	"volume" => $request->volume,
	"pages" => $request->pages,
	"url" =>$request->url,
	"issn" => $request->issn,
	"impactfactor" => $request->impactfactor,
	"document" => $filename,

   );

    $id  =    DB::table('journal_publication')->where('id', $editid)->update($dataArray) ;

	if($id==1){ 
                    	return response()->json(['success'=>'Journal Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	
	        public function exportJournalfac(Request $request)
{
  
   $fileName = 'Journal.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT `typepublication`,`journaltype`,`author`,`title`,`year`,`journalname`,`volume`,`url`,`pages`,`issn`,`impactfactor` FROM `journal_publication` WHERE `publisherwhom`='1' and publisherid='$facultyid'");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Publication Type','Journal Type','Author','Title','Year','Journal Name','Volume','Url','Pages','IssN','Impact Factor');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Publication Type']  = $task->typepublication;
                $row['Journal Type']  = $task->journaltype; 
                $row['Author']  = $task->author;
                 $row['Title']  = $task->title;
                 $row['Year']  = $task->year;
                  $row['Journal Name']  = $task->journalname;
                $row['Volume']  = $task->volume;
                  $row['Url']  = $task->url;
                 $row['Pages']  = $task->pages;
                 $row['IssN']  = $task->issn;
                 $row['Impact Factor']  = $task->impactfactor;
              
               
                fputcsv($file, array($row['Publication Type'],$row['Journal Type'],$row['Author'], $row['Title'],$row['Year'],$row['Journal Name'],$row['Volume'],$row['Url'],$row['Pages'],$row['IssN'],$row['Impact Factor']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	                 public function editBook(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `book_publication` WHERE `id`='$id'");
    
		return view('admin.faculty.editBook',compact('profile_edit'));
		
    }
	
	         public function editInfoBook(Request $request)
    {
		$editid=$request->editid;
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
  
		 $dataArray      =  array(
    "booktype" => $request->booktype,
	"author" => $request->Author,
	"title" => $request->title,
	"year" => $request->year,
	"papername" => $request->papername,
	"volume" => $request->volume,
	"pages" =>$request->pages,
	"url" =>$request->url,
	"issn" => $request->issn,
	"document" => $filename,

   );


    $id  =    DB::table('book_publication')->where('id', $editid)->update($dataArray) ;

	if($id==1){ 
                    	return response()->json(['success'=>'Book Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
	
	                   public function exportBookfac(Request $request)
{
  
   $fileName = 'Journal.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT * FROM `book_publication` WHERE `publisherwhom`='1' and publisherid='$facultyid'");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Book Type','Author','Title','Year','Paper Name','Volume','Url','Pages','IssN');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
               
                $row['Book Type']  = $task->booktype; 
                $row['Author']  = $task->author;
                 $row['Title']  = $task->title;
                 $row['Year']  = $task->year;
                  $row['Paper Name']  = $task->papername;
                $row['Volume']  = $task->volume;
                  $row['Url']  = $task->url;
                 $row['Pages']  = $task->pages;
                 $row['IssN']  = $task->issn;
                
              
               
                fputcsv($file, array($row['Book Type'],$row['Author'], $row['Title'],$row['Year'],$row['Paper Name'],$row['Volume'],$row['Url'],$row['Pages'],$row['IssN']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	                public function editPatent(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `patent` WHERE `id`='$id'");
    
		return view('admin.faculty.editPatent',compact('profile_edit'));
		
    }
	
	      public function editInfoPatent(Request $request)
    {  
    	$editid=$request->editid;
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
        	 $dataArray      =  array(
	
    "typepublication" => $request->typepublication,
     "author" => $request->Author,
	"title" => $request->title,
	"type" => $request->type,
	"datefilling" => $request->datefilling,
	"dateaward" => $request->dateaward,
	"collaborator" => $request->collaborator,
	"url" =>$request->url,
	"patentno" => $request->patentno,
	"document" => $filename,
	

   );

    $id  =   DB::table('patent')->where('id', $editid)->update($dataArray) ; 

	if($id==1){ 
                    return response()->json(['success'=>'Patent Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

	   
    }

	public function exportPatentfac(Request $request)
{
  
   $fileName = 'Patent.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT * FROM `patent` WHERE `publisherwhom`='1' and publisherid='$facultyid'");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Publication Type','Author','Title','Type','Date Filling','Date Award','Collaborator','Url','Patent No');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
                $row['Publication Type']  = $task->typepublication;
              
                $row['Author']  = $task->author;
                 $row['Title']  = $task->title;
                 $row['Type']  = $task->type;
                  $row['Date Filling']  = $task->datefilling;
                $row['Date Award']  = $task->dateaward;
                 $row['Collaborator']  = $task->collaborator;
                  $row['Url']  = $task->url;
                 $row['Patent No']  = $task->patentno;
                
               
                fputcsv($file, array($row['Publication Type'],$row['Author'], $row['Title'],$row['Type'],$row['Date Filling'],$row['Date Award'],$row['Collaborator'],$row['Url'],$row['Patent No']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	

	public function downloadFacultyInfo(Request $request)
{
  
   $fileName = 'Facultydetails.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT * FROM `faculity`");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name','Phone Number','Email Id','Address','Guardian','Department','Designation','Position','Date Of Birth','Date Of Join','Highest Education','Gender');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
                $row['Name']  = $task->name;
              
                $row['Phone Number']  = $task->phone_number;
                 $row['Email Id']  = $task->email_id;
                 $row['Address']  = $task->address;
                  $row['Guardian']  = $task->guardian;
                $row['Department']  = $task->department;
                 $row['Designation']  = $task->designation;
                  $row['Position']  = $task->position;
                 $row['Date Of Birth']  = $task->dob;
                  $row['Date Of Join']  = $task->date_of_join;
                 $row['Highest Education']  = $task->highest_edu;
				   $row['Gender']  = $task->gender;
				   
                fputcsv($file, array($row['Name'],$row['Phone Number'], $row['Email Id'],$row['Address'],$row['Guardian'],$row['Department'],$row['Designation'],$row['Position'],$row['Date Of Birth'],$row['Date Of Join'],$row['Highest Education'],$row['Gender']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	    	 public function editImagePublication($id='',$type)
    {   
         $idd=$id;
	     $typecast='$type';
	     if($type=='P')
	     {
        $list= DB::select("SELECT * FROM `patent` where patent.id='$id'");
	     }
	      if($type=='J')
	     {
        $list= DB::select("SELECT * FROM `journal_publication` where journal_publication.id='$id'");
	     }
	     if($type=='B')
	     {
        $list= DB::select("SELECT * FROM `book_publication` where book_publication.id='$id'");
	     }
		return view('admin.faculty.publicationImageList',compact('list','idd','typecast'));
    }
	
	  
 public function exportJournaladmin(Request $request)
{
  
   $fileName = 'Journal.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("select * from(SELECT journal_publication.*,faculity.name,'Faculty' as category FROM `journal_publication` join faculity on faculity.fid=journal_publication.`publisherid` where journal_publication.publisherwhom='1'  UNION 

SELECT journal_publication.*,students.name,'Student' as category FROM `journal_publication` join students on students.id=journal_publication.`publisherid` where journal_publication.publisherwhom='4'  UNION
  
SELECT journal_publication.*,research_fellow.name,'ResearchFellow' as category FROM `journal_publication` join research_fellow on research_fellow.id=journal_publication.`publisherid` where journal_publication.publisherwhom='2'  UNION    
              
SELECT journal_publication.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `journal_publication` join research_guide on research_guide.id=journal_publication.`publisherid` where journal_publication.publisherwhom='3'  UNION  
              
SELECT journal_publication.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `journal_publication` join research_fellow on research_fellow.id=journal_publication.`publisherid` where journal_publication.publisherwhom='5'  UNION 
              
SELECT journal_publication.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `journal_publication` join research_guide on research_guide.id=journal_publication.`publisherid` where journal_publication.publisherwhom='6'           
) xx order by xx.id desc");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name','Category','Publication Type','Journal Type','Author','Title','Year','Journal Name','Volume','Url','Pages','IssN','Impact Factor');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                 $row['Name']  = $task->name;
                 $row['Category']  = $task->category;
                $row['Publication Type']  = $task->typepublication;
                $row['Journal Type']  = $task->journaltype; 
                $row['Author']  = $task->author;
                 $row['Title']  = $task->title;
                 $row['Year']  = $task->year;
                  $row['Journal Name']  = $task->journalname;
                $row['Volume']  = $task->volume;
                  $row['Url']  = $task->url;
                 $row['Pages']  = $task->pages;
                 $row['IssN']  = $task->issn;
                 $row['Impact Factor']  = $task->impactfactor;
              
               
                fputcsv($file, array($row['Name'],$row['Category'],$row['Publication Type'],$row['Journal Type'],$row['Author'], $row['Title'],$row['Year'],$row['Journal Name'],$row['Volume'],$row['Url'],$row['Pages'],$row['IssN'],$row['Impact Factor']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	public function exportBookadmin(Request $request)
{
  
   $fileName = 'Journal.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("select * from(SELECT book_publication.*,faculity.name,'Faculty' as category FROM `book_publication` join faculity on faculity.fid=book_publication.`publisherid` where book_publication.publisherwhom='1'  UNION 

SELECT book_publication.*,students.name,'Student' as category FROM `book_publication` join students on students.id=book_publication.`publisherid` where book_publication.publisherwhom='4'  UNION
  
SELECT book_publication.*,research_fellow.name,'ResearchFellow' as category FROM `book_publication` join research_fellow on research_fellow.id=book_publication.`publisherid` where book_publication.publisherwhom='2'  UNION    
              
SELECT book_publication.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `book_publication` join research_guide on research_guide.id=book_publication.`publisherid` where book_publication.publisherwhom='3'  UNION  
              
SELECT book_publication.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `book_publication` join research_fellow on research_fellow.id=book_publication.`publisherid` where book_publication.publisherwhom='5'  UNION 
              
SELECT book_publication.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `book_publication` join research_guide on research_guide.id=book_publication.`publisherid` where book_publication.publisherwhom='6'           
) xx order by xx.id desc");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name','Category','Book Type','Author','Title','Year','Paper Name','Volume','Url','Pages','IssN');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
               $row['Name']  = $task->name;
                 $row['Category']  = $task->category;
                $row['Book Type']  = $task->booktype; 
                $row['Author']  = $task->author;
                 $row['Title']  = $task->title;
                 $row['Year']  = $task->year;
                  $row['Paper Name']  = $task->papername;
                $row['Volume']  = $task->volume;
                  $row['Url']  = $task->url;
                 $row['Pages']  = $task->pages;
                 $row['IssN']  = $task->issn;
                
              
               
                fputcsv($file, array($row['Name'],$row['Category'],$row['Book Type'],$row['Author'], $row['Title'],$row['Year'],$row['Paper Name'],$row['Volume'],$row['Url'],$row['Pages'],$row['IssN']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
    
	public function exportPatentadmin(Request $request)
{
  
   $fileName = 'Patent.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("select * from(SELECT patent.*,faculity.name,'Faculty' as category FROM `patent` join faculity on faculity.fid=patent.`publisherid` where patent.publisherwhom='1'  UNION 

SELECT patent.*,students.name,'Student' as category FROM `patent` join students on students.id=patent.`publisherid` where patent.publisherwhom='4'  UNION
  
SELECT patent.*,research_fellow.name,'ResearchFellow' as category FROM `patent` join research_fellow on research_fellow.id=patent.`publisherid` where patent.publisherwhom='2'  UNION    
              
SELECT patent.*,research_guide.supervisor_name as name,'ResearchGuide' as category FROM `patent` join research_guide on research_guide.id=patent.`publisherid` where patent.publisherwhom='3'  UNION  
              
SELECT patent.*,research_fellow.name,'ResearchFellowFaculty' as category FROM `patent` join research_fellow on research_fellow.id=patent.`publisherid` where patent.publisherwhom='5'  UNION 
              
SELECT patent.*,research_guide.supervisor_name as name,'ResearchGuideFaculty' as category FROM `patent` join research_guide on research_guide.id=patent.`publisherid` where patent.publisherwhom='6'           
) xx order by xx.id desc");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name','Category','Publication Type','Author','Title','Type','Date Filling','Date Award','Collaborator','Url','Patent No');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                 $row['Name']  = $task->name;
                 $row['Category']  = $task->category;
                $row['Publication Type']  = $task->typepublication;
              
                $row['Author']  = $task->author;
                 $row['Title']  = $task->title;
                 $row['Type']  = $task->type;
                  $row['Date Filling']  = $task->datefilling;
                $row['Date Award']  = $task->dateaward;
                 $row['Collaborator']  = $task->collaborator;
                  $row['Url']  = $task->url;
                 $row['Patent No']  = $task->patentno;
                
               
                fputcsv($file, array($row['Name'],$row['Category'],$row['Publication Type'],$row['Author'], $row['Title'],$row['Type'],$row['Date Filling'],$row['Date Award'],$row['Collaborator'],$row['Url'],$row['Patent No']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
        	   public function deletePatent(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE patent.* FROM patent  where patent.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
      //faculty Duties
    
     public function addQuestionPaperSetting(Request $request)
    {

		 return view('admin.faculty.addQuestionPaperSetting');
    }
        
     public function storeQuestionpaper(Request $request)
    {
	
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"name_of_paper" => $request->paper, 
	"name_of_pgm" => $request->program,  
	"year" => $request->year,  
	"semester" => $request->semester,  
	"classification" => $request->type,  
	"name_of_colluniversity" => $request->collegeuniver,
	"type" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('question_paper_setting')->insertGetId($dataArray);
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
            public function QuestionPaperSettingList(Request $request)
    {  
         $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT question_paper_setting.*,faculity.name as facultyname,faculity.department as dept FROM `question_paper_setting` 
LEFT join faculity on faculity.fid=question_paper_setting.`faculty_id`
 group by question_paper_setting.id "); 
	   return view('admin.faculty.questionPaperSettingList',compact('list'));
	   }else
	   {
        $faculty_id = Auth::user()->profile_id;
	  $list = DB::select("SELECT question_paper_setting.*,faculity.name as facultyname,faculity.department as dept FROM `question_paper_setting` 
LEFT join faculity on faculity.fid=question_paper_setting.`faculty_id` where faculity.fid='$faculty_id'
 group by question_paper_setting.id "); 
	    return view('admin.faculty.questionPaperSettingList',compact('list'));
	   
    } 
    }
        	   public function deleteQuestion(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE question_paper_setting.* FROM question_paper_setting  where question_paper_setting.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
            public function exportCsvDownloadQuestionfac(Request $request)
{
  
   $fileName = 'QuestionPaperExcel.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT question_paper_setting.`id`,question_paper_setting.`faculty_id`,faculity.name as facultyname,faculity.department as dept,question_paper_setting.name_of_paper,question_paper_setting.name_of_pgm,question_paper_setting.year,question_paper_setting.semester,question_paper_setting.classification,question_paper_setting.name_of_colluniversity,question_paper_setting.type,question_paper_setting.from_date,question_paper_setting.to_date,question_paper_setting.designation,question_paper_setting.recognition_category FROM `question_paper_setting` 
LEFT join faculity on faculity.fid=question_paper_setting.`faculty_id` where faculity.department='$departmentname'
 group by question_paper_setting.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
    
                public function exportCsvDownloadQuestionadmin(Request $request)
{
  
   $fileName = 'QuestionPaperExcel.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT question_paper_setting.`id`,question_paper_setting.`faculty_id`,faculity.name as facultyname,faculity.department as dept,question_paper_setting.name_of_paper,question_paper_setting.name_of_pgm,question_paper_setting.year,question_paper_setting.semester,question_paper_setting.classification,question_paper_setting.name_of_colluniversity,question_paper_setting.type,question_paper_setting.from_date,question_paper_setting.to_date,question_paper_setting.designation,question_paper_setting.recognition_category FROM `question_paper_setting` 
LEFT join faculity on faculity.fid=question_paper_setting.`faculty_id` 
 group by question_paper_setting.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
    
       public function addCuriculamDevelopment(Request $request)
    {

		 return view('admin.faculty.addCuriculamDevelopment');
    }
         
     public function storeCuriculamDevelopment(Request $request)
    {
	
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"name_of_pgm" => $request->program,  
	"year" => $request->year,  
	"semester" => $request->semester,  
	"classification" => $request->type,  
	"name_of_colluniversity" => $request->collegeuniver,
	"type" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('curiculam_development')->insertGetId($dataArray);
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
                public function CuriculamDevelopmentList(Request $request)
    {  
         $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT curiculam_development.*,faculity.name as facultyname,faculity.department as dept FROM `curiculam_development` 
LEFT join faculity on faculity.fid=	curiculam_development.`faculty_id`
 group by curiculam_development.id  "); 
	   return view('admin.faculty.curiculamDevelopmentList',compact('list'));
	   }else
	   {
        $faculty_id = Auth::user()->profile_id;
	  $list = DB::select("SELECT curiculam_development.*,faculity.name as facultyname,faculity.department as dept FROM `curiculam_development` 
LEFT join faculity on faculity.fid=	curiculam_development.`faculty_id` where faculity.fid='$faculty_id'
 group by curiculam_development.id "); 
	    return view('admin.faculty.curiculamDevelopmentList',compact('list'));
	   }
    } 
         	   public function deleteCuriculamDevelopment(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE curiculam_development.* FROM curiculam_development  where curiculam_development.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
                public function exportCuriculamDevelopment(Request $request)
{
  
   $fileName = 'Curiculam.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT 	curiculam_development.`id`,	curiculam_development.`faculty_id`,faculity.name as facultyname,faculity.department as dept,curiculam_development.name_of_pgm,curiculam_development.year,curiculam_development.semester,curiculam_development.classification,curiculam_development.name_of_colluniversity,curiculam_development.type,curiculam_development.from_date,curiculam_development.to_date,	curiculam_development.designation,curiculam_development.recognition_category FROM `curiculam_development` 
LEFT join faculity on faculity.fid=	curiculam_development.`faculty_id` where faculity.department='$departmentname'
 group by curiculam_development.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
               
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                    public function exportCuriculamDevelopmentadmin(Request $request)
{
  
   $fileName = 'Curiculam.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT 	curiculam_development.`id`,	curiculam_development.`faculty_id`,faculity.name as facultyname,faculity.department as dept,curiculam_development.name_of_pgm,curiculam_development.year,curiculam_development.semester,curiculam_development.classification,curiculam_development.name_of_colluniversity,curiculam_development.type,curiculam_development.from_date,curiculam_development.to_date,	curiculam_development.designation,curiculam_development.recognition_category FROM `curiculam_development` 
LEFT join faculity on faculity.fid=	curiculam_development.`faculty_id` 
 group by curiculam_development.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
               
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
      public function addExamValuation(Request $request)
    {

		 return view('admin.faculty.addExamValuation');
    }
    
     public function storeExamValuation(Request $request)
    {
	
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"choosetype"=> $request->choosetype,
	"name_of_paper" => $request->paper, 
	"name_of_pgm" => $request->program,  
	"year" => $request->year,  
	"semester" => $request->semester,  
	"classification" => $request->type,  
	"name_of_colluniversity" => $request->collegeuniver,
	"type" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('valuation_duty')->insertGetId($dataArray);
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
            public function valuationList(Request $request)
    {  
          $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT valuation_duty.*,faculity.name as facultyname,faculity.department as dept FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` 
 group by valuation_duty.id"); 
	   return view('admin.faculty.valuationDutyList',compact('list'));
	   }else
	   {
        $faculty_id = Auth::user()->profile_id;
	  $list = DB::select("SELECT valuation_duty.*,faculity.name as facultyname,faculity.department as dept FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where faculity.fid='$faculty_id'
 group by valuation_duty.id "); 
	    return view('admin.faculty.valuationDutyList',compact('list'));
    }
	   
    } 
        	   public function deleteValuation(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE valuation_duty.* FROM valuation_duty  where valuation_duty.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
            public function exportValuationfac(Request $request)
{
  
   $fileName = 'Valuation.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT valuation_duty.`id`,valuation_duty.`faculty_id`,faculity.name as facultyname,faculity.department as dept,valuation_duty.name_of_paper,valuation_duty.name_of_pgm,valuation_duty.year,valuation_duty.semester,valuation_duty.classification,valuation_duty.name_of_colluniversity,valuation_duty.type,valuation_duty.from_date,valuation_duty.to_date,valuation_duty.designation,valuation_duty.recognition_category FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where faculity.department='$departmentname' and valuation_duty.choosetype='Evaluationduty'
 group by valuation_duty.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                public function exportValuationadmin(Request $request)
{
  
   $fileName = 'Valuation.csv';
  $facultyid =  Auth::user()->profile_id;
  
   $tasks = DB::select("SELECT valuation_duty.`id`,valuation_duty.`faculty_id`,faculity.name as facultyname,faculity.department as dept,valuation_duty.name_of_paper,valuation_duty.name_of_pgm,valuation_duty.year,valuation_duty.semester,valuation_duty.classification,valuation_duty.name_of_colluniversity,valuation_duty.type,valuation_duty.from_date,valuation_duty.to_date,valuation_duty.designation,valuation_duty.recognition_category FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where valuation_duty.choosetype='Evaluationduty'
 group by valuation_duty.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                public function exportInternalValuationfac(Request $request)
{
  
   $fileName = 'Valuation.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT valuation_duty.`id`,valuation_duty.`faculty_id`,faculity.name as facultyname,faculity.department as dept,valuation_duty.name_of_paper,valuation_duty.name_of_pgm,valuation_duty.year,valuation_duty.semester,valuation_duty.classification,valuation_duty.name_of_colluniversity,valuation_duty.type,valuation_duty.from_date,valuation_duty.to_date,valuation_duty.designation,valuation_duty.recognition_category FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where faculity.department='$departmentname' and valuation_duty.choosetype='Internalexamduty'
 group by valuation_duty.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                    public function exportInternalValuationadmin(Request $request)
{
  
   $fileName = 'Valuation.csv';
  $facultyid =  Auth::user()->profile_id;

   $tasks = DB::select("SELECT valuation_duty.`id`,valuation_duty.`faculty_id`,faculity.name as facultyname,faculity.department as dept,valuation_duty.name_of_paper,valuation_duty.name_of_pgm,valuation_duty.year,valuation_duty.semester,valuation_duty.classification,valuation_duty.name_of_colluniversity,valuation_duty.type,valuation_duty.from_date,valuation_duty.to_date,valuation_duty.designation,valuation_duty.recognition_category FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where valuation_duty.choosetype='Internalexamduty'
 group by valuation_duty.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                public function exportExternalValuationfac(Request $request)
{
  
   $fileName = 'Valuation.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT valuation_duty.`id`,valuation_duty.`faculty_id`,faculity.name as facultyname,faculity.department as dept,valuation_duty.name_of_paper,valuation_duty.name_of_pgm,valuation_duty.year,valuation_duty.semester,valuation_duty.classification,valuation_duty.name_of_colluniversity,valuation_duty.type,valuation_duty.from_date,valuation_duty.to_date,valuation_duty.designation,valuation_duty.recognition_category FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where faculity.department='$departmentname' and valuation_duty.choosetype='Externalexamduty'
 group by valuation_duty.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
    
                    public function exportExternalValuationadmin(Request $request)
{
  
   $fileName = 'Valuation.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT valuation_duty.`id`,valuation_duty.`faculty_id`,faculity.name as facultyname,faculity.department as dept,valuation_duty.name_of_paper,valuation_duty.name_of_pgm,valuation_duty.year,valuation_duty.semester,valuation_duty.classification,valuation_duty.name_of_colluniversity,valuation_duty.type,valuation_duty.from_date,valuation_duty.to_date,valuation_duty.designation,valuation_duty.recognition_category FROM `valuation_duty` 
LEFT join faculity on faculity.fid=valuation_duty.`faculty_id` where valuation_duty.choosetype='Externalexamduty'
 group by valuation_duty.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Name Of Paper','Name Of Program','Year','Semester','Classification','Name Of College/University','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
                $row['Name Of Paper']  = $task->name_of_paper;
                 $row['Name Of Program']  = $task->name_of_pgm;
                 $row['Year']  = $task->year;
                  $row['Semester']  = $task->semester;
                $row['Classification']  = $task->classification;
                  $row['Name Of College/University']  = $task->name_of_colluniversity;
                 $row['Type']  = $task->type;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Name Of Paper'], $row['Name Of Program'],$row['Year'],$row['Semester'],$row['Classification'],$row['Name Of College/University'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
    
         public function addTeachingMethodology(Request $request)
    {
       $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
		 return view('admin.faculty.addTeachingMethodology',compact('course'));
    }
     
     public function storeTeachingMethodology(Request $request)
    {
	
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"method"=> $request->choosetype,
	"program" => $request->program,  
	"batch" => $request->batch,  
	"semester" => $request->semester,  
	"category" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('teaching_method')->insertGetId($dataArray);
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
              public function methodologyList(Request $request)
    {  
             $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT teaching_method.*,faculity.name as facultyname,faculity.department as dept FROM `teaching_method` 
LEFT join faculity on faculity.fid=teaching_method.`faculty_id`
 group by teaching_method.id"); 
	   return view('admin.faculty.teachingMethodList',compact('list'));
	   }else
	   {
        $faculty_id = Auth::user()->profile_id;
	  $list = DB::select("SELECT teaching_method.*,faculity.name as facultyname,faculity.department as dept FROM `teaching_method` 
LEFT join faculity on faculity.fid=teaching_method.`faculty_id` where faculity.fid='$faculty_id'
 group by teaching_method.id "); 
	    return view('admin.faculty.teachingMethodList',compact('list'));
	   }
    } 
         	   public function deleteMethodology(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE teaching_method.* FROM teaching_method  where teaching_method.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
    
                public function exportMethodologyfac(Request $request)
{
  
   $fileName = 'TeachingMethodology.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT teaching_method.`id`,teaching_method.`faculty_id`,faculity.name as facultyname,faculity.department as dept,teaching_method.method,teaching_method.program,teaching_method.batch,teaching_method.semester,teaching_method.category,teaching_method.from_date,teaching_method.to_date,teaching_method.designation,teaching_method.recognition_category FROM `teaching_method` 
LEFT join faculity on faculity.fid=teaching_method.`faculty_id` where faculity.department='$departmentname' 
 group by teaching_method.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Teaching Methodology','Name Of Program','Batch','Semester','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
              $row['Teaching Methodology']  = $task->method;
                 $row['Name Of Program']  = $task->program;
                 $row['Batch']  = $task->batch;
                  $row['Semester']  = $task->semester;
                
                 $row['Type']  = $task->category;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Teaching Methodology'],$row['Name Of Program'],$row['Batch'],$row['Semester'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                    public function exportMethodologyadmin(Request $request)
{
  
   $fileName = 'TeachingMethodology.csv';
 
   $tasks = DB::select("SELECT teaching_method.`id`,teaching_method.`faculty_id`,faculity.name as facultyname,faculity.department as dept,teaching_method.method,teaching_method.program,teaching_method.batch,teaching_method.semester,teaching_method.category,teaching_method.from_date,teaching_method.to_date,teaching_method.designation,teaching_method.recognition_category FROM `teaching_method` 
LEFT join faculity on faculity.fid=teaching_method.`faculty_id`  
 group by teaching_method.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Teaching Methodology','Name Of Program','Batch','Semester','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
              $row['Teaching Methodology']  = $task->method;
                 $row['Name Of Program']  = $task->program;
                 $row['Batch']  = $task->batch;
                  $row['Semester']  = $task->semester;
                
                 $row['Type']  = $task->category;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Teaching Methodology'],$row['Name Of Program'],$row['Batch'],$row['Semester'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
             public function addIct(Request $request)
    {
       $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
		 return view('admin.faculty.addIct',compact('course'));
    }
     
     public function storeIct(Request $request)
    {
	
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"title"=> $request->choosetype,
	"program" => $request->program,  
	"batch" => $request->batch,  
	"semester" => $request->semester,  
	"category" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('ict')->insertGetId($dataArray);
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
              public function IctList(Request $request)
    {  
         $type = Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
	        $faculty_id = Auth::user()->profile_id;
		$list = DB::select("SELECT ict.*,faculity.name as facultyname,faculity.department as dept FROM `ict` 
LEFT join faculity on faculity.fid=ict.`faculty_id` 
 group by ict.id "); 
	   return view('admin.faculty.ictList',compact('list'));
	   }else
	   {
        $faculty_id = Auth::user()->profile_id;
	  $list = DB::select("SELECT ict.*,faculity.name as facultyname,faculity.department as dept FROM `ict` 
LEFT join faculity on faculity.fid=ict.`faculty_id` where faculity.fid='$faculty_id'
 group by ict.id "); 
	    return view('admin.faculty.ictList',compact('list'));
	   }
	   
    } 
         	   public function deleteIct(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE ict.* FROM ict  where ict.id='$id'  ");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
    
                public function exportIctfac(Request $request)
{
  
   $fileName = 'Ict.csv';
  $facultyid =  Auth::user()->profile_id;
  $depart = DB::select("SELECT departments.id,departments.department FROM `faculity` join departments on departments.department=faculity.department where fid='$facultyid'"); 
	      $departmentname=$depart[0]->department;
   $tasks = DB::select("SELECT ict.`id`,ict.`faculty_id`,faculity.name as facultyname,faculity.department as dept,ict.title,ict.program,ict.batch,ict.semester,ict.category,ict.from_date,ict.to_date,ict.designation,ict.recognition_category FROM `ict` 
LEFT join faculity on faculity.fid=ict.`faculty_id` where faculity.department='$departmentname' 
 group by ict.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Title','Name Of Program','Batch','Semester','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
              $row['Title']  = $task->title;
                 $row['Name Of Program']  = $task->program;
                 $row['Batch']  = $task->batch;
                  $row['Semester']  = $task->semester;
                
                 $row['Type']  = $task->category;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Title'],$row['Name Of Program'],$row['Batch'],$row['Semester'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
                    public function exportIctadmin(Request $request)
{
  
   $fileName = 'Ict.csv';
  $facultyid =  Auth::user()->profile_id;
  
   $tasks = DB::select("SELECT ict.`id`,ict.`faculty_id`,faculity.name as facultyname,faculity.department as dept,ict.title,ict.program,ict.batch,ict.semester,ict.category,ict.from_date,ict.to_date,ict.designation,ict.recognition_category FROM `ict` 
LEFT join faculity on faculity.fid=ict.`faculty_id` group by ict.id");

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Faculty Name','Department','Title','Name Of Program','Batch','Semester','Type','From Date','To Date','Designation','Recognition Category');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Faculty Name']  = $task->facultyname;
               
                $row['Department']  = $task->dept; 
              $row['Title']  = $task->title;
                 $row['Name Of Program']  = $task->program;
                 $row['Batch']  = $task->batch;
                  $row['Semester']  = $task->semester;
                
                 $row['Type']  = $task->category;
                 $row['From Date']  = $task->from_date;
                 $row['To Date']  = $task->to_date;
                $row['Designation']  = $task->designation;
                 $row['Recognition Category']  = $task->recognition_category;
               
               
                fputcsv($file, array($row['Faculty Name'],$row['Department'],$row['Title'],$row['Name Of Program'],$row['Batch'],$row['Semester'],$row['Type'],$row['From Date'],$row['To Date'],$row['Designation'],$row['Recognition Category']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
           public function editQuestionPaperSetting(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `question_paper_setting` WHERE `id`='$id'");
    
		return view('admin.faculty.editQuestionPaperSetting',compact('profile_edit'));
		
    }
     public function editInfoQuestionpaper(Request $request)
    {
	$editid = $request->editid;
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename= $request->current_file;
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"name_of_paper" => $request->paper, 
	"name_of_pgm" => $request->program,  
	"year" => $request->year,  
	"semester" => $request->semester,  
	"classification" => $request->type,  
	"name_of_colluniversity" => $request->collegeuniver,
	"type" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =  DB::table('question_paper_setting')->where('id', $editid)->update($dataArray) ;
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
              public function editCuriculamDevelopment(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `curiculam_development` WHERE `id`='$id'");
    
		return view('admin.faculty.editCuriculamDevelopment',compact('profile_edit'));
		
    }
      public function editInfoCuriculamDevelopment(Request $request)
    {
		$editid = $request->editid;
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"name_of_pgm" => $request->program,  
	"year" => $request->year,  
	"semester" => $request->semester,  
	"classification" => $request->type,  
	"name_of_colluniversity" => $request->collegeuniver,
	"type" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('curiculam_development')->where('id', $editid)->update($dataArray) ;
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
               public function editValuation(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `valuation_duty` WHERE `id`='$id'");
    
		return view('admin.faculty.editValuation',compact('profile_edit'));
		
    }
      public function editInfoValuation(Request $request)
    {
	$editid = $request->editid;
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"choosetype"=> $request->choosetype,
	"name_of_paper" => $request->paper, 
	"name_of_pgm" => $request->program,  
	"year" => $request->year,  
	"semester" => $request->semester,  
	"classification" => $request->type,  
	"name_of_colluniversity" => $request->collegeuniver,
	"type" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"action" => '1',
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =  DB::table('valuation_duty')->where('id', $editid)->update($dataArray) ;  
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
               public function editMethodology(Request $request)
    {   
    
		$id=$request->id;
	  $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
        $profile_edit= DB::select("SELECT * FROM `teaching_method` WHERE `id`='$id'");
    
		return view('admin.faculty.editMethodology',compact('profile_edit','course'));
		
    }
     public function editInfoMethodology(Request $request)
    {
	$editid = $request->editid;
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"method"=> $request->choosetype,
	"program" => $request->program,  
	"batch" => $request->batch,  
	"semester" => $request->semester,  
	"category" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  =   DB::table('teaching_method')->where('id', $editid)->update($dataArray) ;
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
                public function editIct(Request $request)
    {   
    
		$id=$request->id;
	  
        $profile_edit= DB::select("SELECT * FROM `ict` WHERE `id`='$id'");
      $course =  DB::select("SELECT course_name,id from course ORDER BY id ASC"); 
		return view('admin.faculty.editIct',compact('profile_edit','course'));
		
    }
        public function editInfoIct(Request $request)
    {
		$editid = $request->editid;
	 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/facultyduty/';
            $file->move($filePath, $filename);
        }
        else
        {
             $filename=$request->current_file;
        }
      
		if($request->promoter)
		{
		    $promoter=$request->promoter;  
		}
		else
		{
		    $promoter='';
		}
	
         
		 $dataArray      =  array(
	"faculty_id"=> Auth::user()->profile_id,
	"title"=> $request->choosetype,
	"program" => $request->program,  
	"batch" => $request->batch,  
	"semester" => $request->semester,  
	"category" => $request->Category,  
	"from_date" => $request->datestart,
	"to_date" => $request->dateend,
    "designation" => $request->level, 
     "recognition_category" => $promoter, 
     "document"=>$filename,
	"post_date"=>Carbon::now()->toDateTimeString(),
	);
	
	$id  = DB::table('ict')->where('id', $editid)->update($dataArray) ;  
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
	//Mou.......................//
	
	public function exportMou(Request $request)
{
 
   $fileName = 'Mou.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT `category`,`title`,`from_date`,`to_date`,`funding_agency`,`level`,`signed_authority`,`authority_name`,`principle_investigator`,`co_investigator`,`granteed`,`total_amt`,cell.name_of_the_cell,research_fellow.name as Rf FROM `mou` left join cell on mou.cell=cell.id left join research_fellow on mou.research_fellow=research_fellow.id where mou.profile_id='$facultyid'");
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Category','Title','From Date','To Date','Funding Agency','Level','Signed Authority','Authority Name','Principle Investigator','Co Investigator','Grantee','Total Amount','Cell Title','Research Fellow');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
                $row['Category']  = $task->category;
                $row['Title']  = $task->title; 
                $row['From Date']  = $task->from_date;
                 
                 $row['To Date']  = $task->to_date;
                 $row['Funding Agency']  = $task->funding_agency;
                  $row['Level']  = $task->level;
                $row['Signed Authority']  = $task->signed_authority;
                  $row['Authority Name']  = $task->authority_name;
                 $row['Principle Investigator']  = $task->principle_investigator;
                 $row['Co Investigator']  = $task->co_investigator;
                 $row['Grantee']  = $task->granteed;
                 $row['Total Amount']  = $task->total_amt;
                 $row['Cell Title']  = $task->name_of_the_cell;
                 $row['Research Fellow']  = $task->Rf;
               
                fputcsv($file, array($row['Category'],$row['Title'],$row['From Date'], $row['To Date'],$row['Funding Agency'],$row['Level'],$row['Signed Authority'],$row['Authority Name'],$row['Principle Investigator'],$row['Co Investigator'],$row['Grantee'],$row['Total Amount'],$row['Cell Title'],$row['Research Fellow']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
	
	  public function exportMouadmin(Request $request)
{
 
   $fileName = 'MouAdmin.csv';
  $facultyid =  Auth::user()->profile_id;
 
   $tasks = DB::select("SELECT mou.`category`,`title`,`from_date`,`to_date`,`funding_agency`,`level`,`signed_authority`,`authority_name`,`principle_investigator`,`co_investigator`,`granteed`,`total_amt`,cell.name_of_the_cell,research_fellow.name as Rf,faculity.name as fname FROM `mou` left join cell on mou.cell=cell.id left join research_fellow on mou.research_fellow=research_fellow.id left join faculity on faculity.fid=mou.profile_id");
 
         $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       

        $columns = array('Category','Title','From Date','To Date','Funding Agency','Level','Signed Authority','Authority Name','Principle Investigator','Co Investigator','Grantee','Total Amount','Cell Title','Research Fellow','Faculty Name');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                
                $row['Category']  = $task->category;
                $row['Title']  = $task->title; 
                $row['From Date']  = $task->from_date;
                $row['To Date']  = $task->to_date;
                 $row['Funding Agency']  = $task->funding_agency;
                  $row['Level']  = $task->level;
                $row['Signed Authority']  = $task->signed_authority;
                  $row['Authority Name']  = $task->authority_name;
                 $row['Principle Investigator']  = $task->principle_investigator;
                 $row['Co Investigator']  = $task->co_investigator;
                 $row['Grantee']  = $task->granteed;
                 $row['Total Amount']  = $task->total_amt;
                 $row['Cell Title']  = $task->name_of_the_cell;
                 $row['Research Fellow']  = $task->Rf;
                  $row['Faculty Name']  = $task->fname;
               
                fputcsv($file, array($row['Category'],$row['Title'],$row['From Date'], $row['To Date'],$row['Funding Agency'],$row['Level'],$row['Signed Authority'],$row['Authority Name'],$row['Principle Investigator'],$row['Co Investigator'],$row['Grantee'],$row['Total Amount'],$row['Cell Title'],$row['Research Fellow'],$row['Faculty Name']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    } 
       public function autosearchMou(Request $request)
    {
       $query = $request->search;
          $filterResult =  DB::select("SELECT id,title FROM mou where `title` LIKE '$query%'"); 
        
          if ($filterResult){
			foreach($filterResult as $val){
			$data[] = array(
				"label" => $val->title,
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
     public function addMou()
    {   $faculty =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
        $cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
        $fellow  =  DB::select("SELECT id,`name` FROM `research_fellow` ORDER BY id ASC"); 
         return view('admin.faculty.addMou',compact('fellow','cells','faculty'));
    }
    
    	 public function editMou(Request $request)
    {   
     
		$id=$request->id;
	 
        $profile_edit= DB::select("SELECT * FROM `mou` WHERE `id`='$id'");
    
		$faculty =  DB::select("SELECT name,fid from faculity ORDER BY fid ASC"); 
        $cells  =  DB::select("SELECT id,`name_of_the_cell` FROM `cell` ORDER BY id ASC"); 
        $fellow  =  DB::select("SELECT id,`name` FROM `research_fellow` ORDER BY id ASC"); 
         return view('admin.faculty.editMou',compact('fellow','cells','faculty','profile_edit'));
		
    }
        	 public function editMouImage($id='')
    {   
         $idd=$id;
	    
        $list= DB::select("SELECT * FROM `mou` where mou.id='$idd'");
	    return view('admin.faculty.editMouImage',compact('list','idd'));
    }
          public function editInfoMou(Request $request)
    {
		$editid=$request->editid;
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename=$request->current_file;
        }
      
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(

    "category" => $request->category,	     
	"title" => $request->title,
	"from_date" => $request->datestart,
    "to_date" => $request->dateend,
	"funding_agency" => $request->fundingagency,
	"link_url" => $request->link_url,
	"total_amt" =>$request->totamt,
	"level" => $request->level,
	"signed_authority" => $request->authority,
	"authority_name" => $request->authority_name,
	"principle_investigator" => $request->principle_investigator,
	"co_investigator" => $request->co_investigator,
	"granteed" => $request->granteed,
	"profile_id" => Auth::user()->profile_id,
	"role" => Auth::user()->role,
    "upload_document" => $filename,
    "cell" => $request->cell,
    "research_fellow" => $request->fellow,

   );

    $id  =    DB::table('mou')->where('id', $editid)->update($dataArray) ;

	if($id==1){ 
                    	return response()->json(['success'=>'Mou Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    }
       	   public function deleteMou(Request $request)
    {

      $id= $request->id;

	 DB::delete("DELETE mou.* FROM mou  where mou.id='$id'");

	 return redirect()->back()->with('status', ' Details have been Deleted Successfully !!');
 
    }
           public function saveMou(Request $request)
    {
		
		 if($request->file('file1')) 
		{ 
        
            $file = $request->file('file1');
            $filename = time() . '.' . $request->file('file1')->extension();
            $filePath = public_path() . '/uploads/journal/';
            $file->move($filePath, $filename);
        }
        else
        {
            $filename='';
        }
    
   //	$current_date_time = Carbon::now()->toDateTimeString();
		 $dataArray      =  array(
	"category" => $request->category,	     
	"title" => $request->title,
	"from_date" => $request->datestart,
    "to_date" => $request->dateend,
	"funding_agency" => $request->fundingagency,
	"link_url" => $request->link_url,
	"total_amt" =>$request->totamt,
	"level" => $request->level,
	"signed_authority" => $request->authority,
	"authority_name" => $request->authority_name,
	"principle_investigator" => $request->principle_investigator,
	"co_investigator" => $request->co_investigator,
	"granteed" => $request->granteed,
	"profile_id" => Auth::user()->profile_id,
	"role" => Auth::user()->role,
    "upload_document" => $filename,
    "cell" => $request->cell,
    "research_fellow" => $request->fellow,
   );

    $id  =   DB::table('mou')->insertGetId($dataArray);

	if($id==1){ 
                    	return response()->json(['success'=>'Mou Details has been uploaded']);
                } 
                else{
                    return response()->json(["message" => "Please try again."]);
                }

    } 
    
      public function mouList(Request $request)
    {  
         $type =  Auth::user()->type;
        if ($type=='superadmin' || $type=='sub' ) {
            	$list = DB::select("SELECT mou.*,cell.name_of_the_cell,research_fellow.name as Rf,faculity.name as fname FROM `mou` left join cell on mou.cell=cell.id left join research_fellow on mou.research_fellow=research_fellow.id
left join faculity on faculity.fid=mou.profile_id"); 
	         return view('admin.faculty.mouList',compact('list'));
        }else
        {
        $faculty_id =  Auth::user()->profile_id;
		$list = DB::select("SELECT mou.*,cell.name_of_the_cell,research_fellow.name as Rf FROM `mou` left join cell on mou.cell=cell.id left join research_fellow on mou.research_fellow=research_fellow.id where mou.profile_id='$faculty_id'"); 
	    return view('admin.faculty.mouList',compact('list'));
        }
    }
    
	
}
