
@extends('layouts.faculty.default')

@section('content')
            <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
             
            </div>
            
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                     <div class="preview-thumbnail">
                              
                                <a href="{{url('faculty/editProfile')}}"  title="Edit" ><i class="mdi mdi-account-edit"></i></a>
                                <a href="{{url('faculty/editProfileImage')}}"  title="Camera" ><i class="mdi mdi-camera"></i></a>
                            </div>
                    <div class="d-flex py-4">
                      <div class="preview-list w-100">
                        <div class="preview-item p-0">
						@if(!empty($list[0]->picture))
                          <div class="preview-thumbnail">
                            <img src="{{url('uploads/facultyimg/'.$list[0]->picture)}}" class="rounded-circle" alt="" style="width:136px;height:136px;">
                          </div>
						
						  @else
							   <div class="preview-thumbnail">
                            <img src="{{asset('theme/admin/assets/images/faces/face12.jpg')}}" class="rounded-circle" alt="" style="width:136px;height:136px;">
                          </div>
						  
                         @endif
                        </div>
                      </div>
                    </div>
					 <div class="flex-grow">
                              <div class="d-flex d-md-block d-xl-flex justify-content-between">
                              @if(!empty($list[0]->name))  <h6 class="preview-subject">{{ $list[0]->name }}</h6> @endif
                             @if(!empty($list[0]->designation))   <p class="text-muted text-small">{{ $list[0]->designation }} </p> @endif
                              </div>
                             
                            </div>
               @if(!empty($list[0]->department))   <p class="text-muted text-medium">{{ $list[0]->department }}  </p> @endif
                   
                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                    
                      <p class="text-muted mb-1">Your data status</p>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
						@if(!empty($list[0]->highest_edu))
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                <i class="mdi mdi-cast-education"></i>
                              </div>
                            </div>
							
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">Education</h6>
                                <p class="text-muted mb-0">{{ $list[0]->highest_edu }} </p>
                              </div>
                              
                            </div>
							
                          </div>
						  @endif
						  @if(!empty($list[0]->address))
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                <i class="mdi mdi-map-marker-radius"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">Location</h6>
                                <p class="text-muted mb-0">{{ $list[0]->address }}</p>
                              </div>
                            
                            </div>
                          </div>
						   @endif
						     @if(!empty($list[0]->description))
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                <i class="mdi mdi-file-document-edit"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">Description</h6>
                                <p class="text-muted mb-0">{{ $list[0]->description }}</p>
                              </div>
                             
                            </div>
                          </div>
                         @endif
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
	<div class="row col-md-offset-2">
    	<div class="col-xl-6">
    		<div class="card">
    			<div class="card-body">
			<!--	<select id="lineyear" name="lineyear" class="form-control select_location">
                                <option value="">Select Academic Year</option>
                                <option value="2010-2011">2010-2011</option>
								<option value="2011-2012">2011-2012</option>
								 <option value="2012-2013">2012-2013</option>
								  <option value="2013-2014">2013-2014</option>
								   <option value="2014-2015">2014-2015</option>
								<option value="2015-2016">2015-2016</option>
								 <option value="2016-2017">2016-2017</option>
								  <option value="2017-2018">2017-2018</option>
								   <option value="2018-2019">2018-2019</option>
								<option value="2019-2020">2019-2020</option>
								 <option value="2020-2021">2020-2021</option>
								  <option value="2021-2022">2021-2022</option>
								   <option value="2022-2023">2022-2023</option>
								<option value="2023-2024">2023-2024</option>
								 <option value="2024-2025">2024-2025</option>
								  <option value="2025-2026">2025-2026</option>
								   <option value="2026-2027">2026-2027</option>
								<option value="2027-2028">2027-2028</option>
								 <option value="2028-2029">2028-2029</option>
								  <option value="2029-2030">2029-2030</option>
								   <option value="2030-2031">2030-2031</option>
								  <option value="2031-2032">2031-2032</option>
								   <option value="2032-2033">2032-2033</option>
								<option value="2033-2034">2033-2034</option>
								 <option value="2034-2035">2034-2035</option>
								  <option value="2035-2036">2035-2036</option>
								   <option value="2036-2037">2036-2037</option>
								<option value="2037-2038">2037-2038</option>
								 <option value="2038-2039">2038-2039</option>
								  <option value="2039-2040">2039-2040</option>
                            </select>-->
    				<div class="chart-container">
    					<div> <div id="curve_chart" style="width: 100%; height:610px"><br><br></div></div>
    				</div>
    			</div>
    		</div>
    	</div>
    
    	<div class="col-xl-6">
    		<div class="card">
    			<div class="card-body">
    				<div class="chart-container">
    					<div><canvas id="myPieChart"></canvas></div>
    				</div>
    			</div>
    
    		<div class="card">
    			<div class="card-body">
    				
					 <select id="yearDropdown" name="yearDropdown" class="form-control select_location">
                                <option value="">Select Academic Year</option>
                                <option value="2010-2011">2010-2011</option>
								<option value="2011-2012">2011-2012</option>
								 <option value="2012-2013">2012-2013</option>
								  <option value="2013-2014">2013-2014</option>
								   <option value="2014-2015">2014-2015</option>
								<option value="2015-2016">2015-2016</option>
								 <option value="2016-2017">2016-2017</option>
								  <option value="2017-2018">2017-2018</option>
								   <option value="2018-2019">2018-2019</option>
								<option value="2019-2020">2019-2020</option>
								 <option value="2020-2021">2020-2021</option>
								  <option value="2021-2022">2021-2022</option>
								   <option value="2022-2023">2022-2023</option>
								<option value="2023-2024">2023-2024</option>
								 <option value="2024-2025">2024-2025</option>
								  <option value="2025-2026">2025-2026</option>
								   <option value="2026-2027">2026-2027</option>
								<option value="2027-2028">2027-2028</option>
								 <option value="2028-2029">2028-2029</option>
								  <option value="2029-2030">2029-2030</option>
								   <option value="2030-2031">2030-2031</option>
								  <option value="2031-2032">2031-2032</option>
								   <option value="2032-2033">2032-2033</option>
								<option value="2033-2034">2033-2034</option>
								 <option value="2034-2035">2034-2035</option>
								  <option value="2035-2036">2035-2036</option>
								   <option value="2036-2037">2036-2037</option>
								<option value="2037-2038">2037-2038</option>
								 <option value="2038-2039">2038-2039</option>
								  <option value="2039-2040">2039-2040</option>
                            </select><br>
							<div class="chart-container">
    					<div id="chart_area" style="width:100%; height:300px;"></div>
    				</div>
    			</div>
    		</div>
    	</div>
		
    </div>	
    </div>	
	
   
	<br> 
		
           <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Events List</h4>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <tr>
                              
                                <td>
								Title</td>
                                <td class="text-right"> From Date </td>
                                <td class="text-right font-weight-medium">To Date </td>
								<td class="text-right font-weight-medium">Venue</td>
                              </tr>
							    @if(!empty($profile_list))
                               @foreach($profile_list as $val)
                           <tr>
                                <td>
								{{$val->title}}</td>
                                <td class="text-right"> {{$val->from_date}} </td>
                                <td class="text-right font-weight-medium">{{$val->to_date}} </td>
								<td class="text-right font-weight-medium">{{$val->venue}}</td>
                              </tr>
                           @endforeach
                             @endif
                              
                             
                            </tbody>
                          </table>
                        </div>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         
          <!-- partial -->
        </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	
