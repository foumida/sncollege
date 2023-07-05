
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
 
   @endphp

 
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Hod List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Hod List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
							<th>Department </th>
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
                            
                            <td>{{$val->department}}</td>
                              <td>{{$val->email}}  </td>
						@if(!empty($val->picture))	<td><img src="{{url('public/uploads/facultyimg/'.$val->picture)}}" class="rounded-circle" alt="" style="width:100px;height:100px;"/> </td>@else
            <td><img src="{{url('public/uploads/facultyimg/download.jpeg')}}" class="rounded-circle" alt="" style="width:100px;height:100px;"/></td>
        @endif
        
        						    

@if(Auth::User()->role == 3)
   @php 
    $edit=url('office/editHod/' .$val->id . '/' . $val->fid);
   
 @endphp
@endif    
 
                            <td>
                              <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" >Change HOD</a></div>
							
						
							  </div>
							  
                            </td>
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
function deleteFaculty(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "",
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