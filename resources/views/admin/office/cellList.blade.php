@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   $deleteCell = url('admin/deleteCell'); 
  
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $deleteCell = url('office/deleteCell');
   @endphp
   
   @elseif(Auth::User()->role == 6)
  @php $type = "layouts.hod.default";
   $deleteCell =url('hod/deleteCell');
 @endphp
 @endif
@extends($type)


@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Cell List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Cell List</h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th> Email </th>
							<th> Date Of Affliation </th>
							<th> Phone Number </th>
						
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->name_of_the_cell}}</span>
                            </td>
                            <td>{{$val->cellemail}}</td>
                            <td>{{date('d-m-Y', strtotime($val->date_of_affiliation))}}</td>
                              <td>{{$val->phone}}  </td>
						        						    
 @if(Auth::User()->role == 1)  
 @php 
   $edit=url('admin/editCell',$val->id);
   $delete=url('admin/deleteCell',$val->id);
 @endphp
@elseif(Auth::User()->role == 3)
   @php 
    $edit=url('office/editCell',$val->id);
   $delete=url('office/deleteCell',$val->id);
 @endphp
 @elseif(Auth::User()->role == 6)
   @php 
    $edit=url('hod/editCell',$val->id);
   $delete=url('hod/deleteCell',$val->id);
 @endphp
 @endif                     @if((Auth::User()->role == 3) && (Auth::User()->type == 'sub'))
                            <td>
                             
							  
							  
                            </td>
			@elseif((Auth::User()->role == 3) && (Auth::User()->type == 'superdup'))
                            <td>
                             
                                <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							  
                            </td>
                            @else
                            <td>
                              <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
						
						<div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							 
							  </div>
							 
                            </td> @endif 
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/exportCell')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteCell(id)
{

	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deleteCell}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                
            }
        });
    }
}
</script>
@endsection