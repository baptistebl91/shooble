 
  <script>
    window.onload = function () {
       
        var chart = new CanvasJS.Chart("chartContainer", {
           animationEnabled: true,
           exportEnabled: true,
           theme: "light1",
           title:{
              text: "Résultats de votre sondage"
          },
          data: [{
              type: "column",
              indexLabelFontColor: "black",
              indexLabelPlacement: "outside",   
              dataPoints: <?php echo json_encode(
                  $dataPoints,
                  JSON_NUMERIC_CHECK
              ); ?>
          }]
      });
        chart.render();
        
    }
    </script>