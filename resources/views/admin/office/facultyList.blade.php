@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   $deletefaculty=url('admin/deleteFaculty');
  
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $deletefaculty=url('office/deleteFaculty');
   @endphp
   @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
  
  $deletefaculty=url('hod/deleteFaculty');
   @endphp
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Faculty List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Faculty List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
							<th> Date Of Join </th>
							<th>Email </th>
							<th> DP </th>
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
                            
                            <td>{{date('d-m-Y', strtotime($val->date_of_join))}}</td>
                              <td>{{$val->email_id}}  </td>
						@if(!empty($val->picture))	<td><img src="{{url('uploads/facultyimg/'.$val->picture)}}" class="rounded-circle" alt="" style="width:100px;height:100px;"/> </td>@else
            <td><img src="{{url('public/uploads/facultyimg/download.jpeg')}}" class="rounded-circle" alt="" style="width:100px;height:100px;"/></td>
        @endif
        
        						    
 @if(Auth::User()->role == 1)  
 @php 
   $edit=url('admin/editFaculty',$val->fid);
   $delete=url('admin/deleteFaculty',$val->fid);
 @endphp
@elseif(Auth::User()->role == 3)
   @php 
    $edit=url('office/editFaculty',$val->fid);
   $delete=url('office/deleteFaculty',$val->fid);
 @endphp
  @elseif(Auth::User()->role == 6)
   @php 
    $edit='';
   $delete=url('hod/deleteFaculty',$val->fid);
 @endphp
 @endif               @if((Auth::User()->role == 3) && (Auth::User()->type == 'sub'))
                            <td>
                             
							  
							  
                            </td>
			@elseif((Auth::User()->role == 3) && (Auth::User()->type == 'superdup'))
                            <td>
                             
							   <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>  
							  
                            </td>
							@elseif((Auth::User()->role == 3))
							 <td>
                             
							   <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							    <div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
                            </td>
                            @else
                            <td>
                              <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							
							  <div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							  
                            </td>@endif
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/downloadFacultyInfo')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteFaculty(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $deletefaculty}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Faculty Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection