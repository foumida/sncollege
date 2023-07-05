
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $deleteGeneral=url('office/deleteGeneral');
   @endphp
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">General List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">General List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Title</th>
							 <th> Category</th>
                            <th> Date </th>
                            <th> Uploaded Document</th>
                            
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->titlename}}</span>
                            </td>
							<td>{{$val->title}}</td>
                            <td>{{$val->from_date}}</td>
                         <td><a href="{{url('public/uploads/general/'.$val->document)}}" download="" target="_blank">@if(!empty($val->document))<img src="{{asset('front_end/assets/img//pdf.png')}}" width="60px" height="auto">@endif</a></td>
                                    						    
 
@if(Auth::User()->role == 3)
   @php 
 
   $delete=url('office/deleteGeneral',$val->id);
 @endphp
 @endif                 @if((Auth::User()->role == 3) && (Auth::User()->type == 'sub'))
                            <td>
                             
							  
							  
                            </td>
                            @else
                            <td>
                          
							
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
				
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteGeneral(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $deleteGeneral }}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert(" Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection