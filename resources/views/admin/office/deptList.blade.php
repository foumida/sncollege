@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   $deleteDept=url('admin/deleteDept'); 
  
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $deleteDept=url('office/deleteDept');
   @endphp
    @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
    $deleteDept='';
   @endphp
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Department List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Department List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th> HoD </th>
                           <!-- <th> No Of Students </th>-->
                            
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->department}}</span>
                            </td>
                            <td>{{$val->fachod}}</td>
                          <!--  <td>{{$val->no_of_stu}} </td>-->
                                    						    
 @if(Auth::User()->role == 1)  
 @php 
   $edit=url('admin/editDept',$val->id);
   $delete=url('admin/deleteDept',$val->id);
 @endphp
@elseif(Auth::User()->role == 3)
   @php 
    $edit=url('office/editDept',$val->id);
   $delete=url('office/deleteDept',$val->id);
 @endphp
 @elseif(Auth::User()->role == 6)
   @php 
    $edit=url('hod/editDept',$val->id);
   $delete='';
 @endphp
 @endif
 
    @if((Auth::User()->role == 3) && (Auth::User()->type == 'sub'))
                            <td>
                             
							  
							  
                            </td>
							@elseif((Auth::User()->role == 3) && (Auth::User()->type == 'superdup'))
                            <td>
                             
							  <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							  
                            </td>
							@elseif((Auth::User()->role == 6))
                            <td>
                             
                              <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div> 
							  
                            </td>
                            @else
                            <td>
                              <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							
						<div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							  
                            </td>
							  @endif
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/downloadDepartmentExcel')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteDept(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $deleteDept }}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Department Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection