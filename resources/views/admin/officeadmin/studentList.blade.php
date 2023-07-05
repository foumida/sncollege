@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
 
   @endphp
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Student List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Student List</h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th> CAP ID </th>
							<th>Program </th>
						   <th> Admission NO </th>
						   	<th> Semester </th>
                            <th> Action</th>
                            
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
                            <td>{{$val->cap_id}}</td>
                         
                              <td>{{$val->program}}  </td>
                               <td>{{$val->admission_no}}  </td>
						    <td>{{$val->semester}}  </td>
						    
 @if(Auth::User()->role == 1)  
 @php 
   $edit=url('admin/editStudent',$val->id);
   $addscholar=url('admin/addScholarship',$val->id);
   $delete=url('admin/deleteStudent',$val->id);
 @endphp

 @endif
 @if(Auth::User()->role == 1) 
                            <td>
                              <div class="badge badge-outline-success"><a href="{{$edit}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							  <!--<div class="badge badge-outline-success"><a href="{{$addscholar}}"  title="Add Scholarship" ><i class="fa fa-book" aria-hidden="true"></i></a></div>-->
							   <div class="badge badge-outline-success"> <a href="{{$delete}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							  
                            </td> @else <td> </td>@endif 
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/exportStudentList')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteCourse(id)
{
	alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "url('admin/deleteStudent')",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Student Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection