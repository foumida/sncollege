
@extends('layouts.admin.default')

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
                    <h4 class="card-title">Edit Tc</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Name of Student in Block Letters</label>
									  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->name_of_student}}" disabled>
									  <input type="hidden" class="form-control form-control-lg" id="editid" name="editid" aria-label="Username" value="{{$profile_edit[0]->id}}">
									</div>
										<div class="col-md-4 form-group">
									  <label>Number in the Admission Register</label>
									 <input type="text" class="form-control" id="admission_regno" name="admission_regno" placeholder="Number in the Admission Register" value="{{$profile_edit[0]->admission_regno}}" disabled>
									</div>
									<div class="col-md-4 form-group">
									  <label>Date of Birth (format eg:
									  d-m-y  ------>  24-03-2001)</label>
									 <input type="text" class="form-control form-control-lg" id="dateofbirth" name="dateofbirth"  value="{{$profile_edit[0]->dob}}">
									</div>
									
									
								</div>
							</div>
							
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Relegion & Caste (Block Letters)</label>
									 <input type="text" class="form-control" id="relegion" name="relegion" placeholder="Relegion & Caste" value="{{$profile_edit[0]->relegion}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Whether Belongs to SC/ST/OEC/OBC (Block Letters)</label>
									   <input type="text" class="form-control" id="caste" name="caste" placeholder="Whether Belongs to SC/ST/OEC/OBC" value="{{$profile_edit[0]->reservation_category}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Date Of Admission(format eg:
									  d-m-y  ---->  24-03-2001)</label> 
						            	 <input type="text" class="form-control form-control-lg" id="dateofadmission" name="dateofadmission" aria-label="Username" value="{{$profile_edit[0]->class_date_of_admission}}">
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Date of Leaving(format eg:d/m/y 31/03/2023)</label>
									  <input type="text" class="form-control form-control-lg" id="dateofleave" name="dateofleave"  value="{{$profile_edit[0]->class_date_of_leaving}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Whether Course Completed or Not (Block Letters)</label>
									  <input type="text" class="form-control" id="coursecomplete" name="coursecomplete" placeholder="Whether Course Completed or Not" value="{{$profile_edit[0]->course_completion}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Whether He/She has Paid all Fees & Dues to The College (Block Letters)</label>
									  <input type="text" class="form-control" id="feesdue" name="feesdue"  value="{{$profile_edit[0]->fees_paid}}">
									</div>
									
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3 form-group">
									  <label>Whether Passed or Faild (Block Letters)</label>
									<input type="text" class="form-control" id="result" name="result" placeholder="Whether Passed or Faild" value="{{$profile_edit[0]->student_grade}}">
									</div>
									
								<div class="col-md-4 form-group">
									  <label>Nationality (Block Letters)</label>
						            	  <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" value="{{$profile_edit[0]->nationality}}">
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
 $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/admin/editTcUpdate')}}",
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
                    alert('Tc Details has been updated successfully');
					window.location.href = "{{ url('/admin/tcList')}}";
                }
            },
        });
    });
});
 
 
</script>

@endsection