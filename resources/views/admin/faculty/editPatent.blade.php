@if(Auth::User()->role == 7)
   @php $type = "layouts.research.default";
     $autocompleteSearchResearchPerson = url('/researchguide/autocompleteSearchResearchPerson');
     $savePatent =   url('/researchguide/editInfoPatent');
     $patentList =  url('/researchguide/patentList');
   @endphp

   @elseif(Auth::User()->role == 8)
  
  @php $type = "layouts.researchfellow.default";
    $autocompleteSearchResearchPerson = url('/researchfellow/autocompleteSearchResearchPerson');
   $savePatent =   url('/researchfellow/editInfoPatent');
      $patentList =  url('/researchfellow/patentList');
 @endphp
   @elseif(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
    $autocompleteSearchResearchPerson = url('/faculty/autocompleteSearchResearchPerson');
   $savePatent =   url('/faculty/editInfoPatent');
      $patentList =  url('/faculty/patentList');
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
                    <h4 class="card-title">Edit Patent Filled</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
                      
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
								
								
									<div class="col-md-12 form-group">
									      <label>Type Of Publication</label>
									  <select class="form-control" name="typepublication" id="typepublication">
                                                        <option value="">Select</option>
                                                        <option value="Research Articles" @if($profile_edit[0]->typepublication == 'Research Articles') Selected @endif>Research Articles</option>
                                                         <option value="Research paper" @if($profile_edit[0]->typepublication == 'Research paper') Selected @endif>Research paper</option>
                                                         <option value="Research Communications" @if($profile_edit[0]->typepublication == 'Research Communications') Selected @endif>Research Communications</option>
                                                         <option value="Others" @if($profile_edit[0]->typepublication == 'Others') Selected @endif>Others</option>
                                                        
                                                    </select>
									</div>
								
								</div>
							</div>
							
						</div>
					
						<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label>Author(s)</label>
									 <input type="text" class="form-control" id="Author" name="Author" placeholder="Author" value="{{$profile_edit[0]->author}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Title of Patent</label>
									   <input type="text" class="form-control" id="title" name="title" placeholder="Title Of Patent" value="{{$profile_edit[0]->title}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Type</label>
						            	  <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="{{$profile_edit[0]->type}}">
									</div>
								</div>
							</div>
							
						</div>
							<div class="form-group row">
						
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
								<label>Date Of Filling</label>
									 <input type="date" class="form-control" id="datefilling" name="datefilling" placeholder="Date Of Filling" value="{{$profile_edit[0]->datefilling}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Date Of Award</label>
									   <input type="date" class="form-control" id="dateaward" name="dateaward" placeholder="Date Of Award" value="{{$profile_edit[0]->dateaward}}">
									</div>
									<div class="col-md-4 form-group">
									  <label>Collaborator</label>
						            	  <input type="text" class="form-control" id="collaborator" name="collaborator" placeholder="collaborator" value="{{$profile_edit[0]->collaborator}}">
									</div>
								</div>
							</div>
							
						</div>
			
						<div class="col-md-12">
								<div class="row">
									<div class="col-md-4 form-group">
									  <label> DOI/URL </label>
									 <input type="text" class="form-control" id="url" name="url" placeholder=" DOI/URL"  value="{{$profile_edit[0]->url}}">
									 <input type="hidden" class="form-control" id="editid" name="editid" value="{{$profile_edit[0]->id}}">
									</div>
									<div class="col-md-4 form-group">
									  <label> Patent No </label>
									   <input type="text" class="form-control" id="patentno" name="patentno" placeholder="Patentno" value="{{$profile_edit[0]->patentno}}">
									</div>
									<div class="col-md-4 form-group">
								
						            <label>Upload Proof</label>
							      <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/journal/'.$profile_edit[0]->document)}}" download="">Download</a>
							    <input type="file" class="form-control" id="file1" name="file1"  />
							    <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->document}}">
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

    <script>
       $(document).ready(function(){
	  $( "#skillitems" ).autocomplete({
	      source: function( request, response ) {
             var type =  $('#publisherwhom').val();
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$autocompleteSearchResearchPerson}}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term,
              type:type
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

<script type="text/javascript">

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();

var typepublication =  $('#typepublication').val();                   
var Author= $('#Author').val();	
var title= $('#title').val();	
var type =  $('#type').val();
var datefilling =  $('#datefilling').val();
var dateaward= $('#dateaward').val();
var collaborator= $('#collaborator').val();
var url= $('#url').val();
var patentno= $('#patentno').val();




		
         if(typepublication==''){
                    swal("Warning","Enter Type Of Publication","warning");
                    return false;
                }
    
     
         if(Author ==''){
                    swal("Warning","Enter Author Name","warning");
                    return false;
                }
          if(title ==''){
                    swal("Warning","Enter Title of Journal","warning");
                    return false;
                }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$savePatent}}",
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
                    alert('Patent Details has been updated successfully');
					window.location.href = "{{$patentList}}";
                }
            },
        });
    });
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