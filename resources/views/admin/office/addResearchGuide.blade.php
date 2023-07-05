
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
   $saveResearchGuide=url('/office/saveResearchGuide');
  $researchguidelist=url('/office/researchGuideList');
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
                    <h4 class="card-title">Add Research Guide</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                        
                        	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									
									<div class="col-md-3 form-group">
									  <label>Select Research Centers</label>
								  <select class="form-control" name="centername" id="centername" >
            										<option value="">Select Centers</option>
            									    @foreach($centers as $row)
            								            <option value="{{ $row->id }}">{{ $row->name_research_centre }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-3 form-group">
									  <label> Type </label>
									 <input type="text" class="form-control form-control-lg" id="type" name="type" >
									</div>
									<div class="col-md-3 form-group">
									  <label>Name Of Research Supervisor</label>
								   <input type="text" class="form-control form-control-lg" id="supervisor" name="supervisor">
									</div>
										<div class="col-md-3 form-group">
									  <label>You Belongs to Faculty?</label>
									 <select class="form-control" name="facultybelong" id="facultybelong" >
										<option value="">Select</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
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
            											<option value="Director">Director </option>
            									  	<option value="Joint Coordinator">Joint Coordinator </option>
            									  	<option value="Coordinator">Coordinator </option>
            									  	<option value="Assi. Professor">Assi. Professor </option>
            									  	<option value="Associate Professor">Associate Professor </option>
            									  	<option value="Professor">Professor </option>
            									  	<option value="Program Coordinator">Program Coordinator </option>
            									  	<option value="Visiting Faculty">Visiting Faculty</option>
            									  		<option value="Other">Other </option>
            									</select>
									</div>
									
									<div class="col-md-4 form-group">
									  <label>Parent Institution</label>
								 	 <input type="text" class="form-control form-control-lg" id="parentinst" name="parentinst" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Research Domain</label>
								 	 <input type="text" class="form-control form-control-lg" id="domain" name="domain" aria-label="Username">
									</div>
								</div>
							</div>
						
						</div>
					
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								   
									
									<div class="col-md-4 form-group">
									  <label>Subject</label>
								 	 <input type="text" class="form-control form-control-lg" id="subject" name="subject" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Email</label>
								 	 <input type="email" class="form-control form-control-lg" id="email" name="email" aria-label="Username">
									</div>
									 <div class="col-md-4 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username">
									</div>
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    
									<div class="col-md-4 form-group">
									  <label >Resume</label>
                            <input type="file" class="form-control" id="file1" name="file1"  />
									</div>
									<div class="col-md-4 form-group">
									  <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									</div>
										<div class="col-md-4 form-group">
									  <label >GuideShip Order</label>
                            <input type="file" class="form-control" id="file2" name="file2"  />
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
               
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{url('/office/fetchResearch_type')}}",
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
			url:"{{$saveResearchGuide}}",
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
                  
                    alert('Research Guide details has been submitted successfully.Please Note Loginid :'+response[0].emailnew+'& Password:'+response[0].password);
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