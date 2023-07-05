
@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $deleteResearchFellow = url('office/deleteResearchFellow');
   @endphp
  
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
             
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Research Fellow List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th> Research Centre</th>
                            <th> Name of Supervisor </th>
							<th> Department</th>
						    <th> Designation</th>
						    <th> Title</th>
						   
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
                            <td>{{$val->name_research_centre}}</td>
                            <td>{{$val->supervisor_name}}</td>
                            <td>{{$val->department}}  </td>
						    <td>{{$val->designation}}</td>
                             <td>{{$val->research_title}}  </td>
						    
@if(Auth::User()->role == 3)
   @php 
  $delete=url('office/deleteResearchFellow',$val->id);
     $edit = url('office/editResearchFellow',$val->id);
 @endphp
 
 
 @endif
                @if((Auth::User()->role == 3) && (Auth::User()->type == 'sub'))
                            <td>
                             
							
							  
                            </td>
                            @else      <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							     <div class="badge badge-outline-success"><a href="{{$edit}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
                            </td>@endif  
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/downloadResearchFellowExcel')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteResearchFellow(id)
{

	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deleteResearchFellow}}",
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