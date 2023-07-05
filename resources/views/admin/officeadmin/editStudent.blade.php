
@extends('layouts.admin.default')

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
                    <h4 class="card-title">Edit Student</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Full Name</label>
									  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->name}}">
									  <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" aria-label="Username" value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>CAP ID</label>
									   <input type="text" class="form-control" id="capid" name="capid" placeholder="CAP ID" value="{{$profile_edit[0]->cap_id}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Academic Year(current year)</label>
						            	  <input type="text" class="form-control" id="academic" name="academic" placeholder="Academic Year" value="{{$profile_edit[0]->academic_year}}">
									</div>
									
								</div>
							</div>
							
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Batch(eg:2008-2011)</label>
									 <input type="text" class="form-control" id="batch" name="batch" placeholder="Batch" value="{{$profile_edit[0]->batch}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Roll NO</label>
									   <input type="text" class="form-control" id="rollnum" name="rollnum" placeholder="Roll NO" value="{{$profile_edit[0]->roll_no}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>University Register Number</label> 
						            	  <input type="text" class="form-control" id="universityreg" name="universityreg" placeholder="University Register Number" value="{{$profile_edit[0]->university_regno}}">
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Caste & Income Certificate</label>
									   <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->caste_income_upload)}}" download="">Download</a>
									 <input type="file" class="form-control" id="filecardcaste" name="filecardcaste"  />
									  <span class="text-danger" id="file-input-error"></span>
									   <input type="hidden" name="current_file_income" value="{{$profile_edit[0]->caste_income_upload}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Qualify Examination Certificate</label>
									   <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->qualify_exam_certificate_upload)}}" download="">Download</a>
									 	 <input type="file" class="form-control" id="filecardexam" name="filecardexam"  />
									 	 <span class="text-danger" id="file-input-error"></span>
									   <input type="hidden" name="current_file_exam" value="{{$profile_edit[0]->qualify_exam_certificate_upload}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Bank Passbook Certificate</label>
									  <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->bank_passbook_upload)}}" download="">Download</a>
						            		 <input type="file" class="form-control" id="filecardpassbook" name="filecardpassbook"  />
						            		  <span class="text-danger" id="file-input-error"></span>
									   <input type="hidden" name="current_file_passbook" value="{{$profile_edit[0]->bank_passbook_upload}}">
									</div>
									
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Admission No</label>
									 <input type="text" class="form-control" id="admission" name="admission" placeholder="Admission No" value="{{$profile_edit[0]->admission_no}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Program</label>	<?php
    // explode the saved data back into an array                    
    $project_type_dept = explode(',', $profile_edit[0]->program);
	
