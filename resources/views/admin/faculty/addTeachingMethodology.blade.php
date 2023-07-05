
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
        									            <option value="Lecture using black board-white board">Lecture using black board-white board</option>
                                                        <option value="Lecture using ppt">Lecture using ppt</option>
                                                        <option value="Practical demonstrations">Practical demonstrations</option>
                                                        <option value="Group learning /Discussion">Group learning /Discussion </option>
                                                   		<option value="Case study/ investigations">Case study/ investigations </option>
                                                   		<option value="Problem solving">Problem solving</option>
                                                   		<option value="Participatory learning">Participatory learning </option>
                                                   		<option value="Peer teaching">Peer teaching </option>
                                                   		<option value="Online Teaching Method">Online Teaching Method </option>
                                                   		<option value="ICT – Audio -Visual tool and discussion">ICT – Audio -Visual tool and discussion</option>
                                                   		<option value="Content /ingredient analysis">Content /ingredient analysis</option>
                                                   		<option value="Mapping">Mapping</option>
                                                   		<option value="Product making">Product making</option>
                                                   		<option value="Additional assignments -for case study">Additional assignments -for case study</option>
                                                   		<option value="Extra short-term internship">Extra short-term internship</option>
                                                   		<option value="Participation in congresses/expo etc">Participation in congresses/expo etc</option>
                                                   		<option value="Extra projects or paper works">Extra projects or paper works</option>
        										</select>   
                      </div>
                      
                      	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Batch</label>
									 <input type="text" class="form-control" id="batch" name="batch" placeholder="Enter BATCH">
									</div>
									<div class="col-md-4 form-group">
									  <label>Semester</label>
									  	 <select class="form-control" name="semester" id="semester">
        									            <option value="">Select </option>
        									            <option value="Semester 1">Semester 1</option>
                                                        <option value="Semester 2">Semester 2</option>
                                                        <option value="Semester 3">Semester 3</option>
                                                        <option value="Semester 4">Semester 4</option>
                                                        <option value="Semester 5">Semester 5</option>
                                                        <option value="Semester 6">Semester 6</option>
                                                        <option value="Semester 7">Semester 7</option>
                                                        <option value="Semester 8">Semester 8</option>
                                                   							
        										</select>    
            							
									</div>
									<div class="col-md-4 form-group">
									  <label>Program</label>
									     <select class="form-control" name="program" id="program" >
            										<option value="">Select Program</option>
            									    @foreach($course as $row)
            								            <option value="{{ $row->course_name }}">{{ $row->course_name }}</option>
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
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="University of Calicut" checked> University of Calicut </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other within State"> Other within State </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside State" >Outside State </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Outside Country"> Outside Country </label>
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
									  <input type="date" class="form-control form-control-lg" id="datestart" name="datestart" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend" name="dateend" aria-label="Username">
									</div>
								</div>
							</div>
						
								<div class="col-md-6">
            							
                								<label>Recognition category : </label>
                								 <select class="form-control" name="promoter" id="promoter">
        									    	<option value="">Select </option>
        									    	<option value="National">National</option>
                									<option value="International">International</option>
                									<option value="University">University</option>
                                                    <option value="State">State</option>
                                                    <option value="District">District</option>
                                                   							
        										</select>    
            							
							        	</div>
							        		
								<div class="col-md-4 form-group">
									  <label>Upload Document</label>
							    <input type="file" class="form-control" id="file1" name="file1"  />
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
			url:"{{ url('/faculty/storeTeachingMethodology')}}",
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
                    alert('Teaching Methodology has been submitted successfully');
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