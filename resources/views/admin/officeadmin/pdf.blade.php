<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css" media="all">
.table {
    --bs-table-bg: transparent;
    --bs-table-accent-bg: transparent;
    --bs-table-striped-color: #212529;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: #212529;
    --bs-table-active-bg: rgba(0, 0, 0, 0.1);
    --bs-table-hover-color: #212529;
    --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    vertical-align: top;
    border-color: #dee2e6;
}
.tcfrom h2 {
    color: #000;
    margin-top: -1px;
    font-size: 23px;
}
.tcfrom {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 10px 6px 6px 6px #c1c1c15e;
}
.img-fluid {
    max-width: 100px;
    height: auto;
}


.col-md-12 {
    flex: 0 0 auto;
    width:670px;
}
.tbletc .table-bordered th, .table-bordered td {
    border: 1px solid #bfc1c6 !important;
    box-shadow: 1px 1px 1px 1px #9b949480 !important;
    padding:8px!important;
}
.table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td {
    vertical-align: middle;
    font-size: 12px;
    line-height: 1;
    white-space: nowrap;
}
.col-md-7 {
    flex: 0 0 58.33333%;
    max-width:500px;float: right;
}
.col-md-3 {
    flex: 0 0 25%;
    max-width: 200px;
    float: left;
}
.text-center {
    text-align: center !important;
}
.text-end{
   text-align: right !important;  
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -0.75px;
    margin-left: -0.75px;
}
.headtitle {
    font-size:20px;
    text-decoration: underline;
}
.table-bordered>:not(caption)>* {
    border-width: 1px 0;
}
tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
.table, .jsgrid .jsgrid-table {
    margin-bottom: 0;
    color: #000;
    font-family: DejaVu Sans, sans-serif;
    font-size: 10px !important;
}
.tbletc .table-bordered th, .table-bordered td {
    border: 1px solid #bfc1c6 !important;
    box-shadow: 1px 1px 1px 1px #9a939321 !important;
    padding: 9px!important;
}
.tcfrom p {
    font-size: 14px;
    margin-bottom: -9px;
}
</style>
 </head>
  <body>
            <div id="mainform" >
					    	<div class="row">
							    <div class="col-md-1"></div>
    							<div class="col-md-10 tcfrom">
    								<div class="row">
    									<div class="col-md-12" style="width:300px;;margin-bottom:10px">
    									    <p id="datetimetoday">{{date('Y-m-d H:i:s')}}</p>
    									</div>
    									
    								</div>
    								<div class="row text-center" style="margin-top:5px">
    									<div class="col-md-3"style="width:145px;float: left;margin-bottom:10px">
    									    <img src="{{asset('theme/admin/assets/images/favicon.png')}}" class="img-fluid">
    									</div>
    									<div class="col-md-7" style="width:500px;float: right;margin-bottom:10px">
    									    <h2>MES ASMABI COLLEGE</h2>
    									    <P>P. Vemballur P.O., Kodungallur, Thrissur Dist., Kerala PIN-680671</P>
    									    <P class="details">Web : Email - Principal.mesasmabi@gmail.com <br>Ph.  0480  2850596, 2851171</P>
    									</div>
    								</div>
    								<div class="row titlehead text-center" style="margin-top:30px">
    									<div class="col-md-12">
    									    <h2 class="headtitle" style="margin-top: -30px;">TRANSFER CERTIFICATE </h2>
    									</div>
    								</div>
    								<div class="row">
    									<div class="col-md-12 tbletc">
    									    <table class="table tctable table-bordered">
    									        <tbody>
    									            <tr>
    									                <td colspan="3" style="width:450px">TC No : @if(!empty($list[0]->tc_number)){{$list[0]->tc_number}}@endif</td>
    									                <td style="width:200px">Date : @if(!empty($list[0]->created_date)){{$list[0]->created_date}}@endif</td>
    									               </tr>
    									            <tr>
    									                <td style="width:35px">1</td>
    									                <td colspan="2"  style="width:470px">Name of Student in Block Letters</td>
    									                <td style="width:200px">@if(!empty($list[0]->name_of_student)){{$list[0]->name_of_student}}@endif</td>
    									            </tr>
    									            
    									            <tr>
    									                <td style="width:35px">2</td>
    									                <td colspan="2"  style="width:470px">Number in the Admission Register</td>
    									                <td>@if(!empty($list[0]->admission_regno)){{$list[0]->admission_regno}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td rowspan="2">3</td>
    									                <td rowspan="2">Date of Birth As Entered In The <br> Admission Register</td>
    									                <td>(In Figures)</td>
    									                <td>@if(!empty($list[0]->dob)){{$list[0]->dob}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>(In Words)</td>
    									                <td>@if(!empty($list[0]->dob)){{date('jS F Y', strtotime($list[0]->dob))}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>4</td>
    									                <td colspan="2">Nationality</td>
    									                <td>@if(!empty($list[0]->nationality)){{$list[0]->nationality}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>5</td>
    									                <td colspan="2">Religion & Caste</td>
    									                <td>@if(!empty($list[0]->relegion)){{$list[0]->relegion}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>6</td>
    									                <td colspan="2">Whether Belongs to SC/ST/OEC/OBC</td>
    									                <td>@if(!empty($list[0]->reservation_category)){{$list[0]->reservation_category}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>7</td>
    									                <td colspan="2">Date of Admission</td>
    									                <td>@if(!empty($list[0]->class_date_of_admission)){{$list[0]->class_date_of_admission}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>8</td>
    									                <td colspan="2">Date of Leaving</td>
    									                <td>@if(!empty($list[0]->class_date_of_leaving)){{$list[0]->class_date_of_leaving}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>9</td>
    									                <td colspan="2">Subject Studied</td>
    									                <td>@if(!empty($list[0]->subject_studied)){{$list[0]->subject_studied}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>10</td>
    									                <td colspan="2">Whether Course Completed or Not</td>
    									                <td>@if(!empty($list[0]->course_completion)){{$list[0]->course_completion}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>11</td>
    									                <td colspan="2">Whether He/She has Paid all Fees &  Dues to The College</td>
    									                <td>@if(!empty($list[0]->fees_paid)){{$list[0]->fees_paid}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>12</td>
    									                <td colspan="2">Name of the University</td>
    									                <td>@if(!empty($list[0]->university_name)){{$list[0]->university_name}}@endif</td>
    									            </tr>
    									             <tr>
    									                <td>13</td>
    									                <td colspan="2">University Register No.</td>
    									                <td>@if(!empty($list[0]->university_examination_details)){{$list[0]->university_examination_details}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>14</td>
    									                <td colspan="2">Whether Passed or Faild</td>
    									                <td>@if(!empty($list[0]->student_grade)){{$list[0]->student_grade}}@endif</td>
    									            </tr>
    									            <tr>
    									                <td>15</td>
    									                <td colspan="2">Date of Issue</td>
    									                <td>@if(!empty($list[0]->date_of_issue)){{$list[0]->date_of_issue}}@endif</td>
    									            </tr>
    									        </tbody>
    									    </table>
    									      <div class="row" style="margin-top:80px;dispaly:flex;">
    									    <div class="col-md-6" style="float: left;"><p> Clerk</p> </div> 
    									    <div class="col-md-6 text-end" style="width:500px;float: right;"><p> Principal</p> </div></div>
    									</div>
    								</div>
    							</div>
						    </div>
			        	</div>
				 
           
  												
		
  </body>
</html>