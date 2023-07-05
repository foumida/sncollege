

  @if(Auth::User()->role == 3)
  
  @php $type = "layouts.office.default";
   $fdplist = '';
    $deletfdp =    '';
   
 @endphp
 
 @endif
@extends($type)


@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Cell Event List  </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Cell Event List</h4>
                  
   
    
         
					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Title</th>
                            <th> From Date </th>
                            <th> To Date</th>
                            <th> Venue </th>
                            <th> cell </th>
                           
                            <th> Faculty Name </th>
                             <th> Department </th>
                           
                            
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
                            <td>{{date('d-m-Y', strtotime($val->from_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($val->to_date))}}</td>
                            <td>{{$val->category}}  </td>
                             <td>{{$val->cell}}  </td>
                             <td>{{$val->facultyname}}  </td>
                             <td>{{$val->dept}}  </td>

 
  <!-- $download=url('office/downloadcelleventadmin');-->
 
                           
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div><a class="btn btn-info" href="{{url('office/downloadcelleventadmin')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel</a></div>
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
            url: "{{ $deletfdp}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Event Details Deleted Successfully");
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
window.location.href = "{{ $fdplist}}";
 });

});
 function exportStudent(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
@endsection