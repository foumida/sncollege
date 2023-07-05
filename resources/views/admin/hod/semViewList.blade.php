@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
   $searchlist = url('faculty/searchList/'); 
    $fetchsem=url('/faculty/fetchSem');
   @endphp

   @elseif(Auth::User()->role == 6)
  
  @php $type = "layouts.hod.default";
  $searchlist = url('hod/searchList/') ;
   $fetchsem=url('/hod/fetchSem');
 @endphp

 @endif
@extends($type)


@section('content')
          <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Semester List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Semester List</h4>
                  
   
    
            <br />
                <form id="fupForm" method="POST" action="{{$searchlist}}"> 
                  @csrf
            <div class="row">
                <div class="col-md-4">
                    	<label>Batch : </label>  <input type="hidden" value="{{$courseid}}" name="courseid" id="courseid">
                								 <select class="form-control" name="batch" ID="batch">
        									    	<option value="">Select </option>
            									    @foreach($batch as $row)
            								            <option value="{{ $row->batch }}">{{ $row->batch }}</option>
            						            	@endforeach								
        										</select>    
            							
                </div>
                <div class="col-md-4">
                  	<label>Semester: </label>  
                								 <select class="form-control" name="semester" Id="semester">
        									    	<option value="">Select </option>
        									    	<option value="Semester 1" disabled>Semester 1</option>
                									<option value="Semester 2" disabled>Semester 2</option>
                									<option value="Semester 3" disabled>Semester 3</option>
                                                    <option value="Semester 4" disabled>Semester 4</option>
                                                    <option value="Semester 5" disabled>Semester 5</option>
                                                    <option value="Semester 6" disabled>Semester 6</option>								
        										</select>    
                </div>
                <div class="col-md-4">
                    <button type="submit" name="filter" id="filter" value="refine" class="btn btn-primary" onclick="return ValidateTextBox()">Refine</button>
                   
                    <button type="button" name="refresh" id="refresh" class="btn btn-success">Refresh</button>
                    <button class="btn btn-info" href="" name="filter" value="download" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel</button>
                     
                    
                </div>
            </div>
            </form>
            
            <br />
					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th>Roll No </th>
                            <th> Batch</th>
                            <th> Admission No </th>
                            <th> Admission Date</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                              <span class="pl-2">{{$val->name}}</span>
                            </td>
                            <td>{{$val->roll_no}}</td>
                             <td>{{$val->batch}}  </td>
                             <td>{{$val->admission_no}}  </td>
                            <td>{{date('d-m-Y', strtotime($val->date_of_admission))}}</td>
                           
                           <td>{{$val->gender}}  </td>
                            <td>{{date('d-m-Y', strtotime($val->dob))}}</td>
                            @if(Auth::User()->role == 2)
                             @php 
                             $fetchsem=url('/faculty/fetchSem');
                             @endphp
                             <td>
                            
                              <div class="badge badge-outline-success"><a href="{{url('faculty/studentProgression/'.$val->roll_no.'/'.$val->batch)}}"  title="VIEW" >Enter Marks</a></div>
							  <div class="badge badge-outline-success"><a href="{{url('faculty/individualMarks/'.$val->roll_no.'/'.$val->batch)}}"  title="VIEW" >External Marksheet</a></div>
							  </td>
							  	@endif
							  	@if(Auth::User()->role == 6)
							  	@php 
                                $fetchsem=url('/hod/fetchSem');
                                @endphp
                             <td>
                              <div class="badge badge-outline-success"><a href="{{url('hod/editStudent',$val->id)}}"  title="VIEW" >Edit</a></div>     
                              <div class="badge badge-outline-success"><a href="{{url('hod/studentProgression/'.$val->id.'/'.$val->batch)}}"  title="VIEW" >Enter Marks</a></div>
							  <div class="badge badge-outline-success"><a href="{{url('hod/individualMarks/'.$val->id.'/'.$val->batch)}}"  title="VIEW" >External Marksheet</a></div>
							  </td>
							  	@endif
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                      </div>
                    </div>
					@endif
					<div></div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

  function ValidateTextBox() {
        if ((document.getElementById("batch").value.trim() == "")) {
            alert("Enter Batch");
            return false;
        }
    };
    
    $("#batch").change(function()
{
var id=$(this).val();


 $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$fetchsem}}",
            type: 'GET',
            data:{'id':id},
            dataType: 'json',
           success: function(res) {


                  //  $("#sem1").html(res[0]['semname']);
                  $("#semester").val(res[0]['semname']);

                }
                  
        });
});
</script>
<script>

$(document).ready(function(){
 $('#refresh').click(function(){
  $('#batch').val('');
  $('#semester').val('');
location.reload();
 });

});
 function exportStudent(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

@endsection