?>
									     <select class="form-control" name="program" id="program" >
            										<option value="">Select Program</option>
            									    @foreach($course as $row)
            								            <option value="{{ $row->course_name }}" {{ in_array($row->course_name, $project_type_dept) ? 'selected' : '' }}>{{ $row->course_name }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Semester</label>
						            	  <select class="form-control" name="p_semester" id="p_semester">
                                                        <option value="">none</option>
                                                         <option value="3 Months" @if($profile_edit[0]->semester == '3 Months') Selected @endif>3 Months</option>
                                                         <option value="6 Months" @if($profile_edit[0]->semester == '6 Months') Selected @endif>6 Months</option>
                                                        <option value="Semester 1" @if($profile_edit[0]->semester == 'Semester 1') Selected @endif>Semester 1</option>
                                                        <option value="Semester 2" @if($profile_edit[0]->semester == 'Semester 2') Selected @endif>Semester 2</option>
                                                        <option value="Semester 3" @if($profile_edit[0]->semester == 'Semester 3') Selected @endif>Semester 3</option>
                                                        <option value="Semester 4" @if($profile_edit[0]->semester == 'Semester 4') Selected @endif>Semester 4</option>
                                                        <option value="Semester 5" @if($profile_edit[0]->semester == 'Semester 5') Selected @endif>Semester 5</option>
                                                        <option value="Semester 6" @if($profile_edit[0]->semester == 'Semester 6') Selected @endif>Semester 6</option>
                                                        <option value="Semester 7" @if($profile_edit[0]->semester == 'Semester 7') Selected @endif>Semester 7</option>
                                                        <option value="Semester 8" @if($profile_edit[0]->semester == 'Semester 8') Selected @endif>Semester 8</option>
                                                    </select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Date of Birth</label>
									 <input type="date" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth" aria-label="Username" value="{{$profile_edit[0]->dob}}">
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									
									<div class="col-md-3 form-group">
									  <label>Relegion </label>
									 <select class="form-control" name="relegion" id="relegion">
                                                        <option value=""></option>  
                                                         <option value="Hindu" @if($profile_edit[0]->relegion == 'Hindu') Selected @endif>Hindu</option>
                                                         <option value="Islam" @if($profile_edit[0]->relegion == 'Islam') Selected @endif>Islam</option>
                                                        <option value="Christian" @if($profile_edit[0]->relegion =='Christian') Selected @endif>Christian</option>
                                                        <option value="Others" @if($profile_edit[0]->relegion != 'Hindu') Selected @elseif ($profile_edit[0]->relegion != 'Islam')  @else ($profile_edit[0]->relegion != 'Christian') Selected @endif>Others</option>
                                                       
                                                    </select>
                                <input type="text" class="form-control form-control-lg" id="otherrelegion" name="otherrelegion" placeholder="Specify Other Relegion" style="display:none" value="{{$profile_edit[0]->relegion}}">         
									</div>
										<div class="col-md-3 form-group">
									  <label>Caste</label>
									 <input type="text" class="form-control form-control-lg" id="caste" name="caste" aria-label="caste" value="{{$profile_edit[0]->caste}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Minority Category</label>
									  <select class="form-control" name="mcat" id="mcat" >
            										<option value="">Select Category</option>
            										<option value="OEC"  @if($profile_edit[0]->minority_category == 'OEC') Selected @endif>OEC</option>
            										<option value="OBC" @if($profile_edit[0]->minority_category == 'OBC') Selected @endif>OBC</option>
            										<option value="GENERAL" @if($profile_edit[0]->minority_category == 'GENERAL') Selected @endif>GENERAL</option>
            										<option value="SC" @if($profile_edit[0]->minority_category == 'SC') Selected @endif>SC</option>
            										<option value="ST" @if($profile_edit[0]->minority_category == 'ST') Selected @endif>ST</option>
            										<option value="OTHER" @if($profile_edit[0]->minority_category == 'OTHER') Selected @endif>OTHER</option>
            										</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Gender</label>
								 <select class="form-control" name="gender" id="gender" >
            										<option value="">Select Gender</option>
            										<option value="Male" @if($profile_edit[0]->gender=='Male') Selected @endif>Male</option>
            										<option value="Female" @if($profile_edit[0]->gender=='Female') Selected @endif>Female</option>
            										</select>
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <div class="col-md-3 form-group">
									  <label>Reservation Category</label>
										 <select class="form-control" name="reservationcat" id="reservationcat" >
            										<option value="">Select Category</option>
            										<option value="OPEN" @if($profile_edit[0]->reservation_category=='OPEN') Selected @endif>Open Category</option>
            										<option value="PWD" @if($profile_edit[0]->reservation_category=='PWD') Selected @endif>PWD</option>
            										<option value="Ezhava" @if($profile_edit[0]->reservation_category=='Ezhava') Selected @endif>Ezhava</option>
            										<option value="Muslim" @if($profile_edit[0]->reservation_category=='Muslim') Selected @endif>Muslim</option>
            										<option value="LC" @if($profile_edit[0]->reservation_category=='LC') Selected @endif>LC</option>
            										<option value="AI" @if($profile_edit[0]->reservation_category=='AI') Selected @endif>AI</option>
            										<option value="OBX" @if($profile_edit[0]->reservation_category=='OBX') Selected @endif>OBX</option>
            										<option value="OBH" @if($profile_edit[0]->reservation_category=='OBH') Selected @endif>OBH</option>
            										<option value="EWS" @if($profile_edit[0]->reservation_category=='EWS') Selected @endif>EWS</option>
            										<option value="SC" @if($profile_edit[0]->reservation_category=='SC') Selected @endif>SC</option>
            										<option value="ST"  @if($profile_edit[0]->reservation_category=='ST') Selected @endif>ST</option>
													<option value="OBC"  @if($profile_edit[0]->reservation_category=='OBC') Selected @endif>OBC</option>
            										<option value="SPORTS" @if($profile_edit[0]->reservation_category=='SPORTS') Selected @endif>SPORTS</option>
            										</select>
													
									</div>
									<div class="col-md-3 form-group">
									  <label>Whatsapp</label>
									 <input type="text" class="form-control form-control-lg" id="whatsapp" name="whatsapp" placeholder="whatsApp" value="{{$profile_edit[0]->whats_app}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" placeholder="Phone number" value="{{$profile_edit[0]->contact_number}}">
									</div>
										<div class="col-md-3 form-group">
									  <label>Email</label>
									  <input type="email" class="form-control form-control-lg" id="email"  name="email" placeholder="Email" value="{{$profile_edit[0]->email}}">
									</div>
								</div>
							</div>
						
						</div>
						
					     <div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Guardian Name</label>
									 <input type="text" class="form-control form-control-lg" id="guardianname" name="guardianname" placeholder="GuardianName" value="{{$profile_edit[0]->parent_name}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Guardian Phone number </label>
								 <input type="text" class="form-control form-control-lg" id="guardianphone" name="guardianphone" placeholder="GuardianPhone" value="{{$profile_edit[0]->parent_phonenum}}">
                               
									</div>
									<div class="col-md-3 form-group">
									  <label>Guardian Whatsapp number</label>
								<input type="text" class="form-control form-control-lg" id="guardianwhatsapp" name="guardianwhatsapp" placeholder="GuardianWhatsApp" value="{{$profile_edit[0]->parent_whatsapp}}">
									</div>
										<div class="col-md-3 form-group">
									  <label>Language</label>
							 <select class="form-control" name="language" id="language" >
            										<option value="">Select </option>
            										<option value="ARABIC" @if($profile_edit[0]->language=='ARABIC') Selected @endif>ARABIC</option>
            										<option value="FRENCH" @if($profile_edit[0]->language=='FRENCH') Selected @endif>FRENCH</option>
            										<option value="HINDI" @if($profile_edit[0]->language=='HINDI') Selected @endif>HINDI</option>
            										<option value="MALAYALAM" @if($profile_edit[0]->language=='MALAYALAM') Selected @endif>MALAYALAM</option>
            									
            										</select>
									</div>
								</div>
							</div>
							
						</div>
							  <div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Country</label>
								 <select id="country-dropdown" name="country" class="form-control col-md-12"  >
                                            				 <option value="">Select</option>
                                            					@foreach($countrylist as $row)
                                            					 <option value="{{ $row->country_id }}" @if($profile_edit[0]->Nationality==$row->country_id) selected @endif>{{ $row->country_name }}</option>
                                            					@endforeach
                                            				</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Select State</label>
							    <select id="state-dropdown" class="form-control form-control-lg" name="state">
                                </select>
                                </div>
									<div class="col-md-4 form-group">
									  <label>Select City</label>
							    <select id="city-dropdown" name="city" class="form-control">
                        </select>
									</div>
								</div>
							</div>
							
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Address</label>
                            <textarea class="form-control"  id="address" name="address" rows="10" cols="100" placeholder="Address"  value="{{$profile_edit[0]->address}}">{{$profile_edit[0]->address}}</textarea>
                         </div>
                          <div class="form-group">
						    <label class="col-sm-12 col-form-label">Pincode</label>
                           <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{$profile_edit[0]->pincode}}">
                         </div>	
						 	 <div class="form-group row">
						<h6> ID Proof Details</h6>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Id Proof</label>
								 <select class="form-control" name="prooftype" id="prooftype" >
            										<option value="">Select Proof</option>
            										<option value="Aadhar" @if($profile_edit[0]->proof_type=='Aadhar') Selected @endif>Aadhar</option>
            										<option value="Paasport" @if($profile_edit[0]->proof_type=='Paasport') Selected @endif>Paasport</option>
            										</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Proof Number</label>
								 <input type="text" class="form-control form-control-lg" id="proofno" name="proofno" placeholder="Enter Proof ID" value="{{$profile_edit[0]->Proof_no}}">
                               
									</div>
									<div class="col-md-4 form-group">
									  <label>Upload Proof</label>
							  <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->proof_doc)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file1" id="file1" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->proof_doc}}">
									</div>
								</div>
							</div>
							
						</div>
                         <div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12 form-group">
									  <label>Profile Picture</label>
							<input type="file" class="form-control" id="image" name="image"  />
									  <input type="hidden" name="current_file_img" id="current_file_img" value="{{$profile_edit[0]->profile_pic}}">
									   <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/student/'.$profile_edit[0]->profile_pic)}}" /></span>
									</div>
								
								
								</div>
							</div>
							
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

  <script>
  	var state_province_id=<?=$profile_edit[0]->state;?>;
		var country=<?=$profile_edit[0]->Nationality;?>;
			var city_id=<?=$profile_edit[0]->city;?>;
	
	
        $(document).ready(function () {
  
    $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{url('/admin/getStatebyid')}}",
                    type: "Post",
                    data: {
                        stateid: state_province_id,
                    },
                    dataType: 'json',
                    success: function (result) {
                       
                         $("#state-dropdown").append('<option value="' + result
                                .state_province_id + '">' + result.state_province_name + '</option>');
                      
                    }
                });
                
                  $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{url('/admin/getCityid')}}",
                    type: "Post",
                    data: {
                        cityid: city_id,
                    },
                    dataType: 'json',
                    success: function (result) {
                        
                         $("#city-dropdown").append('<option value="' + result.id + '">' + result.city_name + '</option>');
                      
                    }
                });
            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
               // alert(idCountry);
                $("#state-dropdown").html('');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{url('/admin/fetchStates')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .state_province_id + '">' + value.state_province_name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
  
            /*------------------------------------------
            --------------------------------------------
            State Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#state-dropdown').on('change', function () {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{url('/admin/fetchCities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            });
  
        });
    </script>


<script type="text/javascript">

$("#relegion").change(function() {
   if ($(this).val() === "Others") {
           
           // blethry.style.display="block";
            $('#otherrelegion').show();
        }
        else
        {
            
             // blethry.style.display="none"
              $('#otherrelegion').hide();
        }
        
        
});   
$(document).ready(function(){
var relegion = <?php echo json_encode($profile_edit[0]->relegion); ?>;

if ((relegion === "Hindu")||(relegion === "Islam")||(relegion === "Christian")) {  
            $('#otherrelegion').hide();
        }
        else
        {
            
             // blethry.style.display="none"
               $('#otherrelegion').show();
        }
         
})
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var capid =  $('#capid').val();                   
var academic= $('#academic').val();
var batch= $('#batch').val();	
var rollnum= $('#rollnum').val();	
var universityreg =  $('#universityreg').val();;
var admission =  $('#admission').val();

var program= $('#program').val();
var p_semester= $('#p_semester').val();
var email= $('#email').val();
var country =  $('#country-dropdown').val();
var state =   $('#state-dropdown').val();
var city =  $('#city-dropdown').val();
var address =  $('#address').val();
var pincode =  $('#pincode').val();
		  if(name.trim()==''){
                    swal("Warning","Enter FullName","warning");
                    return false;
                }
	      if(admission.trim()==''){
                    swal("Warning","Enter Admission Number ","warning");
                    return false;
                }
		 if(program.trim()==''){
                    swal("Warning","Enter Program ","warning");
                    return false;
                }
		
		
	
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/admin/editStudentinfo')}}",
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
                    alert('Student Details has been updated successfully');
					window.location.href = "{{ url('/admin/studentList')}}";
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
</script>

@endsection