<script>
	
const response = [
  {"label":"Curricular Aspects", "values":{{$piechart[0]->Criterion1}}},
  {"label":"Teaching- Learning and Evaluation", "values":{{$piechart[0]->Criterion2}}},
  {"label":"Research, Innovations and Extension", "values":{{$piechart[0]->Criterion3}}},
   {"label":"Infrastructure and Learning Resource", "values":{{$piechart[0]->Criterion4}}},
  {"label":"Student Support and Progression", "values":{{$piechart[0]->Criterion5}}},
  {"label":"Governance, Leadership and Management", "values":{{$piechart[0]->Criterion6}}},
   {"label":"Institutional Values and Best Practice", "values":{{$piechart[0]->Criterion7}}}
 
]

var valoresnew   = new Array();
var etiquetasnew = new Array();

response.forEach(function(item){
  valoresnew.push(item.values);
  etiquetasnew.push(item.label);
});

var config = {
  type: 'pie',
  data: {
    datasets: [{
      data: valoresnew,
      backgroundColor: ['#96ff00', '#00ffec','#f60095','#fff400','#0003c5','#ee82ee','#3cb371','#0000ff','#ff0000']
    }],
    labels: etiquetasnew
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
	  
    },
   
  }
};
new Chart(document.getElementById('myPieChart'), config);
</script>	
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', '');
        data.addColumn({type: 'string', role: 'style'});
        data.addRows([
          ['Seminar', {{$barchart[0]->Seminar}},'color: #FF8000'],
          ['Workshop', {{$barchart[0]->Workshop}},'color: #FF0000'],
          ['StudyTour', {{$barchart[0]->StudyTour}},'color: #00FF00'],
          ['Symposium', {{$barchart[0]->Symposium}},'color: #0000FF'],
          ['Conference', {{$barchart[0]->Conference}},'color: #800080'],
		  ['Webinar', {{$barchart[0]->Webinar}},'color: #761646'],
		  ['PublicPrograms', {{$barchart[0]->PublicPrograms}},'color: #5410d6'],
		  ['StudentExecutive', {{$barchart[0]->StudentExecutive}},'color: #2a1006'],
		   ['Other', {{$barchart[0]->Other}},'color: #fff400'],
        ]);



        // Set chart options
        var options = {'title':'Category Event Status'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
        chart.draw(data, options);
      }
	 

    </script>
	<script type="text/javascript">


      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['','Total Events', 'Male Student','Female Student','Other Student'],
       
