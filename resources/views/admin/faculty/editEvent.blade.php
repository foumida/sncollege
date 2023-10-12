@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
     $fileupload = route('updateFileUpload');
     $updatevent = url('/faculty/updateEvent');
   $multifileupload =  url('/faculty/store-multi-file-ajax_seller');
  $eventlist = url('/faculty/eventList');
   
  $editupdatefile = url('/faculty/editupdateFileUpload');
  $autosearchMou= url('/faculty/autosearchMou');
   @endphp

   @elseif(Auth::User()->role == 6)
  
  @php $type = "layouts.hod.default";
    $fileupload = route('updateFileUpload');
     $updatevent = url('/hod/updateEvent');
      $multifileupload =  url('/hod/store-multi-file-ajax_seller');
       $eventlist = url('/hod/eventList');
        $editupdatefile = url('/hod/editupdateFileUpload');
		  $autosearchMou= url('/hod/autosearchMou');
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
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="StudentExecutive" @if($event_edit[0]->category=='StudentExecutive') checked @endif> StudentExecutive </label>
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
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Competition" @if($event_edit[0]->category=='Competition') checked @endif> Competition </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Orientation"  @if($event_edit[0]->category=='Orientation') checked @endif> Orientation Program </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Refreshing"  @if($event_edit[0]->category=='Refreshing') checked @endif> Refresher Program </label>
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Refreshing"  @if($event_edit[0]->category=='Extension & OutReach') checked @endif> Extension & OutReach </label>
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
							<div class="col-md-6">
								<label class="col-sm-12 col-form-label">Venue</label>
								<input type="Text" class="form-control" id="venue" placeholder="Venue" value="{{$event_edit[0]->venue}}">
							</div>
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Agenda</label>
                            <textarea id="agenda" name="agenda" cols="100" rows="10" class="form-control" >{{$event_edit[0]->agenda}}</textarea>
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
								    <label><b>Teacher Details : </b></label>
									<div class="form-group row">
    									<div class="col-lg-3">
    										<div class="form-line">
    										    <label>Male Teacher  </label>
    										    <input class="form-control teachernew" type="text" name="male_teacher" id="male_teacher"  value="{{$event_edit[0]->male_teacher}}">
    										</div>
    									</div>	 
    									<div class="col-lg-3">
    										<div class="form-line">
    										    <label>Female Teacher  </label>
    										    <input class="form-control teachernew" type="text" name="female_teacher" id="female_teacher" placeholder="Female Teacher"value="{{$event_edit[0]->female_teacher}}">
    										</div>
    									</div>
    								    <div class="col-lg-3">
    									    <div class="form-line">
    										    <label>Other Teacher  </label>
    										    <input class="form-control teachernew" type="text" name="other_teacher" id="other_teacher" placeholder="Other Teacher" value="{{$event_edit[0]->other_teacher}}">
    										</div>
    								    </div>
    								    <div class="col-lg-3">
        									<div class="form-line focused">
        										<label>Total Teacher  </label>
        										<input class="form-control total" type="text" id="total_teacher" name="total_teacher" placeholder="Total Teacher" value="{{$event_edit[0]->no_teachers}}">        
        									</div>
    								    </div>
    								</div>
								</th>
							</tr>
						    <tr>
								<th colspan="2">
								    <label><b>Student Details  </b></label>
									<div class="form-group row">
    									<div class="col-lg-3">
        									<div class="form-line">
        									    <label>Male Student  </label>
        									    <input class="form-control studnew" type="text" id="male_student" name="male_student" placeholder="Male Students" value="{{$event_edit[0]->male_student}}">      
        									</div>
									    </div>
    									<div class="col-lg-3">
        									<div class="form-line">
            									<label>Female Student </label>
            									<input class="form-control studnew" type="text" id="female_student" name="female_student" placeholder="Female Students" value="{{$event_edit[0]->female_student}}">      
        									</div>
    									</div>
    									<div class="col-lg-3">
        									<div class="form-line">
            									<label>Other Student  </label>
            									<input class="form-control studnew" type="text" id="other_student" name="other_student" placeholder="Other Students" value="{{$event_edit[0]->other_student}}">        
        									</div>
    									</div>
                                        <div class="col-lg-3">
        									<div class="form-line focused">
            									<label>Total Student </label>
            									<input class="form-control totalnew" type="text" id="total_student" name="total_student" placeholder="Total Students" value="{{$event_edit[0]->no_students}}">        
        									</div>
								    	</div>
    									<div class="col-lg-2">
        									<div class="form-line">
            									<label>Specially abled  </label>
            									<input class="form-control" type="text" name="specially_abled" id="specially_abled" placeholder="Specially abled" value="{{$event_edit[0]->specially_abled}}">         
        									</div>
    									</div>
    									<div class="col-lg-2">
        									<div class="form-line">
            									<label>SC  </label>
            									<input class="form-control" type="text" name="caste_sc" id="caste_sc" placeholder="SC" value="{{$event_edit[0]->caste_sc}}">       
        									</div>
    									</div>
    									<div class="col-lg-2">
        									<div class="form-line">
            									<label>ST  </label>
            									<input class="form-control" type="text" name="caste_st" id="caste_st" placeholder="ST" value="{{$event_edit[0]->caste_st}}">         
        									</div>
    									</div>
    									<div class="col-lg-2">
        									<div class="form-line">
            									<label>OBC  </label>
            								<input class="form-control" type="text" name="caste_obc" id="caste_obc" placeholder="OBC" value="{{$event_edit[0]->caste_obc}}">         
        									</div>
    									</div>
    									<div class="col-lg-2">
        									<div class="form-line">
            									<label>EWS  </label>
            									<input class="form-control" type="text" name="ews"  id ="ews" placeholder="EWS" value="{{$event_edit[0]->ews}}">        
        									</div>
    									</div>
    								</div>
								</th>
							</tr>
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
									    <div class="col-md-6">
									        <div class="form-line">
    									        <label>Promotor Details </label><br>
    									        <select class="form-control" name="promoter"  id="promoter"  tabindex="-98" >
										<option value="">Select Promoters</option>
									<option value="Central" @if($event_edit[0]->promotors=='Central') selected @endif>Central</option>
										<option value="State"  @if($event_edit[0]->promotors=='State') selected @endif>State</option>
