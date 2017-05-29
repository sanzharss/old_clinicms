<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
                  <?php 
                  $derivationTypeId=4;
                  if(isset($_GET['derivationType'])){
                    $derivationTypeId=$_GET['derivationType'];

                  }
                  
                  include "getData.php" ?>
      ]);

    var options = {
      title : 'Месячный показатель ',
      vAxis: {title: 'Количество'},
      hAxis: {title: 'Месяц'},
      seriesType: 'bars',
  
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);

  }
    </script>
  </head>
  <body>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
                <h1 class="page-header">Статистика по</h1>
                <div class="col-md-3">
                        <?php
          $sqlAllD="SELECT * FROM `derivationstype`";
        $queryAllD=$connection->query($sqlAllD);
        while ($rowAllD=$queryAllD->fetch_object()) {
          ?>
          <p><a href="?page=stat&derivationType=<?php echo $rowAllD->id;?>"><label ><?php echo $rowAllD->name ; ?></label></a></p>
            <?php
        }

      ?>
                
        </div>  
    </div>
      <?php 
        if(isset($_GET['derivationType'])){
          ?>
          <div id="chart_div" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="width: 1200; height: 500px;"></div>
          <?php
        }

      ?>
    </body>
</html>