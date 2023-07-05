@if(Auth::User()->role == 8)
  
  @php $type = "layouts.researchfellow.default";
  $autocompleteSearchResearchPerson = url('/researchfellow/autocompleteSearchResearchPerson');
    $savePhdprogress = url('/researchfellow/savePhdprogress');
    $PhdprogressList = url('/researchfellow/PhdprogressList');
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
                    <h4 class="card-title">Add PhD Progress Details</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
						<div class="form-group row">
						<div class="col-md-12 form-group">
									     <label>For Whom ?</label>
									  <select class="form-control" name="publisherwhom" id="publisherwhom">
                                                        <option value="">Select</option>
                                                        <option value="2">Research Fellow</option>
                                                        <option value="5">Research Fellow & Faculty</option>
                                                       
                                                    </select>
									</div>
								<table class="table">

							<tbody>
							    
							<tr>
								
							
								<th colspan="2">
								    <label><b>Course Work : </b></label>
									<div class="form-group row">
    									<div class="col-lg-3">
    										<div class="form-line">
    										   
    										     <label>Date of Course work </label>
									             <input type="date" class="form-control " id="dateOfcw" name="dateOfcw" placeholder="Date of Course work">
    										</div>
    									</div>	 
    									<div class="col-lg-3">
    										<div class="form-line">
    										     <label>Course Work Status</label>
									  <select class="form-control" name="coursestatus" id="coursestatus">
                                                        <option value="">Select</option>
                                                         
                                                         <option value="No">No</option>
                                                         <option value="Doing">Doing</option>
                                                        <option value="Completed">Completed</option>
                                                      
                                                       
                                                    </select>
    										</div>
    									</div>
    								    <div class="col-lg-3">
    									    <div class="form-line">
    										   <label>Course Work Completion </label>
									   <input type="date" class="form-control" id="coursecompletedate" name="coursecompletedate" placeholder="Date Of Completion of Course Work">
    										</div>
    								    </div>
    								    <div class="col-lg-3">
        									<div class="form-line ">
        										<label>    Upload Certificate </label>
        									    <input type="file" class="form-control" id="file1" name="file1"  />       
        									</div>
    								    </div>
    								</div>
								</th>
							</tr>
								<tr>
								
							
								<th colspan="2">
								    <label><b>RAC : </b></label>
									<div class="form-group row">
    									<div class="col-lg-4">
    										<div class="form-line">
    										   
    										     <label>RAC Progress</label>
						            	 <select class="form-control" name="racprogress" id="racprogress">
                                                        <option value="">Select</option>
                                                         
                                                         <option value="RAC 1">RAC 1</option>
                                                         <option value="RAC 2">RAC 2</option>
                                                        <option value="RAC 3">RAC 3</option>
                                                        <option value="RAC 4">RAC 4</option>
                                                        <option value="RAC 5">RAC 5</option>
                                                        <option value="RAC 6">RAC 6</option>
                                                        <option value="RAC 7">RAC 7</option>
                                                        <option value="RAC 8">RAC 8</option>
                                                    </select>
    										</div>
    									</div>	 
    									<div class="col-lg-4">
    										<div class="form-line">
    										    <label>Date RAC</label>
									   <input type="date" class="form-control" id="daterac" name="daterac" placeholder="Date RAC">
    										</div>
    									</div>
    								   
    								    <div class="col-lg-4">
        									<div class="form-line ">
        										<label>    Upload Progress </label>
        									    <input type="file" class="form-control" id="file2" name="file2"  />        
        									</div>
    								    </div>
    								</div>
								</th>
							</tr>
							<tr>
								
							
								<th colspan="2">
								    <label><b>PHD Completion : </b></label>
									<div class="form-group row">
    									<div class="col-lg-3">
    										<div class="form-line">
    										   
    										    <label>Date Pre Submission on Viva</label>
									   <input type="date" class="form-control" id="vivadate" name="vivadate" placeholder="Date Pre Submission on Viva">
    										</div>
    									</div>	 
    									<div class="col-lg-3">
    										<div class="form-line">
    										   <label> Date Thesis Submission </label>
									   <input type="date" class="form-control" id="thesisdate" name="thesisdate" placeholder="Date Thesis Submission">
    										</div>
    									</div>
    								   	<div class="col-lg-3">
    										<div class="form-line">
    										     <label>Date Open Defence</label>
						            	  <input type="date" class="form-control" id="defencedate" name="defencedate" placeholder=" Date Open Defence">
    										</div>
    									</div>
    								    <div class="col-lg-3">
        									<div class="form-line ">
        										<label>Upload Document</label>
							        <input type="file" class="form-control" id="file3" name="file3"  />
        									</div>
    								    </div>
    								</div>
								</th>
							</tr>
								</tbody>
									</table>
						</div>
					
						
						
			
							
						<div class="col-md-12">
						    	<label for="exampleInputEmail3"><b>Research Activities : </b></label>
								<div class="row">
									<div class="col-md-3 form-group">
									 <label>Choose Progress</label>
									   <select class="form-control" name="progress" id="progress">
                                                        <option value="">Select</option>
                                                         
                                                         <option value="Conference Participation">Conference Participation</option>
                                                         <option value="Paper Presentation">Paper Presentation</option>
                                                        <option value="Awards">Awards</option>
                                                        <option value="Fellowships">Fellowships</option>
                                                        <option value="Organising programs">Organising programs</option>
                                                        <option value="Resource person Lectures or classes">Resource person Lectures or classes</option>
                                                        <option value="Training programs">Training programs</option>
                                                        <option value="Extension and outreach">Extension and outreach</option>
                                                        <option value="Consultancy, Class room lecture">Consultancy, Class room lecture </option>
                                                    </select>
									</div>
									<div class="col-md-3 form-group">
									  <label>Title of the event</label>
									   <input type="text" class="form-control" id="eventtitle" name="eventtitle" placeholder="Title of the event">
									</div>
									<div class="col-md-6 form-group">
									 <div class="row">
									<div class="col-md-6 form-group">
									  <label>From Date</label>
									 <input type="date" class="form-control form-control-lg" id="datestart" name="datestart" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>To Date </label>
									  <input type="date" class="form-control form-control-lg" id="dateend" name="dateend" aria-label="Username">
									</div>
								</div>
									</div>
										
								</div>
							</div>
								<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									       <label>Organiser </label>
									   <input type="text" class="form-control" id="organiser" name="organiser" placeholder="Organiser">
									</div>
									<div class="col-md-4 form-group">
									   <label>Status  </label>
									   <select class="form-control" name="status" id="status">
                                                        <option value="">Select</option>
                                                         
                                                         <option value="International">International</option>
                                                         <option value="National">National</option>
                                                        <option value="State">State</option>
                                                        <option value="Regional">Regional</option>
                                                        <option value="College level">College level</option>
                                                       
                                                    </select>
									</div>
										<div class="col-md-4 form-group">
									      	<label>Upload Activity Certificate</label>
							      <input type="file" class="form-control" id="file4" name="file4"  />
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
  $(document).ready(function(){
	  $( "#skillitems" ).autocomplete({
        source: function( request, response ) {
			var type =  $('#publisherwhom').val();
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$autocompleteSearchResearchPerson}}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term,
			  type :type
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
  
</script>
<script type="text/javascript">

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
 var publisherwhom =  $('#publisherwhom').val();       
        
//var dateOfcw =  $('#dateOfcw').val();
//var racprogress =  $('#racprogress').val();
//var progress =  $('#progress').val();                   


         	  if(publisherwhom ==''){
                    swal("Warning","Enter Category Whom","warning");
                    return false;
                }

		/*  if(dateOfcw ==''){
                    swal("Warning","Enter Date of Course Work","warning");
                    return false;
                }
	
	     if(racprogress==''){
                    swal("Warning","Enter RAC Progress","warning");
                    return false;
                }
         if(progress==''){
                    swal("Warning","Choose Progress","warning");
                    return false;
                } */
    
		if(publisherwhom!=""){	  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$savePhdprogress}}",
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
                    alert('Phd Progress has been submitted successfully');
					window.location.href = "{{$PhdprogressList}}";
                }
            },
        });
	}
	else{
          alert('Please fill all the field !');
      }
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