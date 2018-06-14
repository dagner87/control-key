<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>plantilla\assets\js\jquery.min.js"></script>
</head>
<body>

	<input type="button" id="btnBuscar" value="Graficar">

	<div id="contenedor_grafico">
		<canvas id="myChart" width="400" height="150"></canvas>
	</div>

<script>

var cantidad_articulo = [];
var fecha_venta = [];

// $('#btnBuscar').click(function(){
// 	$.post("<?php echo base_url();?>Welcome/getPersonas",
// 		function(data){
// 			var obj = JSON.parse(data);

// 			paramNombres = [];
// 			paramEdades = [];
// 			$.each(obj, function(i,item){
// 				paramNombres.push(item.nombre);
// 				paramEdades.push(item.edad);
// 			});
			
// 			//Eliminamos y creamos la etiqueta canvas
// 			$('#myChart').remove();
// 			$('#contenedor_grafico').append("<canvas id='myChart' width='400' height='150'></canvas>");

// 			var ctx = $("#myChart");
// 			var myChart = new Chart(ctx, {
// 			    type: 'line',
// 			    data: {
// 			    	labels: paramNombres, //paramMeses,//horizontal
// 			    	datasets: [
// 			        	{
// 				            label: "Edades",
// 				            fill: true,
// 				            lineTension: 0.1,
// 				            backgroundColor: "rgba(75,192,192,0.4)",
// 				            borderColor: "rgba(75,192,192,1)",
// 				            borderCapStyle: 'butt',
// 				            borderDash: [],
// 				            borderDashOffset: 0.0,
// 				            borderJoinStyle: 'miter',
// 				            pointBorderColor: "rgba(75,192,192,1)",
// 				            pointBackgroundColor: "#fff",
// 				            pointBorderWidth: 10,
// 				            pointHoverRadius: 5,
// 				            pointHoverBackgroundColor: "rgba(75,192,192,1)",
// 				            pointHoverBorderColor: "rgba(220,220,220,1)",
// 				            pointHoverBorderWidth: 5,
// 				            pointRadius: 1,
// 				            pointHitRadius: 10,
// 				            data: paramEdades, //paramValores,//vertical
// 				            spanGaps: false,
// 				        }
// 			    	]
// 				},
// 			    options: {
// 			        scales: {
// 			            yAxes: [{
// 			                ticks: {
// 			                    beginAtZero:true
// 			                }
// 			            }]
// 			        }
// 			    }
// 			});
// 		});
// });
var bgColor = [];
var bgBorder = [];
$('#btnBuscar').click(function(){
	$.post("<?php echo base_url();?>examples/datos_venta",
		function(data){
			var obj = JSON.parse(data);

			cantidad_articulo = [];
			fecha_venta = [];
			bgColor = [];
			bgBorder = [];
			$.each(obj, function(i,item){
				var r = Math.random() * 255;
				r = Math.round(r);

				var g = Math.random() * 255;
				g = Math.round(g);

				var b = Math.random() * 255;
				b = Math.round(b);

				cantidad_articulo.push(item.cantidad_articulo);
				fecha_venta.push(item.fecha_venta);
				bgColor.push('rgba('+r+','+g+','+b+', 0.3)');
				bgBorder.push('rgba('+r+','+g+','+b+', 1)');
			});
			
			//Eliminamos y creamos la etiqueta canvas
			$('#myChart').remove();
			$('#contenedor_grafico').append("<canvas id='myChart' width='400' height='150'></canvas>");

			var ctx = $("#myChart");
			var myChart = new Chart(ctx, {
			    type: 'colum',
			    data: {
			        labels: fecha_venta,
			        datasets: [{
			            label: 'Ventas por Fecha',
			            data: cantidad_articulo,
			            backgroundColor: bgColor,
			            borderColor: bgBorder,
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
			
		});
});

</script>


</body>
</html>