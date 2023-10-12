
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
                    <h4 class="card-title">Teaching Methodology </h4>
                     <div id="mainform">
                  <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                           <div class="form-group">
                        <label for="exampleInputName1">Method</label>	

                        <select class="form-control" name="choosetype" id="choosetype">
        									            <option value="">Select Methods </option>
        									            <option value="Lecture using black board-white board" @if($profile_edit[0]->method == 'Lecture using black board-white board') Selected @endif>Lecture using black board-white board</option>
                                                        <option value="Lecture using ppt" @if($profile_edit[0]->method == 'Lecture using ppt') Selected @endif>Lecture using ppt</option>
                                                        <option value="Practical demonstrations" @if($profile_edit[0]->method == 'Practical demonstrations') Selected @endif>Practical demonstrations</option>
                                                        <option value="Group learning /Discussion" @if($profile_edit[0]->method == 'Group learning /Discussion') Selected @endif>Group learning /Discussion </option>
                                                   		<option value="Case study/ investigations" @if($profile_edit[0]->method == 'Case study/ investigations') Selected @endif>Case study/ investigations </option>
                                                   		<option value="Problem solving" @if($profile_edit[0]->method == 'Problem solving') Selected @endif>Problem solving</option>
                                                   		<option value="Participatory learning" @if($profile_edit[0]->method == 'Participatory learning') Selected @endif>Participatory learning </option>
                                                   		<option value="Peer teaching" @if($profile_edit[0]->method == 'Peer teaching') Selected @endif>Peer teaching </option>
                                                   		<option value="Online Teaching Method" @if($profile_edit[0]->method == 'Online Teaching Method') Selected @endif>Online Teaching Method </option>
                                                   		<option value="ICT – Audio -Visual tool and discussion" @if($profile_edit[0]->method == 'ICT – Audio -Visual tool and discussion') Selected @endif>ICT – Audio -Visual tool and discussion</option>
                                                   		<option value="Content /ingredient analysis" @if($profile_edit[0]->method == 'Content /ingredient analysis') Selected @endif>Content /ingredient analysis</option>
                                                   		<option value="Mapping"  @if($profile_edit[0]->method == 'Mapping') Selected @endif>Mapping</option>
                                                   		<option value="Product making" @if($profile_edit[0]->method == 'Product making') Selected @endif>Product making</option>
                                                   		<option value="Additional assignments -for case study" @if($profile_edit[0]->method == 'Additional assignments -for case study') Selected @endif>Additional assignments -for case study</option>
                                                   		<option value="Extra short-term internship" @if($profile_edit[0]->method == 'Extra short-term internship') Selected @endif>Extra short-term internship</option>
                                                   		<option value="Participation in congresses/expo etc"  @if($profile_edit[0]->method == 'Participation in congresses/expo etc') Selected @endif>Participation in congresses/expo etc</option>
                                                   		<option value="Extra projects or paper works" @if($profile_edit[0]->method == 'Extra projects or paper works') Selected @endif>Extra projects or paper works</option>
        										</select>   
                      </div>
                      
                      	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Batch</label>
									 <input type="text" class="form-control" id="batch" name="batch" placeholder="Enter BATCH" value="{{$profile_edit[0]->batch}}">
									 <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" aria-label="Username" value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-4 form-group">
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
									<div class="col-md-4 form-group">
									  <label>Program</label>
									     <select class="form-control" name="program" id="program" >
            										<option value="">Select Program</option>
            									    @foreach($course as $row)
            								            <option value="{{ $row->course_name }}" @if($profile_edit[0]->program==$row->course_name) Selected @endif >{{ $row->course_name }}</option>
            						            	@endforeach
            									</select>
									</div>
								</div>
							</div>
							
						</div>
					  <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Type</label>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="University of Calicut" @if($profile_edit[0]->category == 'University of Calicut') checked @endif> University of Calicut </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other within State" @if($profile_edit[0]->category == 'Other within State') checked @endif> Other within State </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside State" @if($profile_edit[0]->category == 'Outside State') checked @endif>Outside State </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside Country" @if($profile_edit[0]->category == 'Outside Country') checked @endif> Outside Country </label>
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
var choosetype=$('#choosetype').val();
var program =  $('#program').val();
var batch =  $('#batch').val();
var semester =  $('#semester').val();

var Category =  $('input[name=Category]:checked').val();
var datestart= $('#datestart').val();
var dateend= $('#dateend').val();	
var level=$('#level').val();
var promoter= $('#promoter').val();

      if(choosetype==''){
                    swal("Warning","Please Enter Teaching Methodology","warning");
                    return false;
                }
	  
	   	if(program.trim()==''){
                    swal("Warning","Enter Program","warning");
                    return false;
                }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/faculty/editInfoMethodology')}}",
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
                    alert('Teaching Methodology has been updated successfully');
				window.location.href = "{{ url('/faculty/methodologyList')}}";
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