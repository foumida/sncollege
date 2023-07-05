@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
  
   @endphp
 @elseif(Auth::User()->role == 2)
  
  @php 
  $type = "layouts.faculty.default";
   
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
                    <h4 class="card-title"> Student List For Add Scholarship</h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th>Admission No </th>
							<!--<th>Program </th>
						
						   	<th> Semester </th>-->
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
                            <td>{{$val->admission_no}}</td>
                         
                             <!-- <td>  </td>
						    <td></td>-->
						    
 @if(Auth::User()->role == 1)  
 @php 

   $addscholar=url('admin/addScholarship',$val->id);
  
 @endphp
 @elseif(Auth::User()->role == 2)  
 @php 
  
   $addscholar=url('faculty/addScholarship',$val->id);
  
 @endphp
 @endif
                            <td>
                         
							  <div class="badge badge-outline-success"><a href="{{$addscholar}}"  title="Add Scholarship" ><i class="fa fa-book" aria-hidden="true"></i></a></div>
							
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