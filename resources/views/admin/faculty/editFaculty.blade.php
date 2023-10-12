@extends('layouts.faculty.default')
@section('content')

<style>
label {
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 400;
    color:#fff;
}
</style>
         <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Faculty</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->name}}">
                      </div>
					
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Date of Birth</label>
									 <input type="date" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth" aria-label="Username" value="{{$profile_edit[0]->dob}}">
									  <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" aria-label="Username" value="{{$profile_edit[0]->fid}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Date of Joining </label>
									  <input type="date" class="form-control form-control-lg" id="dateofjoining" name="dateofjoining" aria-label="Username" value="{{$profile_edit[0]->date_of_join}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Gender</label>
								 <select class="form-control" name="gender" id="gender" >
            										<option value="">Select Dept</option>
            										<option value="Male" @if($profile_edit[0]->gender=='Male') Selected @endif>Male</option>
            										<option value="Female"  @if($profile_edit[0]->gender=='Female') Selected @endif>Female</option>
            										</select>
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Guardian Name</label>
									 <input type="text" class="form-control form-control-lg" id="guardianName" name="guardianName" aria-label="Username" value="{{$profile_edit[0]->guardian}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username" value="{{$profile_edit[0]->phone_number}}">
									</div>
										<div class="col-md-4 form-group">
									  <label>Email</label>
									  <input type="email" class="form-control form-control-lg" id="email"  name="email" aria-label="Username" value="{{$profile_edit[0]->email_id}}">
									</div>
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <label><b> Membership Isproffessional Academic Body</b></label>
									<div class="col-md-6 form-group">
									  <label>Name of the body</label>
									 <input type="text" class="form-control form-control-lg" id="academicbody" name="academicbody" value="{{$profile_edit[0]->academic_body}}">
									</div>
									<div class="col-md-6 form-group">
									  <label>University/Institution</label>
									  	 <select class="form-control" name="university" id="university" >
            										<option value="">Select </option>
            										<option value="govt" @if($profile_edit[0]->academic_institution=='govt') Selected @endif>Government</option>
            										<option value="nongovt" @if($profile_edit[0]->academic_institution=='nongovt') Selected @endif>Non Govt</option>
            										<option value="semigovt" @if($profile_edit[0]->academic_institution=='semigovt') Selected @endif>Semi Govt</option>
            										</select>
									</div>
									
									
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Department</label>	<?php
                            // explode the saved data back into an array                    
                            $project_type_dept = explode(',', $profile_edit[0]->department);
                            ?>
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->department }}" @if($row->department==$profile_edit[0]->department) Selected @endif>{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Designation</label>
									  <select class="form-control" name="designation" id="designation" >
										<option value="">Select Designation</option>
										<option value="Professor" @if($profile_edit[0]->designation=='Professor') Selected @endif>Professor</option>
										<option value="Associate Professor" @if($profile_edit[0]->designation=='Associate Professor') Selected @endif>Associate Professor</option>
										<option value="Assistant Professor & Research Guide" @if($profile_edit[0]->designation=='Assistant Professor & Research Guide') Selected @endif>Assistant Professor & Research Guide</option>
										<option value="Assistant Professor" @if($profile_edit[0]->designation=='Assistant Professor') Selected @endif>Assistant Professor</option>
										<option value="Guest Faculty" @if($profile_edit[0]->designation=='Guest Faculty') Selected @endif>Guest Faculty</option>
										<option value="None" @if($profile_edit[0]->designation=='None') Selected @endif>None</option>
											</select>
									</div>
										<div class="col-md-4 form-group">
									  <label>Position</label>
									
									  <select class="form-control" name="Position[]" id="lstSelect" multiple>
									
									   <?php
		   $poss=explode(',', $profile_edit[0]->position);
		  if (in_array("Principal", $poss,TRUE)){ ?>
                    <option value="Principal" selected>Principal</option>
		  <?php } else { ?>
		  <option value="Principal" >Principal</option>
		   <?php }  ?>
		    <?php
		  if (in_array("Vice Principal", $poss,TRUE)){ ?>
          <option value="Vice Principal" selected>Vice Principal</option>
		  <?php } else { ?>
		  <option value="Vice Principal">Vice Principal</option>
		   <?php }  ?>
		     <?php
		   if (in_array("HOD", $poss,TRUE)){ ?>
		  <option value="HOD" selected>HOD</option>
		   <?php } else { ?>
		  <option value="HOD">HOD</option>
		   <?php }  ?>
		     <?php
		 if (in_array("Self Financing Director", $poss,TRUE)){ ?>
          <option value="Self Financing Director" selected>Self Financing Director</option>
		   <?php } else { ?>
		  <option value="Self Financing Director">Self Financing Director</option>
		   <?php }  ?>
		     <?php
		  if (in_array("IQAC Coordinator", $poss,TRUE)){ ?>
          <option value="IQAC Coordinator" selected>IQAC Coordinator</option>
		   <?php } else { ?>
		  <option value="IQAC Coordinator">IQAC Coordinator</option>
		   <?php }  ?>
		     <?php
		 if (in_array("NAAC Coordinator", $poss,TRUE)){ ?>
          <option value="NAAC Coordinator" selected>NAAC Coordinator</option>
		   <?php } else { ?>
		   <option value="NAAC Coordinator">NAAC Coordinator</option>
		    <?php }  ?>
		     <?php
		  if (in_array("Research Nodal Officer", $poss,TRUE)){ ?>
          <option value="Research Nodal Officer" selected>Research Nodal Officer</option>
		   <?php } else { ?>
		  <option value="Research Nodal Officer">Research Nodal Officer</option>
		   <?php }  ?>
		     <?php
		 if (in_array("Staff Secretary", $poss,TRUE)){ ?>
          <option value="Staff Secretary" selected>Staff Secretary</option>
		   <?php } else { ?>
		  <option value="Staff Secretary">Staff Secretary</option>
		   <?php }  ?>
		     <?php
		 if (in_array("Nodal Officer - Admission", $poss,TRUE)){ ?>
          <option value="Nodal Officer - Admission" selected>Nodal Officer - Admission</option>
		   <?php } else { ?>
		   <option value="Nodal Officer - Admission">Nodal Officer - Admission</option>
		    <?php }  ?>
		     <?php
		 if (in_array("Nodal Officer - Examination", $poss,TRUE)){ ?>
          <option value="Nodal Officer - Examination" selected>Nodal Officer - Examination</option>
		   <?php } else { ?>
		  <option value="Nodal Officer - Examination">Nodal Officer - Examination</option>
		   <?php }  ?>
		    <?php
		 if (in_array("Public Information Officer (PIO)", $poss,TRUE)){ ?>
          <option value="Public Information Officer (PIO)" selected>Public Information Officer (PIO)</option>
		   <?php } else { ?>
		   <option value="Public Information Officer (PIO)">Public Information Officer (PIO)</option>
		    <?php }  ?>
		     <?php
		 if (in_array("Public Relation  Officer (PRO)", $poss,TRUE)){ ?>
          <option value="Public Relation  Officer (PRO)" selected>Public Relation  Officer (PRO)</option>
		   <?php } else { ?>
		   <option value="Public Relation  Officer (PRO)">Public Relation  Officer (PRO)</option>
		    <?php }  ?>
		     <?php
		 if (in_array("PTA", $poss,TRUE)){ ?>
          <option value="PTA" selected>PTA </option>
		   <?php } else { ?>
		   <option value="PTA">PTA </option>
		    <?php }  ?>
		     <?php
		  if (in_array("Secretary", $poss,TRUE)){ ?>
          <option value="Secretary" selected>Secretary</option>
		   <?php } else { ?>
		  <option value="Secretary">Secretary</option>
		   <?php }  ?>
		     <?php
		 if (in_array("Superintendent", $poss,TRUE)){ ?>
          <option value="Superintendent" selected>Superintendent</option>
		   <?php } else { ?>
		  <option value="Superintendent">Superintendent</option>
		   <?php }  ?>
		     <?php
		 if (in_array("Head Accountant (HA)", $poss,TRUE)){ ?>
          <option value="Head Accountant (HA)" selected>Head Accountant (HA)</option>
		   <?php } else { ?>
		  <option value="Head Accountant (HA)">Head Accountant (HA)</option>
		   <?php }  ?>
		     <?php
		 if (in_array("None", $poss,TRUE)){ ?>
		  <option value="None" selected>None</option>
		   <?php } else { ?>
		  <option value="None">None</option>
		   <?php }  ?>
		    
        </select>
											</select>
									</div>
									
								</div>
							</div>
						
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Address</label>
                            <textarea class="form-control"  id="address" name="address" rows="10" cols="100" value="{{$profile_edit[0]->address}}">{{$profile_edit[0]->address}}</textarea>
                         </div>
						 	 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Qualification</label>
                            <textarea class="form-control"  id="qualification" name="qualification" rows="10" cols="100" value="{{$profile_edit[0]->highest_edu}}">{{$profile_edit[0]->highest_edu}}</textarea>
                         </div>
						  <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control"  id="description" name="description" rows="10" cols="100" value="{{$profile_edit[0]->description}}">{{$profile_edit[0]->description}}</textarea>
                         </div>
                         
						 <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Resume</label><a style="float:right;" class="btn btn-info mb-2" href="{{url('uploads/facultyresume/'.$profile_edit[0]->resume)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file1" id="file1" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->resume}}">
                         </div>
                        
                          <div class="form-group">
						    
                             <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									  <input type="hidden" name="current_file_img" id="current_file_img" value="{{$profile_edit[0]->picture}}">
									   <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/facultyimg/'.$profile_edit[0]->picture)}}" /></span>
                         </div>
						 <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Appointment Order</label>  @if(!empty($profile_edit[0]->appointment_order)) <iframe src="{{url('uploads/facultyresume/'.$profile_edit[0]->appointment_order)}}" width="50%" height="300">
           
    </iframe> @endif
                         <input type="file" class="form-control"  name="file2" id="file2" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file2" value="{{$profile_edit[0]->appointment_order}}">
                         </div>
						  <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Joining Memo</label>  @if(!empty($profile_edit[0]->joining_memo)) <iframe src="{{url('uploads/facultyresume/'.$profile_edit[0]->joining_memo)}}" width="50%" height="300">
           
    </iframe> @endif
                         <input type="file" class="form-control"  name="file3" id="file3" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file3" value="{{$profile_edit[0]->joining_memo}}">
                         </div>
						 <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Promotion Details</label>  @if(!empty($profile_edit[0]->promotion_details)) <iframe src="{{url('uploads/facultyresume/'.$profile_edit[0]->promotion_details)}}" width="50%" height="300">
           
    </iframe> @endif
                         <input type="file" class="form-control"  name="file4" id="file4" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file4" value="{{$profile_edit[0]->promotion_details}}">
                         </div>
					
						
						 
					<button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Submit</button> 
					</form> 
				</div>
				
					
                
            </div>
          </div>
          </div>
          </div>
          </div>
          </div>
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

 <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description');
	
