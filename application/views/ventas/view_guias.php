
<div class="row">
	<img  style="width: 250px; float: right;padding: 10px;" src="<?php echo base_url(); ?>/assets/uploads/files/logoKey.jpg">
	<div class="col-xs-12 text-left">
	 	<strong class="text-uppercase"> KEY SOLUTIONS SRL </strong>
	    <p><b> NIT </b> 254946027 <br>
		<b>Dirección</b> Barasea #414 Barrio Urbarí <br>
		<b>Teléfono Santa Cruz</b> +591 (3) 3557278<br>
		<b>Teléfono La Paz</b> +591 (2) 2148110<br> 
		<b>Correo:</b> gpestana@keysolutions.com.bo </p>   
	</div>
</div> 
<div class="row">
	<div class="col-xs-6">	
		<b>CLIENTE</b><br>
		<b>Nombre:</b> <?php echo $venta->nombre_cli;?> <br>
		<b>Nro Documento:</b> <?php echo $venta->documento;?><br>
		<b>Telefono:</b> <?php echo $venta->telefono_cli;?> <br>
		<b>Direccion</b> <?php echo $venta->direccion_cli;?><br>
	</div>	
	<div class="col-xs-6">	
		<b><?php echo $venta->tipocomprobante;?></b> <br>
		<b>Serie:</b> <?php echo $venta->serie;?><br>
		<b>Nro de Comprobante:</b><?php echo $venta->num_documento;?><br>
		<b>Fecha</b> <?php echo $venta->fecha;?>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">	
		<b>LUGAR DE DESPACHO:</b><br>
		<b>Contacto:</b>  <?php echo $venta->contacto;?><br>
		<b>Telefono:</b>  <?php echo $venta->telefono;?> <br>
		<b>Domicilio:</b> <?php echo $venta->direccion;?> <br>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Cantidad</th>
				
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td><?php echo $detalle->items;?></td>
					<td><?php echo $detalle->nombre_producto;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				
			</tfoot>
		</table>
	</div>
<div class="row">
	<div class="col-xs-6 text-center">	
		<b>Firma Cliente:</b> ______________________<br>
		<b>Nombre:</b> _____________________________<br>
		<b>Cargo:</b>_______________________________<br>
		
	</div>	
	<div class="col-xs-6 text-center">	
		<b>Firma Key:</b> ______________________<br>
		<b>Nombre:</b> _________________________<br>
		<b>Cargo:</b>___________________________<br>
		
	</div>	
</div>	
</div>