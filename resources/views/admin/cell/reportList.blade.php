@if(Auth::User()->role == 4)
   @php $type = "layouts.cell.default";
  
    $deleteReport =    url('cell/deleteReport');
  
   @endphp

  
 @endif


@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Report List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Report List</h4>
                  
   
    
           
            
            <br />
					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Title</th>
                           <th> Author</th>
                           <th> From Date</th>
                           <th> To Date</th>
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                              <span class="pl-2">{{$val->title}}</span>
                            </td>
                             <td>{{$val->author}}  </td>
                            <td>{{date('d-m-Y', strtotime($val->datestart))}}</td>
                            <td>{{date('d-m-Y', strtotime($val->dateend))}}</td>
                           
                         
                            @if(Auth::User()->role == 4)  
 @php 
   
   $deleteReport= url('cell/deleteReport',$val->id) ; 
 
 
       
 @endphp

 @endif
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{ $deleteReport }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							
                            </td>
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div></div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
function deleteReport(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $deleteReport }}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Report Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>

@endsection