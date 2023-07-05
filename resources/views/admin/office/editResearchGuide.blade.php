
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
 
  $researchguidelist=url('/office/researchGuideList');
  $editinfo=url('/office/editInfoResearchGuide');
  $fetchresearchtype = url('/office/fetchResearch_type');
 @endphp
 @elseif(Auth::User()->role == 7)
   @php $type = "layouts.research.default";
    $researchguidelist= url('/researchguide/dashboard');
 $editinfo=url('/researchguide/editInfoResearchGuide');
  $fetchresearchtype = url('/researchguide/fetchResearch_type');
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
                    <h4 class="card-title">Edit Research Guide</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                        
                        	<div class="form-group row">
						
							<div class="col-md-12">
							
									<div class="col-md-12 form-group">
									  <label>Name Of Research Supervisor</label>
								   <input type="text" class="form-control form-control-lg" id="supervisor" name="supervisor" value="{{$profile_edit[0]->supervisor_name}}">
								   <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-12 form-group">
									  <label>You Belongs to Faculty?</label>
									 <select class="form-control" name="facultybelong" id="facultybelong" >
										<option value="">Select</option>
										<option value="Yes" @if($profile_edit[0]->is_belongs_to_faculty == 'Yes') Selected @endif>Yes</option>
										<option value="No" @if($profile_edit[0]->is_belongs_to_faculty == 'No') Selected @endif>No</option>
									</select>
									</div>
								</div>
							</div>
						
						</div>
                     
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								   
								    	<div class="col-md-4 form-group">
									  <label>Designation</label>
								  <select class="form-control" name="designation" id="designation" >
            										<option value="Director" @if($profile_edit[0]->designation == 'Director') Selected @endif>Director </option>
            									  	<option value="Joint Coordinator" @if($profile_edit[0]->designation == 'Joint Coordinator') Selected @endif>Joint Coordinator </option>
            									  	<option value="Coordinator" @if($profile_edit[0]->designation == 'Coordinator') Selected @endif>Coordinator </option>
            									  	<option value="Assi. Professor" @if($profile_edit[0]->designation == 'Assi. Professor') Selected @endif>Assi. Professor </option>
            									  	<option value="Associate Professor" @if($profile_edit[0]->designation == 'Associate Professor') Selected @endif>Associate Professor </option>
            									  	<option value="Professor" @if($profile_edit[0]->designation == 'Professor') Selected @endif>Professor </option>
            									  	<option value="Program Coordinator" @if($profile_edit[0]->designation == 'Program Coordinator') Selected @endif>Program Coordinator </option>
            									  	<option value="Visiting Faculty" @if($profile_edit[0]->designation == 'Visiting Faculty') Selected @endif>Visiting Faculty</option>
            									  		<option value="Other" @if($profile_edit[0]->designation == 'Other') Selected @endif>Other </option>
            									</select>
									</div>
									
									<div class="col-md-4 form-group">
									  <label>Parent Institution</label>
								 	 <input type="text" class="form-control form-control-lg" id="parentinst" name="parentinst" aria-label="Username" value="{{$profile_edit[0]->parentinstitute}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Research Domain</label>
								 	 <input type="text" class="form-control form-control-lg" id="domain" name="domain" aria-label="Username" value="{{$profile_edit[0]->domain}}">
									</div>
								</div>
							</div>
						
						</div>
					
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								   
									
									<div class="col-md-6 form-group">
									  <label>Subject</label>
								 	 <input type="text" class="form-control form-control-lg" id="subject" name="subject" aria-label="Username" value="{{$profile_edit[0]->subject}}">
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
								    
									<div class="col-md-4 form-group">
									  <label >Resume</label>
                            
                             <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/facultyresume/'.$profile_edit[0]->resume)}}" download="">Download</a>
							    <input type="file" class="form-control" id="file1" name="file1"  />
							    <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->resume}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Profile Picture</label>
									  	<input type="file" class="form-control" id="image" name="image"  />
									  <input type="hidden" name="current_file_img" id="current_file_img" value="{{$profile_edit[0]->picture}}">
									   <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/facultyimg/'.$profile_edit[0]->picture)}}" /></span>
									</div>
										<div class="col-md-4 form-group">
									  <label >GuideShip Order</label>
                              <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/facultyresume/'.$profile_edit[0]->guide_shiporder)}}" download="">Download</a>
							    <input type="file" class="form-control" id="file2" name="file2"  />
							    <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file1" value="{{$profile_edit[0]->guide_shiporder}}">
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
function check_dd() {
     if(document.getElementById('course_type').value == "Research Centers Aided") {
        document.getElementById('hodres').style.display = 'block';
        document.getElementById('facultyres').style.display = 'none';
         document.getElementById('otherres').style.display = 'none';
        
    } 
     if(document.getElementById('course_type').value == "Research Extension Centers") {
        document.getElementById('hodres').style.display = 'none';
        document.getElementById('facultyres').style.display = 'block';
        document.getElementById('otherres').style.display = 'none';
    } 
    
}
  $('#centername').on('change', function () {
                var idCenter = this.value;
              // alert(idCenter);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{$fetchresearchtype}}",
                    type: "POST",
                    data: {
                        idCenter: idCenter,
                    },
                    dataType: 'json',
                    success: function (result) {
                      if (result == null) {
                         
                      } else {
                        $("#type").val(result[0]['type']);
                      }
                    }
                });
            });



$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();

var supervisor =  $('#supervisor').val();                   
var designation =  $('#designation').val();  
var domain = $('#domain').val();  
var phonenum =  $('#phonenum').val();
var facultybelong=$('#facultybelong').val();
           
            if(supervisor.trim() ==''){
                    swal("Warning","Enter Name Of Research Supervisor","warning");
                    return false;
                }
            if(designation.trim()==''){
                    swal("Warning","Select Designation","warning");
                    return false;
                }
		 
		  if(domain.trim() ==''){
                    swal("Warning","Enter Research Domain","warning");
                    return false;
                }
         if(phonenum ==''){
                    swal("Warning","Enter Phone Number","warning");
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
                    alert('Research Guide data has been updated successfully');
					window.location.href = "{{ $researchguidelist}}";
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
    var match = ['application/pdf', 'application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if(!((fileType == match[0]) || (fileType == match[1])  || (fileType == match[2]))){
        alert('Sorry only Pdf or Word files are allowed to upload.');
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
</script>
            
@endsection