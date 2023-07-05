
@extends('layouts.admin.default')

@section('content')
<style>
label {
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 400;
    color:#fff;
}
.ui-widget-content {
    border: 1px solid #aaa;
    background: #fff url(images/ui-bg_flat_75_ffffff_40x100.png) 50% 50% repeat-x;
    color: #222;
    margin-top: 15%;
    margin-left: 1rem;
}
.logo-img{
    width:100%;
}
.college-details {
    margin-top: -7px;
}
.contecttext {
    text-align: justify;
    padding: 0 90px;
}
.contecttext p{
	font-size:17px;
}
.contecttext p span input {
    font-size: 17px;
    text-transform: uppercase;
}
.contecttext p span .forms-control {
    width: auto;
    padding-left: 10px;
    padding-right: 10px;
}
.forms-control {
    border: none;
    border-bottom: dotted;
    color: #333;
    background: #fff;
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 4px solid #000000 !important;
}
</style>
 <div class="main-panel">
     <div class="content-wrapper">
       <div class="row">
          <div class="col-12 grid-margin stretch-card">
             <div class="card">
			 
             
								  <label>Search Student</label>
								   <input type="text" id="skillitems" name="skillitems" class="form-control skillitems" />
                                    <input type="hidden" id="skillid" name="skillid" value="0"/>
                                    <div id="skill_pos"></div> 
                               
						 
                 <div class="card-body">
                      <form method="POST" action="{{ url('admin/downloadCertificate') }}" enctype="multipart/form-data"> 
             
                        @csrf 
 	
					    <div id="mainform" >
					    	<div class="row">
							    <div class="col-md-1"></div>
    							<div class="col-xl-10 col-sm-12 col-md-12 tcfrom">
    								<br><br>
    								<div class="row text-center">
    									<div class="col-md-2">
    									    <img src="{{asset('theme/admin/assets/images/favicon.png')}}" class="logo-img img-fluid">
    									</div>
    									<div class="col-md-6 college-details text-left">
    									    <h2>MES ASMABI COLLEGE</h2>
    									    <P>P. Vemballur P.O., Kodungallur, Thrissur Dist.,<br> Kerala PIN-680671</P>
    									    <P class="details">Web : Email - Principal.mesasmabi@gmail.com <br>Ph.  0480 – 2850596, 2851171</P>
    									</div>
										<div class="col-md-4">
											<p>Tel.Office: 0487  3216548</p>
										</div>
    								</div>
									<hr>
									<br><br>
									<div class="row">
    									<div class="col-md-1"></div>
    									<div class="col-md-5">
    									    <p><input type="text" id="conductnumber" class="forms-control" name="conductnumber" value="MES/AC8/2023"></p>
    									</div>
    									<div class="col-md-5 text-right">
    									    <p><input type="text" id="dateperiod" class="forms-control" name="dateperiod" ></p>
    									</div>
										<div class="col-md-1"></div>
    								</div>
									<br><br><br><br>
									
    								<div class="row titlehead text-center">
    									<div class="col-md-12">
    									    <h2 class="headtitle">CONDUCT CERTIFICATE </h2>
    									</div>
    								</div>
    								<br><br><br>
									
									<div class="row">
    									<div class="col-md-12 contecttext">
    									    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to cerify that <span><input type="text" class="forms-control myInput name" id="name" name="name" ></span>was student of this college for the<span><input type="text" class="forms-control myInput programs" name="program" id="program"></span>programme during the Academic Year </span><input type="text" class="forms-control myInput batch" name="year" id="year">.His/Her Conduct and character has been <span><input type="text" class="forms-control myInput" name="type" id="type"></span>.</p>
    									</div>
    								</div>
									
									<br><br><br>
									<div class="row">
    									<div class="col-md-6"></div>
    									<div class="col-md-5 text-right">
    									    <h2>PRINCPAL</h2>
    									</div>
										<div class="col-md-1"></div>
    								</div>
									<br><br>
    							</div>
						    	<div class="col-md-1"></div>
						    </div>
			        	</div>
			        	<br>
                <button type="submit" name="filter" id="filter" class="btn btn-primary fa fa-file-pdf-o">  Download Conduct Certificate </button>
            </div>
          </div>
        </div>
     </div>
 </div>
	</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <!-- Script -->
    <script>
    $(document).ready(function() {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = String(currentDate.getMonth() + 1).padStart(2, '0');
        var day = String(currentDate.getDate()).padStart(2, '0');
        var formattedDate = year + '-' + month + '-' + day;
        $('#dateperiod').val(formattedDate);
    });
</script>
 <script type="text/javascript">
 $(document).ready(function(){
	  $( "#skillitems" ).autocomplete({
        source: function( request, response ) {
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/admin/autocompleteSearch')}}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('.skillitems').val(ui.item.label);
		   $('.name').val(ui.item.name);// display the selected text
          $('#skillid').val(ui.item.value); // save selected id to input
		   $('.programs').val(ui.item.program);
			$('.batch').val(ui.item.batch);
          return false;
        },
appendTo: "#skill_pos",
      });
        });

 
 
 
 
 var inputField = document.querySelector(".myInput");
 inputField.addEventListener("input", adjustWidth);
 function adjustWidth() {
   var value = inputField.value;
   var width = value.length * 10 + 55; // 8px per character
   inputField.style.width = width + "px";
}
</script>

@endsection