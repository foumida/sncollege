@if(Auth::User()->role == 4)
   @php $type = "layouts.cell.default";
     $fileupload = url('/cell/updateFileUpload');
     $updatevent = url('/cell/updatewebEvent');
   $multifileupload =  url('/cell/store-multi-file-ajax_seller');
  $eventlist = url('/cell/eventList');
   $editupdatefile = url('/cell/editupdateFileUpload');
  
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
            <div class="page-header">
              <h3 class="page-title"> Edit Event</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  
                </ol>
              </nav>
            </div>
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Event</h4>
                     <div id="mainform">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name" value="{{$event_edit[0]->title}}">
                      </div>
					  <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$event_edit[0]->id}}">
					 
						
						<div class="form-group row">
							
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>Date Start</label>
									  <input type="date" class="form-control form-control-lg" id="datestart"  value="{{$event_edit[0]->from_date}}" >
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend"  value="{{$event_edit[0]->to_date}}" >
									</div>
								</div>
							</div>
						
						</div>
						 
						 
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="6" cols="100">{{$event_edit[0]->description}}</textarea>
                         </div>
							
						<div class="form-group">
							<label for="exampleInputEmail3">More Informations</label>
							<table class="table">
							<tbody>
						
					
							<tr>
								<th colspan="2">
								  
									<div class="form-group row">
									   <div class="col-md-6">
    									    <div class="form-line">
    									        <label> Collaborators </label><br>
                    						<select class="form-control" name="collaborators[]" ID="lstSelect" class="get_value"  multiple>
                                                   <?php
                                                    // explode the saved data back into an array                    
                                                    $project_type_collabrators = explode(',', $event_edit[0]->collaborators);
                                                    
                                                    ?>
                                                    <option value="">Select Collaborators</option>
                                                    
                                                    @foreach($collabrators as $row)
                                                    <option value="{{ $row->fid }}" {{ in_array($row->fid, $project_type_collabrators) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                    @endforeach
                                                </select>	
    									    </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-line">
    									        <label>Collaborating Dept </label><br>
    									      <select class="form-control" name="collaboratorsdept[]" ID="2ndSelect" multiple>
            										<?php
                                                    // explode the saved data back into an array                    
                                                    $project_type_dept = explode(',', $event_edit[0]->dept);
                                                    ?>
                                                    <option value="">Select Dept</option>
                                                    <option value="1" {{ in_array('1', $project_type_dept) ? 'selected' : '' }}>All Department</option>
                                                    @foreach($departments as $row)
                                                    <option value="{{ $row->id }}" {{ in_array($row->id, $project_type_dept) ? 'selected' : '' }}>{{ $row->department }}</option>
                                                    @endforeach
                                                </select>
									        </div>
									    </div>
									    <div class="col-md-6">
    									    <div class="form-line">
    									        <label>Collaborating Cell </label><br>
                    							<select class="form-control" name="collaboratorscell[]" ID="3rdSelect"  multiple>
                    								<?php
                                                    // explode the saved data back into an array                    
                                                    $project_type_cell = explode(',', $event_edit[0]->cell);
                                                    ?>
                                                    <option value="">Select Cell</option>
                                                    @foreach($cells as $row)
                                                    <option value="{{ $row->id }}" {{ in_array($row->id, $project_type_cell) ? 'selected' : '' }}>{{ $row->name_of_the_cell }}</option>
                                                    @endforeach		
                                                </select>	
    									    </div>
									    </div>
									   
									</div>
								<th>
							</tr>
						   
                            
						    <tr>
								<th colspan="2">
								    <label><b>URL</b></label>
									<div class="form-group row">
    									<div class="col-lg-6">
        								    <div class="form-line">
                								<label>Video URL : </label>
                								<input class="form-control" type="text" name="vurl" id="vurl" value="{{$event_edit[0]->vurl}}">   
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Common URL : </label>
                								<input class="form-control" type="text" name="surl" id="surl" value="{{$event_edit[0]->surl}}">       
            								</div>
							        	</div>
							        	 <div class="col-lg-4">
            								<div class="form-line">
                								<label>Instagram URL : </label>
                								<input class="form-control" type="text" name="insta" id="insta" value="{{$event_edit[0]->instagram_url}}">        
            								</div>
							        	</div>
							        	 <div class="col-lg-4">
            								<div class="form-line">
                								<label>Facebook URL : </label>
                								<input class="form-control" type="text" name="facebook" id="facebook" value="{{$event_edit[0]->facebook_url}}">        
            								</div>
							        	</div>
							        	 <div class="col-lg-4">
            								<div class="form-line">
                								<label>Linkedin URL : </label>
                								<input class="form-control" type="text" name="linkedin" id="linkedin" value="{{$event_edit[0]->linkedin_url}}">        
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
						
							<tr>
								<th colspan="2">
								    <label><b>NACC Keyword</b></label>
									<div class="form-group row">
    									<div class="col-lg-12">
    									    	<select class="form-control" name="Criteria[]"  id="4thSelect"  multiple>
            										<?php
                                                            // explode the saved data back into an array                    
                                                            $project_type_naac = explode(',', $event_edit[0]->main_criteria);
                                                        	
                                                        ?>
                    									<option value="">Select Criteria</option>
                    									@foreach($naac as $row)  
                    									
                    								<option value="{{ $row->id }}" {{ in_array($row->id, $project_type_naac) ? 'selected' : '' }}>{{ $row->name}}</option>
                    								@endforeach
            								</select>
                                        </div>
                                    </div>
                                </th>
                            </tr>
							
                        <tr>
                        
                       </tbody>
					</table>
					<button class="addtocart_article-element button btn btn-success mt-3 " style="float:right;"onclick="Save()">
    <i class="material-icons">Proceed to Upload File</i>
  </button>
					</form>
						</div>
						</div>
					 <form action="{{ $fileupload }}" method="POST" id="file-upload-faculty" enctype="multipart/form-data">
                @csrf 
                <div id=uploadFormNew style="display:none">
				  <div class="form-group" >
                        <label class="col-sm-12 col-form-label" for="exampleInputName1">File Upload</label>
                         <a href="{{url('public/uploads/facultyfile/'.$event_edit[0]->uploadfile)}}" class="btn btn-success" style="float:right;" download="">Download</a>
                         
                         <input type="file" class="form-control"  name="file" 
                        id="inputFile" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$event_edit[0]->uploadfile}}">
						 <input type="hidden" class="form-control" id="editidf" name="editidf"  value="{{$event_edit[0]->id}}">
                      </div>
                     
					   <button type="submit" class="btn btn-success">Save</button>
						</form>
							<!--<button id="test1" class="test-btn" onclick="goBack()">Go Back</button>-->
				</div>
			
			</div>
              </div>
            </div>
          </div>
          </div>
          </div>
          </div>
	

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description');
	
