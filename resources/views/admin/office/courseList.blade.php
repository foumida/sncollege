@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   $deleteCourse=url('admin/deleteCourse'); 
  
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
  $deleteCourse=url('office/deleteCourse');
   @endphp
     @elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
  
  $deleteCourse=url('hod/deleteCourse');
   @endphp
 @endif
 
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Program List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Program List</h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Program</th>
                            <th> Program Code </th>
							<th>Date of Introduction </th>
							<th> Program Credit </th>
						   <!--	<th> Tutor </th>-->
                       @if(Auth::User()->role == 3)        <th> Action</th>@endif
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->course_name}}</span>
                            </td>
                            <td>{{$val->course_code}}</td>
                          @if(!empty($val->date_of_intro))   <td>{{date('d-m-Y', strtotime($val->date_of_intro))}}</td>	 @else
      <td></td>   @endif
                              <td>{{$val->course_credit}}  </td>
						    <!-- <td>{{$val->tutor}}  </td>-->
						    
 @if(Auth::User()->role == 1)  
 @php 
   $edit=url('admin/editCourse',$val->id);
   $addpaper=url('admin/addPaper',$val->id);
   $delete=url('admin/deleteCourse',$val->id);
 @endphp
@elseif(Auth::User()->role == 3)
   @php 
    $edit=url('office/editCourse',$val->id);
    $addpaper=url('office/addPaper',$val->id);
    $delete=url('office/deleteCourse',$val->id);
 @endphp
 @elseif(Auth::User()->role == 6)
   @php 
    $edit=url('hod/editCourse',$val->id);
    $addpaper=url('hod/addPaper',$val->id);
    $delete=url('hod/deleteCourse',$val->id);
 @endphp
 @endif
                  @if((Auth::User()->role == 3) && (Auth::User()->type == 'sub'))
                            <td>
                             
						
							  
                            </td>
			@elseif((Auth::User()->role == 3) && (Auth::User()->type == 'superdup'))
                            <td>
                             
							    <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							  <div class="badge badge-outline-success"><a href="{{ $addpaper }}"  title="Add Paper" ><i class="fa fa-book" aria-hidden="true"></i></a></div>
							  
                            </td>
                            @else           <td>
                              <div class="badge badge-outline-success"><a href="{{ $edit }}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							  <div class="badge badge-outline-success"><a href="{{ $addpaper }}"  title="Add Paper" ><i class="fa fa-book" aria-hidden="true"></i></a></div>
							  <div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							  
                            </td>@endif
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/downloadProgramListExcel')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteCourse(id)
{
	alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $deleteCourse}}",
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