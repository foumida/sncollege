
@extends('layouts.faculty.default')

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Faculty Academic Progress</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  
                </ol>
              </nav>
            </div>
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Faculty Academic Progress </h4>
                     <div id="mainform">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                      </div>
					  <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Category</label>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Workshop" checked> Workshop </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Seminar"> Seminar </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Tour" > Study Tour </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Symposium"> Symposium </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Conference" > Conference </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Webinar"> Webinar </label>
                              </div>
                            </div>
							  <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="programs"> Public programs </label>
                              </div>
                            </div>
							  <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Competition"> Competition </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Orientation"> Orientation Program </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Refreshing"> Refresher Program </label>
                              </div>
                            </div>
                             <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Fdp"> Fdp </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other"> Other </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Extension & OutReach"> Extension & OutReach </label>
                              </div>
                            </div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-12">
								<label class="col-form-label">Range</label>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6 form-group">
									  <label>Date Start</label>
									  <input type="date" class="form-control form-control-lg" id="datestart" aria-label="Username">
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend" aria-label="Username">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label>Venue</label>
								<input type="Text" class="form-control" id="venue" placeholder="Venue">
							</div>
								<div class="col-md-3">
            							
                								<label>Recognition category level : </label>
                								 <select class="form-control" name="promoter" ID="promoter">
        									    	<option value="">Select </option>
        									    	<option value="National">National</option>
                									<option value="International">International</option>
                									<option value="University">University</option>
                                                    <option value="State">State</option>
                                                    <option value="District">District</option>
                                                    <option value="College">College</option>								
        										</select>    
            							
							        	</div>
						</div>
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12 form-group">
									  <label>Indulgence Level</label>
									  <select class="form-control" name="level" id="level">
										<option value="">Select </option>
        									    	<option value="Participant">Participant</option>
                									<option value="Presenter">Presenter</option>
                									<option value="Invited Lecturer">Invited Lecturer</option>
                                                    <option value="Resource Person">Resource Person</option>
                                                    <option value="Sponsor">Sponsor</option>
                                                    <option value="Chair">Chair</option>
                                                    	<option value="Keynote Presenter">Keynote Presenter</option>
                									<option value="Inauguration Talk">Inauguration Talk</option>
                									<option value="Plenary">Plenary</option>
                                                    <option value="Co-Chair">Co-Chair</option>
                                                    <option value="Discussion">Discussion</option>
                                                    <option value="Paper Presentation">Paper Presentation</option>
                                                    <option value="Poster Presentation">Poster Presentation</option>
                                                    <option value="Book Release">Book Release</option>
                                                    <option value="Awards & Competition">Awards & Competition</option>
        										</select>
									</div>
									
								</div>
							</div>
						 </div>
						 	<table class="table">

							<tbody>
						 	<tr>
								<th colspan="2" style="display:none" id="presentationlist">
								    <label><b>Paper Presentation</b></label>
									<div class="form-group row">
    									<div class="col-lg-6">
        								    <div class="form-line">
                								<label>Title : </label>
                								<input class="form-control" type="text" name="papertitle" id="papertitle">     
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Theme : </label>
                								<input class="form-control" type="text" name="theme" id="theme">        
            								</div>
							        	</div>
							        	<div class="col-lg-12">
            								<div class="form-line">
                								<label>Abstract : </label>
                							<textarea  class="form-control" name="abstract" id="abstract" rows="10" cols="100"></textarea>     
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
							 </tbody>
					</table>
						<table class="table">

							<tbody>
						 	<tr>
								<th colspan="2" style="display:none" id="awardslist">
								    <label><b>Awards</b></label>
									<div class="form-group row">
    									<div class="col-lg-4">
        								    <div class="form-line">
                								<label>Title : </label>
                								<input class="form-control" type="text" name="awardname" id="awardname">     
        								    </div>
								        </div>
								        <div class="col-lg-4">
            								<div class="form-line">
                								<label>Agency : </label>
                								<input class="form-control" type="text" name="agency" id="agency">        
            								</div>
							        	</div>
							        	<div class="col-lg-4">
            								<div class="form-line">
                								<label>Date : </label>
                						 <input type="date" class="form-control form-control-lg" id="awarddate" name="awarddate" aria-label="Username">    
            								</div>
							        	</div>
							        
							        	<div class="col-lg-12">
            								<div class="form-line">
                								<label>Event Details : </label>
                							<textarea id="eventdtl" class="form-control" name="eventdtl"  rows="10" cols="100"></textarea>     
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
							 </tbody>
					</table>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="10" cols="100"></textarea>
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
    									        <label>Collaborating Dept </label><br>
                    							<select class="form-control" name="collaboratorsdept[]" ID="2ndSelect" multiple>
            										<option value="">Select Dept</option>
            										<option value="All">All Department</option>
            										@foreach($departments as $row)
            								        <option value="{{ $row->id }}">{{ $row->department }}</option>
            						            	@endforeach
                    							</select>	
    									    </div>
    								    </div>
    								    <div class="col-md-6">
    								        <div class="form-line">
    									        <label>NAAC KEYWORD </label><br>
    									      	<select class="form-control" name="Criteria[]"  id="4thSelect"  multiple>
                									<option value="">Select KEYWORD</option>
                    									@foreach($naac as $row)
                    								<option value="{{ $row->id }}">{{ $row->name}}</option>
                    							    @endforeach
            									</select>
    								        </div>
    								    </div> 
    								</div> 
    								  <div class="form-group row">
    								   <div class="col-md-6">
    									    <div class="form-line">
    									      <label>Collaborators </label><br>
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
    						    </th>	
                            </tr>
                        	<tr>
								<th colspan="2">
								    <label><b>URL</b></label>
									<div class="form-group row">
    									<div class="col-lg-3">
        								    <div class="form-line">
                								<label>Video URL : </label>
                								<input class="form-control" type="text" name="vurl" id="vurl">     
        								    </div>
								        </div>
								        <div class="col-lg-3">
            								<div class="form-line">
                								<label>Instagram URL : </label>
                								<input class="form-control" type="text" name="insta" id="insta">        
            								</div>
							        	</div>
							        	 <div class="col-lg-3">
            								<div class="form-line">
                								<label>Facebook URL : </label>
                								<input class="form-control" type="text" name="facebook" id="facebook">        
            								</div>
							        	</div>
							        	 <div class="col-lg-3">
            								<div class="form-line">
                								<label>Linkedin URL : </label>
                								<input class="form-control" type="text" name="linkedin" id="linkedin">        
            								</div>
							        	</div>
							        	<div class="col-lg-12">
            								<div class="form-line">
                								<label>Common URL : </label>
                								<input class="form-control" type="text" name="surl" id="surl">        
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
						
                       </tbody>
					</table>
					<button class="addtocart_article-element button btn btn-success mt-3 " style="float:right;" onclick="Save()">
    <i class="material-icons">Proceed to Upload Image</i>
  </button>
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
				   <form action="{{ route('updateFileUpload') }}" method="POST" id="file-upload-faculty" enctype="multipart/form-data">
                @csrf  
				  
                        <label class="col-sm-12 col-form-label" for="exampleInputName1">File Upload</label>
                         <input type="file" class="form-control"  name="file" 
                        id="inputFile" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden"  name="editidf" id="editidf" />
						 
                      <small> (only Pdf,Doc files accepted)</small>
					   <button type="submit" class="btn btn-success mt-3 " style="float:right;">Save</button>
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
$("#level").change(function() {
   if ($(this).val() === "Paper Presentation") {
           
           // blethry.style.display="block";
            $('#presentationlist').show();
        }
        else
        {
            
             // blethry.style.display="none"
              $('#presentationlist').hide();
        }
         if ($(this).val() === "Awards & Competition") {
           
           // blethry.style.display="block";
            $('#awardslist').show();
        }
        else
        {
            
             // blethry.style.display="none"
              $('#awardslist').hide();
        }
        
});   
function Save()
{
event.preventDefault();

var title =  $('#title').val();
var Category =  $('input[name=Category]:checked').val();
var Type =  $('input[name=Type]:checked').val();
var datestart= $('#datestart').val();
var dateend= $('#dateend').val();	
var venue= $('#venue').val();	
var description =  CKEDITOR.instances.description.getData(); //$('#description').val();
//var agenda =  $('#agenda').val();
var level=$('#level').val();
 
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
	
	var vurl= $('#vurl').val();
   var surl= $('#surl').val();
   var insta= $('#insta').val();
   var facebook= $('#facebook').val();
   var linkedin= $('#linkedin').val();
    var promoter= $('#promoter').val();
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
		 
				 if(venue.trim()==''){
                    swal("Warning","Enter Venue","warning");
                    return false;
                }
				 if(description.trim()==''){
                    swal("Warning","Enter Description","warning");
                    return false;
                }
			
				
				if(naac == ''){
                    swal("Warning","Enter Naac Criteria","warning");
                    return false;
                }
                   if(promoter ==''){
                    swal("Warning","Enter Award Recognition Category Level","warning");
                    return false;
                } 
                if(level.trim()==''){
                    swal("Warning","Enter Indulgence Level","warning");
                    return false;
                }
         if ($('#level').val() === "Paper Presentation") {
         var papertitle= $('#papertitle').val();  
           var theme= $('#theme').val();
           var abstract= $('#abstract').val();
         if(papertitle.trim()==''){
                    swal("Warning","Enter Presenation Title","warning");
                    return false;
                }
          if(theme.trim()==''){
                    swal("Warning","Enter Presenation Theme","warning");
                    return false;
                }
         if(abstract.trim()==''){
                    swal("Warning","Enter Presenation Abstract","warning");
                    return false;
                }        
        }
          if ($('#level').val() === "Awards & Competition") {
         var awardname= $('#awardname').val();  
           var agency= $('#agency').val();
           var awarddate= $('#awarddate').val();
          
           var eventdtl= $('#eventdtl').val();
         if(awardname.trim()==''){
                    swal("Warning","Enter Award Name","warning");
                    return false;
                }
          if(agency.trim()==''){
                    swal("Warning","Enter Agency","warning");
                    return false;
                }
         if(awarddate ==''){
                    swal("Warning","Enter Award Date","warning");
                    return false;
                }    
       
                 if(eventdtl.trim()==''){
                    swal("Warning","Enter Event Details","warning");
                    return false;
                }
        }
        
                
                	var m = document.getElementById("mainform");
    var i = document.getElementById("imageform");
			
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{ url('/faculty/storefdp')}}",
				method:"POST",
				data:{title:title,Category:Category,Type:Type,datestart:datestart,dateend:dateend,venue:venue,description:description,collabratorsdata:collabratorsdata,collabratorsdeptdata:collabratorsdeptdata,collabratorscelldata:collabratorscelldata,naacdata:naacdata,vurl:vurl,surl:surl,level:level,papertitle:papertitle,theme:theme,abstract:abstract,awardname:awardname,agency:agency,awarddate:awarddate,promoter:promoter,eventdtl:eventdtl,linkedin:linkedin,insta:insta,facebook:facebook},
				dataType:"json",
            success:function(data){
			   $("#editid").val(data.id);
			   $("#editidf").val(data.id);
           // window.location.href = url;   
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
url:"{{ url('/faculty/store-multi-file-ajax_seller')}}",
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
			url:"{{ url('/faculty/updateFileUpload')}}",
			type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    alert('Files has been uploaded successfully');
					window.location.href = "{{ url('/faculty/fdpList')}}";
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