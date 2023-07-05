@if(Auth::User()->role == 4)
   @php $type = "layouts.faculty.default";
   $imageupload= url('/cell/store-multi-file-ajax_seller');
    $deleteimage= url('cell/deleteEventImage');
   @endphp

 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Event Images List </h3>
           
            </div>
    
	
		
				
			
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                     
                    <div id="contact" class="container">
                        <label class="col-form-label">Image Upload</label>
                        <form method="POST" action="" enctype="multipart/form-data" id="multi-file-upload-ajax">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                   <input class="form-control" name="files[]" id="files" type="file" multiple />
                                    <input type="hidden" class="form-control" id="editid" name="editid"  value="{{$idd}}"> 
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary btn-lg">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                    <br>
                    
					@if(!empty($list))	 
                    <div class="table-responsive">
                      <table class="table" id="myTable" >
                        <thead>
                          <tr>
                            <th> sl no</th>
                            <th> Image </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/faculty/'.$val->picture)}}" download="">Download</a>
                              <span class="pl-2"><img height="100" width="100" src="{{url('public/uploads/faculty/'.$val->picture)}}"  /></span>
                            </td>
     @if(Auth::User()->role == 4)  
 @php 
     
   $deleteEvent= url('cell/deleteEventImage',$val->pid) ; 
   
 
 @endphp
 @endif                      
                          
                            <td>
							
                              <div class="badge badge-outline-success"> <a href="{{ $deleteEvent }}" title="DeleteImage" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div></div>
							
                            </td>
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					
                  </div>
                </div>
            
	@endif

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
url:"{{$imageupload}}",
type:'POST',

data: formData,
cache:false,
contentType: false,
processData: false,
dataType: 'json',
success: (data) => {
this.reset();
alert('Files has been uploaded using jQuery ajax');
window.location.reload();
},
error: function(data){
alert(data.responseJSON.errors.files[0]);
console.log(data.responseJSON.errors);
}
});
});
});
</script>
<script>

function deleteEventImage(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $deleteimage}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Image  Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection