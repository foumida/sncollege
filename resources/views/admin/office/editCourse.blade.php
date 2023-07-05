@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
   
   $editCourseinfo= url('/admin/saveCourseinfo'); 
     $courselist= url('/admin/courseList'); 
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
    $courselist= url('/office/courseList');
  $editCourseinfo= url('/office/saveCourseinfo');
   @endphp
     @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
  $courselist= url('/hod/courseList');
  $editCourseinfo= url('/hod/saveCourseinfo');
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
                    <h4 class="card-title">Edit Program</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                        
                        	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label> Department</label>
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->id }}"  @if($profile_edit[0]->departments==$row->id) Selected @endif>{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Program Type</label>
									  <select class="form-control" name="course_type" id="course_type" onchange="makeSubmenu(this.value)">
                             <option value="">Select a Type</option>
                             <option value="UG"  @if($profile_edit[0]->course_type=='UG') Selected @endif>UG</option>
                             <option value="PG" @if($profile_edit[0]->course_type=='PG') Selected @endif>PG</option>
                             <option value="PhD" @if($profile_edit[0]->course_type=='PhD') Selected @endif>PhD</option>
                             <option value="Certificate" @if($profile_edit[0]->course_type=='Certificate') Selected @endif>Certificate</option>
							  <option value="Diploma"  @if($profile_edit[0]->course_type=='Diploma') Selected @endif>Diploma</option>
							  <option value="AddOn" @if($profile_edit[0]->course_type=='AddOn') Selected @endif>AddOn Programmes</option>
                         </select>
									</div>
										<div class="col-md-4 form-group">
									  <label>Sub Division </label>
								 <select class="form-control " name="sub_division" id="categorySelect">
                             <option value="" @if($profile_edit[0]->sub_division==$profile_edit[0]->sub_division) Selected @endif>{{$profile_edit[0]->sub_division}}</option>
                            <option></option>
                         </select>
									</div>
									
								</div>
							</div>
						
						</div>
                     
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <div class="col-md-4 form-group">
									  <label>Program Name</label>
									 <input type="text" class="form-control form-control-lg" id="name" name="coursename" value="{{$profile_edit[0]->course_name}}" aria-label="Username">
									   <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Program Code</label>
									 <input type="text" class="form-control form-control-lg" id="code" name="coursecode" aria-label="Username" value="{{$profile_edit[0]->course_code}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Program Credit</label>
									 <input type="text" class="form-control form-control-lg" id="credit" name="coursecredit" aria-label="Username" value="{{$profile_edit[0]->course_credit}}">
									</div>
								
								</div>
							</div>
						
						</div>
					
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <div class="col-md-6 form-group">
									  <label>Date of Introduction</label>
									 <input type="date" class="form-control form-control-lg" id="dateofaffliation" name="dateofaffliation" aria-label="Username" value="{{$profile_edit[0]->date_of_intro}}">
									</div>
									<div class="col-md-6 form-group">
									  <label>Faculties</label>
									 <select class="form-control" name="faculty[]" id="faculty" data-placeholder="Choose a Faculties..."  multiple="">
            										<option value="">Select Faculties</option>
            										 <?php
                                                    // explode the saved data back into an array                    
                                                    $facultiesexplode = explode(',', $profile_edit[0]->faculties);
                                                    
                                                    ?>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->name }}" {{ in_array($row->name, $facultiesexplode) ? 'selected' : '' }} >{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
								<!--	<div class="col-md-4 form-group">
									  <label>Tutor</label>
									 
									 <select class="form-control" name="tutor" id="tutor" >
            										<option value="">Select Tutor</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->name }}" @if($profile_edit[0]->tutor==$row->name) Selected @endif>{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div> -->
								
								</div>
							</div>
						
						</div>
						
						
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
										<div class="col-md-4 form-group">
									  <label>Add Syllabus</label> <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/course/'.$profile_edit[0]->syllabus)}}" download="">Download</a>
									  <input type="file" class="form-control" id="file1" name="file1"  />
									  <small> (Only PDF/Word Files Accepted)</small>
									  <input type="hidden" name="current_file" value="{{$profile_edit[0]->syllabus}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Max Intake </label>
									  <input type="text" class="form-control form-control-lg" id="maxintake" name="maxintake" aria-label="Username" value="{{$profile_edit[0]->maxintake}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Select Tenure </label>
									  <select name="tenure" class="form-control" id="tenure" name="tenure">
							 <option selected disabled>Select Tenure</option>
							  <option value="3 Months" @if($profile_edit[0]->tenure=='3 Months') Selected @endif>3 Months</option>
							 <option value="1 Semester" @if($profile_edit[0]->tenure=='1 Semester') Selected @endif>1 Semester</option>
                             <option value="2 Semester"  @if($profile_edit[0]->tenure=='2 Semester') Selected @endif>2 Semester</option>
                             <option value="4 Semester" @if($profile_edit[0]->tenure=='4 Semester') Selected @endif>4 Semester</option>
                             <option value="5 Semester" @if($profile_edit[0]->tenure=='5 Semester') Selected @endif>5 Semester</option>
                             <option value="6 Semester" @if($profile_edit[0]->tenure=='6 Semester') Selected @endif>6 Semester</option>
                             <option value="7 Semester" @if($profile_edit[0]->tenure=='7 Semester') Selected @endif>7 Semester</option>
                             <option value="8 Semester" @if($profile_edit[0]->tenure=='8 Semester') Selected @endif>8 Semester</option>
                           
							 </select>
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
        var subcategory = {
            UG: ["BA", "BSC", "Bcom", "Bvoc"],
            PG: ["MA", "MSC", "Mcom","Mvoc"],
            Certificate: ["Diploma", "Advanced Diploma", "Certificate", "Mooc"],
           
        }

        function makeSubmenu(value) {
            if (value.length == 0) document.getElementById("categorySelect").innerHTML = "<option></option>";
            else {
                var citiesOptions = "NA";
                for (categoryId in subcategory[value]) {
                    citiesOptions += "<option value="+subcategory[value][categoryId]+" >" + subcategory[value][categoryId] + "</option>";
                }
                document.getElementById("categorySelect").innerHTML = citiesOptions;
            }
        }


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
var department =  $('#department').val();
var course_type =  $('#course_type').val();                   
var name =  $('#name').val();  
var code =  $('#code').val();  
var credit =  $('#credit').val();
var tutor= $('#tutor').val();	
var faculty = $('#faculty').val();	

		  if(department.trim()==''){
                    swal("Warning","Select A Department","warning");
                    return false;
                }
		  if(course_type.trim() ==''){
                    swal("Warning","Select course type","warning");
                    return false;
                }
    
		  if(name.trim() ==''){
                    swal("Warning","Select course name","warning");
                    return false;
                }
         if(code.trim() ==''){
                    swal("Warning","Select course code","warning");
                    return false;
                }
         if(credit.trim() ==''){
                    swal("Warning","Select course credit","warning");
                    return false;
                }
    
    	if(faculty == ''){
                    swal("Warning","Select Faculties","warning");
                    return false;
                }
     var validate = false;
    $('#tab_logic').find('tr input[type=text]').each(function(){
    if($(this).val() == ""){
        validate = true;
    }
  });
   if(validate==true){
    alert("Pls add a paper with all fields")
    return false;// you can submit form or send ajax or whatever you want here
 
  }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$editCourseinfo}}",
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
                    alert('Course details has been updated successfully');
					window.location.href = "{{ $courselist}}";
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
<script type="text/javascript">  
$(function()  
{  
    
$('#add').click(function()  
{  

addnewrow();  
});  
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();  
});  
}); 
   
function addnewrow()   
{  
var n=($('.detail tr').length-0)+1;  
var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+  
'<td><input type="text" class="form-control" name="p_code[]"></td>'+  
'<td><input type="text" class="form-control" name="p_name[]"></td>'+  
'<td><input type="text" class="form-control" name="p_credit[]"></td>'+  
'<td><input type="text" class="form-control" name="p_hourse[]"></td>'+
'<td><select class="form-control" name="p_type[]"><option value="">none</option><option value="Theory">Theory</option><option value="Practical">Practical</option><option value="Viva">Viva</option><option value="Project">Project</option><option value="Internship">Internship</option></select></td>'+    
'<td><input type="file" class="form-control" name="files[]"></td>'+  
'<td><select class="form-control" name="p_semester[]"><option value="">none</option><option value="Semester 1">Semester 1</option><option value="Semester 2">Semester 2</option><option value="Semester 3">Semester 3</option><option value="Semester 4">Semester 4</option><option value="Semester 5">Semester 5</option><option value="Semester 6">Semester 6</option></select></td>'+  
'<td><button class="remove btn btn-danger">-</button></td>'+
'</tr>';  
$('.detail').append(tr);   
}  
</script>                
@endsection