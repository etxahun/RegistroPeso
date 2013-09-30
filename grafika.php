<?php
include_once('conexion.php');

$resultado1=mysql_query("SELECT peso FROM medidas WHERE personas_id='1'");
$resultado2=mysql_query("SELECT peso FROM medidas WHERE personas_id='2'");

$interests1=array();
$interests2=array();

while($row1 = mysql_fetch_assoc($resultado1))
{
    $interests1[] = $row1['peso'];
}

while($row2 = mysql_fetch_assoc($resultado2))
{
    $interests2[] = $row2['peso'];
}

?>

<script type="text/javascript"> 

var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'grafica',
	 	 zoomType: 'x',
		 marginBottom: 50,
		 marginRight: 15,
		 marginLeft: 150
      },
	  credits: {
		 enabled: false
	  },
      title: {
         text: 'Registro Diario de Pesos'
      },

      subtitle: {
         text: ''
      },

      xAxis: {
	     title: {text: 'Diciembre 2012'},
		 maxZoom: 48 * 3600 * 1000,
		 type: 'datetime',
	     dateTimeLabelFormats: {
	         day: '%e of %b'   
	        }
	  },
      yAxis: {
         min: 60,
         alternateGridColor: '#FDFFD5',
         title: {
            align: 'high',
			rotation: '0',
			text: 'Peso (Kg.)'
         }
      },
      legend: {
          layout: 'vertical',
          backgroundColor: '#FFFFFF',
          align: 'left',
          verticalAlign: 'top',
          x: 15,
          y: 70
      },
      tooltip: {
         formatter: function() {
            return ''+
               this.x +': '+ this.y +' Kg.';
         }
      },
   	  plotOptions: {
          line: {
           dataLabels: {
               enabled: true
           },
           enableMouseTracking: false
       }
   },
      series: [{
         name: 'Etxahun',
         data: [<?php echo join($interests1, ', ');?>],
         pointStart: Date.UTC(2012, 11, 1),
         pointInterval: 24 * 3600 * 1000 // one day
      	},
		{
		 name: 'Nerea',
         data: [<?php echo join($interests2, ', ');?>],
         pointStart: Date.UTC(2012, 11, 1),
         pointInterval: 24 * 3600 * 1000 // one day
		}]
   });

});
</script>