@foreach ($columnchart as $article)
    [{{''}}, {{ $article->events }}, {{ $article->male }} , {{ $article->female }}, {{ $article->other}}] ,
@endforeach

        ]);
       
         
        

        var options = {
          title: 'Total Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
	<script type="text/javascript">
  $("#yearDropdown").change(function () {
        var year = $(this).val();
		
        if(year != '')
        {
            load_monthwise_data(year, 'Year Wise Event Data For');
        }
  });
  
  function load_monthwise_data(year, title)
{
	
    var temp_title = title + ' '+year+'';
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		url:"{{ url('/faculty/fetchBarchart')}}",
        method:"POST",
        data:{year:year},
        dataType:"JSON",
        success:function(data)
        {
			
            drawMonthwiseChart(data, temp_title);
        }
    });
}
function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', '');
    data.addColumn('number', '');
     data.addColumn({type: 'string', role: 'style'});
	 data.addRows([
	    
          ['Seminar', Number(jsonData[0].Seminar),'color: #FF8000'],
          ['Workshop', Number(jsonData[0].Workshop),'color: #FF0000'],
          ['StudyTour', Number(jsonData[0].StudyTour),'color: #00FF00'],
          ['Symposium', Number(jsonData[0].Symposium),'color: #0000FF'],
          ['Conference', Number(jsonData[0].Conference),'color: #800080'],
		  ['Webinar',Number( jsonData[0].Webinar),'color: #761646'],
		  ['PublicPrograms', Number(jsonData[0].PublicPrograms),'color: #5410d6'],
		  ['StudentExecutive', Number(jsonData[0].StudentExecutive),'color: #2a1006'],
		   ['Other', Number(jsonData[0].Other),'color: #fff400'],
			 
        ]);
     var options = {'title':'Category Event Status'};


    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}
</script>
<script type="text/javascript">
  $("#lineyear").change(function () {
        var year = $(this).val();
		
        if(year != '')
        {
            load_linedata(year, 'Year Wise Event Data For');
        }
  });
  
  function load_linedata(year, title)
{
	
    var temp_title = title + ' '+year+'';
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		url:"{{ url('/faculty/fetchLinechart')}}",
        method:"POST",
        data:{year:year},
        dataType:"JSON",
        success:function(data)
        {
			
            drawLinewiseChart(data);
        }
    });
}
function drawLinewiseChart(chart_data)
{
    var jsonData = chart_data;
	//console.log(jsonData);
   var s='';
    var data = google.visualization.arrayToDataTable([
         ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]

        ]);
       
console.log(s);
        var options = {
          title: 'Total Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
}
</script>
@endsection



