
@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
   $deleteQuestion = url('faculty/deleteQuestion');
  
 
   @endphp
 @elseif(Auth::User()->role == 3)
  
  @php $type = "layouts.office.default";
   $deleteQuestion = '';

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
                    <h4 class="card-title">Question Paper Setting List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th>Faculty</th>
                            <th>Department</th>
                            <th> Name Of Paper</th>
                            <th> Name Of Program</th>
                            <th> Year</th>
                            <th> Semester </th>
							<th> Classification</th>
						    <th> Name Of College/University</th>
						    
                           <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
							 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>{{$val->facultyname}}</td>
                             <td>{{$val->dept}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->name_of_paper}}</span>
                            </td>
                            <td>{{$val->name_of_pgm}}</td>
                             <td>{{$val->year}}</td>
                            <td>{{$val->semester}}</td>
                            <td>{{$val->classification}}  </td>
						    <td>{{$val->name_of_colluniversity}}</td>
                            
  
                      @if(Auth::User()->role == 2)
                            <td>
                             
							  <div class="badge badge-outline-success"> <a href="{{url('faculty/deleteQuestion',$val->id) }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"><a href="{{url('faculty/editQuestionPaperSetting',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							  
                            </td>@else 
                            <td> </td>
                             @endif
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div>   @if(Auth::User()->role == 2)	  <a class="btn btn-info" href="{{url('faculty/downloadQuestionSettingfac')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel</a>@else <a class="btn btn-info" href="{{url('office/downloadQuestionSettingadmin')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel</a>  @endif</div>
                  </div>
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
function deleteQuestion(id)
{

	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deleteQuestion}}",
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