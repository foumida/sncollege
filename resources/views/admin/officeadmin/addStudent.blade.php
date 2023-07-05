
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
                    <h4 class="card-title">Add Student</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Full Name</label>
									  <input type="text" class="form-control" id="name" name="name" placeholder="Name">
									</div>
									<div class="col-md-3 form-group">
									  <label>CAP ID</label>
									   <input type="text" class="form-control" id="capid" name="capid" placeholder="CAP ID">
									</div>
									<div class="col-md-3 form-group">
									  <label>Academic Year(current year)</label>
						            	  <input type="text" class="form-control" id="academic" name="academic" placeholder="Academic Year">
									</div>
									<div class="col-md-3 form-group">
									  <label>Entry Card Upload</label>
							    <input type="file" class="form-control" id="filecard" name="filecard"  />
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Batch(eg:2008-2011)</label>
									 <input type="text" class="form-control" id="batch" name="batch" placeholder="Batch">
									</div>
									<div class="col-md-4 form-group">
									  <label>Roll NO</label>
									   <input type="text" class="form-control" id="rollnum" name="rollnum" placeholder="Roll NO">
									</div>
									<div class="col-md-4 form-group">
									  <label>University Register Number</label>
						            	  <input type="text" class="form-control" id="universityreg" name="universityreg" placeholder="University Register Number">
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Caste & Income Certificate</label>
									 <input type="file" class="form-control" id="filecardcaste" name="filecardcaste"  />
									</div>
									<div class="col-md-4 form-group">
									  <label>Qualify Examination Certificate</label>
									 	 <input type="file" class="form-control" id="filecardexam" name="filecardexam"  />
									</div>
									<div class="col-md-4 form-group">
									  <label>Bank Passbook Certificate</label>
						            		 <input type="file" class="form-control" id="filecardpassbook" name="filecardpassbook"  />
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Admission No</label>
									 <input type="text" class="form-control" id="admission" name="admission" placeholder="Admission No">
									</div>
									<div class="col-md-3 form-group">
									  <label>Program</label>
									     <select class="form-control" name="program" id="program" >
            										<option value="">Select Program</option>
            									    @foreach($course as $row)
            								            <option value="{{ $row->course_name }}">{{ $row->course_name }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Semester</label>
						            	  <select class="form-control" name="p_semester" id="p_semester">
                                                        <option value="">none</option>
                                                         <option value="3 Months">3 Months</option>
                                                         <option value="6 Months">6 Months</option>
                                                        <option value="Semester 1">Semester 1</option>
                                                        <option value="Semester 2">Semester 2</option>
                                                        <option value="Semester 3">Semester 3</option>
                                                        <option value="Semester 4">Semester 4</option>
                                                        <option value="Semester 5">Semester 5</option>
                                                        <option value="Semester 6">Semester 6</option>
                                                        <option value="Semester 7">Semester 7</option>
                                                        <option value="Semester 8">Semester 8</option>
                                                    </select>
									</div>
										<div class="col-md-3 form-group">
									  <label>Date of Birth</label>
									 <input type="date" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth" aria-label="Username">
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
                                                        <option value="">none</option>
                                                         <option value="Hindu">Hindu</option>
                                                         <option value="Islam">Islam</option>
                                                        <option value="Christian">Christian</option>
                                                        <option value="Others">Others</option>
                                                       
                                                    </select>
                                <input type="text" class="form-control form-control-lg" id="otherrelegion" name="otherrelegion" placeholder="Specify Other Relegion" style="display:none">         
									</div>
										<div class="col-md-3 form-group">
									  <label>Caste</label>
									 <input type="text" class="form-control form-control-lg" id="caste" name="caste" aria-label="caste">
									</div>
									<div class="col-md-3 form-group">
									  <label>Minority Category</label>
									  <select class="form-control" name="mcat" id="mcat" >
            										<option value="">Select Category</option>
            										<option value="OEC">OEC</option>
            										<option value="OBC">OBC</option>
            										<option value="GENERAL">GENERAL</option>
            										<option value="SC">SC</option>
            										<option value="ST">ST</option>
            										<option value="OTHER">OTHER</option>
            										</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Gender</label>
								 <select class="form-control" name="gender" id="gender" >
            										<option value="">Select Gender</option>
            										<option value="Male">Male</option>
            										<option value="Female">Female</option>
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
            										<option value="OPEN">Open Category</option>
            										<option value="PWD">PWD</option>
            										<option value="Ezhava">Ezhava</option>
            										<option value="Muslim">Muslim</option>
            										<option value="LC">LC</option>
            										<option value="AI">AI</option>
            										<option value="OBX">OBX</option>
            										<option value="OBH">OBH</option>
            										<option value="EWS">EWS</option>
            										<option value="SC">SC</option>
            										<option value="ST">ST</option>
													<option value="OBC">OBC</option>
            										<option value="SPORTS">SPORTS</option>
            										</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Whatsapp</label>
									 <input type="text" class="form-control form-control-lg" id="whatsapp" name="whatsapp" placeholder="whatsApp">
									</div>
									<div class="col-md-3 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" placeholder="Phone number">
									</div>
										<div class="col-md-3 form-group">
									  <label>Email</label>
									  <input type="email" class="form-control form-control-lg" id="email"  name="email" placeholder="Email">
									</div>
								</div>
							</div>
						
						</div>
						
					     <div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Guardian Name</label>
									 <input type="text" class="form-control form-control-lg" id="guardianname" name="guardianname" placeholder="GuardianName">
									</div>
									<div class="col-md-3 form-group">
									  <label>Guardian Phone number </label>
								 <input type="text" class="form-control form-control-lg" id="guardianphone" name="guardianphone" placeholder="GuardianPhone">
                               
									</div>
									<div class="col-md-3 form-group">
									  <label>Guardian Whatsapp </label>
								<input type="text" class="form-control form-control-lg" id="guardianwhatsapp" name="guardianwhatsapp" placeholder="GuardianWhatsApp">
									</div>
										<div class="col-md-3 form-group">
									  <label>Language</label>
							 <select class="form-control" name="language" id="language" >
            										<option value="">Select </option>
            										<option value="ARABIC">ARABIC</option>
            										<option value="FRENCH">FRENCH</option>
            										<option value="HINDI">HINDI</option>
            										<option value="MALAYALAM">MALAYALAM</option>
            									
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
                                            					 <option value="{{ $row->country_id }}">{{ $row->country_name }}</option>
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
                            <textarea class="form-control"  id="address" name="address" rows="10" cols="100" placeholder="Address"></textarea>
                         </div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Pincode</label>
                           <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode">
                         </div>	
                          <div class="form-group row">
						<h6> ID Proof Details</h6>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Id Proof</label>
								 <select class="form-control" name="prooftype" id="prooftype" >
            										<option value="">Select Proof</option>
            										<option value="Aadhar">Aadhar</option>
            										<option value="Paasport">Paasport</option>
            										</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Proof Number</label>
								 <input type="text" class="form-control form-control-lg" id="proofno" name="proofno" placeholder="Enter Proof ID">
                               
									</div>
									<div class="col-md-4 form-group">
									  <label>Upload Proof</label>
							    <input type="file" class="form-control" id="file1" name="file1"  />
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
        $(document).ready(function () {
  
            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
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
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var capid =  $('#capid').val();                   
var academic= $('#academic').val();
var batch= $('#batch').val();	
var rollnum= $('#rollnum').val();	
var reservationcat =  $('#reservationcat').val();
var admission =  $('#admission').val();
var dateofbirth= $('#dateofbirth').val();
var program= $('#program').val();
var p_semester= $('#p_semester').val();
var email= $('#email').val();
var filecard= $('#filecard').val();
var phonenum= $('#phonenum').val();


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
    
        if(email ==''){
                    swal("Warning","Enter Email ","warning");
                    return false;
                }
         if(dateofbirth ==''){
                    swal("Warning","Enter Date Of Birth","warning");
                    return false;
                }
          if(phonenum ==''){
                    swal("Warning","Enter Phone Number","warning");
                    return false;
                }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/admin/saveStudent')}}",
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
                    alert('Student Details has been submitted successfully');
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