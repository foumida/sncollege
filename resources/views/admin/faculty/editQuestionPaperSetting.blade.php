
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
                    <h4 class="card-title">QusetionPaper Setting </h4>
                     <div id="mainform">
                  <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Name of Paper</label>
                        <input type="text" class="form-control" id="paper" name="paper" placeholder="Name of Paper" value="{{$profile_edit[0]->name_of_paper}}">
                         <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" aria-label="Username" value="{{$profile_edit[0]->id}}">
                      </div>
                       <div class="form-group">
                        <label for="exampleInputName1">Name of Program</label>
                        <input type="text" class="form-control" id="program" name="program" placeholder="Name of Program" value="{{$profile_edit[0]->name_of_pgm}}">
                      </div>
                      	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Year</label>
									 <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year" value="{{$profile_edit[0]->year}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Semester</label>
									  	 <select class="form-control" name="semester" id="semester">
        									            <option value="">Select </option>
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
									  <label>UG/PG</label>
						            	  <select class="form-control" name="type" Id="type">
        									            <option value="">Select </option>
        									            <option value="UG" @if($profile_edit[0]->classification == 'UG') Selected @endif>UG</option>
                                                        <option value="PG" @if($profile_edit[0]->classification == 'PG') Selected @endif>PG</option>
                                                    
        										</select>    
									</div>
									<div class="col-md-3 form-group">
									  <label>Name Of College/Name Of University</label>
									 <input type="text" class="form-control" id="collegeuniver" name="collegeuniver" placeholder="Enter College/University" value="{{$profile_edit[0]->name_of_colluniversity}}">
									</div>
								</div>
							</div>
							
						</div>
					  <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Type</label>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="University of Calicut" @if($profile_edit[0]->type == 'University of Calicut') checked @endif> University of Calicut </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other within State" @if($profile_edit[0]->type == 'Other within State') checked @endif> Other within State </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside State" @if($profile_edit[0]->type == 'Outside State') checked @endif>Outside State </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside Country" @if($profile_edit[0]->type == 'Outside Country') checked @endif> Outside Country </label>
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
									  <input type="date" class="form-control form-control-lg" id="datestart" name="datestart" aria-label="Username" value="{{$profile_edit[0]->from_date}}">
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend" name="dateend" aria-label="Username" value="{{$profile_edit[0]->to_date}}">
									</div>
								</div>
							</div>
						
								<div class="col-md-3">
            							
                								<label>Recognition category : </label>
                								 <select class="form-control" name="promoter" id="promoter">
        									    	<option value="">Select </option>
        									    	<option value="National"  @if($profile_edit[0]->recognition_category == 'National') Selected @endif>National</option>
                									<option value="International" @if($profile_edit[0]->recognition_category == 'International') Selected @endif>International</option>
                									<option value="University" @if($profile_edit[0]->recognition_category == 'University') Selected @endif>University</option>
                                                    <option value="State" @if($profile_edit[0]->recognition_category == 'State') Selected @endif>State</option>
                                                    <option value="District" @if($profile_edit[0]->recognition_category == 'District') Selected @endif>District</option>
                                                   							
        										</select>    
            							
							        	</div>
							        		<div class="col-md-3">
								 <label>Designation</label>
									  <select class="form-control" name="level" id="level">
										<option value="">Select </option>
        									    	<option value="Chairman" @if($profile_edit[0]->designation == 'Chairman') Selected @endif>Chairman</option>
                									<option value="Co-chairman" @if($profile_edit[0]->designation == 'Co-chairman') Selected @endif>Co-chairman</option>
                									<option value="Member" @if($profile_edit[0]->designation == 'Member') Selected @endif>Member</option>
                                                    <option value="Executive Member" @if($profile_edit[0]->designation == 'Executive Member') Selected @endif>Executive Member</option>
                                                    
        										</select>
							</div>
								<div class="col-md-4 form-group">
									  <label>Upload Document</label>
									   <a style="float:right;" class="btn btn-info mb-2" href="{{url('uploads/facultyduty/'.$profile_edit[0]->document)}}" download="">Download</a>
							    <input type="file" class="form-control" id="file1" name="file1"  />
							    <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->document}}">
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
	    if(paper.trim()==''){
                    swal("Warning","Enter Name of Paper","warning");
                    return false;
                }
	   	if(program.trim()==''){
                    swal("Warning","Enter Program","warning");
                    return false;
                }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/faculty/editInfoQuestionpaper')}}",
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
                    alert('Question Paper Setting has been updated successfully');
				window.location.href = "{{ url('/faculty/QuestionPaperSettingList')}}";
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