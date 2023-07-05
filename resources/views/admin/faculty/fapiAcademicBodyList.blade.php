@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
     $fapiAcademicBodyList =  url('/faculty/fapiAcademicBodyList');
  
   $deletefapiAcademicBody =    url('faculty/deletefapiAcademicBody');
   @endphp

  @elseif(Auth::User()->role == 3)
  
  @php $type = "layouts.office.default";
   $fapiAcademicBodyList = '';
    $deletefapiAcademicBody =    '';
   
 @endphp
  @elseif(Auth::User()->role == 6)
  
  @php $type = "layouts.hod.default";
   $fapiAcademicBodyList = '';
    $deletefapiAcademicBody =    '';
   
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
                    <h4 class="card-title">Faculty Academic Body List</h4>
                  
   
    
         
					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Faculty Name</th>
                            <th>Department</th>
                            <th> Name Of Academic Body</th>
                            <th> Type </th>
                            <th> From Date </th>
                             <th> To Date </th>
                            <th> Name Of Recognised Body </th>
                             <th> Designation </th>
                            <th> Recognition Category </th>
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                              <span class="pl-2">{{$val->facultyname}}</span>
                            </td>
                             <td>{{$val->dept}}  </td>
                             <td>{{$val->name_academic_body}}  </td>
                             <td>{{$val->type}}  </td>
                            <td>{{date('d-m-Y', strtotime($val->from_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($val->to_date))}}</td>
                            <td>{{$val->name_recognised_body}}  </td>
                            <td>{{$val->designation}}  </td>
                            <td>{{$val->recognition_category}}  </td>

              @if(Auth::User()->role == 2)
                            <td>
                         
							  <div class="badge badge-outline-success"> <a href="{{url('faculty/deletefapiAcademicBody',$val->id)}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div> 
						  <div class="badge badge-outline-success"><a href="{{url('faculty/editfapiAcademicBody',$val->id)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
                  
                            </td>@else <td> </td>@endif 
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div>@if(Auth::User()->role == 2) <a class="btn btn-info" href="{{url('faculty/downloadfapiAcademicfac')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @elseif(Auth::User()->role == 3)
					<a class="btn btn-info" href="{{url('office/downloadfapiAcademicadmin')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a> @else	  <a class="btn btn-info" href="{{url('hod/downloadfapiAcademichod')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel</a> @endif</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
function deleteEvent(id)
{
	//alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{url('faculty/deletefapiAcademicBody')}}",
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
<script>
$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
window.location.href = "{{ $fapiAcademicBodyList}}";
 });

});
 function exportStudent(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
@endsection