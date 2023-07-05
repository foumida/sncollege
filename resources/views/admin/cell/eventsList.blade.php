@if(Auth::User()->role == 4)
   @php $type = "layouts.cell.default";
    $eventlist = url('/cell/eventList');
   $eventdatelist =  url('cell/eventdateList'); 
    $deletevent =    url('cell/deleteEvent');
  
   @endphp

  
 @endif


@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Event List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Event List</h4>
                  
   
    
           
            
            <br />
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
                            <th> Event Type </th>
                            <th> Category </th>
                            <th> Department </th>
                            <!-- <th> Cell </th>-->
                              <th> Faculty </th>
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
                            <td>{{date('d-m-Y', strtotime($val->from_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($val->to_date))}}</td>
                            <td>{{$val->venue}}  </td>
                           <td>{{$val->eventtype}}  </td>
                           <td>{{$val->category}}  </td>
                           <td>{{$val->dept}}  </td>
                          <!-- <td>{{$val->cell}}  </td>-->
                           <td>{{$val->facultyname}}  </td>
                           
                            @if(Auth::User()->role == 4)  
 @php 
   $editEvent=url('cell/editEvent/'.$val->id.'/'.$val->type);
   $editImage= url('cell/editImage',$val->id) ;  
   $editFile=  url('cell/editFileImage',$val->id) ;
   $deleteEvent= url('cell/deleteEvent',$val->id) ; 
   $pdf= url('cell/pdf',$val->id) ;
 
       
 @endphp

 @endif
                            <td>
                              <div class="badge badge-outline-success"><a href="{{$editEvent}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							 <div class="badge badge-outline-success"> <a href="{{ $editImage }}" title="EditImage" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"> <a href="{{ $editFile }}" title="EditFile" ><i class="fa fa-file-o" aria-hidden="true"></i></a>
							  </div>
							  <div class="badge badge-outline-success"> <a href="{{ $deleteEvent }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </div>
							   <div class="badge badge-outline-success"> <a href="{{ $pdf }}"  title="Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
							  </div>
                            </td>
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
					<div><a class="btn btn-info" href="" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel</a></div>
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
            url: "{{ $deletevent }}",
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
window.location.href = "{{$eventlist}}";
 });

});
 function exportStudent(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
@endsection