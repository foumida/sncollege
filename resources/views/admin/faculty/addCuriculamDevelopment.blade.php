
@extends('layouts.faculty.default')

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
            
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  
                </ol>
              </nav>
            </div>
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Participation in Design & Development of Curriculum </h4>
                     <div id="mainform">
                  <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
                       <div class="form-group">
                        <label for="exampleInputName1">Name of Program</label>
                        <input type="text" class="form-control" id="program" name="program" placeholder="Name of Program">
                      </div>
                      	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Year</label>
									 <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year">
									</div>
									<div class="col-md-3 form-group">
									  <label>Semester</label>
									  	 <select class="form-control" name="semester" id="semester">
        									            <option value="">Select </option>
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
									  <label>UG/PG</label>
						            	  <select class="form-control" name="type" Id="type">
        									            <option value="">Select </option>
        									            <option value="UG">UG</option>
                                                        <option value="PG">PG</option>
                                                        <option value="PhD">PhD</option>
                                                        <option value="Certificate">Certificate</option>
                                                        <option value="Add on">Add on</option>
                                                        <option value="Diploma">Diploma</option>
                                                        <option value="Others">Others</option>
        										</select>    
									</div>
									<div class="col-md-3 form-group">
									  <label>Name Of College/Name Of University</label>
									 <input type="text" class="form-control" id="collegeuniver" name="collegeuniver" placeholder="Enter College/University">
									</div>
								</div>
							</div>
							
						</div>
					  <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Type</label>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="University of Calicut" checked> University of Calicut </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other within State"> Other within State </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside State" >Outside State </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside Country"> Outside Country </label>
                              </div>
                            </div>
						
							 
							</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="col-form-label">Range</label>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>Date Start</label>
									  <input type="date" class="form-control form-control-lg" id="datestart" name="datestart" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend" name="dateend" aria-label="Username">
									</div>
								</div>
							</div>
						
								<div class="col-md-3">
            							
                								<label>Recognition category : </label>
                								 <select class="form-control" name="promoter" id="promoter">
        									    	<option value="">Select </option>
        									    	<option value="National">National</option>
                									<option value="International">International</option>
                									<option value="University">University</option>
                                                    <option value="State">State</option>
                                                    <option value="District">District</option>
                                                   							
        										</select>    
            							
							        	</div>
							        		<div class="col-md-3">
								 <label>Designation</label>
									  <select class="form-control" name="level" id="level">
										<option value="">Select </option>
        									    	<option value="Chairman">Chairman</option>
                									<option value="Co-chairman">Co-chairman</option>
                									<option value="Member">Member</option>
                                                    <option value="Executive Member">Executive Member</option>
                                                    
        										</select>
							</div>
								<div class="col-md-4 form-group">
									  <label>Upload Document</label>
							    <input type="file" class="form-control" id="file1" name="file1"  />
									</div>
						</div>
				
					
						  <div class="form-group">
						
					<button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Submit</button> 
					</form>
					</div>
				</div>
			
			
              </div>
            </div>
          </div>
          </div>
          </div>
          </div>
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var paper =  $('#paper').val();
var program =  $('#program').val();
var year =  $('#year').val();
var semester =  $('#semester').val();
var type =  $('#type').val();
var collegeuniver =  $('#collegeuniver').val();
var Category =  $('input[name=Category]:checked').val();
var datestart= $('#datestart').val();
var dateend= $('#dateend').val();	
var level=$('#level').val();
var promoter= $('#promoter').val();
	   
	   	if(program.trim()==''){
                    swal("Warning","Enter Program","warning");
                    return false;
                }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/faculty/storeCuriculamDevelopment')}}",
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
                    alert('Curiculam Development has been submitted successfully');
				window.location.href = "{{ url('/faculty/CuriculamDevelopmentList')}}";
                }
            },
        });
    });
});

 </script>

<script type="text/javascript">

	$(document).ready(function(){
$('#datestart').blur( function(){
     $('#dateend').val($(this).val());
});
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