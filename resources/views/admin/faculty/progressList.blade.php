@if(Auth::User()->role == 8)
    @php $type = "layouts.researchfellow.default";
   $deletePhdprogress = url('researchfellow/deletePhdprogress');
 
   @endphp
 @elseif(Auth::User()->role == 3)
  
  @php $type = "layouts.office.default";
   $deletePhdprogress = '';

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
                    <h4 class="card-title">Phd Progress List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" style="width:100%" id="myTable" >
                        <thead>
						 <tr>
                            <th>
                              
                            </th>
                            <th></th>
                            <th></th>
							
                             <th> Coursework</th>
							  <th></th>
							   <th></th> 
							<th> Rac </th>
						    <th>   </th>
							 <th>Phd Completion </th>
							  <th></th>
							   <th>  </th>
							   <th> Research Activities </th>
							   <th> </th>
							   <th> </th>
							   <th> </th>
                           <th> </th>
                            
                          </tr>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Publisher Name</th>
                            <th>Category</th>
							
                             <th>Date Of Coursework</th>
							  <th>Course Work Status</th>
							   <th>Date of Coursework Completion</th> 
							<th> Rac Progress</th>
						    <th> Date Of Rac </th>
							 <th>Date Pre Submission on Viva </th>
							  <th>Date Thesis Submission</th>
							   <th> Date Open Defence </th>
							   <th> Progress </th>
							   <th>Title of the event </th>
							   <th>Organiser </th>
							   <th>Status </th>
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
                            <td>{{$val->category}}</td>
                            <td>{{$val->date_coursewrk}}</td>
							<td>{{$val->coursewrk_status}}</td>
							<td>{{$val->date_coursewrk_completion	}}</td>
                            <td>{{$val->rac_progress}}  </td>
						    <td>{{$val->date_rac}}  </td>
                            <td>{{$val->date_viva}}  </td>
							<td>{{$val->date_thesis}}  </td>
							<td>{{$val->date_opendefence}}  </td>
							<td>{{$val->progress_name}}  </td>
							<td>{{$val->title_event}}  </td>
							<td>{{$val->organiser}}  </td>
							<td>{{$val->status}}  </td>
                         @if(Auth::User()->role == 8)
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{url('researchfellow/deletePhdprogress',$val->id)}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"><a href="{{url('researchfellow/editPhdprogress',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							   
							  </div>
                            </td>   
                            
                            @else 
                            <td> </td>
                             @endif					    
   
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
						<div>	@if(Auth::User()->role == 8) <a class="btn btn-info" href="{{url('researchfellow/downloadPhdProgressList')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a> @else
					<a class="btn btn-info" href="{{url('office/downloadPhdProgressListAdmin')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a> @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deletePhdprogress(id)
{

	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deletePhdprogress}}",
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