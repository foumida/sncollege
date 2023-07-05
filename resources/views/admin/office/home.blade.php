@extends('layouts.office.default')
@section('content')
            <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
             
            </div>
          
         
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Departments</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">{{$list[0]->totlogbook}}</h2>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Faculty</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">{{$faculty[0]->total}}</h2>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Students</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">{{$students[0]->totst}}</h2>
                        
                        </div>
                        <h6 class="text-muted font-weight-normal">Male: {{$students[0]->Malest}}</h6>
                        <h6 class="text-muted font-weight-normal">Female: {{$students[0]->femalest}}</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             	<div class="card">
    			<div class="card-body">
    				
					<br>
							<div class="chart-container">
    					<div id="chart_area" style="width:100%; height:300px;"></div>
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
          ['Botany', {{$barchart[0]->Botany}},'color: #FF8000'],
           ['Arabic', {{$barchart[0]->Arabic}},'color: #FF0000'],
          ['Economics', {{$barchart[0]->Economics}},'color: #00FF00'],
          ['Aquaculture', {{$barchart[0]->Aquaculture}},'color: #0000FF'],
          ['Malayalam', {{$barchart[0]->Malayalam}},'color: #800080'],
		  ['Chemistry', {{$barchart[0]->Chemistry}},'color: #761646'],
		  ['English', {{$barchart[0]->English}},'color: #5410d6'],
		  ['Hindi', {{$barchart[0]->Hindi}},'color: #2a1006'],
		  ['History', {{$barchart[0]->History}},'color: #fff400'],
		  ['ComputerApplication', {{$barchart[0]->ComputerApplication}},'color: #4A180D'],
		  ['MassCommunication', {{$barchart[0]->MassCommunication}},'color: #410D4A'],
		  ['PhysicalEducation', {{$barchart[0]->PhysicalEducation}},'color: #0D4A43'],
		  ['Mathematics', {{$barchart[0]->Mathematics}},'color: #37BF0E'],
		  ['Physics', {{$barchart[0]->Physics}},'color: #C9E10B'],
		  ['Psychology', {{$barchart[0]->Psychology}},'color: #ADB37B'],
		  ['Statistics', {{$barchart[0]->Statistics}},'color: #41407C'],
		  ['Zoology', {{$barchart[0]->Zoology}},'color: #9B1E14'],
		  ['FishProcessingTechnology', {{$barchart[0]->FishProcessingTechnology}},'color: #EB984E'],
		  ['DigitalFilmProduction', {{$barchart[0]->DigitalFilmProduction}},'color: ##E74C3C'],
		  ['LogisticsManagement', {{$barchart[0]->LogisticsManagement}},'color: #0E6655 '],
		  ['Tourism', {{$barchart[0]->Tourism}},'color: #21618C'],
		  ['Commerce', {{$barchart[0]->Commerce}},'color: ##5F6A6A'],
		  ['CommerceManagementStudies', {{$barchart[0]->CommerceManagementStudies}},'color: #212F3D'],
		  ['LibraryScience', {{$barchart[0]->LibraryScience}},'color: #D7BDE2'],
        ]);



        // Set chart options
        var options = {'title':'Department Faculty Graph'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
        chart.draw(data, options);
      }
	 

    </script>
@endsection



