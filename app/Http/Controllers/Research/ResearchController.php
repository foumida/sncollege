<?php

namespace App\Http\Controllers\Research;
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


class ResearchController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }  
	    public function dashboard(Request $request)
    {
          $faculty_id =  Auth::user()->profile_id;
		 $list= DB::select("SELECT * FROM `research_guide` WHERE `id`='$faculty_id'");
	
         return view('admin.research.home',compact('list'));
   
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
			 
		
			  
      $image = $request->file('select_file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('uploads/facultyimg'), $new_name);
	   $postArray = ['picture' => $new_name];
        DB::table('research_guide')->where('id',  $profileid)->update($postArray);
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
      	public function storeProfileImagefellow(Request $request)
    {
     $validation = Validator::make($request->all(), [
      'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
     ]);
     if($validation->passes())
     {     
             $profileid = Auth::user()->profile_id;
			 
		
			  
      $image = $request->file('select_file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('uploads/student'), $new_name);
	   $postArray = ['picture' => $new_name];
        DB::table('research_fellow')->where('id',  $profileid)->update($postArray);
      return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="{{url(uploads/student/'.$new_name.')}}" class="img-thumbnail" width="300" />',
	 
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
       public function dashboardfellow(Request $request)
    {
        $faculty_id =  Auth::user()->profile_id;
		 $list= DB::select("SELECT * FROM `research_fellow` WHERE `id`='$faculty_id'");
          //return view('admin.research.home',compact('list'));
        return view('admin.research.homefellow',compact('list'));
    }
	    
}