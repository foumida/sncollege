
@if(Auth::User()->role == 7)
   @php $type = "layouts.research.default";
   $deleteJournal = url('researchguide/deleteJournal');
 
   @endphp
    @elseif(Auth::User()->role == 8)
  
  @php $type = "layouts.researchfellow.default";
   $deleteJournal = url('researchfellow/deleteJournal');
 

 @endphp
 @elseif(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
   $deleteJournal = url('faculty/deleteJournal');
 

 @endphp
  @elseif(Auth::User()->role == 3)
  
  @php $type = "layouts.office.default";
   $deleteJournal = '';

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
                    <h4 class="card-title">Journal List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Publisher Name</th>
                            <th> Publication Type</th>
                             <th>Category</th>
                            <th> Journal Type </th>
							<th> Author</th>
						    <th> Title</th>
						    <th> Year</th>
						    <th> Journal Name</th>
						   
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
                            <td>{{$val->typepublication}}</td>
                            <td>{{$val->category}}</td>
                            <td>{{$val->journaltype}}</td>
                            <td>{{$val->author}}  </td>
						    <td>{{$val->title}}</td>
                            <td>{{$val->year}}  </td>
                            <td>{{$val->journalname}}  </td>
	@if(Auth::User()->role == 7)
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{url('researchguide/deleteJournal',$val->id)}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"><a href="{{url('researchguide/editJournal',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							    <div class="badge badge-outline-success"> <a href="{{ url('researchguide/editImagePublication',[$val->id,'J'])}}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div>
                            </td>
                         	@elseif(Auth::User()->role == 8)
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{url('researchfellow/deleteJournal',$val->id)}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"><a href="{{url('researchfellow/editJournal',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							    <div class="badge badge-outline-success"> <a href="{{ url('researchfellow/editImagePublication',[$val->id,'J'])}}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div>
                            </td>   
                           @elseif(Auth::User()->role == 2)
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{url('faculty/deleteJournal',$val->id)}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"><a href="{{url('faculty/editJournal',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							    <div class="badge badge-outline-success"> <a href="{{ url('faculty/editImagePublication',[$val->id,'J'])}}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div>
                            </td>    
                            @else 
                            <td>  <div class="badge badge-outline-success"> <a href="{{ url('office/editImagePublication',[$val->id,'J'])}}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div></td>
                             @endif					    
   
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div>	@if(Auth::User()->role == 7) <a class="btn btn-info" href="{{url('researchguide/downloadJournalfac')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>	@elseif(Auth::User()->role == 8) <a class="btn btn-info" href="{{url('researchfellow/downloadJournalfac')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>
                    @elseif(Auth::User()->role == 2) <a class="btn btn-info" href="{{url('faculty/downloadJournalfac')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>
					@else
					<a class="btn btn-info" href="{{url('office/downloadJournaladmin')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a> @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteJournal(id)
{

	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deleteJournal}}",
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