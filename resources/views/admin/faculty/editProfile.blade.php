
@extends('layouts.faculty.default')

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Profile View </h3>
             
            </div>
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Profile View</h4>
                    
                    <form action="{{ route('updateProfile') }}" method="POST" id="file-upload" enctype="multipart/form-data">
                @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$profile_edit[0]->name}}">
                      </div>
					  <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$profile_edit[0]->email_id}}">
                      </div> 
					<div class="form-group">
                        <label for="exampleInputName1">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact number" value="{{$profile_edit[0]->phone_number}}">
                      </div>
						
					<div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        
                            <textarea class="form-control" id="address" name="address" rows="2" cols="100" >{{$profile_edit[0]->address}}</textarea>
                      </div>	
						<div class="form-group">
                        <label for="exampleInputName1">Highest Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" value="{{$profile_edit[0]->highest_edu}}">
                      </div> 
					  <div class="form-group">
                        <label for="exampleInputName1">Date Of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Date Of Birth" value="{{$profile_edit[0]->dob}}">
                      </div> 
					 <div class="form-group">
                        <label for="exampleInputName1">Date Of Joining</label>
                        <input type="date" class="form-control" id="doj" name="doj" placeholder="Date Of Joining" value="{{$profile_edit[0]->date_of_join}}">
                      </div> 
						<div class="form-group">
                        <label for="exampleInputName1">Department</label>
                        <input type="text" class="form-control" id="dept" name="dept" placeholder="Department" value="{{$profile_edit[0]->department}}">
                      </div>
					<div class="form-group">
                        <label for="exampleInputName1">Description</label>
                          <textarea class="form-control" id="description" name="description" rows="2" cols="100" >{{$profile_edit[0]->description}}</textarea>
                    </div>
					<div class="form-group mb-5">
                         <label for="exampleInputName1" style="float:left;">Resume</label><a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/facultyresume/'.$profile_edit[0]->resume)}}" download="">Download</a>
                         <input type="file" class="form-control"  name="file" id="inputFile" placeholder="File">
						 <span class="text-danger" id="file-input-error"></span>
						 <input type="hidden" name="current_file" value="{{$profile_edit[0]->resume}}">
                    </div>
					  <button type="submit" style="float:right;"  class="btn btn-success">Save</button>
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

    $('#file-upload').submit(function(e) {
        e.preventDefault();
		
     var name =  $('#name').val();
	 var email =  $('#email').val();
	 var phone =  $('#phone').val();
	 var address =  $('#address').val();
	 var qualification =  $('#qualification').val(); 
	 var dob =  $('#dob').val();
	 var doj =  $('#doj').val();
	 var dept =  $('#dept').val();
	 var description =  $('#description').val();
	 
		 if(name.trim()==''){
                    swal("Warning","Enter Name","warning");
                    return false;
                }
		 if(email.trim()==''){
                    swal("Warning","Enter Email","warning");
                    return false;
                }
		if(phone.trim()==''){
                    swal("Warning","Enter Contact Number","warning");
                    return false;
                }
		if(address.trim()==''){
                    swal("Warning","Enter Address","warning");
                    return false;
                }
		if(qualification.trim()==''){
                    swal("Warning","Enter Qualification Details","warning");
                    return false;
                }
		if(dob.trim()==''){
                    swal("Warning","Enter Date Of Birth","warning");
                    return false;
                }
	  if(doj.trim()==''){
                    swal("Warning","Enter Date Of Joining","warning");
                    return false;
                }
		if(dept.trim()==''){
                    swal("Warning","Enter Department","warning");
                    return false;
                }
	   if(description.trim()==''){
                    swal("Warning","Enter Description","warning");
                    return false;
                }
        let formData = new FormData(this);
          $('#file-input-error').text('');
        $.ajax({
            
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/faculty/updateProfile')}}",
			type:'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    alert('Files has been uploaded successfully');
					window.location.reload();
                }
            },
            error: function(response){
                $('#file-input-error').text(response.responseJSON.message);
            }
       });
    });
</script>
@endsection