</script>
<script >

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

$(document).ready(function(){
$(".studnew").on("change", function(){
   var total=0;
      $(".studnew").each(function(){
          if(!isNaN(parseInt($(this).val())))
          {
            total+=parseInt($(this).val());  
          }
      });
      $(".totalnew").val(total);
});
})
function Save()
{
event.preventDefault();

var title =  $('#title').val();
var Category =  $('input[name=Category]:checked').val();
var Type =  $('input[name=Type]:checked').val();
var datestart= $('#datestart').val();
var dateend= $('#dateend').val();	
var venue= $('#venue').val();	
var description =  CKEDITOR.instances.description.getData(); //$('#description').val();;
var agenda =  $('#agenda').val();;
var male_teacher= $('#male_teacher').val();
var editid= $('#editid').val();  
var female_teacher= $('#female_teacher').val();
var other_teacher= $('#other_teacher').val();
var total_teacher= $('#total_teacher').val();
var male_student= $('#male_student').val();
var female_student= $('#female_student').val();
var other_student= $('#other_student').val();
var total_student= $('#total_student').val();
var specially_abled= $('#specially_abled').val();
var caste_obc= $('#caste_obc').val();
var caste_sc= $('#caste_sc').val();
var caste_st= $('#caste_st').val();
var ews= $('#ews').val();
var promoter= $('#promoter').val();
var com_name= $('#com_name').val();
var com_det= $('#com_det').val();
var panchayath= $('#panchayath').val();
var ward= $('#ward').val();
var vurl= $('#vurl').val();
var surl= $('#surl').val();
var insta= $('#insta').val();
 var facebook= $('#facebook').val();
 var linkedin= $('#linkedin').val();
var nom= $('#nom').val();
var nof= $('#nof').val();
var catlearn= $('#catlearn').val();

var collabrators = [];    
    $("#lstSelect :selected").each(function(){
        collabrators.push($(this).val()); 
    });

var collabratorsdept = [];    
    $("#2ndSelect :selected").each(function(){
        collabratorsdept.push($(this).val()); 
    });

var collabratorscell = [];    
    $("#3rdSelect :selected").each(function(){
        collabratorscell.push($(this).val()); 
    });
 var naac = [];    
    $("#4thSelect :selected").each(function(){
        naac.push($(this).val()); 
    });
	
	var collabratorsdata = collabrators.toString();
	var collabratorsdeptdata = collabratorsdept.toString();
	var collabratorscelldata = collabratorscell.toString();
	var naacdata = naac.toString();
	
	 if(title.trim()==''){
                    swal("Warning","Enter Title","warning");
                    return false;
                }
       
		 if(datestart ==''){
                    swal("Warning","Enter Starting Date","warning");
                    return false;
                }
        if(dateend ==''){
                    swal("Warning","Enter End Date","warning");
                    return false;
                }
		 
		if(description.trim()==''){
                    swal("Warning","Enter Description","warning");
                    return false;
                }
	var m = document.getElementById("mainform");
    var i = document.getElementById("uploadFormNew");
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{ $updatevent}}",
				method:"POST",
				data:{title:title,Category:Category,Type:Type,datestart:datestart,dateend:dateend,venue:venue,description:description,agenda:agenda,male_teacher:male_teacher,female_teacher:female_teacher,other_teacher:other_teacher,total_teacher:total_teacher,male_student:male_student,female_student:female_student,other_student:other_student,total_student:total_student,specially_abled:specially_abled,caste_obc:caste_obc,caste_sc:caste_sc,caste_st:caste_st,ews:ews,promoter:promoter,com_name:com_name,com_det:com_det,panchayath:panchayath,ward:ward,vurl:vurl,nom:nom,nof:nof,catlearn:catlearn,collabratorsdata:collabratorsdata,collabratorsdeptdata:collabratorsdeptdata,collabratorscelldata:collabratorscelldata,naacdata:naacdata,surl:surl,editid:editid,linkedin:linkedin,insta:insta,facebook:facebook},
				dataType:"json",
           success: (data) => {

alert('Files has been updated');
 i.style.display = "block";
 m.style.display ="none";
},
error: function(data){
alert(data.responseJSON.errors.files[0]);
console.log(data.responseJSON.errors);
}
		   });
}
 </script>
 <script type="text/javascript">
