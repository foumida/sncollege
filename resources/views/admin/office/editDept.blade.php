@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
   
   $editDeptinfo= url('/admin/editDeptinfo');  
     $deptList = url('/admin/deptList');  
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
    $deptList = url('/office/deptList');
  $editDeptinfo= url('/office/editDeptinfo');
   @endphp
   @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
    $deptList = url('/hod/deptList');
  $editDeptinfo= url('/hod/editDeptinfo');
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
                    <h4 class="card-title">Edit Department</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                   
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>Department</label>
							 <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->department}}">
							  <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-6 form-group">
									  <label>Department E-Mail</label>
									  <input type="email" class="form-control" id="deptemail" name="deptemail" placeholder="Department E-Mail" value="{{$profile_edit[0]->email}}">
									</div>
									<!--	<div class="col-md-4 form-group">
								 <label>No Of Students</label>
							       <input type="text" class="form-control" id="nos" name="nos" placeholder="No of Students" value="{{$profile_edit[0]->no_of_stu}}">
                        
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
            								            <option value="{{ $row->fid }}" @if($profile_edit[0]->faculty_h==$row->fid) Selected @endif>{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Educational Stream</label>
									  <select class="form-control" name="stream" id="stream" >
										<option value="">Select Stream</option>
										
									 <option value="Aided" @if($profile_edit[0]->hod=='Aided') Selected @endif>Aided</option>Aided (Language)
 <option value="Aided (Language)" @if($profile_edit[0]->hod=='Aided (Language)') Selected @endif>Aided (Language)</option>
 <option value="Aided (Subsidiary)" @if($profile_edit[0]->hod=='Aided (Subsidiary)') Selected @endif>Aided (Subsidiary)</option>
  <option value="Aided (UGC)" @if($profile_edit[0]->hod=='Aided (UGC)') Selected @endif>Aided (UGC)</option>
  <option value="Self-Financing" @if($profile_edit[0]->hod=='Self-Financing') Selected @endif>Self-Financing</option>
  <option value="Research Centres" @if($profile_edit[0]->hod=='Research Centres') Selected @endif>Research Centres</option>
  <option value="Aided & Self-Financing"  @if($profile_edit[0]->hod=='Aided & Self-Financing') Selected @endif>Aided & Self-Financing</option>
											</select>
									</div>
										<div class="col-md-4 form-group">
								 <label>Banner</label>
							    <input type="file" class="form-control" id="image" name="image"  />
                          <input type="hidden" name="current_file_img" value="{{$profile_edit[0]->picture}}">
									   <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/department/'.$profile_edit[0]->picture)}}"  /></span>
									</div>
									
								</div>
							</div>
						
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control"  id="description" name="description"  value="{{$profile_edit[0]->descn}}">{{$profile_edit[0]->descn}}</textarea>
                         </div>
						 	 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Vision</label>
                            <textarea class="form-control"  id="vision" name="vision"  value="{{$profile_edit[0]->vision}}">{{$profile_edit[0]->vision}}</textarea>
                         </div>
						  <div class="form-group">
						    <label class="col-sm-12 col-form-label">Mission</label>
                            <textarea class="form-control"  id="mission" name="mission"  value="{{$profile_edit[0]->mission}}">{{$profile_edit[0]->mission}}</textarea>
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
		  //if(nos.trim() ==''){
    //                 swal("Warning","Enter No Of Students","warning");
    //                 return false;
    //             }
				 if(hod.trim()==''){
                    swal("Warning","Enter Head oF Department","warning");
                    return false;
                }
                 if(stream.trim()==''){
                    swal("Warning","Enter Stream","warning");
                    return false;
                }
               
                 if(description.trim()==''){
                    swal("Warning","Enter Description","warning");
                    return false;
                }
                   if(vision.trim()==''){
                    swal("Warning","Enter vision","warning");
                    return false;
                }
				 if(mission.trim ==''){
                    swal("Warning","Enter Mission","warning");
                    return false;
                }
			
				
			
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ $editDeptinfo }}",
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
                    alert('Department Details has been updated Successfully');
					window.location.href = "{{ $deptList }}";
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