</script>

<script type="text/javascript">
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var guardianName =  $('#guardianName').val();                   
var dateofbirth= $('#dateofbirth').val();
var dateofjoining= $('#dateofjoining').val();	
var gender= $('#gender').val();	
var phonenum =  $('#phonenum').val();;
var email =  $('#email').val();;


var department= $('#department').val();
var designation= $('#designation').val();
var address= $('#address').val();
var qualification= $('#qualification').val();
var description= $('#description').val();

var position = [];    
    $("#lstSelect :selected").each(function(){
        position.push($(this).val()); 
    });
var positiondata = position.toString();


		  if(name.trim()==''){
                    swal("Warning","Enter FullName","warning");
                    return false;
                }
		 if(dateofbirth ==''){
                    swal("Warning","Enter Date Of Birth","warning");
                    return false;
                }
		  if(dateofjoining ==''){
                    swal("Warning","Enter Date Of Joining","warning");
                    return false;
                }
				 if(gender.trim()==''){
                    swal("Warning","Enter Gender","warning");
                    return false;
                }
                 if(department.trim()==''){
                    swal("Warning","Enter Department","warning");
                    return false;
                }
                 if(designation.trim()==''){
                    swal("Warning","Enter Designation","warning");
                    return false;
                }
                 if(qualification.trim()==''){
                    swal("Warning","Enter Qualification","warning");
                    return false;
                }
                   if(address.trim()==''){
                    swal("Warning","Enter Address","warning");
                    return false;
                }
				 if(phonenum ==''){
                    swal("Warning","Enter Phone Number","warning");
                    return false;
                }
				if(email ==''){
                    swal("Warning","Enter Email","warning");
                    return false;
                }
			
				if(position == ''){
                    swal("Warning","Enter Position","warning");
                    return false;
                }
				
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{url('/faculty/editFacultyinfo')}}",
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: (response) => {
                if (response) {
                   // this.reset();
                    alert('Files has been uploaded successfully');
						window.location.href = "{{url('/faculty/facultyIndividualList')}}";
                }
            },
        });
    });
});
 $("#image").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['image/jpeg', 'image/png', 'image/jpg'];
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))){
        alert('Sorry JPG, JPEG, & PNG files are allowed to upload.');
        $("#image").val('');
        return false;
    }
});   
 $("#file1").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword'];
    if(!((fileType == match[0]) || (fileType == match[1]))){
        alert('Sorry only Pdf or Doc files are allowed to upload.');
        $("#file1").val('');
        return false;
    }
});  

$("#file2").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword'];
    if(!((fileType == match[0]) || (fileType == match[1]))){
        alert('Sorry only Pdf or Doc files are allowed to upload.');
        $("#file2").val('');
        return false;
    }
});   
 $("#file3").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword'];
    if(!((fileType == match[0]) || (fileType == match[1]))){
        alert('Sorry only Pdf or Doc files are allowed to upload.');
        $("#file3").val('');
        return false;
    }
});   
 $("#file4").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword'];
    if(!((fileType == match[0]) || (fileType == match[1]))){
        alert('Sorry only Pdf or Doc files are allowed to upload.');
        $("#file4").val('');
        return false;
    }
});      
</script>

@endsection