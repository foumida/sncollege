
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
    width:70%;
}
</style>
 <div class="main-panel">
     <div class="content-wrapper">
       <div class="row">
          <div class="col-12 grid-margin stretch-card">
             <div class="card">
                 <div class="card-body">
                    <h4 class="card-title"> Transfer Certificate</h4>
                     <form method="POST" action="{{ url('admin/storeTc') }}" enctype="multipart/form-data"> 
             
                        @csrf  
                       
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-7 form-group">
								  <label>Search Student</label>
								   <input type="text" id="skillitems" name="skillitems" class="form-control skillitems" />
                                    <input type="hidden" id="skillid" name="skillid" value="0"/>
                                    <div id="skill_pos"></div> 
                                </div>    
                                 <div class="col-md-4 mt-3 form-group"><br>
                                    <button type="submit" id="btnTC" class="btn btn-success btn-block enter-btn" style="float:right;" >Submit</button>
								</div>
						    </div>
						</div>
					    <div id="mainform" >
					    	<div class="row">
							    <div class="col-md-1"></div>
    							<div class="col-xl-10 col-sm-12 col-md-12 tcfrom">
    								<div class="row">
    									<div class="col-md-6">
    									    <p id="datetimetoday"></p>
    									</div>
    									<div class="col-md-6">
    									    <p>About:blank</p>
    									</div>
    								</div>
    								<div class="row text-center">
    									<div class="col-md-3">
    									    <img src="{{asset('theme/admin/assets/images/favicon.png')}}" class="logo-img img-fluid">
    									</div>
    									<div class="col-md-7">
    									    <h2>MES ASMABI COLLEGE</h2>
    									    <P>P. Vemballur P.O., Kodungallur, Thrissur Dist., Kerala PIN-680671</P>
    									    <P class="details">Web : Email - Principal.mesasmabi@gmail.com <br>Ph.  0480 – 2850596, 2851171</P>
    									</div>
    								</div>
    								<div class="row titlehead text-center">
    									<div class="col-md-12">
    									    <h2 class="headtitle">TRANSFER CERTIFICATE </h2>
    									</div>
    								</div>
    								<div class="row">
    									<div class="col-md-12 tbletc">
    									    <table class="table tctable table-bordered">
    									        <tbody>
    									            <tr>
    									                <td colspan="3">TC No : <input type="text" id="tc" name="tc"></td>
    									                <input type="hidden" id="tcgennumber" name="tcgennumber">
														<input type="hidden" id="statusgen" name="statusgen">
    									                <td>Date : <input type="text" id="datetoday" name="datetoday"></td>
    									                  <input type="hidden" id="editid" name="editid">
    									            </tr>
    									            <tr>
    									                <td>1</td>
    									                <td colspan="2">Name of Student in Block Letters</td>
    									                <td><input type="text" id="studentname" name="studentname"></td>
    									            </tr>
    									           
    									            <tr>
    									                <td rowspan="2">2</td>
    									                <td rowspan="2">Date of Birth As Entered In The <br> Admission Register</td>
    									                <td>(In Figures)</td>
    									                <td><input type="text" id="dobfigure" name="dobfigure"></td>
    									            </tr>
    									            <tr>
    									                <td>(In Words)</td>
    									                <td><input type="text" id="dobword" name="dobword"></td>
    									            </tr>
    									            <tr>
    									                <td>3</td>
    									                <td colspan="2">Number in the Admission Register</td>
    									                <td><input type="text" id="admissionno" name="admissionno"></td>
    									            </tr>
    									            <tr>
    									                <td>4</td>
    									                <td colspan="2">Nationality</td>
    									                <td><input type="text" id="Nationality" name="Nationality"></td>
    									            </tr>
    									            <tr>
    									                <td>5</td>
    									                <td colspan="2">Religion & Caste</td>
    									                <td><input type="text" id="Religion" name="Religion"></td>
    									            </tr>
    									            <tr>
    									                <td>6</td>
    									                <td colspan="2">Whether Belongs to SC/ST/OEC/OBC</td>
    									                <td><input type="text" id="category" name="category"></td>
    									            </tr>
    									            <tr>
    									                <td>7</td>
    									                <td colspan="2">Date of Admission</td>
    									                <td><input type="text" id="Admissiondate" name="Admissiondate"></td>
    									            </tr>
    									            <tr>
    									                <td>8</td>
    									                <td colspan="2">Date of Leaving</td>
    									                <td><input type="text" name="dateofLeaving" id="dateofLeaving"></td>
    									            </tr>
    									            <tr>
    									                <td>9</td>
    									                <td colspan="2">Subject Studied</td>
    									                <td><input type="text" id="program" name="program"></td>
    									            </tr>
    									            <tr>
    									                <td>10</td>
    									                <td colspan="2">Whether Course Completed or Not</td>
    									                <td><input type="text" id="coursecompleted" name="coursecompleted"></td>
    									            </tr>
    									            <tr>
    									                <td>11</td>
    									                <td colspan="2">Whether He/She has Paid all Fees &  Dues to The College</td>
    									                <td><input type="text" id="feesPaid" name="feesPaid"></td>
    									            </tr>
    									            <tr>
    									                <td>12</td>
    									                <td colspan="2">Name of the University</td>
    									                <td><input type="text" id="university" name="university"></td>
    									            </tr>
    									             <tr>
    									                <td>13</td>
    									                <td colspan="2">University  Register No</td>
    									                <td><input type="text" id="universityreg" name="universityreg"></td>
    									            </tr>
    									            <tr>
    									                <td>14</td>
    									                <td colspan="2">Whether Passed or Faild</td>
    									                <td><input type="text" id="studentgrade" name="studentgrade"></td>
    									            </tr>
    									           
    									            <tr>
    									                <td>15</td>
    									                <td colspan="2">Date of Issue</td>
    									                <td><input type="text" name="dateofissue" id=dateofissue></td>
    									            </tr>
    									        </tbody>
    									    </table>
    									    <div class="row" style="margin-top:70px">
    									    <div class="col-md-6 ps-5"><p> Clerk</p> </div> 
    									    <div class="col-md-6 text-right pe-5" ><p> Principal</p> </div></div>
    									</div>
    								</div>
    							</div>
						    	<div class="col-md-1"></div>
						    </div>
			        	</div>
			        	<br>
				  <button type="submit" name="filter" id="filter" class="btn btn-primary fa fa-file-pdf-o">  Download TC </button>
                
            </div>
          </div>
        </div>
     </div>
 </div>
	</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <!-- Script -->
    
 
 

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
          $('.skillitems').val(ui.item.label);// display the selected text
          $('#skillid').val(ui.item.value); // save selected id to input
		 
          return false;
        },
