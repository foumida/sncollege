@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
   
   @endphp

   @elseif(Auth::User()->role == 6)
  
  @php $type = "layouts.hod.default";
   
 @endphp

 @endif
@extends($type)


@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Programs List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Programs List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
							
                            <th> Action</th>
                            
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
                           
        						    
@if(Auth::User()->role == 2) <td>  <div class="badge badge-outline-success"><a href="{{url('faculty/semPaperView',$val->id)}}"  title="VIEW" >Student List</a></div>
<div class="badge badge-outline-success"><a href="{{url('faculty/studentListscholarship',$val->id)}}"  title="VIEW" >Add Scholarship</a></div>
</td> @else
                            <td>
                              <div class="badge badge-outline-success"><a href="{{url('hod/semPaperView',$val->id)}}"  title="VIEW" >Student List</a></div>
                           
							  <div class="badge badge-outline-success"><a href="{{url('hod/addTutor',$val->id)}}"  title="VIEW" >Tutor Assign</a></div>
							  <div class="badge badge-outline-success"><a href="{{url('hod/addPaperAssign',$val->id)}}"  title="VIEW" > Assign Paper To Faculty</a></div>
						      <div class="badge badge-outline-success"><a href="{{url('hod/assignSem',$val->id)}}"  title="VIEW" >Semester Assign</a></div>
						      <div class="badge badge-outline-success"><a href="{{url('hod/markSheet',$val->id)}}"  title="VIEW" >Mark Sheet</a></div>
							  </div>
							  
                            </td> @endif
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


@endsection