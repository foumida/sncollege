@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $saveCell=url('/office/saveCell');
  $checkMail=url('/office/checkemail');
  $cellList=url('/office/cellList');
   @endphp

 @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
  
  $saveCell=url('/hod/saveCell');
 $checkMail=url('/hod/checkemail');
  $cellList=url('/hod/cellList');
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
                    <h4 class="card-title">Add Cell</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Name of Cell</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                      </div>
					 <div class="form-group">
                        <label for="exampleInputName1">Category</label>
                        <select class="form-control" name="type" id="type" >
            										<option value="">---Select---</option>
            									  
            								            <option value="WebCell">WebCell</option>
            						                    <option value="Club">Club</option>
														<option value="Commities">Commities</option>
														<option value="Infrastructure">Infrastructure</option>
														<option value="ITFacility">ITFacility</option>
														<option value="ICT">ICT</option>
														<option value="Research and Innovation">Research and Innovation</option>
														<option value="Academic Devlopment">Academic Devlopment</option>
            									</select>
                      </div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Date of Affliation</label>
									 <input type="date" class="form-control form-control-lg" id="dateofaffliation" name="dateofaffliation" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Unit Number </label>
									  <input type="text" class="form-control form-control-lg" id="unitnumber" name="unitnumber" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>No Of Unit </label>
									  <input type="text" class="form-control form-control-lg" id="noofunit" name="noofunit" aria-label="Username">
									</div>
										<div class="col-md-3 form-group">
									  <label>Email </label>
									  <input type="email" class="form-control form-control-lg" id="email" name="email" aria-label="Username" type="email" placeholder="mail@example.com" onblur="checkmain(this.value)">
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row"> <h4> Current Enroll</h4>
									<div class="col-md-3 form-group">
									  <label>Boys</label>
									 <input type="text" class="form-control teachernew" id="boys" name="boys" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Girls</label>
									  <input type="text" class="form-control teachernew" id="girls" name="girls"  aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Others</label>
									  <input type="text" class="form-control teachernew" id="others" name="others"  aria-label="Username">
									</div>	
									<div class="col-md-3 form-group">
									  <label>Total</label>
									  <input type="text" class="form-control total" id="total" name="total"  aria-label="Username">
									</div>
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Associated Department</label>
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->department }}">{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Name of co-ordinator</label>
									 <select class="form-control" name="coordinator" id="coordinator" >
            										<option value="">Select Cordinator</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->fid }}">{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
										<div class="col-md-4 form-group">
									  <label>Sub Cordinator</label>
									   <select class="form-control" name="subcordinator" id="subcordinator" >
            										<option value="">Select Sub Cordinator</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->name }}">{{ $row->name }}</option>
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
									  <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									  
									</div>
									<div class="col-md-4 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Previous Report </label>
									   <input type="file" class="form-control" id="file1" name="file1"  />
									</div>
								
								</div>
							</div>
						
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Address</label>
                            <textarea class="form-control"  id="address" name="address" rows="10" cols="100"></textarea>
                         </div>
						 	 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Affliated With</label>
                            <textarea class="form-control"  id="affliated" name="affliated" rows="10" cols="100"></textarea>
                         </div>
						  <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control"  id="description" name="description" rows="10" cols="100"></textarea>
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
$(document).ready(function(){
$(".teachernew").on("change", function(){
   var total=0;
      $(".teachernew").each(function(){
          if(!isNaN(parseInt($(this).val())))
          {
            total+=parseInt($(this).val());  
          }
      });
      $(".total").val(total);
});
})
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var dateofaffliation =  $('#dateofaffliation').val();                   
var email= $('#email').val();
var coordinator= $('#coordinator').val();	


		  if(name.trim()==''){
                    swal("Warning","Enter CellName","warning");
                    return false;
                }
		 if(dateofaffliation ==''){
                    swal("Warning","Enter Date Of Affliation","warning");
                    return false;
                }
        if(coordinator.trim()==''){
                    swal("Warning","Enter Coordinator","warning");
                    return false;
                }
    	if(email ==''){
                    swal("Warning","Enter Email","warning");
                    return false;
                }
			
  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ $saveCell}}",
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
                    alert('Cell details has been submitted successfully');
					window.location.href = "{{ $cellList}}";
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

function checkmain(email)
{
   
$.ajax({
 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
url: "{{ $checkMail}}",
type: 'POST',
data: { email: email },
}).done(function(response) {
if(response == "Email Already In Use.")
{
alert("Email Already In Use. Please Enter OtherOne");
$('#email').val("");
}
});
}
</script>

@endsection