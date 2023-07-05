
@extends('layouts.office.default')

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
                    <h4 class="card-title">Add Department</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                   
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>Department</label>
							 <input type="text" class="form-control" id="name" name="name" placeholder="Name">
									</div>
									<div class="col-md-6 form-group">
									  <label>Department E-Mail</label>
									  <input type="email" class="form-control" id="deptemail" name="deptemail" placeholder="Department E-Mail">
									</div>
									<!--	<div class="col-md-4 form-group">
								 <label>No Of Students</label>
							       <input type="text" class="form-control" id="nos" name="nos" placeholder="No of Students">
                        
									</div>-->
									
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>HOD</label>
								  <select class="form-control" name="hod" id="hod" >
            										<option value="">Select HOD</option>
            									    @foreach($hod as $row)
            								            <option value="{{ $row->fid }}">{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Educational Stream</label>
									  <select class="form-control" name="stream" id="stream" >
										<option value="">Select Stream</option>
									 <option value="Aided">Aided</option>Aided (Language)
 <option value="Aided (Language)">Aided (Language)</option>
 <option value="Aided (Subsidiary)">Aided (Subsidiary)</option>
  <option value="Aided (UGC)">Aided (UGC)</option>
  <option value="Self-Financing">Self-Financing</option>
  <option value="Research Centres">Research Centres</option>
  <option value="Aided & Self-Financing">Aided & Self-Financing</option>
											</select>
									</div>
										<div class="col-md-4 form-group">
								 <label>Banner</label>
							    <input type="file" class="form-control" id="image" name="image"  />
                        
									</div>
									
								</div>
							</div>
						
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control"  id="description" name="description" ></textarea>
                         </div>
						 	 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Vision</label>
                            <textarea class="form-control"  id="vision" name="vision" ></textarea>
                         </div>
						  <div class="form-group">
						    <label class="col-sm-12 col-form-label">Mission</label>
                            <textarea class="form-control"  id="mission" name="mission" ></textarea>
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
	 CKEDITOR.replace( 'vision');
	  CKEDITOR.replace( 'mission');
</script>
<script type="text/javascript">
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var deptname =  $('#name').val();
var deptemail =  $('#deptemail').val();                   
//var nos= $('#nos').val();
var hod= $('#hod').val();	

var stream= $('#stream').val();	

var description =  $('#description').val();;
var vision= $('#vision').val();
var mission= $('#mission').val();

		  if(deptname.trim()==''){
                    swal("Warning","Enter DepartmentName","warning");
                    return false;
                }
		 if(deptemail.trim()==''){
                    swal("Warning","Enter Department Email","warning");
                    return false;
                }
		
		 if(hod.trim()==''){
                    swal("Warning","Enter Head oF Department","warning");
                    return false;
                }
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/office/saveDept')}}",
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
                    alert('Department Details has been uploaded Successfully');
					window.location.href = "{{ url('/office/deptList')}}";
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
</script>

@endsection