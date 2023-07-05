@if(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
  
   @endphp

  @elseif(Auth::User()->role == 8)
  
  @php $type = "layouts.researchfellow.default";
  
 @endphp
 @elseif(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
  
 @endphp
 @endif
@extends($type)

@section('content')
         <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Mou Image Download </h3>
           
            </div>
    
	
		
				
			
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                
                    <br>
                    
					@if(!empty($list))	 
                    <div class="table-responsive">
                      <table class="table" id="myTable" >
                        <thead>
                          <tr>
                           
                            <th> File  </th>
                           
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                          	@if(!empty($val->upload_document))	 
                            <td>
                                <iframe src="{{url('public/uploads/journal/'.$val->upload_document)}}" width="50%" height="600">
           
    </iframe>
                @endif            
                            </td>
    
                          
                            <td>
							
                              </div>
							
                            </td>
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					
                  </div>
                </div>
            
	@endif

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


@endsection