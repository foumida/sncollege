@if(Auth::User()->role == 4)
   @php $type = "layouts.cell.default";
     $storeevent = url('/cell/storewebevent');
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
                    <h4 class="card-title">Cell Event</h4>
                    <div id="mainform">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                      </div>
                      
					 
						
						<div class="form-group row">
							
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>From Date</label>
									 <input type="date" class="form-control form-control-lg" id="datestart" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>To Date </label>
									  <input type="date" class="form-control form-control-lg" id="dateend" aria-label="Username">
									</div>
								</div>
							</div>
						
						</div>
					
						 
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="10" cols="100"></textarea>
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
    									        <label>Collaborators Faculty</label><br>
                    						<select class="form-control" name="collaborators[]" ID="lstSelect" class="get_value"  multiple>
                    								<option value="">Select Collaborators</option>
                    								@foreach($collabrators as $row)
                    								    <option value="{{ $row->fid }}">{{ $row->name }}</option>
                    							    @endforeach
                    							</select>	
    									    </div>
									    </div>
									    <div class="col-md-6">
									        <div class="form-line">
    									        <label>Collaborating Dept </label><br>
    									        <select class="form-control" name="collaboratorsdept[]" ID="2ndSelect" multiple>
            										<option value="">Select Dept</option>
            										<option value="1">All Department</option>
            										@foreach($departments as $row)
            								            <option value="{{ $row->id }}">{{ $row->department }}</option>
            						            	@endforeach
            									</select>
									        </div>
									    </div>
									    <div class="col-md-6">
    									    <div class="form-line">
    									        <label>Collaborating Cell </label><br>
                    							<select class="form-control" name="collaboratorscell[]" ID="3rdSelect"  multiple>
                    								<option value="">Select Cell</option>
            										@foreach($cells as $row)
            								        <option value="{{ $row->id }}">{{ $row->name_of_the_cell }}</option>
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
                								<input class="form-control" type="text" name="vurl" id="vurl">     
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Common URL : </label>
                								<input class="form-control" type="text" name="surl" id="surl">        
            								</div>
							        	</div>
							        	 <div class="col-lg-4">
            								<div class="form-line">
                								<label>Instagram URL : </label>
                								<input class="form-control" type="text" name="insta" id="insta">        
            								</div>
							        	</div>
							        	 <div class="col-lg-4">
            								<div class="form-line">
                								<label>Facebook URL : </label>
                								<input class="form-control" type="text" name="facebook" id="facebook">        
            								</div>
							        	</div>
							        	 <div class="col-lg-4">
            								<div class="form-line">
                								<label>Linkedin URL : </label>
                								<input class="form-control" type="text" name="linkedin" id="linkedin">        
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
							<tr>
								<th colspan="2">
								
									<div class="form-group row">
    								
								        <div class="col-lg-12">
            								<div class="form-line">
                								<label>Best Practises : </label>
                								<select class="form-control" name="catlearn" id="catlearn" tabindex="-98">
            									<option value="">Choose A Practise</option>
            									<option value="Experiancial">Experiancial Learning</option>
            									<option value="Marginalised">Support The Marginalised</option>
            									<option value="Other">Other</option>
            								</select>       
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
            									<option value="">Select Criteria</option>
            									@foreach($naac as $row)
            								    <option value="{{ $row->id }}">{{ $row->name}}</option>
            						        	@endforeach
            								</select>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                       </tbody>
					</table>
					<button class="addtocart_article-element button btn btn-success mt-3 " style="float:right;" onclick="Save();">Proceed to Upload Image</button>
					</form>
				</div>
				</div>
				
				<div class="form-group" style="display:none" id="imageform">
					<label class="col-sm-12 col-form-label">Image Upload</label>
				  <form id="multi-file-upload-ajax"   enctype="multipart/form-data" class="dropzone">
					<div class="fallback">
				    <input name="files[]" id="files" type="file" multiple />
					 
					</div>
					<input type="hidden"  name="editid" id="editid" />
				  <small> (only jpeg,png,jpg,gif files accepted)</small>
				   <button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Proceed to Upload File</button> 
				 </form>
				</div>			
                <div class="form-group" style="display:none" id=uploadFormNew>
				    <label class="col-sm-12 col-form-label" for="exampleInputName1">File Upload</label>
				    <form action="{{ route('updateFileUpload') }}" method="POST" id="file-upload-faculty" enctype="multipart/form-data">
                    @csrf  
                         <input type="file" class="form-control"  name="file" 
                        id="inputFile" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden"  name="editidf" id="editidf" />
						  <small> (only Pdf,Doc files accepted)</small>
					   <button type="submit" style="float:right;" class="btn btn-success mt-3">Finish</button>
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
var eventtype= $('#eventtype').val();
var Category =  $('input[name=Category]:checked').val();
var Type =  $('input[name=Type]:checked').val();
var datestart= $('#datestart').val();
var dateend= $('#dateend').val();	
var venue= $('#venue').val();	
var description =  CKEDITOR.instances.description.getData(); //$('#description').val();;
var agenda =  $('#agenda').val();;
var male_teacher= $('#male_teacher').val();

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
	var m = document.getElementById("mainform");
    var i = document.getElementById("imageform");
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
			
			
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{$storeevent}}",
				method:"POST",
				data:{title:title,eventtype:eventtype,Category:Category,Type:Type,datestart:datestart,dateend:dateend,venue:venue,description:description,agenda:agenda,male_teacher:male_teacher,female_teacher:female_teacher,other_teacher:other_teacher,total_teacher:total_teacher,male_student:male_student,female_student:female_student,other_student:other_student,total_student:total_student,specially_abled:specially_abled,caste_obc:caste_obc,caste_sc:caste_sc,caste_st:caste_st,ews:ews,promoter:promoter,com_name:com_name,com_det:com_det,panchayath:panchayath,ward:ward,vurl:vurl,nom:nom,nof:nof,catlearn:catlearn,collabratorsdata:collabratorsdata,collabratorsdeptdata:collabratorsdeptdata,collabratorscelldata:collabratorscelldata,naacdata:naacdata,surl:surl,linkedin:linkedin,insta:insta,facebook:facebook},
				dataType:"json",
            success:function(data){
			   $("#editid").val(data.id);
			    $("#editidf").val(data.id);
         
		  i.style.display = "block";
          m.style.display ="none";
		 	
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
url:"{{$storeimage}}",
type:'POST',

data: formData,
cache:false,
contentType: false,
processData: false,
dataType: 'json',
success: (data) => {
this.reset();
alert('Images has been uploaded ');
$('#mainform').css({display: 'none'});
$('#imageform').css({display: 'none'});
$('#uploadFormNew').css({display: 'block'});
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
			url:"{{$updateFileUpload }}",
			type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    alert('Files has been uploaded successfully');
					window.location.href = "{{ $eventlist}}";
                }
            },
            error: function(response){
                $('#file-input-error').text(response.responseJSON.message);
            }
       });
    });
	
	$(document).ready(function(){
$('#datestart').blur( function(){
     $('#dateend').val($(this).val());
});
});

</script>

@endsection