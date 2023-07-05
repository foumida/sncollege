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
                                                           
                                                            <th>TITLE</th>
															
															<th>FUNDING AGENCY</th>
															@if($data[0]->category=='Project')
															<th>TOTAL AMOUNT</th>
														 @endif	
															<th>PRINCIPLE INVESTIGATOR</th>
															@if($data[0]->category=='Fellowship')
															<th>RESEARCH FELLOW</th>
														 @endif	
															<th>Link</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													@if(!empty($data))
					 @foreach($data as $row)
                                                        <tr>
														
														  <td>{{$row->title}}</td>
                                                        
														 <td>{{$row->funding_agency}}</td>
														 @if($data[0]->category=='Project')
														 <td>{{$row->total_amt}}</td>
													     @endif	
														 <td>{{$row->principle_investigator}}</td>
														 	@if($data[0]->category=='Fellowship')
														 <td>{{$row->rf}}</td>
														 @endif	
															  <td><a href="{{$row->link_url}}">{{$row->link_url}}</a></td>
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