$(document).ready(function (e) {

$('#multi-file-upload-ajax').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
let TotalFiles = $('#files')[0].files.length; //Total files
let files = $('#files')[0];
for (let i = 0; i < TotalFiles; i++) {
formData.append('files' + i, files.files[i]);
}
formData.append('TotalFiles', TotalFiles);
$.ajax({
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
url:"{{$multifileupload}}",
type:'POST',

data: formData,
cache:false,
contentType: false,
processData: false,
dataType: 'json',
success: (data) => {
this.reset();
alert('Files has been uploaded');
window.location.href = "{{$eventlist}}";
},
error: function(data){
alert(data.responseJSON.errors.files[0]);
console.log(data.responseJSON.errors);
}
});
});
});
</script>
<script type="text/javascript">

    $('#file-upload-faculty').submit(function(e) {
        e.preventDefault();
		
     
        let formData = new FormData(this);
          $('#file-input-error').text('');
        $.ajax({
            
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$editupdatefile}}",
			type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    alert('Files has been uploaded successfully');
					window.location.href = "{{$eventlist}}";
                }
            },
            error: function(response){
                $('#file-input-error').text(response.responseJSON.message);
            }
       });
    });
    

</script>
<script>
$('.test-btn').click(function() {
	var m = document.getElementById("mainform");
    var i = document.getElementById("uploadFormNew");
     i.style.display = "none";
     m.style.display ="block";
  //window.history.back();
});
</script>
@endsection