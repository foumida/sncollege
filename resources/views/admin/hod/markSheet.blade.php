@extends('layouts.hod.default')

@section('content')
          <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Mark Sheet</h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Mark Sheet</h4>
                  
   
    
            <br />
                <form id="fupForm" method="POST" action="{{ url('hod/searchMarksheet/') }}"> 
                  @csrf
            <div class="row">
                <div class="col-md-3">
                    	<label>Batch : </label>  
                								 <select class="form-control" name="batch" ID="batch">
        									    	<option value="">Select </option>
            									    @foreach($batch as $row)
            								            <option value="{{ $row->batch }}">{{ $row->batch }}</option>
            						            	@endforeach								
        										</select>    
            							
                </div>
                <div class="col-md-3">
                  	<label>Semester: </label>  
                								 <select class="form-control" name="semester" Id="semester">
        									    	<option value="">Select </option>
        									    	<option value="Semester 1" >Semester 1</option>
                									<option value="Semester 2" >Semester 2</option>
                									<option value="Semester 3" >Semester 3</option>
                                                    <option value="Semester 4" >Semester 4</option>
                                                    <option value="Semester 5" >Semester 5</option>
                                                    <option value="Semester 6" >Semester 6</option>	
                                                    <option value="Semester 7" >Semester 7</option>	
                                                    <option value="Semester 8" >Semester 8</option>	
        										</select>    
                </div>
                 <div class="col-md-3">
                  	<label>Course: </label>  
                						<input type="hidden" value="{{$courseid}}" name="courseid" id="courseid" class="form-control">
                						<input type="text" value="{{$coursename}}" name="coursename" id="coursename" class="form-control">
                </div>
                <div class="col-md-3">
                    <button type="submit" name="filter" id="filter" class="btn btn-primary" onclick="return ValidateTextBox()">Refine</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-success">Refresh</button>
                     
                    
                </div>
            </div>
            </form>
            
            <br />
				 @if(!empty($paper))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                           <th></th>
                           @foreach($papers as $pkey=>$p_val)
                            
                            <th>{{$p_val}}</th>
                            
                            
                            @endforeach
                            
                          </tr>  
                        </thead>
                        @if(!empty($empdetail))     
					 	@foreach($empdetail as $key=>$val)
                        <tbody> <?php $size =  sizeof($empdetail[$key]); ?>
                        <tr>
                               <td>{{$val['stname']}}</td>
                                @for ($i=0; $i<$size-1; $i++)
                            <td>{{$val['paper'.$i]}}</td>
                           @endfor
                       </tr>
                     
                        </tbody>@endforeach @endif 
                      </table>
                    </div>
				 @endif
				
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

  function ValidateTextBox() {
        if ((document.getElementById("batch").value.trim() == "")) {
            alert("Enter Batch");
            return false;
        }
    };
    
  
</script>
<script>

$(document).ready(function(){
 $('#refresh').click(function(){
  $('#batch').val('');
  $('#semester').val('');
location.reload();
 });

});
 function exportStudent(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>

@endsection