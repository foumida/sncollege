@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">COLLEGE HOSTEL</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Facilities</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->


            <!-- featured-courses -->
            <!-- blog-area -->
            <section class="blog-area gray-bg pt-80 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                   <h4>WOMEN'S HOSTEL</h4><br>
					<h5 style="font-size:20px">Kamaru Bai Women's Hostel & Fathima Gafoor Women's Hostel</h5><br>

				  	 <p>These hostels provide accommodation to girls students. The principal is the warden of the hostel. A member of the staff or a specially
 					appointed deputy warden looks after the day to day affairs and general discipline of the hostel. Vegetarian and non-vegetarian mess is provided in the hostel. Inn mates 
					are directed to follow the hostel rules strictly. Any violation of the hostel rules and misconduct in the hostel will be seriously dealt with. A student expelled from the 
					hostel is liable to be expelled from the college also.</p>
					<br>
					<h6>Dy Warden : Dr. Girija T P</h6>

					<br><br>
				<h4>MEN'S HOSTEL</h4><br>
					<h5 style="font-size:20px">Gulshanbi Men's Hostel</h5><br>

				  	 <p>Students who want accommodation in Gulshanbi Mens hostel should apply to the principal after getting admitted to the college. A few members 
					of the teaching staff also reside in the hostel. The principal is the warden.</p>
					<br>
					<h6>Dy Warden : Sri. Najumudheen K P</h6>

					<br><br>

                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>
@endsection