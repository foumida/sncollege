
 @if(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
  $deleteMou = url('faculty/deleteMou');

 @endphp
 @elseif(Auth::User()->role == 3)
  
  @php $type = "layouts.office.default";
   $deleteMou = '';

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
                    <h4 class="card-title">Mou List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th>Category</th>
                            <th> Title</th>
                             <th>From Date</th>
                            <th>To Date </th>
							<th> Funding Agency</th>
						    <th> Level</th>
						    <th> Signed Authority</th>
						    <th> Principle Investigator</th>
						   @if(Auth::User()->type=='superadmin' || Auth::User()->type=='sub')<th> Faculty Name</th> @endif	
                           <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
							 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->category}}</span>
                            </td>
                            <td>{{$val->title}}</td>
                            <td>{{$val->from_date}}</td>
                            <td>{{$val->to_date}}</td>
                            <td>{{$val->funding_agency}}  </td>
						    <td>{{$val->level}}</td>
                            <td>{{$val->signed_authority}}  </td>
                            <td>{{$val->principle_investigator}}  </td>
                             @if(Auth::User()->type=='superadmin' || Auth::User()->type=='sub')<td>{{$val->fname}}  </td> @endif	
	@if(Auth::User()->role == 2)
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{url('faculty/deleteMou',$val->id)}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"><a href="{{url('faculty/editMou',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							    <div class="badge badge-outline-success"> <a href="{{url('faculty/editMouImage',$val->id)}}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div>
                            </td>
                          @else 
                            <td>  <div class="badge badge-outline-success"> <a href="{{ url('office/editMouImage',$val->id)}}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div></td>
                             @endif	
                      				    
   
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div>	@if(Auth::User()->role == 2) <a class="btn btn-info" href="{{url('faculty/downloadMou')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a> @else
					<a class="btn btn-info" href="{{url('office/downloadMouadmin')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a> @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteMou(id)
{

	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deleteMou}}",
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