<option value="Regional" @if($event_edit[0]->promotors=='Regional') selected @endif>Regional</option>		<option value="College" @if($event_edit[0]->promotors=='College') selected @endif>College</option>								
															</select>
									        </div>
									    </div>
									</div>
								<th>
							</tr>
						    <tr>
								<th colspan="2">
								    <label><b>Community</b></label>
									<div class="form-group row">
    									<div class="col-lg-6">
        								    <div class="form-line">
                								<label>Name : </label>
                								<input class="form-control" type="text" name="com_name" id="com_name" value="{{$event_edit[0]->comm_name}}">         
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Details : </label>
                								<input class="form-control" type="text" name="com_det" id="com_det" value="{{$event_edit[0]->comm_details}}">          
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
                            <tr>
								<th colspan="2">
								    <label><b>Local Body </b></label>
									<div class="form-group row">
    									<div class="col-lg-6">
        								    <div class="form-line">
                								<label>Panchayath : </label>
                								<input class="form-control" type="text" name="panchayath" id="panchayath" value="{{$event_edit[0]->panchayath}}">       
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Ward : </label>
                								<input class="form-control" type="text" name="ward" id="ward" value="{{$event_edit[0]->ward}}">       
            								</div>
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
								    <label><b>Participants</b></label>
									<div class="form-group row">
    									<div class="col-lg-6">
        								    <div class="form-line">
                								<div class="row">
    									            <div class="col-lg-6"> 
    									                <label>No Male </label>
                								        <input type="text" class="form-control" name="nom" id="nom" placeholder="No of Male" value="{{$event_edit[0]->no_male}}">   
        								            </div>
        								            <div class="col-lg-6">
        								                <label> No Female </label>
                								       <input type="text"  class="form-control" name="nof" id="nof" placeholder="No of Female" value="{{$event_edit[0]->no_female}}">  
        								            </div>
        								        </div>
        								    </div>
								        </div>
								        <div class="col-lg-6">
            								<div class="form-line">
                								<label>Best Practises : </label>
                								<select class="form-control" name="catlearn" id="catlearn" tabindex="-98">
                									<option value="">Choose A Practise</option>
                									<option value="Experiancial" @if($event_edit[0]->practice=='Experiancial') selected @endif>Experiancial Learning</option>
                									<option value="Marginalised" @if($event_edit[0]->practice=='Marginalised') selected @endif>Support The Marginalised</option>
                									<option value="Other">Other</option>
                								</select>
            								</div>
							        	</div>
							        </div>
								</th>
							</tr>
							<tr>
								<th colspan="2">
								    <label><b>NAAC KEYWORD</b></label>
									<div class="form-group row">
    									<div class="col-lg-12">
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
								    <label><b>MoU,Project,Grant,Fellowship</b></label>
									<div class="form-group row">
    									<div class="col-lg-12">
    									    <label>Search Name</label>
								   <input type="text" id="skillitems" name="skillitems" class="form-control skillitems" value="{{$event_edit[0]->moutitle}}"/>
                                    <input type="hidden" id="skillid" name="skillid" value="0" value="{{$event_edit[0]->mouid}}"/>
                                    <div id="skill_pos"></div> 
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
					 <form action="{{ route('updateFileUpload') }}" method="POST" id="file-upload-faculty" enctype="multipart/form-data">
                @csrf 
                <div id=uploadFormNew style="display:none">
				  <div class="form-group" >
                        <label class="col-sm-12 col-form-label" for="exampleInputName1">File Upload</label>
                         <a href="{{url('uploads/facultyfile/'.$event_edit[0]->uploadfile)}}" class="btn btn-success" style="float:right;" download="">Download</a>
                         
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
<script type="text/javascript">
  $(document).ready(function(){
	  $( "#skillitems" ).autocomplete({
        source: function( request, response ) {
			var type =  $('#publisherwhom').val();
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$autosearchMou}}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term,
			  type :type
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('.skillitems').val(ui.item.label);// display the selected text
          $('#skillid').val(ui.item.value); // save selected id to input
		 
          return false;
        },
appendTo: "#skill_pos",
      });
        });
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
var description = CKEDITOR.instances.description.getData();// $('#description').val();;
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
var skillid =  $('#skillid').val();
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
		 
				 if(venue.trim()==''){
                    swal("Warning","Enter Venue","warning");
                    return false;
                }
				 if(description.trim()==''){
                    swal("Warning","Enter Description","warning");
                    return false;
                }
				if(agenda.trim()==''){
                    swal("Warning","Enter Agenda","warning");
                    return false;
                }
				if(male_teacher ==''||female_teacher ==''){
                    swal("Warning","Enter number ofMale/Female Teacher","warning");
                    return false;
                }
				if(male_student ==''||female_student ==''){
                    swal("Warning","Enter number of Male/Female Student","warning");
                    return false;
                }
				if(caste_sc ==''||caste_st ==''||caste_obc==''){
                   swal("Warning","Enter number of SC/ST/OBC Students","warning");
                    return false;
                }
				
				if(naac == ''){
                    swal("Warning","Enter Naac Criteria","warning");
                    return false;
                }
	var m = document.getElementById("mainform");
    var i = document.getElementById("uploadFormNew");
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{$updatevent}}",
				method:"POST",
				data:{title:title,Category:Category,Type:Type,datestart:datestart,dateend:dateend,venue:venue,description:description,agenda:agenda,male_teacher:male_teacher,female_teacher:female_teacher,other_teacher:other_teacher,total_teacher:total_teacher,male_student:male_student,female_student:female_student,other_student:other_student,total_student:total_student,specially_abled:specially_abled,caste_obc:caste_obc,caste_sc:caste_sc,caste_st:caste_st,ews:ews,promoter:promoter,com_name:com_name,com_det:com_det,panchayath:panchayath,ward:ward,vurl:vurl,nom:nom,nof:nof,catlearn:catlearn,collabratorsdata:collabratorsdata,collabratorsdeptdata:collabratorsdeptdata,collabratorscelldata:collabratorscelldata,naacdata:naacdata,surl:surl,editid:editid,linkedin:linkedin,insta:insta,facebook:facebook,skillid:skillid},
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
url:"{{ $multifileupload}}",
type:'POST',

data: formData,
cache:false,
contentType: false,
processData: false,
dataType: 'json',
success: (data) => {
this.reset();
alert('Files has been uploaded');
window.location.href = "{{ url('/faculty/eventList')}}";
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