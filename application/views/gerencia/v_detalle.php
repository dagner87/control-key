
<div class="row">
	<img  style="width: 200px; float: right;" src="<?php echo base_url(); ?>/assets/uploads/files/logoKey.jpg">
	<div class="col-xs-12">
		<b>Key Solutions SRL</b> <br>
		Barasea #414 Barrio Urbarí <br>
		Tel. 3557278 <br>
		Email:gpestana@keysolutions.com.bo
	</div>
</div> <br>
<div class="row">
	
	<div class="col-xs-6">	
		<b>CLIENTE</b><br>
		<b>Nombre:</b><?php echo $propuesta->nombre_cli;?> <br>
		<b>NIT:</b><?php echo $propuesta->numero;?><br>
		<b>Teléfono:</b><?php echo $propuesta->telefono_cli;?> <br>
		<b>Dirección:</b><?php echo $propuesta->direccion_cli;?>
	</div>
	<div class="col-xs-6">	
		<b>Propuesta</b> <br>
		<b>No Propuesta:</b> <?php echo $propuesta->no_propuesta;?><br>
		<b>Fecha</b> <?php echo $propuesta->fecha_propuesta;?><br>
		<b>Duración:</b> <?php echo $propuesta->duracion;?>
	</div>	
		
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td><?php echo $detalle->items;?></td>
					<td><?php echo $detalle->nombre_producto;?></td>
					<td><?php echo $detalle->precio;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->importe;?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo $propuesta->total;?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>