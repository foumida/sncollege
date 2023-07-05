
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
                    <h4 class="card-title"> FAPI Academic Bodies </h4>
                     <div id="mainform">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Name of Academic Bodies</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name of Academic Bodies">
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
									  <input type="date" class="form-control form-control-lg" id="datestart" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend" aria-label="Username">
									</div>
								</div>
							</div>
						
								<div class="col-md-3">
            							
                								<label>Recognition category : </label>
                								 <select class="form-control" name="promoter" ID="promoter">
        									    	<option value="">Select </option>
        									    	<option value="National">National</option>
                									<option value="International">International</option>
                									<option value="University">University</option>
                                                    <option value="State">State</option>
                                                    <option value="District">District</option>
                                                   							
        										</select>    
            							
							        	</div>
							        		<div class="col-md-3">
								 <label>Designation</label>
									  <select class="form-control" name="level" id="level">
										<option value="">Select </option>
        									    	<option value="Chairman">Chairman</option>
                									<option value="Co-chairman">Co-chairman</option>
                									<option value="Member">Member</option>
                                                    <option value="Executive Member">Executive Member</option>
                                                    
        										</select>
							</div>
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12 form-group">
									 	<label>Name of Reconised Body</label>
								<input type="Text" class="form-control" id="venue" placeholder="Name of Reconised Body">
									</div>
									
								</div>
							</div>
						 </div>
						 
					
						  <div class="form-group">
						
					<button class="addtocart_article-element button btn btn-success mt-3 " style="float:right;" onclick="Save()">
    <i class="material-icons">SAVE</i>
  </button>
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
<script >

function Save()
{
event.preventDefault();

var title =  $('#title').val();
var Category =  $('input[name=Category]:checked').val();

var datestart= $('#datestart').val();
var dateend= $('#dateend').val();	
var venue= $('#venue').val();	

var level=$('#level').val();
 


    var promoter= $('#promoter').val();


		  if(title.trim()==''){
                    swal("Warning","Enter Name of Academic Bodies","warning");
                    return false;
                }
		 if(datestart ==''){
                    swal("Warning","Enter Starting Date","warning");
                    return false;
                }
		 
				 if(venue.trim()==''){
                    swal("Warning","Enter Name of Recognised Body","warning");
                    return false;
                }
		
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{ url('/faculty/storefapiAcademicBody')}}",
				method:"POST",
				data:{title:title,Category:Category,datestart:datestart,dateend:dateend,venue:venue,level:level,promoter:promoter},
				dataType:"json",
            success:function(data){
			  alert('FAPI Academic Bodies has been submitted successfully');
				window.location.href = "{{ url('/faculty/fapiAcademicBodyList')}}";
				
           }
		   });
}
 </script>

<script type="text/javascript">

	$(document).ready(function(){
$('#datestart').blur( function(){
     $('#dateend').val($(this).val());
});
});
</script>
@endsection