
@extends('layouts.faculty.default')

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Edit Fdp </h3>
              <nav aria-label="breadcrumb">
              
              </nav>
            </div>
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Fdp</h4>
                    <div id="mainform">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name" value="{{$event_edit[0]->title}}">
                      </div>
					  <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$event_edit[0]->id}}">
					  <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Category</label>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Workshop" @if($event_edit[0]->category=='Workshop') checked @endif> Workshop </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Seminar" @if($event_edit[0]->category=='Seminar') checked @endif> Seminar </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Tour" @if($event_edit[0]->category=='Tour') checked @endif> Study Tour </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Symposium" @if($event_edit[0]->category=='Symposium') checked @endif> Symposium </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Conference" @if($event_edit[0]->category=='Conference') checked @endif> Conference </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Webinar" @if($event_edit[0]->category=='Webinar') checked @endif> Webinar </label>
                              </div>
                            </div>
							  <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="programs" @if($event_edit[0]->category=='programs') checked @endif> Public programs </label>
                              </div>
                            </div>
							  <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Competition" @if($event_edit[0]->category=='Competition') checked @endif> Competition </label>
                              </div>
                            </div>
                             <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Orientation" @if($event_edit[0]->category=='Orientation') checked @endif> Orientation Program </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Refreshing" @if($event_edit[0]->category=='Refreshing') checked @endif> Refresher Program </label>
                              </div>
                            </div>
                             <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Fdp" @if($event_edit[0]->category=='Fdp') checked @endif> Fdp </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other" @if($event_edit[0]->category=='Other') checked @endif> Other </label>
                              </div>
                            </div>
								<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other" @if($event_edit[0]->category=='Extension & OutReach') checked @endif>  Extension & OutReach  </label>
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
									  <input type="date" class="form-control form-control-lg" id="datestart"  value="{{$event_edit[0]->from_date}}" >
									</div>
									<div class="col-md-6 form-group">
									  <label>Date End</label>
									  <input type="date" class="form-control form-control-lg" id="dateend"  value="{{$event_edit[0]->to_date}}" >
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="col-sm-12 col-form-label">Venue</label>
								<input type="Text" class="form-control" id="venue" placeholder="Venue" value="{{$event_edit[0]->venue}}">
							</div>
							<div class="col-lg-3">
            								<div class="form-line">
                								<label>Awards & Recognition category level : </label>
                								 <select class="form-control" name="promoter" ID="promoter">
        									    	<option value="">Select </option>
        									    	<option value="National" @if($event_edit[0]->awrd_promoter=='National') selected @endif>National</option>
                									<option value="International" @if($event_edit[0]->awrd_promoter=='International') selected @endif>International</option>
                									<option value="University" @if($event_edit[0]->awrd_promoter=='University') selected @endif>University</option>
                                                    <option value="State" @if($event_edit[0]->awrd_promoter=='State') selected @endif>State</option>
                                                    <option value="District" @if($event_edit[0]->awrd_promoter=='District') selected @endif>District</option>
                                                    <option value="College" @if($event_edit[0]->awrd_promoter=='College') selected @endif>College</option>								
        										</select>    
            								</div>
							        	</div>
						</div>
						 	<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12 form-group">
									  <label>Indulgence Level</label>
									  <select class="form-control" name="level" id="level">
										<option value="">Select </option>
        									    	<option value="Participant" @if($event_edit[0]->indulgence_level=='Participant') selected @endif>Participant</option>
                									<option value="Presenter" @if($event_edit[0]->indulgence_level=='Presenter') selected @endif>Presenter</option>
                									<option value="Invited Lecturer" @if($event_edit[0]->indulgence_level=='Invited Lecturer') selected @endif>Invited Lecturer</option>
                                                    <option value="Resource Person" @if($event_edit[0]->indulgence_level=='Resource Person') selected @endif>Resource Person</option>
                                                    <option value="Sponsor" @if($event_edit[0]->indulgence_level=='Sponsor') selected @endif>Sponsor</option>
                                                    <option value="Chair" @if($event_edit[0]->indulgence_level=='Chair') selected @endif>Chair</option>
                                                    	<option value="Keynote Presenter" @if($event_edit[0]->indulgence_level=='Keynote Presenter') selected @endif>Keynote Presenter</option>
                									<option value="Inauguration Talk" @if($event_edit[0]->indulgence_level=='Inauguration Talk') selected @endif>Inauguration Talk</option>
                									<option value="Plenary" @if($event_edit[0]->indulgence_level=='Plenary') selected @endif>Plenary</option>
                                                    <option value="Co-Chair" @if($event_edit[0]->indulgence_level=='Co-Chair') selected @endif>Co-Chair</option>
                                                    <option value="Discussion"  @if($event_edit[0]->indulgence_level=='Discussion') selected @endif>Discussion</option>
                                                    <option value="Paper Presentation" @if($event_edit[0]->indulgence_level=='Paper Presentation') selected @endif>Paper Presentation</option>
                                                    <option value="Poster Presentation" @if($event_edit[0]->indulgence_level=='Poster Presentation') selected @endif>Poster Presentation</option>
                                                    <option value="Book Release" @if($event_edit[0]->indulgence_level=='Book Release') selected @endif>Book Release</option>
                                                    <option value="Awards & Competition" @if($event_edit[0]->indulgence_level=='Awards & Competition') selected @endif>Awards & Competition</option>
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
                								<input class="form-control" type="text" name="papertitle" id="papertitle" value="{{$event_edit[0]->paper_title}}">     
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Theme : </label>
                								<input class="form-control" type="text" name="theme" id="theme" value="{{$event_edit[0]->paper_theme}}">        
            								</div>
							        	</div>
							        	<div class="col-lg-12">
            								<div class="form-line">
                								<label>Abstract : </label>
                							<textarea  class="form-control" name="abstract" id="abstract" rows="10" cols="100" value="{{$event_edit[0]->paper_abstract}}"></textarea>     
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
                								<input class="form-control" type="text" name="awardname" id="awardname" value="{{$event_edit[0]->award_name}}">     
        								    </div>
								        </div>
								        <div class="col-lg-4">
            								<div class="form-line">
                								<label>Agency : </label>
                								<input class="form-control" type="text" name="agency" id="agency" value="{{$event_edit[0]->agency}}">        
            								</div>
							        	</div>
							        	<div class="col-lg-4">
            								<div class="form-line">
                								<label>Date : </label>
                						 <input type="date" class="form-control form-control-lg" id="awarddate" name="awarddate" value="{{$event_edit[0]->awarddate}}">    
            								</div>
							        	</div>
							        
							        	<div class="col-lg-12">
            								<div class="form-line">
                								<label>Event Details : </label>
                							<textarea id="eventdtl" class="form-control" name="eventdtl"  rows="10" cols="100" value="{{$event_edit[0]->eventdtl}}">{{$event_edit[0]->eventdtl}}</textarea>     
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
							 </tbody>
					</table>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Description</label>
                             <textarea id="description" class="form-control" name="description" rows="6" cols="100">{{$event_edit[0]->description}}</textarea>
                         </div>
							
						
						
						
						
						
						  <div class="form-group">
							<label for="exampleInputEmail3">More Informations</label>
							<table class="table">

							<tbody>
						
								<tr>
								    	<th>Collaborators: </th>
								<th >
								  
									<div class="form-group">
									  
    									    <div class="form-line">
    									        <label> Collaborators </label>
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
									   
								</th>
							</tr>
							<tr>
								    	<th>Collaborators cell: </th>
								<th >
								  
									<div class="form-group">
									  
    									    <div class="form-line">
    									        <label> Collaborators cell </label>
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
									   
								</th>
							</tr>
								<tr>
								<th>Collaborating Dept: </th>
								<th>
									<div class="form-group">
									<div class="form-line">
									<label>Collaborating Dept : </label>
									
									<select class="form-control" name="collaboratorsdept[]" ID="2ndSelect" multiple>
									<?php
    // explode the saved data back into an array                    
    $project_type_dept = explode(',', $event_edit[0]->dept);
	
