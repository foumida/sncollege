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
                                                            <th> NAME</th>
                                                            <th>TITLE</th>
															<th>URL</th>
															<th>AUTHOR</th>
															<th>DOCUMENT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													@if(!empty($journal))
					 @foreach($journal as $row)
                                                        <tr>
														 <td>{{$type}}({{$row->name}})</td>
														  <td>{{$row->title}}</td>
                                                            <td><a href="{{$row->url}}">Click Here to go to Journal Website:</a></td>
                                                            <td>{{$row->author}}</td>
															  <td><a href="{{url('public/uploads/journal/'.$row->document)}}" download="" target="_blank">@if(!empty($row->document))<img src="{{asset('front_end/assets/img//pdf.png')}}" width="60px" height="auto">@endif</a></td>
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