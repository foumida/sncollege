@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   @endphp
@endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">TC List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> TC List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th> Admission No </th>
							<th>Tc No </th>
						   
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->name_of_student}}</span>
                            </td>
                            <td>{{$val->admission_regno}}</td>
                         
                              <td>{{$val->tc_number}}  </td>
                             
						    
 @if(Auth::User()->role == 1)  
 @php 
   $edit=url('admin/editTc',$val->id);
  
   $delete=url('admin/deleteTc',$val->id);
 @endphp

 @endif
 @if(Auth::User()->role == 1) 
                            <td>
                              <div class="badge badge-outline-success"><a href="{{$edit}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							
							   <div class="badge badge-outline-success"> <a href="{{$delete}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							  
                            </td>@endif 
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
			
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteTc(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "url('admin/deleteTc')",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Tc Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection