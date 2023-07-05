@extends('layouts.front_end.default')
@section('content')
            <!-- breadcrumb area start -->
<link src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
            <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">Gallery</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Gallery</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

      <div class="tp-profolio__section-inner pt-120 pb-120">
         <div class="container">
 	   <div class="row gallery">
		 @if(!empty($gallery))
		 @foreach($gallery as $row)

   	       <div class="col-md-4">
                   <img src="{{url('public/uploads/faculty/'.$row->picture)}}" onclick="openModal();currentSlide(1)" class="hover-shadow img-fluid">
               </div>

	        @endforeach	
                @endif

	   </div>
     </div>



<!-- The Modal/Lightbox -->
  <div id="myModal" class="modal">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content  modal-lg">
      @if(!empty($gallery))
        @foreach($gallery as $row)

       <div class="mySlides">
         <img src="{{url('public/uploads/faculty/'.$row->picture)}}" class="img-fluid">
      </div>
     @endforeach	
    @endif
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
</div>



<style>
.gallery img {
    width: 100%;
    height: 400px;
    border: 2px solid #061c784a;
    border-radius: 10px;
    margin-bottom: 1.8rem;
}.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 30px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: black;
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 90px auto;
    padding: 0;
    width: 30%;
    max-width: 1200px;
}
/* The Close Button */
.close {
    color: white;
    position: absolute;
    top: 100px;
    right: 105px;
    font-size: 35px;
    font-weight: bold;
    z-index: 1000;
}
.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

/* Hide the slides by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: #0d0044;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  -moz-user-select: none;
   -ms-user-select: none;
       user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
  background: black;
  color: white;
  width: 100%;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  cursor: pointer;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>




    <script>
      // Open the Modal
      function openModal() {
        document.getElementById("myModal").style.display = "block";
      }
      // Close the Modal
      function closeModal() {
        document.getElementById("myModal").style.display = "none";
      }
      var slideIndex = 1;
      showSlides(slideIndex);
      // Next/previous controls
      function plusSlides(n) {
        showSlides(slideIndex += n);
      }
      // Thumbnail image controls
      function currentSlide(n) {
        showSlides(slideIndex = n);
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
    
        if (n > slides.length) {
          slideIndex = 1
        }
        if (n < 1) {
          slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        
        slides[slideIndex - 1].style.display = "block";
      }
    </script>

@endsection