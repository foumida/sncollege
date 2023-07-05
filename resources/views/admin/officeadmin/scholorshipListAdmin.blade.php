@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
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
                    <h4 class="card-title"> Scholarship List</h4>
                  
   
    

					 @if(!empty($list))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th>Admission No </th>
							<th>Scholarship </th>
							<th>Relegion </th>
							<th>Reservation Category </th>
                             <th>Amount </th>
                             <th>Amount Type</th>
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
                             <td>{{$val->scholarship_name}}</td>
                            <td>{{$val->relegion}}</td>
							 <td>{{$val->reservation_category}}</td>
							  <td>{{$val->amount}}</td>
							    <td>{{$val->amount_type}}</td>
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				<div>	@if(Auth::User()->role == 3) <a class="btn btn-info" href="{{url('office/exportScholarshipList')}}" id="export" onclick="exportStudent(event.target);"><i class="fa fa-download"></i> Download Excel </a>  @endif 
				</div>
                  </div>
                  
                </div>
            
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


@endsection