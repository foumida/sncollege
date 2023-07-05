@if(Auth::User()->role == 4)
   @php $type = "layouts.cell.default";
     $storeevent = url('/cell/storeevent');
    $storeimage =  url('/cell/store-multi-file-ajax_seller');
    $updateFileUpload = url('/cell/updateFileUpload');
     $eventlist= url('/cell/eventList');
  
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
                    <h4 class="card-title">Cell Report</h4>
                    <div id="mainform">
                      <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                      </div>
                     
				
						
						<div class="form-group row">
							<div class="col-md-12">
								
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>From Date</label>
									 <input type="date" class="form-control form-control-lg" id="datestart" name="datestart"  aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>To Date </label>
									  <input type="date" class="form-control form-control-lg" id="dateend" name="dateend" aria-label="Username">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label >Author</label>
								<input type="Text" class="form-control" id="author"  name="author" placeholder="author">
							</div>
						</div>
					
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="10" cols="100"></textarea>
                         </div>
						<div class="form-group">
						<label class="col-sm-12 col-form-label">Upload Document</label>
						<input type="file" class="form-control" id="file1" name="file1"  />
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
var title =  $('#title').val();

		  if(title.trim()==''){
                    swal("Warning","Enter Title","warning");
                    return false;
                }
	
	  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/cell/saveReport')}}",
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
                    alert('Report has been submitted successfully');
				  window.location.href = "{{ url('/cell/reportList')}}";
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