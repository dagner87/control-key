
<div class="register-box">
  <div class="register-logo">
<?php

$nombre_fichero = 'backup.txt';
if (file_exists($nombre_fichero))
 {

	$txt=fopen("backup.txt","w");
	echo "archivo Limpiado";
	if (empty($arraypedidosKey)!="false")
                  {
                foreach($arraypedidosKey as $item):
		           #  Se establecen los datos que va a conterner el archivo
                  	fwrite($txt, $item->no_factura.",");
                  	fwrite($txt, $item->peso_total.",");
                  	fwrite($txt, $item->fecha_key.", ");
                  	fwrite($txt, $item->costo_aduana_ext."\n\r");
                 
                  endforeach;
                  } 
		#  Se hace el ciere para no sobre escribir datos 
		fclose($txt);
   

} else {
    $txt= fopen('backup.txt', 'a') or die ('Problemas al crear el archivo');
     if (empty($arraypedidosKey)!="false")
                  {
                foreach($arraypedidosKey as $item):
       #  Se genera el archivo TXT  'a'
        #  Se establecen los datos que va a conterner el archivo

                  	fwrite($txt, $item->no_factura.",");
                  	fwrite($txt, $item->peso_total.",");
                  	fwrite($txt, $item->fecha_key.", ");//***
                  	fwrite($txt, $item->costo_aduana_ext."\n\r");
                 
                  endforeach;
                  } 
	fclose($txt);
}
 

  

		#  Se lee el archivo 'r'
		$leer= fopen('backup.txt', 'r');
		#  Se juntan los datos en un solo string
		$mostrar = fgets($leer);
		#  Se separan los datos por medio de la condicion puesta ',' en este caso
	  	$datos = explode(",", $mostrar);
		
	  	#  Se crea la tabla la cual alberga todo los datos del archivo
	  	echo "<table border=1>
				<thead>
					<tr>
						<th>Dato 1</th>
						<th>Dato 2</th>
						<th>Dato 3</th>
						<th>Dato 4</th>
					</tr>
				</thead>
				<tbody>
					";
		#  hacemos un conteo para saber cuanto datos tiene nuestro archivo y asi poder 		mostrarlos todos 			
		$total = count($datos);
		#  Creamos un for el cual va ha mostrar todos los datos en una tabla
		for ($i=0; $i < $total -1; $i++) { 
		#  Se establece la informacion que contienen los campo de la tabla	
			echo '<tr>';
			 if(($i % 4)==0) {
			echo 	'<td>'.$datos[$i].'</td><td>'. $datos[$i+1].'</td>';
			}
	echo '</tr>';
}
		#  Cerramos la tabla 
		echo  '</tbody></table>';

?>

</div></div>