 @if(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
  
     $saveStudentProgression = url('/faculty/saveStudentProgression');
    $studentProgressionList = url('/faculty/studentProgressionList');
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
                    <h4 class="card-title">Add Student Progression</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
					
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								    <div class="col-md-3 form-group">
									  	<label> category : </label>
                								 <select class="form-control" name="category" id="category">
        									    	<option value="">Select </option>
        									    	<option value="Placement">Placement</option>
                									<option value="HigherEducation">HigherEducation</option>
                								   	<option value="Competitive Exams">Competitive Exams</option>				
        										</select> 
									</div>
									<div class="col-md-3 form-group">
									  <label>Select Program</label>
								    <select class="form-control" name="program" id="program" >
            										<option value="">Select Program</option>
            									    @foreach($course as $row)
            								            <option value="{{ $row->course_name }}">{{ $row->course_name }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Search Student</label>
								   <input type="text" id="skillitems" name="skillitems" class="form-control skillitems" />
                                    <input type="hidden" id="skillid" name="skillid" value="0"/>
                                    <div id="skill_pos"></div> 
									</div>
									<div class="col-md-3 form-group">
									 <label>Year</label>
									 <input type="text" class="form-control form-control-lg" id="year" name="year" placeholder="Enter Year">
									</div>
									
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								<div class="col-md-4 form-group">
									  <label>Program Graduated From</label>
									  <input type="text" class="form-control form-control-lg" id="graduated" name="graduated" placeholder="Program Graduated From">
									</div>
									<div class="col-md-4 form-group">
									  <label>Name Of Institution/Employer with Contact Number</label>
									 <textarea id="institution" name="institution" rows="4" cols="50" class="form-control"></textarea>   
									</div>
									<div class="col-md-4 form-group">
									  <label>Name of program admitted to (applicable for students who progressed to higher education)</label>
									 <input type="text" class="form-control" id="name_of_pgm" name="name_of_pgm" placeholder="Name of program admitted to">
									</div>
									
									
								</div>
							</div>
							
						</div>
			
						<div class="col-md-12">
								<div class="row">
								
									<div class="col-md-6 form-group">
									  <label>Pay package at appointment (In INR per annum) (applicable for students who got placement) </label>
									 <input type="text" class="form-control" id="package" name="package" placeholder="Pay package at appointment (In INR per annum)">
									</div>
								
										<div class="col-md-6 form-group">
								
						            	<label>Upload Proof</label>
							    <input type="file" class="form-control" id="file1" name="file1"  />
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
$(document).ready(function(){
	  $( "#skillitems" ).autocomplete({
        source: function( request, response ) {
			var program =  $('#program').val();
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/faculty/autocompleteSearchstudent')}}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term,
			  program:program
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('.skillitems').val(ui.item.label);// display the selected text
          $('#skillid').val(ui.item.value); // save selected id to input
		 
          return false;
        },
appendTo: "#skill_pos",
      });
        });
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var category=  $('#category').val();
var program=  $('#program').val();
var studentid =  $('#skillid').val();
                

          if(category.trim()==''){
                    swal("Warning","Enter Category","warning");
                    return false;
                }
		  if(program==''){
                    swal("Warning","Enter Program","warning");
                    return false;
                }
		   if(studentid ==''){
                    swal("Warning","Enter Student","warning");
                    return false;
                }
	
        
	 
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$saveStudentProgression}}",
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
                    alert('Student Progression Details has been submitted successfully');
					window.location.href = "{{$studentProgressionList}}";
                }
            },
        });
	

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