
@extends('layouts.office.default')

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
                    <h4 class="card-title">Register Staff Login</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
						<div class="form-group row">
						
							<div class="col-md-12">
							<div class="row">
									<div class="col-md-4 form-group">
									  <label>Full Name</label>
									  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name">
									</div>
									<div class="col-md-4 form-group">
									  <label>Email</label>
									   <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Id" onblur="checkmain(this.value)">
									</div>
								   <div class="col-md-4 form-group">
									  <label>Password</label>
									   <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								<div class="col-md-3 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Date of Birth</label>
									 <input type="date" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Date of Joining </label>
									  <input type="date" class="form-control form-control-lg" id="dateofjoining" name="dateofjoining" aria-label="Username">
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
									  <label>Designation </label>
									  <input type="text" class="form-control form-control-lg" id="designation" name="designation" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Department</label>
									 <input type="text" class="form-control form-control-lg" id="dept" name="dept" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Name Of Section </label>
									  <input type="date" class="form-control form-control-lg" id="section" name="section" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Category</label>
								 <select class="form-control" name="category" id="category" >
            										<option value="">Select Aided/Temporary</option>
            										<option value="Aided">Aided</option>
            										<option value="Temporary">Temporary</option>
            										</select>
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    
									<div class="col-md-6 form-group">
									  <label >Resume</label>
                            <input type="file" class="form-control" id="file1" name="file1"  />
									</div>
									<div class="col-md-6 form-group">
									  <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									</div>
									
									
								</div>
							</div>
						
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="row">
								    
									<div class="col-md-4 form-group">
									  <label >Appointment Order</label>
                            <input type="file" class="form-control" id="file2" name="file2"  />
									</div>
									<div class="col-md-4 form-group">
									  <label>Joining Memo</label>
									 <input type="file" class="form-control" id="file3" name="file3"  />
									</div>
										<div class="col-md-4 form-group">
									  <label>Promotion Details</label>
									 <input type="file" class="form-control" id="file4" name="file4"  />
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

<script type="text/javascript">
function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
            return false;
        }

        return true;

}
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var email =  $('#email').val();                   
var password= $('#password').val();



		  if(name.trim()==''){
                    swal("Warning","Enter FullName","warning");
                    return false;
                }
		if(email==''){
                    swal("Warning","Enter Email","warning");
                    return false;
                }
		if(password==''){
                    swal("Warning","Enter Password","warning");
                    return false;
                }
	
                
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/office/saveLogininfo')}}",
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
                     this.reset();
                  //  alert('Staff Login has Created Succesffully');
					//window.location.reload();
					  alert('Non Teaching details has been submitted successfully.Please Note Loginid :'+response[0].emailnew+'& Password:'+response[0].password);
					window.location.href = "{{ url('/office/nonfacultyList')}}";
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

function checkmain(email)
{
$.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url: "{{ url('/office/checkemail')}}",
            type: 'POST',
            data: { email: email },
            dataType: 'json',
           
            success: (response) => {
                if (response) {
                     console.log(response);
alert("Email Already In Use. Please Enter OtherOne");
$('#email').val("");
                }
            },
        });
}
</script>

@endsection