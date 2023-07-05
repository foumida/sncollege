
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $savefaculty=url('/office/saveFaculty');
  $facultylist=url('/office/facultyList');
    $checkMail=url('/office/checkemail');
   @endphp

 @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
  
  $savefaculty=url('/hod/saveFaculty');
  $facultylist=url('/hod/facultyList');
    $checkMail=url('/hod/checkemail');
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
                    <h4 class="card-title">Add Faculty</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                      </div>
					
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Date of Birth</label>
									 <input type="date" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Date of Joining </label>
									  <input type="date" class="form-control form-control-lg" id="dateofjoining" name="dateofjoining" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
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
									<div class="col-md-4 form-group">
									  <label>Guardian Name</label>
									 <input type="text" class="form-control form-control-lg" id="guardianName" name="guardianName" aria-label="Username">
									</div>
									<div class="col-md-4 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" aria-label="Username">
									</div>
										<div class="col-md-4 form-group">
									  <label>Email</label>
									   <input type="email" class="form-control form-control-lg" id="email" name="email" aria-label="Username" type="email" placeholder="mail@example.com" onblur="checkmain(this.value)">
									</div>
								</div>
							</div>
						
						</div>
						
					
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Department</label>
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->department }}">{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Designation</label>
									  <select class="form-control" name="designation" id="designation" >
										<option value="">Select Designation</option>
										<option value="Professor">Professor</option>
										<option value="Associate Professor">Associate Professor</option>
									    <option value="Assistant Professor & Research Guide">Assistant Professor & Research Guide</option>
										<option value="Assistant Professor">Assistant Professor</option>
										<option value="Guest Faculty">Guest Faculty</option>
										<option value="None">None</option>
											</select>
									</div>
										<div class="col-md-4 form-group">
									  <label>Position</label>
									  <select class="form-control" name="Position[]" id="lstSelect" multiple>
									
										<option value="Principal">Principal</option>
										<option value="VicePrincipal">Vice Principal</option>
										<option value="HOD">HOD</option>
										<option value="SelfFinancingDirector">Self Financing Director</option>
										<option value="IQACCoordinator">IQAC Coordinator</option>
										<option value="NAACCoordinator">NAAC Coordinator</option>
										<option value="ResearchNodalOfficer">Research Nodal Officer</option>
										<option value="StaffSecretary">Staff Secretary</option>
										<option value="NodalOfficer-Admission">Nodal Officer - Admission</option>
										<option value="NodalOfficer-Examination">Nodal Officer - Examination</option>
										<option value="PublicInformationOfficer(PIO)">Public Information Officer (PIO)</option>
										<option value="PublicRelationOfficer(PRO)">Public Relation  Officer (PRO)</option>
										<option value="PTASecretary">PTA Secretary</option>
										<option value="Superintendent">Superintendent</option>
										<option value="HeadAccountant(HA)">Head Accountant (HA)</option>
										<option value="None">None</option>
											</select>
									</div>
									
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <label><b> Membership Isproffessional Academic Body</b></label>
									<div class="col-md-6 form-group">
									  <label>Name of the body</label>
									 <input type="text" class="form-control form-control-lg" id="academicbody" name="academicbody" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>University/Institution</label>
									  	 <select class="form-control" name="university" id="university" >
            										<option value="">Select </option>
            										<option value="govt">Government</option>
            										<option value="nongovt">Non Govt</option>
            										<option value="semigovt">Semi Govt</option>
            										</select>
									</div>
									
									
								</div>
							</div>
						
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Address</label>
                            <textarea class="form-control"  id="address" name="address" rows="10" cols="100"></textarea>
                         </div>
						 	 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Qualification</label>
                            <textarea class="form-control"  id="qualification" name="qualification" rows="10" cols="100"></textarea>
                         </div>
						  <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control"  id="description" name="description" rows="10" cols="100"></textarea>
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
var guardianName =  $('#guardianName').val();                   
var dateofbirth= $('#dateofbirth').val();
var dateofjoining= $('#dateofjoining').val();	
var gender= $('#gender').val();	
var phonenum =  $('#phonenum').val();;
var email =  $('#email').val();;

var department= $('#department').val();
var designation= $('#designation').val();
var address= $('#address').val();
var qualification= $('#qualification').val();
var description= $('#description').val();

var position = [];    
    $("#lstSelect :selected").each(function(){
        position.push($(this).val()); 
    });
var positiondata = position.toString();


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
			
			
			
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/office/saveFaculty')}}",
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
					window.location.href = "{{ url('/office/facultyList')}}";
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
			url: "{{$checkMail}}",
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