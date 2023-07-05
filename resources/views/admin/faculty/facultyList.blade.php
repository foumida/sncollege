
@extends('layouts.faculty.default')

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Faculty List </h3>
           
            </div>
            
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Faculty List </h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
							<th> Date Of Join </th>
							<th>Email </th>
							<th> DP </th>
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
                            
                            <td>{{date('d-m-Y', strtotime($val->date_of_join))}}</td>
                              <td>{{$val->email_id}}  </td>
						@if(!empty($val->picture))	<td><img src="{{url('public/uploads/facultyimg/'.$val->picture)}}" class="rounded-circle" alt="" style="width:100px;height:100px;"/> </td>@else
            <td><img src="{{url('public/uploads/facultyimg/download.jpeg')}}" class="rounded-circle" alt="" style="width:100px;height:100px;"/></td>
        @endif
        
        						    

                            <td>
                              <div class="badge badge-outline-success"><a href="{{url('faculty/editFaculty',$val->fid)}}"  title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
							
						
							  </div>
							  
                            </td>
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