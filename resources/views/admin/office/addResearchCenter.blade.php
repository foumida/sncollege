
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
   $saveResearch=url('/office/saveResearch');
  $researchlist=url('/office/researchList');
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
                    <h4 class="card-title">Add Research Centre</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                        
                        	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									
									<div class="col-md-4 form-group">
									  <label>Type</label>
									  <select class="form-control" name="course_type" id="course_type" onchange="check_dd();">
                             <option value="">Select a Type</option>
                             <option value="Research Centers Aided">Research Centers Aided</option>
                             <option value="Research Extension Centers">Research Extension Centers</option>
                             
                         </select>
									</div>
									<div class="col-md-4 form-group">
									  <label> Name Of Centre</label>
									 <input type="text" class="form-control form-control-lg" id="centrename" name="centrename" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Affliated Department</label>
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->id }}">{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
									
								</div>
							</div>
						
						</div>
                     
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <div id="hodres" style="display:none">
								    	<div class="col-md-4 form-group">
									  <label>HOD List</label>
								  <select class="form-control" name="departmenthod" id="departmenthod" >
            										<option value="">Select Hod</option>
            									    @foreach($hod as $row)
            								            <option value="{{ $row->name }}">{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
									</div>
									<div id="facultyres" style="display:none">
										<div class="col-md-4 form-group">
									  <label>Faculties</label>
									 <select class="form-control" name="faculty[]" id="faculty" data-placeholder="Choose a Faculties..."  multiple="" onchange="check_data();">
            										<option value="">Select Faculties</option>
            										<option value="Other">Other</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->name }}">{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
									</div>
									<div id="otherres" style="display:none">
									<div class="col-md-4 form-group">
									  <label>Specify Other</label>
									 <input type="text" class="form-control form-control-lg" id="other" name="other" aria-label="Username">
									</div>
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

function check_data()
{
     if(document.getElementById('faculty').value == "Other") {
        document.getElementById('hodres').style.display = 'none';
        document.getElementById('facultyres').style.display = 'block';
         document.getElementById('otherres').style.display = 'block';
        
    } else
    {
        document.getElementById('hodres').style.display = 'none';
        document.getElementById('facultyres').style.display = 'block';
         document.getElementById('otherres').style.display = 'none';
    }
    
}

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();

var course_type =  $('#course_type').val();                   
var name =  $('#centrename').val();  
var department = $('#department').val();  
           
            if(course_type.trim() ==''){
                    swal("Warning","Select Research  type","warning");
                    return false;
                }
            if(department.trim()==''){
                    swal("Warning","Select A Department","warning");
                    return false;
                }
		 
		  if(name.trim() ==''){
                    swal("Warning","Enter Name of Research Centre","warning");
                    return false;
                }
      
        
    
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$saveResearch}}",
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
                    alert('Research Centre details has been submitted successfully');
					window.location.href = "{{ $researchlist}}";
			
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
</script>
            
@endsection