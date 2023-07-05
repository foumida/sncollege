
@extends('layouts.cell.default')

@section('content')
            <div class="main-panel">
          <div class="content-wrapper">
           
            <div class="row">
                   <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                     <div class="preview-thumbnail">
                              
                                <a href="{{url('cell/editCell',$list[0]->id)}}"  title="Edit" ><i class="mdi mdi-account-edit"></i></a>
                                <a href="{{url('cell/editProfileImage')}}"  title="Camera" ><i class="mdi mdi-camera"></i></a>
                            </div>
                    <div class="d-flex py-4">
                      <div class="preview-list w-100">
                        <div class="preview-item p-0">
						@if(!empty($list[0]->picture))
                          <div class="preview-thumbnail">
                            <img src="{{url('public/uploads/cell/'.$list[0]->picture)}}" class="rounded-circle" alt="" style="width:136px;height:136px;">
                          </div>
						
						  @else
							   <div class="preview-thumbnail">
                            <img src="{{asset('theme/admin/assets/images/faces/face12.jpg')}}" class="rounded-circle" alt="" style="width:136px;height:136px;">
                          </div>
						  
                         @endif
                        </div>
                      </div>
                    </div>
					 <div class="flex-grow">
                              <div class="d-flex d-md-block d-xl-flex justify-content-between">
                              @if(!empty($list[0]->description))  <h6 class="preview-subject">{{ $list[0]->description }}</h6> @endif
                           
                              </div>
                             
                            </div>
             
                   
                  </div>
                </div>
              </div>
             
              
              
           
            </div>
           
         
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         
          <!-- partial -->
        </div>
@endsection
