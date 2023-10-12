@if(Auth::User()->role == 7)
   @php $type = "layouts.research.default";
  
     $saveMou = '';
     $mouList = '';
   @endphp

   @elseif(Auth::User()->role == 8)
  
  @php $type = "layouts.researchfellow.default";
   
     $saveMou = '';
     $mouList = '';
 @endphp
 @elseif(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
  
     $saveMou = url('/faculty/editInfoMou');
     $mouList = url('/faculty/mouList');
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
                    <h4 class="card-title">Edit Mou</h4>
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
        									    	<option value="Mou" @if($profile_edit[0]->category == 'Mou') Selected @endif>Mou</option>
                									<option value="Project" @if($profile_edit[0]->category == 'Project') Selected @endif>Project</option>
                								    <option value="Grants" @if($profile_edit[0]->category == 'Grants') Selected @endif>Grants</option>
                                                    <option value="Fellowship" @if($profile_edit[0]->category == 'Fellowship') Selected @endif>Fellowship</option> <option value="Consultancy" @if($profile_edit[0]->category == 'Consultancy') Selected @endif>Consultancy</option>							
        										</select> 
									</div>
									<div class="col-md-3 form-group">
									  <label>Title</label>
									 <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$profile_edit[0]->title}}">
									 <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-3 form-group">
									 <label>Date Start</label>
									 <input type="date" class="form-control form-control-lg" id="datestart" name="datestart" value="{{$profile_edit[0]->from_date}}" aria-label="Username">
									</div>
									<div class="col-md-3 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend" name="dateend" value="{{$profile_edit[0]->to_date}}" aria-label="Username">
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Funding Agency</label>
									 <input type="text" class="form-control" id="fundingagency" name="fundingagency" placeholder="Funding Agency" value="{{$profile_edit[0]->funding_agency}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Total Amount</label>
									 <input type="text" class="form-control" id="totamt" name="totamt" placeholder="Total Amount" value="{{$profile_edit[0]->total_amt}}">
									</div>
									<div class="col-md-3 form-group">
									  	<label>Recognition category level : </label>
                								 <select class="form-control" name="level" id="level">
        									    	<option value="">Select </option>
        									    	<option value="National" @if($profile_edit[0]->level == 'National') Selected @endif>National</option>
                									<option value="International"  @if($profile_edit[0]->level == 'International') Selected @endif>International</option>
                								    <option value="State"  @if($profile_edit[0]->level == 'State') Selected @endif>State</option>
                                                    							
        										</select> 
									</div>
									<div class="col-md-3 form-group">
									  <label>Link</label>
									 <input type="text" class="form-control" id="link_url" name="link_url" placeholder="Provide Link" value="{{$profile_edit[0]->link_url}}">
									</div>
								</div>
							</div>
							
						</div>
			
						<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label> Principle Investigator </label>
									 <select class="form-control" name="principle_investigator" id="principle_investigator">
                    								<option value="">--Select-- </option>
            										@foreach($faculty as $row)
            								        <option value="{{ $row->name }}" @if($row->name==$profile_edit[0]->principle_investigator) Selected @endif>{{ $row->name}}</option>
            						            	@endforeach
                    							</select>	
									</div>
									<div class="col-md-3 form-group">
									  <label> Co-Investigator </label>
									  <select class="form-control" name="co_investigator" id="co_investigator">
                    								<option value="">--Select-- </option>
            										@foreach($faculty as $row)
            								        <option value="{{ $row->name }}" @if($row->name==$profile_edit[0]->co_investigator) Selected @endif>{{ $row->name}}</option>
            						            	@endforeach
                    							</select>	
									</div>
									<div class="col-md-3 form-group">
									  <label>Granteed</label>
						            	  <input type="text" class="form-control" id="granteed" name="granteed" placeholder="Granteed" value="{{$profile_edit[0]->granteed}}">
									</div>
										<div class="col-md-3 form-group">
								
						            	<label>Upload Proof</label>
							    <a style="float:right;" class="btn btn-info mb-2" href="{{url('uploads/journal/'.$profile_edit[0]->upload_document)}}" download="">Download</a>
							    <input type="file" class="form-control" id="file1" name="file1"  />
							    <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->upload_document}}">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label> Cell </label>
										<select class="form-control" name="cell" id="cell">
                    								<option value="">--Select-- </option>
            										@foreach($cells as $row)
            								        <option value="{{ $row->id }}" @if($row->id==$profile_edit[0]->cell) Selected @endif>{{ $row->name_of_the_cell }}</option>
            						            	@endforeach
                    							</select>	
									</div>
									<div class="col-md-3 form-group">
									  <label> Research Fellow </label>
									 	<select class="form-control" name="fellow" id="fellow">
                    								<option value="">--Select--</option>
            										@foreach($fellow as $row)
            								        <option value="{{ $row->id }}" @if($row->id==$profile_edit[0]->research_fellow) Selected @endif>{{ $row->name }}</option>
            						            	@endforeach
                    							</select>	
									</div>
									<div class="col-md-3 form-group">
									  <label>Signed Authorities</label>
						            	  <select class="form-control" name="authority" id="authority">
        									    	<option value="">Select </option>
        									    	<option value="Authority 1" @if($profile_edit[0]->signed_authority == 'Authority 1') Selected @endif>Authority 1</option>
                									<option value="Authority 2" @if($profile_edit[0]->signed_authority == 'Authority 2') Selected @endif>Authority 2</option>
                								    <option value="Authority 3" @if($profile_edit[0]->signed_authority == 'Authority 3') Selected @endif>Authority 3</option>
                                                    							
        										</select> 
									</div>
										<div class="col-md-3 form-group">
									  <label>Signed Authority Name</label>
									 <input type="text" class="form-control" id="authority_name" name="authority_name" placeholder="Signed Authority Name" value="{{$profile_edit[0]->authority_name}}">
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

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var category=  $('#category').val();
var title =  $('#title').val();
var datestart =  $('#datestart').val();
var dateend =  $('#dateend').val();                   

          if(category.trim()==''){
                    swal("Warning","Enter Category","warning");
                    return false;
                }
		   if(title.trim()==''){
                    swal("Warning","Enter Title","warning");
                    return false;
                }
	
	      if(datestart ==''){
                    swal("Warning","Enter Date of Start","warning");
                    return false;
                }
          if(dateend ==''){
                    swal("Warning","Enter Date of End","warning");
                    return false;
                }
		if(title!="" && datestart!="" && dateend!=""){	  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$saveMou}}",
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
                    alert('Mou Details has been updated successfully');
					window.location.href = "{{$mouList}}";
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