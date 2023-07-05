@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">COOPERATIVE SOCIETY</h3>
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
                                   <h4>COLLEGE CO-OPERATIVE STORE</h4><br>
					 <p>A Co-operative store is functioning in the college. All students and members of staff who became share holders are members of the 
society. The members are given discounts for their purchase from the store. The aims of the society are (a) to encourage thrift and self help. (b) To disseminate knowledge 
of co-operative principles.</p>
<br><br>
<h5 style="font-size:18px;"><b>Teacher in Charge : Lt. M.B. Bindil</b><br>

<b>Advisory Committee for Co-operative Store :</b><br>

<b>Dr. K.P. Sumedhan, Dr. Asma V.M., Najmudheen K.P., V. Shailaja</b><br>

<b>Shibu A. Nair, Mohammed Areej E.M.</b></h5>

					
                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>
@endsection