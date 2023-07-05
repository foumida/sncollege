@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
   
   $editFacultyinfo= url('/admin/editNonFacultyinfo');
     $facultylist= url('/admin/nonfacultyList');
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
    $facultylist= url('/office/nonfacultyList');
  $editFacultyinfo= url('/office/editNonFacultyinfo');
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
									  <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" aria-label="Username" value="{{$profile_edit[0]->id}}">
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
									
									<div class="col-md-6 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username" value="{{$profile_edit[0]->phone_number}}">
									</div>
										<div class="col-md-6 form-group">
									  <label>Category</label>
								 <select class="form-control" name="category" id="category" >
            										<option value="">Select Aided/Temporary</option>
            										<option value="Aided" @if($profile_edit[0]->aided_temp=='Aided') Selected @endif>Aided</option>
            										<option value="Temporary"  @if($profile_edit[0]->aided_temp=='Temporary') Selected @endif>Temporary</option>
            										</select>
									</div>
								</div>
							</div>
						
						</div>
						
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Department</label>
									   <input type="text" class="form-control form-control-lg" id="dept" name="dept" value="{{$profile_edit[0]->department}}" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Designation</label>
									 <input type="text" class="form-control form-control-lg" id="designation" name="designation" value="{{$profile_edit[0]->designation}}" aria-label="Username">
									</div>
										<div class="col-md-4 form-group">
									  <label>Name Of Section </label>
									  <input type="date" class="form-control form-control-lg" id="section" name="section" aria-label="Username" value="{{$profile_edit[0]->name_of_section	}}">
									</div>
								
								</div>
							</div>
						
						</div>
						
                         
						 <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Resume</label><a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/nonfaculty/'.$profile_edit[0]->resume)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file1" id="file1" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->resume}}">
                         </div>
                        
                          <div class="form-group">
						    
                             <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									  <input type="hidden" name="current_file_img" id="current_file_img" value="{{$profile_edit[0]->profile_picture}}">
									   <span class="pl-2"><img width="20%" height="100" src="{{url('public/uploads/nonfaculty/'.$profile_edit[0]->	profile_picture)}}" >  </span> 
                         </div>
						 <div class="form-group">
						    
                              <label for="exampleInputName1" style="float:left;">Appointment Order</label><a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/nonfaculty/'.$profile_edit[0]->appointment_order)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file2" id="file2" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file2" value="{{$profile_edit[0]->appointment_order}}">
                         </div>
						  <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Joining Memo</label>  
							 <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/nonfaculty/'.$profile_edit[0]->joining_memo)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file3" id="file3" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file3" value="{{$profile_edit[0]->	joining_memo}}">
                         </div>
						 <div class="form-group">
						    
                             <label for="exampleInputName1" style="float:left;">Promotion Details</label> 
 <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/nonfaculty/'.$profile_edit[0]->promotion_details)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file4" id="file4" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file4" value="{{$profile_edit[0]->		promotion_details}}">							 
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


  if(name.trim()==''){
                    swal("Warning","Enter FullName","warning");
                    return false;
                }
	
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ $editFacultyinfo }}",
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
					window.location.href = "{{ $facultylist}}";
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