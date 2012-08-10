<h2>Objetivos y proyectos 2013</h2>
<h1>Planificación 2013 - |-$root-|</h1>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>

     <script type="text/javascript">
      
      google.load('visualization', '1', {packages:['orgchart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows([|-$data-|]);
      
         // Create and draw the visualization.
          var chart = new google.visualization.OrgChart(document.getElementById('visualization'));
          chart.draw(data, {allowHtml: true, allowCollapse: true});
         // chart.setRowProperty(3, 'style', 'border: 1px solid green');
        //for (var i = 0; i < data.getNumberOfRows(); i++) {
        //    chart.collapse(i, true);
        //  }
      }
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 300px; height: auto;"></div>
  </body>