?>
										<option value="">Select Dept</option>
										<option value="All" @if($event_edit[0]->dept=='All') selected @endif>All Department</option>
																@foreach($departments as $row)
																
								<option value="{{ $row->id }}" {{ in_array($row->id, $project_type_dept) ? 'selected' : '' }}>{{ $row->department }}</option>
							
								@endforeach							</select>	
									
									  </div>
									</div>
									
									
									
								</th>
							</tr>
								
                        <th>NAAC KEYWORD : </th>
							<th>  
								<div class="form-group">
								<div class="form-line">
								<label>Main KEYWORD : </label>
								<select class="form-control" name="Criteria[]"  id="4thSelect"  multiple>
								<?php
    // explode the saved data back into an array                    
    $project_type_naac = explode(',', $event_edit[0]->main_criteria);
	
?>
									<option value="">Select KEYWORD</option>
									@foreach($naac as $row)  
									
								<option value="{{ $row->id }}" {{ in_array($row->id, $project_type_naac) ? 'selected' : '' }}>{{ $row->name}}</option>
								@endforeach
							
								</select>
								  </div>
								</div>
                            </th>
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
							        	 <div class="col-lg-3">
            								<div class="form-line">
                								<label>Instagram URL : </label>
                								<input class="form-control" type="text" name="insta" id="insta" value="{{$event_edit[0]->instagram_url}}">        
            								</div>
							        	</div>
							        	 <div class="col-lg-3">
            								<div class="form-line">
                								<label>Facebook URL : </label>
                								<input class="form-control" type="text" name="facebook" id="facebook" value="{{$event_edit[0]->facebook_url}}">        
            								</div>
							        	</div>
							        	 <div class="col-lg-3">
            								<div class="form-line">
                								<label>Linkedin URL : </label>
                								<input class="form-control" type="text" name="linkedin" id="linkedin" value="{{$event_edit[0]->linkedin_url}}">        
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
                       </tbody>
					</table>
					<button class="addtocart_article-element button btn btn-success mt-3 " style="float:right;"onclick="Save()">
    <i class="material-icons">Proceed to Upload File</i>
  </button>
				</form>
					</div>
						</div>
					 <form action="{{ route('updateFileUpload') }}" method="POST" id="file-upload-faculty" enctype="multipart/form-data">
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
            	</div>
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
$(document).ready(function(){
var indulgence = <?php echo json_encode($event_edit[0]->indulgence_level); ?>;
if (indulgence === "Paper Presentation") {
           
           // blethry.style.display="block";
            $('#presentationlist').show();
        }
        else
        {
            
             // blethry.style.display="none"
              $('#presentationlist').hide();
        }
         if (indulgence === "Awards & Competition") {
           
           // blethry.style.display="block";
            $('#awardslist').show();
        }
        else
        {
            
             // blethry.style.display="none"
              $('#awardslist').hide();
        }
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
var description = CKEDITOR.instances.description.getData();  //$('#description').val();


var editid= $('#editid').val();  
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
	 var promoter= $('#promoter').val();
	var vurl= $('#vurl').val();
    var surl= $('#surl').val();
	  var insta= $('#insta').val();
    var facebook= $('#facebook').val();
    var linkedin= $('#linkedin').val();
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
    var i = document.getElementById("uploadFormNew");
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{ url('/faculty/updateFdp')}}",
				method:"POST",
				data:{title:title,Category:Category,Type:Type,datestart:datestart,dateend:dateend,venue:venue,description:description,collabratorsdata:collabratorsdata,collabratorsdeptdata:collabratorsdeptdata,collabratorscelldata:collabratorscelldata,naacdata:naacdata,vurl:vurl,surl:surl,level:level,papertitle:papertitle,theme:theme,abstract:abstract,awardname:awardname,agency:agency,awarddate:awarddate,promoter:promoter,eventdtl:eventdtl,editid:editid,linkedin:linkedin,insta:insta,facebook:facebook},
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
url:"{{ url('/faculty/store-multi-file-ajax_seller')}}",
type:'POST',

data: formData,
cache:false,
contentType: false,
processData: false,
dataType: 'json',
success: (data) => {
this.reset();
alert('Files has been uploaded');
window.location.href = "{{ url('/faculty/fdpList')}}";
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
			url:"{{ url('/faculty/editupdateFileUpload')}}",
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
</script>
@endsection