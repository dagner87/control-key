
<div class="row">

	<img  style="width: 250px; float: right;padding: 10px;" src="<?php echo base_url(); ?>/assets/uploads/files/logoKey.jpg">
	
	<div class="col-xs-12 text-left">
     	<strong class="text-uppercase"> KEY SOLUTIONS SRL </strong>
        <p><b> NIT: </b> 254946027 <br>
		<b>Dirección:</b> Barasea #414 Barrio Urbarí <br>
		<b>Teléfono Santa Cruz:</b> +591 (3) 3557278<br>
		<b>Teléfono La Paz:</b> +591 (2) 2148110<br> 
		<b>Correo:</b> gpestana@keysolutions.com.bo </p> 
    </div>
  
</div>
<div class="row">
	<div class="col-xs-6">	
		<b>FACTURA</b><br>
		<b>Nro.Factura:</b><?php echo $venta->num_documento;?><br>
		<b>Nro.Autorización:</b> <?php echo $noAutorizacion ;?><br>
		<b>Serie:</b> <?php echo $venta->serie;?><br>
		<?php $fecha_factura = date("d/m/Y", strtotime("$venta->fecha")); ?>
		<b>Fecha</b> <?php echo $fecha_factura;?>
	</div>
	<div class="col-xs-6">	
		<b>CLIENTE</b><br>
		<b>NIT / CI:</b> <?php echo $venta->documento;?><br>
		<b>Señor(es): </b> <?php echo $venta->nombre_cli;?> <br>
		<b>Telefono: </b> <?php echo $venta->telefono_cli;?> <br>
		<b>Dirección: </b> <?php echo $venta->direccion_cli;?><br>
	</div>	
		
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Detalle</th>
					<th>Cantidad</th>
					<th>P/U</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td><?php echo $detalle->items;?></td>
					<td><?php echo $detalle->nombre_producto;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->precio;?></td>
					<td><?php echo $detalle->importe;?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total Bs:</strong></td>
					<td><?php echo $venta->total;?></td>
				</tr>
			</tfoot>
		</table>
<div class="row">
	<div class="col-xs-12 text-left">	
		<b><strong>Son:</strong></b> <u><?php echo $leyenda; ?></u>
		
	</div>
	<div class="col-xs-12 text-right">	
		<b>Código de Control:</b> <strong><?php echo $codigo_control; ?></strong><br>
		<?php $dia = 57;
		$fecha_limiteEmision = date("d/m/Y", strtotime("$venta->fecha +$dia day")); ?>
		<b>Fecha Limite Emisión:</b><strong> <?php echo $fecha_limiteEmision;?></strong> <br>
		<img  style="float: right;" src="<?php echo base_url(); ?>assets/uploads/qr_code/qrcode.png">
	</div>
	<br>
	<div class="col-xs-12 text-center">	
		<p><strong>"ESTA FACTURA CONSTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ESTA SERÁ SANCIONADO DE ACUERDO A LEY"</strong></p>
	</div>	
		
</div>
     
	</div>

</div>