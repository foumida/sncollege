@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
   
   $editCellinfo= url('/admin/editCellinfo'); 
     $cellList= url('/admin/cellList');
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
    $cellList= url('/office/cellList');
  $editCellinfo= url('/office/editCellinfo');
   @endphp
    @elseif(Auth::User()->role == 4)
   @php $type = "layouts.cell.default";
    $cellList= url('/cell/dashboard');
  $editCellinfo= url('/cell/editCellinfo');
   @endphp
   @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
    $cellList= url('/hod/cellList');
  $editCellinfo= url('/hod/editCellinfo');
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
                    <h4 class="card-title">Edit Cell</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      <div class="form-group">
                        <label for="exampleInputName1">Name of Cell</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->name_of_the_cell}}">
                          <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$profile_edit[0]->id}}">
                      </div>
						<div class="form-group">
                        <label for="exampleInputName1">Category</label>
                        <select class="form-control" name="type" id="type" >
            										<option value="">---Select---</option>
            									  
          <option value="WebCell" @if($profile_edit[0]->type=='WebCell') Selected @endif>WebCell</option>
          <option value="Club" @if($profile_edit[0]->type=='Club') Selected @endif>Club</option>
	      <option value="Commities" @if($profile_edit[0]->type=='Commities') Selected @endif>Commities</option>
          <option value="Infrastructure" @if($profile_edit[0]->type=='Infrastructure') Selected @endif>Infrastructure</option>
		  <option value="ITFacility" @if($profile_edit[0]->type=='ITFacility') Selected @endif>ITFacility</option>
		  <option value="ICT" @if($profile_edit[0]->type=='ICT') Selected @endif>ICT</option>
		  <option value="ICT" @if($profile_edit[0]->type=='Research and Innovation') Selected @endif>Research and Innovation</option>
		    <option value="Academic Devlopment" @if($profile_edit[0]->type=='Academic Devlopment') Selected @endif>Academic Devlopment</option>
            									</select>
                      </div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Date of Affliation</label>
									 <input type="date" class="form-control form-control-lg" id="dateofaffliation" name="dateofaffliation" value="{{$profile_edit[0]->date_of_affiliation}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Unit Number </label>
									  <input type="text" class="form-control form-control-lg" id="unitnumber" name="unitnumber" value="{{$profile_edit[0]->unit_number}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>No Of Unit </label>
									  <input type="text" class="form-control form-control-lg" id="noofunit" name="noofunit" aria-label="Username" value="{{$profile_edit[0]->num_of_unit}}">
									</div>
									
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row"> <h4> Current Enroll</h4>
									<div class="col-md-3 form-group">
									  <label>Boys</label>
									 <input type="text" class="form-control teachernew" id="boys" name="boys"  value="{{$profile_edit[0]->boys}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Girls</label>
									  <input type="text" class="form-control teachernew" id="girls" name="girls"   value="{{$profile_edit[0]->girls}}">
									</div>
									<div class="col-md-3 form-group">
									  <label>Others</label>
									  <input type="text" class="form-control teachernew" id="others" name="others"  value="{{$profile_edit[0]->others}}" >
									</div>	
									<div class="col-md-3 form-group">
									  <label>Total</label>
									  <input type="text" class="form-control total" id="total" name="total"   value="{{$profile_edit[0]->total}}">
									</div>
								</div>
							</div>
						
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Associated Department</label>
								  <select class="form-control" name="department" id="department" >
            				<option value="">Select Dept</option>
            									    @foreach($departments as $row)
            					 <option value="{{$row->id}}" @if($profile_edit[0]->department==$row->id) Selected @endif>{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									</div>
									<div class="col-md-4 form-group">
									  <label>Name of co-ordinator</label>
									 <select class="form-control" name="coordinator" id="coordinator" >
            										<option value="">Select Cordinator</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->fid }}" @if($profile_edit[0]->cordinator==$row->fid) Selected @endif>{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									</div>
										<div class="col-md-4 form-group">
									  <label>Sub Cordinator</label>
									   <select class="form-control" name="subcordinator" id="subcordinator" >
            										<option value="">Select Sub Cordinator</option>
            									    @foreach($faculty as $row)
            								            <option value="{{ $row->name }}" @if($profile_edit[0]->sub_cordinator==$row->name) Selected @endif>{{ $row->name }}</option>
            						            	@endforeach
            									</select>
									
									</div>
									
								</div>
							</div>
						
						</div>
						
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
										<div class="col-md-4 form-group">
									  <label>Profile Picture</label>
									  <input type="file" class="form-control" id="image" name="image"  />
									     <input type="hidden" name="current_file_img" value="{{$profile_edit[0]->picture}}">
									   <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/cell/'.$profile_edit[0]->picture)}}"  /></span>
									</div>
									<div class="col-md-4 form-group">
									  <label>Phone Number </label>
									  <input type="text" class="form-control form-control-lg" id="phonenum" name="phonenum" value="{{$profile_edit[0]->phone}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Previous Report </label>
									  <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/cell/'.$profile_edit[0]->previous_report)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file1" id="file1" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->previous_report}}">
									</div>
								
								</div>
							</div>
						
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Address</label>
                            <textarea class="form-control"  id="address" name="address" rows="10" cols="100" value="{{$profile_edit[0]->address}}">{{$profile_edit[0]->address}}</textarea>
                         </div>
						 	 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Affliated With</label>
                            <textarea class="form-control"  id="affliated" name="affliated" rows="10" cols="100" value="{{$profile_edit[0]->affiliated_with}}">{{$profile_edit[0]->affiliated_with}}</textarea>
                         </div>
						  <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control"  id="description" name="description" rows="10" cols="100" value="{{$profile_edit[0]->description}}">{{$profile_edit[0]->description}}</textarea>
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
	
</script>
 

<script type="text/javascript">
$(document).ready(function(){
$(".teachernew").on("change", function(){
   var total=0;
      $(".teachernew").each(function(){
          if(!isNaN(parseInt($(this).val())))
          {
            total+=parseInt($(this).val());  
          }
      });
      $(".total").val(total);
});
})
$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
var name =  $('#name').val();
var dateofaffliation =  $('#dateofaffliation').val();                   

var coordinator= $('#coordinator').val();	


		  if(name.trim()==''){
                    swal("Warning","Enter CellName","warning");
                    return false;
                }
		 if(dateofaffliation ==''){
                    swal("Warning","Enter Date Of Affliation","warning");
                    return false;
                }
        if(coordinator.trim()==''){
                    swal("Warning","Enter Coordinator","warning");
                    return false;
                }
    	
			
  
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ $editCellinfo }}",
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
                    alert('Cell details has been updated successfully');
					window.location.href = "{{ $cellList }}";
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