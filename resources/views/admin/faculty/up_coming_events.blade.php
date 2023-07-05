@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
     $storeevent = url('/faculty/storeevent_upcoming');
    $storeimage =  url('/faculty/store-multi-file-ajax_seller');  
    $updateFileUpload = url('/faculty/updateFileUpload');
     $eventlist= url('/faculty/eventList');
    $autosearchMou= url('/faculty/autosearchMou');
   @endphp

   @elseif(Auth::User()->role == 6)
  
  @php $type = "layouts.hod.default";
    $storeevent = url('/hod/storeevent_upcoming');
     $storeimage =  url('/hod/store-multi-file-ajax_seller');
      $updateFileUpload = url('/hod/updateFileUpload');
        $eventlist= url('/hod/eventList');
         $autosearchMou= url('/hod/autosearchMou');
 @endphp
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Upcoming Event </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  
                </ol>
              </nav>
            </div>
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Upcoming Event</h4>
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
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="StudentExecutive"> StudentExecutive </label>
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
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Refreshing"> Refreshing Program </label>
                              </div>
                            </div>
							
							<div class="col-sm-2">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="Category" id="Category" value="Other"> Other </label>
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
							<div class="col-md-6">
								<label class="col-sm-12 col-form-label">Venue</label>
								<input type="Text" class="form-control" id="venue" placeholder="Venue">
							</div>
						</div>
						 <div class="form-group">
						    <label class="col-sm-12 col-form-label">Agenda</label>
                            <textarea id="agenda" class="form-control" name="agenda" rows="10" cols="100"></textarea>
                         </div>
						 
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
    						    </th>	
                            </tr>
                         <tr>
								<th colspan="2">
								    <label><b>MoU,Project,Grant,Fellowship</b></label>
									<div class="form-group row">
    									<div class="col-lg-12">
    									    <label>Search Name</label>
								   <input type="text" id="skillitems" name="skillitems" class="form-control skillitems" />
                                    <input type="hidden" id="skillid" name="skillid" value="0"/>
                                    <div id="skill_pos"></div> 
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
var description = CKEDITOR.instances.description.getData();  //$('#description').val();;
var agenda =  $('#agenda').val();;
var skillid =  $('#skillid').val();

var collabratorsdept = [];    
    $("#2ndSelect :selected").each(function(){
        collabratorsdept.push($(this).val()); 
    });


 var naac = [];    
    $("#4thSelect :selected").each(function(){
        naac.push($(this).val()); 
    });
	
	
	var collabratorsdeptdata = collabratorsdept.toString();
	
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
				
				
				
			
			
				
				if(naac == ''){
                    swal("Warning","Enter Naac Criteria","warning");
                    return false;
                }
                	var m = document.getElementById("mainform");
    var i = document.getElementById("imageform");
			
$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"{{ url('/faculty/storeevent_upcoming')}}",
				method:"POST",
				data:{title:title,Category:Category,Type:Type,datestart:datestart,dateend:dateend,venue:venue,description:description,agenda:agenda,collabratorsdeptdata:collabratorsdeptdata,naacdata:naacdata,skillid:skillid},
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
					window.location.href = "{{ url('/faculty/eventList')}}";
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