appendTo: "#skill_pos",
      });
        });

$("#btnTC").click(function(e) {
      e.preventDefault();
       var studentid =  $('#skillid').val();
       //alert(studentid);
              $.ajax({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		         url:"{{ url('/admin/fetchRecords')}}",
                  method: "GET",
                  data: {studentid : studentid},
                  dataType: 'json',
                  success: function(res)
                  {    
                      console.log(res);
                     // loader_off();      
                         
                      if (res == null) {
                         
                      } else {
                        
                        $("#skillitems").val('');
                        $("#skillid").val('');
                        $("#editid").val(res[0]['pid']);
                        $("#studentname").val(res[0]['name']);
                        $("#guardian").val(res[0]['parent_name']);
                        $("#dobfigure").val(res[0]['dob']);
                        $("#dobword").val(res[0]['dobword']);
                        $("#admissionno").val(res[0]['admission']);
                        $("#Nationality").val(res[0]['nationality']);
                        $("#Religion").val(res[0]['relegion']);
                        $("#category").val(res[0]['category']);
                        $("#Admissiondate").val(res[0]['admissiondate']);
                        $("#program").val(res[0]['program']);
                        $("#university").val(res[0]['university_name']);
                        $("#universityreg").val(res[0]['university_regno']);
                        $("#tc").val(res[0]['tcnumber']);
                        $("#tcgennumber").val(res[0]['generatornum']);
						$("#statusgen").val(res[0]['stgen']);
                        $("#datetoday").val(new Date().toLocaleDateString("en-GB"));
                        $("#datetimetoday").html(new Date().toLocaleString('es-ES'));
                        $("#dateofissue").val(res[0]['date_of_issue']);
                        $("#dateofapplication").val(res[0]['date_of_applicationtc']);
                        $("#character_conduct").val(res[0]['conductCharacter']);
                         $("#leavingReason").val(res[0]['reason_for_leaving']);
                         $("#studentgrade").val(res[0]['student_grade']);
                         $("#feesPaid").val(res[0]['fees_paid']);
                         $("#coursecompleted").val(res[0]['course_completion']);
                         $("#dateofLeaving").val(res[0]['class_date_of_leaving']);
                          $("#conductCharacter").val(res[0]['character_conduct']);
                           $("#dateofissue").val(new Date().toLocaleDateString("en-GB"));
                         
                        
                      }
                  },
                  error: function(e){
                     // loader_off();                 
                                      
                  }
              });
});



</script>

@endsection