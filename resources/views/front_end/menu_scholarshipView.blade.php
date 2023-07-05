@extends('layouts.front_end.default')
@section('content')

<!-- breadcrumb area start -->

            <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                  
					         <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="blog-content">
                                                <h4>{{$heading}}</h4>

                                               <table class="table table-bordered" id="users-list">
                                                    <thead>
                                                        <tr>
                                                           
                                                            <th>SCHOLARSHIP NAME</th>
															
															<th>AMOUNT</th>
															<th>STUDENT NAME</th>
															<th>BATCH</th>
															<th>PROGRAM</th>
															
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													@if(!empty($data))
					 @foreach($data as $row)
                                                        <tr>
														
														  <td>{{$row->scholarship_name}}</td>
                                                        
														 <td>{{$row->amount}}</td>
														 <td>{{$row->studentname}}</td>
														 <td>{{$row->batch}}</td>
														 <td>{{$row->program}}</td>
															 
                                                        </tr>

                                                     
                                                      @endforeach	
                                                      @endif		
                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about area end -->

@endsection