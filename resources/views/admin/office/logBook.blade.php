@extends('layouts.office.default')
@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
           
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Log Book </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Content</th>
							<th>Updated By </th>
						
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody> 
						 <?php $i=1; ?>
                                    @foreach($list as $val) 
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->updated_value}}.{{$val->stname}}</span>
                            </td>
                            <td>{{$val->updatedby}}</td>
                           
                             
      
        
        						    
 

                            <td>
                           
							
							  <div class="badge badge-outline-success"> <a href="{{ route('deletelogBook',$val->id) }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
function deletelogBook(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('office/deletelogBook')}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("LogBook Record Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection