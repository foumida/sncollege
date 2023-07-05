@if(Auth::User()->role == 2)
   @php $type = "layouts.faculty.default";
   $search = url('faculty/searchMarksheet/') ;
   $searchmark = url('/faculty/fetchExternal_marksheet');
   
   @endphp

   @elseif(Auth::User()->role == 6)
  
  @php $type = "layouts.hod.default";
  $search = url('hod/searchMarksheet/') ;
    $searchmark = url('/hod/fetchExternal_marksheet');
 @endphp

 @endif
@extends($type)

@section('content')
<style>
.formsection{
    padding:20px;
}
.logo img {
    width: 13%;
    margin: 1px 0 5px 0;
}
.logo h3 {
    color: #333;
    font-size: 18px;
    text-transform: uppercase;
}
.logo p {
    color: #333;
    font-size: 16px;
    text-transform: uppercase;
    margin-top: -4px;
}
hr {
    margin-top: 0rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 3px solid rgb(0 0 0 / 47%);
}
.basicdetails {
    color: #222;
    line-height: 31px;
    font-size: 15px;
    margin-bottom:1rem;
}
.basicdetailsform{
    color: #222;
    line-height: 31px;
    font-size: 15px;
    width:100%;
}
.basicdetailsform .tbletc .table-bordered th, .table-bordered td {
    border: 1px solid #bfc1c6 !important;
    box-shadow: 1px 1px 1px 1px #9a939321 !important;
    padding: 10px!important;
    font-size: 12px!important;
}
.blodtext {
    font-weight: 500;
}
.totalvalues {
 margin-top:1.5rem;   
}
.totalvalues h5{
    color: #222;
}
.totalDisclaimer {
    color: #000000bf;
    margin-top: 2rem;
}
.totalDisclaimer p {
    text-align: justify;
    font-size: 12px;
    color: #6f6262b0;
}
.totalDisclaimer h5{
    font-size: 16px;
    color: #333;
}
</style>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Programs List </h3>
                </div>
                        <form id="fupForm" method="POST" action="{{ $search }}"> 
                  @csrf
            <div class="row">
                  <div class="col-md-3">
                  	<label>Course: </label>  
                						<input type="text" value="{{$batch}}" name="batch" id="batch" class="form-control" disabled>
                						
                </div>
                <div class="col-md-3">
                  	<label>Semester: </label>  
                								 <select class="form-control" name="semester" id="semester">
        									    	<option value="">Select </option>
        									    	<option value="Semester 1" >Semester 1</option>
                									<option value="Semester 2" >Semester 2</option>
                									<option value="Semester 3" >Semester 3</option>
                                                    <option value="Semester 4" >Semester 4</option>
                                                    <option value="Semester 5" >Semester 5</option>
                                                    <option value="Semester 6" >Semester 6</option>	
                                                    <option value="Semester 7" >Semester 7</option>	
                                                    <option value="Semester 8" >Semester 8</option>	
        										</select>    
                </div>
                 <div class="col-md-3">
                  	<label>Course: </label>  
                						<input type="text" value="{{$stid}}" name="studentid" id="studentid" class="form-control">
                						<input type="text" value="{{$program}}" name="coursename" id="coursename" class="form-control" disabled>
                </div>
               
            </div>
            </form>
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 bg-white">
                                    <div class="formsection">
                                        <div class="logo text-center">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQovC_3f-XHe8iCNgfkUJ0MtBn5HYDWJd_YWw&usqp=CAU" alt="" class="img-fluid">
                                            <h3>university of calicut</h3>
                                            <p>examination result</p>
                                        </div>
                                        <hr>
                                        <table class="basicdetails">
                                            <tbody>
                                                <tr>
                                                    <td width="30%">Examination:</td>
                                                    <td class="blodtext" width="70%" id="exam"> </td>
                                                </tr>
                                                 <tr>
                                                    <td>Register Number:</td>
                                                    <td class="blodtext" id="registernumber" >  </td>
                                                </tr>
                                                 <tr>
                                                    <td>Name:</td>
                                                    <td class="blodtext" id="name">  </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="table-responsive">
                                        <table class="table table-bordered dt-responsive nowrap w-100  basicdetailsform">
                                            <thead>
                                                <th style="width:8%">Course <br> Code</th>
                                                <th style="width:20%">Course <br> Title</th>
                                                <th style="width:8%">Credites</th>
                                                <th style="width:8%">External <br> Grade</th>
                                                <th style="width:8%">Internal <br> Grade</th>
                                                <th style="width:8%">Total <br> Grade</th>
                                                <th style="width:8%">Credit <br> Point</th>
                                                <th style="width:8%">Status</th>
                                            </thead>
                                            <tbody id="table_data">
                                               
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="row text-center totalvalues">
                                            <div class="col-xl-4 col-lg-4 col-sm-4 col-md-4">
                                                <h5>SGPA :</h5><h5 id="sgpa"></h5>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-sm-4 col-md-4">
                                                <h5>GRADE :</h5><h5 id="grade"></h5>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-sm-4 col-md-4">
                                                <h5>CGPA :</h5><h5 id="cgpa"></h5>
                                            </div>
                                        </div>
                                        
                                        
                                        <!--<div class="row totalDisclaimer">-->
                                        <!--    <div class="col-xl-10 col-lg-10 col-sm-10 col-md-10">-->
                                        <!--        <h5>Disclaimer</h5>-->
                                        <!--        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text -->
                                        <!--        ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived -->
                                        <!--        not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>-->
                                              
                                        <!--        <h5>65465465465465</h5>-->
                                        <!--    </div>-->
                                        <!--    <div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="col-xl-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript"> 
$("#semester").change(function()
{
var semester=$(this).val();
var batch = $('#batch').val();
var studentid = $('#studentid').val();
var coursename = $('#coursename').val();
 $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$searchmark}}",
            type: 'GET',
             data: {
               
                  semester : semester,
                  batch:batch,
                  studentid:studentid,
                  coursename:coursename,
                 
              },
            dataType: 'json',
           success: function(result) {
                    
                    $('#table_data').html(result.result);  
                    $('#registernumber').html(result.regno); 
                    $('#exam').html(result.examination); 
                    $('#name').html(result.name); 
                    $('#sgpa').html(result.sgpa); 
                    $('#grade').html(result.grade); 
                    $('#cgpa').html(result.cgpa); 
                }
                  
        });
        event.preventDefault();
});
</script>
@endsection