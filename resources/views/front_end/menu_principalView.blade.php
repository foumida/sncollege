@extends('layouts.front_end.default')
@section('content')

 <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">Principal</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Principal's Message </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="about-area about-us-area pb-0 mb-0">
                <div class="about-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 messageblock">
                                <div>
                                    <img src="{{asset('front_end/assets/img/about-us/pinciimg.jpg')}}" alt="" class="img-fluid" />
                                    <h3>Prof (Dr) A Biju</h3>
                                    <h5>M.Sc., B.Ed., M.Phil., PhD.</h5>
									<br>
                                    <p><span class="blockqote"><img src="{{asset('front_end/assets/img/icon/quote.png')}}"></span>I am indeed very much pleased to address you all through this virtual
platform. M E S Asmabi College stands out from the rest in its
perspectives to higher Education. The institution has crossed fifty
two years of glorious existence. It Has been quite a remarkable
journey, striving towards excellence. We have Successfully completed
three cycles of NAAC accreditation with commendable Grades. The
college has largely contributed to the process of national development
by providing quality education to the less privileged rural students
and bringing them to limelight. We are racing towards excellence by
providing more career-oriented courses in tune with the national and
international Standards. The institution currently accommodates 2500
plus students distributed in 26 programmes of diverse kinds. Addition
of more courses of global career relevance is in the pipeline for
which academic infrastructural upgrades are required. But the college
is committed to the fruition of her dreams through the Concerted
efforts of all stakeholders.
<br><br>
I can say with confidence that this institution has par excelled in
all spheres of academic setting. We were able to provide an inclusive
and secular platform to accommodate the diverse cultures across
including international students.
<br><br>
We have been adhering to the stated vision of Muslim Educational
Society without which it would not have been possible for us to make
so much of remarkable gains. Education is not just the process of
gathering knowledge but acquiring life skills to lead life and shaping
one's personality. This is an aggrandizing process of personal growth
which should be reflected for the common welfare. Of course the
college is making diligent efforts to sustain the momentum and move in
search of better and wider realms.</p>
                                </div>
								
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- about area end -->
            
      <div class="container text-center">
           <h3>SUCCESSION LIST OF PRINCIPALS</h3>
      </div>       
            
 <section class="section-timeline">
    
  <div class="container">
      <div class="row">
          <div class="col-lg-6 ">
            <ul class="timeline">
              <li class="">
                <div class="content">
                  <h3>2020</h3>
                  <p>Onwards Dr A.Biju</p>
                </div>
              </li>
        			<li class="">
                <div class="content">
                  <h3>2012-20</h3>
                  <p>Dr.Ajims P.Muhamed</p>
                </div>
              </li>
        			<li class="">
                <div class="content">
                  <h3>2009-12</h3>
                  <p>Dr.A.Biju</p>
                </div>
              </li>
              <li class="">
        		<div class="content">
        			<h3>1999-2009</h3>
        			<p>Dr.P.K.Yacoob</p>
        		</div>
              </li>
        	  <li class="">
        		<div class="content">
        			<h3>1997-99</h3>
        			<p>Prof.M.Muhamed</p>
        		</div>
              </li>
        	  <li class="">
        		<div class="content">
        			<h3>1992-97</h3>
        			<p>Prof P K Noorudheen </p>
        		</div>
              </li>
              <li class="">
        		<div class="content">
        			<h3>1991-92</h3>
        			<p>Dr.C.A.Abdulsalam</p>
        		</div>
              </li>
              <li class="">
        		<div class="content">
        			<h3>1986-91</h3>
        			<p>Prof.P.K.Noorudheen</p>
        		</div>
              </li>
              <li class="">
        		<div class="content">
        			<h3>1983-86</h3>
        			<p> Dr.C.A.Abdulsalam</p>
        		</div>
              </li>
              <li class="">
        		<div class="content">
        			<h3>1968-83</h3>
        			<p> Prof.K K Abdulkader</p>
        		</div>
              </li>
            </ul>
  </div>
  </div>
  </div>
</section>

@endsection