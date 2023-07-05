
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
 
  $researchfellowlist=url('/office/researchFellowList');
  $editinfo=url('/office/editInfoResearchFellow');
  $fetchsupervisor  = url('/office/fetchSupervisor');
  $fetchguide  = url('/office/fetchguide');
 @endphp
 @elseif(Auth::User()->role == 8)
   @php $type = "layouts.researchfellow.default";
    $researchfellowlist= url('/researchfellow/dashboardfellow');
 $editinfo=url('/researchfellow/editInfoResearchFellow');
  $fetchsupervisor  = url('/researchfellow/fetchSupervisor');
   $fetchguide  = url('/researchfellow/fetchguide');
   @endphp
 @endif


@extends($type)

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
                    <h4 class="card-title">Edit Research Fellow</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->name}}">
                          <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" value="{{$profile_edit[0]->id}}">
                      </div>
					
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <div class="col-md-3 form-group">
									  <label>You Belongs to Faculty?</label>
									 <select class="form-control" name="facultybelong" id="facultybelong" >
										<option value="">Select</option>
										<option value="Yes" @if($profile_edit[0]->is_belongs_to_faculty == 'Yes') Selected @endif>Yes</option>
										<option value="No" @if($profile_edit[0]->is_belongs_to_faculty == 'No') Selected @endif>No</option>
									
											</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Date of Birth</label>
									 <input type="date" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth" aria-label="Username" value="{{$profile_edit[0]->dob}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Date of Joining </label>
									  <input type="date" class="form-control form-control-lg" id="dateofjoining" name="dateofjoining" aria-label="Username" value="{{$profile_edit[0]->date_of_join}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Gender</label>
								 <select class="form-control" name="gender" id="gender" >
            										<option value="">Select Gender</option>
            										<option value="Male" @if($profile_edit[0]->gender == 'Male') Selected @endif>Male</option>
            										<option value="Female" @if($profile_edit[0]->gender == 'Female') Selected @endif>Female</option>
            										</select>
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>Guardian Name</label>
									 <input type="text" class="form-control form-control-lg" id="guardianName" name="guardianName" aria-label="Username" value="{{$profile_edit[0]->guardian}}">
									</div>
									<div class="col-md-6 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username" value="{{$profile_edit[0]->phone_number}}">
									</div>
									
								</div>
							</div>
						
						</div>
						
					
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Research Centre</label>
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Centre</option>
            									    @foreach($centers as $row)
            								            <option value="{{ $row->id }}" @if($row->id==$profile_edit[0]->research_centre) Selected @endif>{{ $row->name_research_centre }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Name of Supervisor</label>
							    <select id="state-supervisor" class="form-control form-control-lg" name="supervisor" id="supervisor" value="{{$profile_edit[0]->phone_number}}">
                                </select>
                                </div>
									<div class="col-md-3 form-group">
									  <label>Designation</label>
									  <select class="form-control" name="designation" id="designation" >
										<option value="">Select Designation</option>
										<option value="Ph.D. (part-time)" @if($profile_edit[0]->designation == 'Ph.D. (part-time)') Selected @endif>Ph.D. (part-time)</option>
										<option value="Ph.D. (full-time)" @if($profile_edit[0]->designation == 'Ph.D. (full-time)') Selected @endif>Ph.D. (full-time)</option>
										<option value="Research Associate" @if($profile_edit[0]->designation == 'Research Associate') Selected @endif>Research Associate</option>
									
										<option value="Project Fellow" @if($profile_edit[0]->designation == 'Project Fellow') Selected @endif>Project Fellow</option>
										<option value="Project Assistant" @if($profile_edit[0]->designation == 'Project Assistant') Selected @endif>Project Assistant</option>
										<option value="Technical Assistant" @if($profile_edit[0]->designation == 'Technical Assistant') Selected @endif>Technical Assistant</option>
										<option value="Intern" @if($profile_edit[0]->designation == 'Intern') Selected @endif>Intern</option>
											</select>
											

									</div>
										<div class="col-md-3 form-group">
									  <label>Department</label>
								  <select class="form-control" name="department_original" id="department_original" >
            										<option value="">Select Department</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->department }}" @if($row->department==$profile_edit[0]->department) Selected @endif>{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Title of Research</label>
									 <input type="text" class="form-control form-control-lg" id="titleresearch" name="titleresearch" aria-label="Username" value="{{$profile_edit[0]->research_title}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Subject Keyword 1</label>
							  	 <input type="text" class="form-control form-control-lg" id="subkeyword" name="subkeyword" aria-label="Username" value="{{$profile_edit[0]->subject_one}}">
							  	 <label>Subject Keyword 2</label>
							  	 <input type="text" class="form-control form-control-lg" id="subkeywordtwo" name="subkeywordtwo" aria-label="Username" value="{{$profile_edit[0]->subject_two}}">
							  	 <label>Subject Keyword 3</label>
							  	 <input type="text" class="form-control form-control-lg" id="subkeywordthree" name="subkeywordthree" aria-label="Username" value="{{$profile_edit[0]->subject_three}}">
                                </div>
									<div class="col-md-4 form-group">
									 <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									   <input type="hidden" name="current_file_img" id="current_file_img" value="{{$profile_edit[0]->picture}}">
									   <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/student/'.$profile_edit[0]->picture)}}" /></span>
											

									  <label>Upload Registration Order<br> <small>(Pdf Files Accepted)</small></label>
							    <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->reg_award)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file1" id="file1" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->reg_award}}">
									<label>Joining Memo  <small>(Pdf Files Accepted)</small></label>
							   <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->memo)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file2" id="file2" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file2" value="{{$profile_edit[0]->memo}}">
							    	<label>PQE  <small>(Pdf Files Accepted)</small></label>
							    	 <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->pqe)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file3" id="file3" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file3" value="{{$profile_edit[0]->pqe}}">
							    
							    	<label>Research Award  <small>(Pdf Files Accepted)</small></label>
							    <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/student/'.$profile_edit[0]->research_award)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file4" id="file4" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file4" value="{{$profile_edit[0]->research_award}}">
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
  $(document).ready(function () {
      var idSupervisor =<?=$profile_edit[0]->guide_name;?>;
    
         $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{$fetchguide}}",
                    type: "POST",
                    data: {
                        idSupervisor: idSupervisor,
                    },
                    dataType: 'json',
                    success: function (result) {
                       
                        $("#state-supervisor").append('<option value="' + result.id + '">' + result.supervisor_name + '</option>');
                        
                    
                    }
                });
                
      
   $('#department').on('change', function () {
                var idSupervisor =this.value;
               
                $("#state-supervisor").html('');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{$fetchsupervisor}}",
                    type: "POST",
                    data: {
                        idSupervisor: idSupervisor,
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-supervisor').html('<option value="">-- Select Supervisor --</option>');
                        $.each(result.supervisor, function (key, value) {
                            $("#state-supervisor").append('<option value="' + value.id + '">' + value.supervisor_name + '</option>');
                        });
                      
                    }
                });
            });
  });

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var guardianName =  $('#guardianName').val();                   
var dateofbirth= $('#dateofbirth').val();
var dateofjoining= $('#dateofjoining').val();	
var gender= $('#gender').val();	
var phonenum =  $('#phonenum').val();
var email =  $('#email').val();;

var department= $('#department').val();
var supervisor= $('#supervisor').val();
var titleresearch= $('#titleresearch').val();
var facultybelong=$('#facultybelong').val();



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
                
		  if(phonenum ==''){
                    swal("Warning","Enter Phone Number","warning");
                    return false;
                }
	    	if(email ==''){
                    swal("Warning","Enter Email","warning");
                    return false;
                }
		if(department ==''){
                    swal("Warning","Enter Research Centre","warning");
                    return false;
                }
			
		if(supervisor ==''){
                    swal("Warning","Enter Supervisor","warning");
                    return false;
                }
    	if(titleresearch ==''){
                    swal("Warning","Title of Research","warning");
                    return false;
                }
                	if(facultybelong ==''){
                    swal("Warning","Please Enter Whether you belongs to faculty","warning");
                    return false;
                }
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$editinfo}}",
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
                    alert('Research Fellow details has been submitted successfully');
					window.location.href = "{{$researchfellowlist}}";
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