
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
                    <h4 class="card-title">Add General Data</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                   
						<div class="form-group row">
						
						
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12 form-group">
									  <label> Title</label>
									 <input type="text" class="form-control form-control-lg" id="title" name="title">
									</div>
									<div class="col-md-4 form-group">
									  <label>Category</label>
									  <select class="form-control" name="stream" id="stream" >
										<option value="">Select Category</option>
									 <option value="Academic Calendar">Academic Calendar</option>
									 	 <option value="Annual Report">Annual Report</option>
									
                                      </select>
									</div>
									 <div class="col-md-4 form-group">
									  <label >Upload Document</label>
                            <input type="file" class="form-control" id="file1" name="file1"  />
									</div>
									<div class="col-md-4 form-group">
									  <label> Date</label>
									 <input type="date" class="form-control form-control-lg" id="datestart" name="datestart">
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
var title =  $('#stream').val();
var datestart =  $('#datestart').val();                   
var file1= $('#file1').val();	


		  if(title==''){
                    swal("Warning","Select Category","warning");
                    return false;
                }
		 if(datestart==''){
                    swal("Warning","Enter Date","warning");
                    return false;
                }
		
		 if(file1==''){
                    swal("Warning","Please Upload Document","warning");
                    return false;
                }
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/office/saveGeneral')}}",
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
                    alert(' Details has been uploaded Successfully');
					window.location.href = "{{ url('/office/generalList')}}";
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