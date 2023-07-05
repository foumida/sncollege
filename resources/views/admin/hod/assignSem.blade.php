
@if(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
        $saveTutor= url('/hod/saveTutor');
          $deleteTutor=url('hod/deleteTutor');
   @endphp   
   
 @endif
@extends($type)

@section('content')
<style>
label {
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 400;
    color:#fff;
}
</style>
         <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Assign Semester</h4> <br>  
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
               <div class="row">
                    <input type="hidden" name="student_id" id="skill_student_id" value=""/>
             <div class="scrollmenu">      
             <span class="text-success" id="skilladd"></span>
             <span class="text-danger" id="skillfail"></span>
                <table class="table skils">
                     <thead>
                          <tr>
                          
                           
							 <th> Batch</th>
							 <th> Semester</th>
							
                            
                          </tr>
                        </thead>
                       <tbody>
                          @if(count($semlist)>0)
               
                         @foreach($semlist as $val) 
                        <tr>
                            <td style="width: 45%;"> @if(!empty($val->batch))  {{ $val->batch }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($val->semester))  {{ $val->semester }}  @endif</td>
                            
                                                  
                        </tr>
                           @endforeach
                    
                        @endif
                         
                        <tr>  
                           <input type="text"  value="{{$coursename}}" id="program" name="program" class="form-control" disabled/>
                               <td>
                                
                               <select class="form-control" name="batch" id="batch">
            										<option value="">Select Batch</option>
            										@foreach($batch as $row)
            								            <option value="{{ $row->batch }}">{{ $row->batch }}</option>
            						            	@endforeach
            									</select>
                    
                                <span id="batch_Err" class="text-danger"></span>
                               
                            </td>
                           
                            <td>
                                
                                <select  id="semester" name="semester" class="form-control">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="semester_Err" class="text-danger"></span> 
                            </td>
                          
                            <td>
                                <button class="btn btn-info" id="butsaveSkill">Save</button>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                        </div> 
                        </div> 
                     
					       
                
            </div>
          </div>
          </div>
          </div>
          </div>
          </div>
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

 

<script type="text/javascript">
$('body').on('click', '#butsaveSkill', function() {
      var program = $('#program').val();
      var batch = $('#batch').val();
       var semester = $('#semester').val();
    
      $("#skilladd").html('');
      $("#skillfail").html('');
      if(semester==""){ $("#semester_Err").html("Please Enter Semester"); }
      else{$("#semester_Err").html(""); }
      if(batch==""){ $("#batch_Err").html("Please Enter Batch"); }
      else{$("#batch_Err").html(""); }
      
      if(semester!="" && batch!=""){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{url('/hod/updateSemester')}}",
              type: "POST",
              data: {
               
                  program: program,
                  batch:batch,
                  semester:semester,
                  
              },
              cache: false,
              success: function(dataResult){
                 $("#skilladd").html(dataResult.success);
                 
                  
              }
          });
      }
      else{
        
          
      }
  });


</script>


@endsection