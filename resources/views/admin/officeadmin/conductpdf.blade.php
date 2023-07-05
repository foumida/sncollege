<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css" media="all">
.logo-img{
    width:100%;
}
.college-details {
    margin-top: -7px;
}
.contecttext {
    text-align: justify;
    padding: 0 30px;
}
.contecttext p span .forms-control {
    width: auto;
    padding-left: 10px;
    padding-right: 10px;
}
.contecttext p {
    font-size: 19px;
    line-height: 1.8;
}
.contecttext p span input {
    font-size: 16px;font-weight:600;
    text-transform: uppercase;
    text-align: center !important;
}
.forms-control {
    border: none;
    border-bottom: dotted;
    color: #333;
    text-align: center !important;
    background: #fff;
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 4px solid #000000 !important;
}
.col-lg-1 {flex: 0 auto;width: 50px;}
.col-md-2 {flex: 0 auto;width: 100px;}
.col-md-3 {flex: 0 auto;width: 150px;}
.col-md-4 {flex: 0 auto;width: 200px;}
.col-md-5 {flex: 0 auto;width: 250px;}
.col-md-6 {flex: 0 auto;width: 300px;}
.col-xl-7 {flex: 0 auto;width: 350px;}
.col-md-8 {flex: 0 auto;width: 400px;}
.col-md-9 {flex: 0 auto;width: 450px;}
.col-md-10{flex: 0 auto;width: 500px;}
.col-md-11{flex: 0 auto;width: 550px;}
.col-md-12{flex: 0 auto;width: 630px;}


.text-center {text-align: center !important;}
.text-right{text-align: right !important;  }
.text-left{text-align: left !important;  }
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -0.75px;
    margin-left: -0.75px;
}

.datesection {
    position: absolute;
}
.datesection .rightside {
    position: relative;
    left: 330px;
}
</style>
 </head>
  <body>
             <div id="mainform" >
					    	<div class="row">
							    <div class="col-md-1"></div>
    							<div class="col-xl-10 col-sm-12 col-md-12 tcfrom">
    								<br><br>
    								<div class="row text-center">
    									<div class="col-md-12">
    									    <img src="{{asset('theme/admin/assets/images/mes.jpg')}}" width="630" class="logo-img img-fluid">
    									</div>
    								</div>
									<br>
									<div class="row datesection">
    									<div class="col-md-6 leftside text-left">
    									    <div style="float:left;">
												<input type="text" id="conductnumber" class="forms-control" name="conductnumber" value="{{$list[0]->conduct_number}}">
											</div>
    									</div>
    									<div class="col-md-6 rightside text-right">
    									    <div style="float:right;">
												<input type="text" id="dateperiod" class="forms-control" name="dateperiod" value="{{$list[0]->period_date}}">
											</div>
    									</div>
    								</div>
									<br><br>
									
    								<div class="row titlehead text-center">
    									<div class="col-md-12">
    									    <h2 class="headtitle">CONDUCT CERTIFICATE </h2>
    									</div>
    								</div>
    								<br><br><br>
									
									<div class="row">
    									<div class="col-md-12 contecttext">
    									     <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to cerify that <span><input type="text" class="forms-control myInput" id="name" name="name" value="{{$list[0]->name}}"></span>was student of this college for the<span><input type="text" class="forms-control myInput" name="program" id="program" value="{{$list[0]->programme}}"></span>programme during the Academic Year </span><input type="text" class="forms-control myInput" name="year" id="year" value="{{$list[0]->academic_year}}">.His/Her Conduct and character has been <span><input type="text" class="forms-control myInput" style="width:200px" name="type" id="type"value="{{$list[0]->type}}"></span>.</p>
    									</div>
    								</div>
									
									<br><br><br>
									<div class="row">
    									<div class="col-md-12 text-right">
    									    <h2>PRINCPAL</h2>
    									</div>
    								</div>
									<br><br>
    							</div>
						    	<div class="col-md-1"></div>
						    </div>
			        	</div>
				 
           
<script>
 var inputField = document.querySelector(".myInput");
 inputField.addEventListener("input", adjustWidth);
 function adjustWidth() {
   var value = inputField.value;
   var width = value.length * 10 + 55; // 8px per character
   inputField.style.width = width + "px";
}
</script>		
		
  </body>
</html>