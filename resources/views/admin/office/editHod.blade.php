
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
    $hodList= url('/office/hodList');
  $hodUpdateInfo= url('/office/hodUpdateInfo');
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
                    <h4 class="card-title">Change HOD</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                    
					
					
					
						
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Department</label>	
								  <select class="form-control" name="department" id="department" >
            										<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            								            <option value="{{ $row->department }}" @if($row->department==$profile_edit[0]->department) Selected @endif>{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
								
									
									
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Hod</label>	
								  <select class="form-control" name="profileid" id="profileid" >
            										<option value="">Select Faculty For Hod</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->fid }}" @if($row->fid==$profile_faculty[0]->profile_id) Selected @endif>{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
								
									<input type="hidden" value="{{$profile_faculty[0]->profile_id}}" id="hodid" name="hodid">
									
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

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$hodUpdateInfo}}",
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
					window.location.href = "{{ $hodList}}";
                }
            },
        });
    });
});
 

</script>

@endsection