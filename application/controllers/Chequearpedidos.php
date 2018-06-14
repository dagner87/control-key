<?php
class Chequearpedidos extends CI_Controller
{

    function __construct()
      {
          parent::__construct();
         
         $this->output->set_header("Access-Control-Allow-Origin:*");
         $this->load->model('modelogeneral');
          $this->load->library('email');
      }
  	


    public function SendMail_pendientes()
    {
	     
	     $configuraciones['mailtype']='html';
	     $resultado = $this->modelogeneral->mostrar_pedidos_pendientes();
	     $this->email->initialize($configuraciones);
	    foreach($resultado as $key):

			    $this->email->from('sistema@keysolutions.com.bo','Postmaster');
			    $this->email->to('dalena@keysolutions.com.bo');
			    $this->email->cc('gpestana@keysolutions.com.bo,acassinelli@keysolutions.com.bo,rpestana@keysolutions.com.bo');
			    $this->email->subject('Pedidos Pendientes');  
              
			    $fecha_entrega = $key->fecha_entrega;
			    $id_proveedor  = $key->id_proveedor;
			    $id_prod = $key->id_producto;
    
			    $dato_prov['parametro']= $this->modelogeneral->datos_proveedor($id_proveedor);
			    $nombre_prod['parametro']= $this->modelogeneral->devolver_nombre_Producto($id_prod);
			    $fecha = date('Y-m-d');
			    $dia_alerta['parametro']= $this->modelogeneral->valor_alerta_correos();
			    $dia = $dia_alerta['parametro']->valor;
    
    			$fecha_notificacion = date("Y-m-d", strtotime("$fecha_entrega -$dia day"));

			    $message = '<html><head>';
			    $message .='<head>';
			    $message .='<meta charset="utf-8">';
			    $message .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			    $message .='<title>Panel de administracion Key</title>';
			    $message .='<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
			    $message .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/bootstrap/css/bootstrap.min.css">';
			    $message .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">';
			    $message .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
			    $message .='<link rel="stylesheet" href="  ase_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">';
			    $message .='<!-- Theme style -->';
			    $message .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/AdminLTE.min.css">';
			    $message .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/skins/_all-skins.min.css">';
			    $message .='<!--[if lt IE 9]>';
			    $message .='<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
			    $message .='<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			    $message .=' <![endif]-->';
			    $message .='</head>';
			    $message = '<html><body class="hold-transition skin-blue sidebar-mini">';
			    $message .= '<div class= "alert alert-success alert-dismissible">';
			    $message .= '<h1>Darle seguimiento a este pedido con su proveedor...</h1>';
			    $message .= '<p style="color: red"> A partir de Hoy: '.$fecha_notificacion.' Faltan '.$dia.' dia para la entrega del pedido.<p>';
			    $message .= '</div>';
			    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			    $message .= "<tr ><td bgcolor='#1696e0' colspan='2'><h3>Pedidos Pendientes</h3></td></tr >";
			    $message .= "<tr style='background: #eee;'><td><strong>Fecha de entrega:</strong> </td><td>" . $fecha_entrega. "</td></tr>";
			    $message .= "<tr><td><strong>Pedido:</strong> </td><td>" .$key->no_pedido. "</td></tr>";
			    $message .= "<tr><td><strong>Proveedor:</strong> </td><td>" .$dato_prov['parametro']->nombre_prove. "</td></tr>";
			    $message .= "<tr><td><strong>Producto:</strong> </td><td>" .$nombre_prod['parametro']->nombre_producto. "</td></tr>";
			    $message .= "<tr><td><strong>Cantidad:</strong> </td><td>" . $key->cantidad_solicitada. "</td></tr>";
			    $message .= "<tr ><td colspan='2'><p><i>Correo generado de forma autom&aacute;tica por el sistema </i></p></td></tr>";
			    $message .= "</table>";
			    $message .= "</body></html>";


			     //----------notificacion de pedido----------  
			      
			    if($fecha_notificacion == $fecha)
			      {
			        $this->email->message($message);
			        echo $message;
			        $this->email->send();
			      }

			    //----------------------Pedido listo-------------------
			    $messagelisto = '<html><head>';
			    $messagelisto .='<head>';
			    $messagelisto .='<meta charset="utf-8">';
			    $messagelisto .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			    $messagelisto .='<title>Panel de administracion Key</title>';
			    $messagelisto .='<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
			    $messagelisto .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/bootstrap/css/bootstrap.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="  ase_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">';
			    $messagelisto .='<!-- Theme style -->';
			    $messagelisto .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/AdminLTE.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/skins/_all-skins.min.css">';
			    $messagelisto .='<!--[if lt IE 9]>';
			    $messagelisto .='<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
			    $messagelisto .='<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			    $messagelisto .=' <![endif]-->';
			    $messagelisto .='</head>';
			    $messagelisto = '<html><body class="hold-transition skin-blue sidebar-mini">';
			    $messagelisto .= '<div class= "alert alert-success alert-dismissible">';
			    $messagelisto .= '<h1>Hoy debe estar listo su pedido</h1>';
			    $messagelisto .= '</div>';
			    $messagelisto .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			    $messagelisto .= "<tr ><td bgcolor='#6dcb30' colspan='2'><h3>Pedidos Pendientes</h3></td></td></tr>";
			    $messagelisto .= "<tr style='background: #eee;'><td><strong>Fecha de entrega:</strong> </td><td>" . $fecha_entrega. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Pedido:</strong> </td><td>" .$key->no_pedido. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Proveedor:</strong> </td><td>" .$dato_prov['parametro']->nombre_prove. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Producto:</strong> </td><td>" .$nombre_prod['parametro']->nombre_producto. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Cantidad:</strong> </td><td>" . $key->cantidad_solicitada. "</td></tr>";
			    $messagelisto .= "<tr ><td colspan='2'><p><i>Correo generado de forma autom&aacute;tica por el sistema </i></p></td></tr>";
			    $messagelisto .= "</table>";
			    $messagelisto .= "</body></html>";

			     //---------pedido listo----------           
			     
			    if($fecha == $fecha_entrega)
			      {
			       $this->email->message($messagelisto);
			       echo $messagelisto;
			       $this->email->send();
			       
			      }

			    //--------- Pendiente de confirmacion-----------------------

			    $messagependiente = '<html><head>';
			    $messagependiente .='<head>';
			    $messagependiente .='<meta charset="utf-8">';
			    $messagependiente .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			    $messagependiente .='<title>Panel de administracion Key</title>';
			    $messagependiente .='<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
			    $messagependiente .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/bootstrap/css/bootstrap.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="  ase_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">';
			    $messagependiente .='<!-- Theme style -->';
			    $messagependiente .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/AdminLTE.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/skins/_all-skins.min.css">';
			    $messagependiente .='<!--[if lt IE 9]>';
			    $messagependiente .='<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
			    $messagependiente .='<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			    $messagependiente .=' <![endif]-->';
			    $messagependiente .='</head>';
			    $messagependiente = '<html><body class="hold-transition skin-blue sidebar-mini">';
			    $messagependiente .= '<div class= "alert alert-success alert-dismissible">';
			    $messagependiente .= '<h1>Pedido Pendiente de confirmaci&oacute;n...</h1>';
			    $messagependiente .= '</div>';
			    $messagependiente .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			    $messagependiente .= "<tr ><td bgcolor='#e02015' colspan='2'><h3>Pedidos Pendientes </h3></td></tr >";
			    $messagependiente .= "<tr style='background: #eee;'><td><strong>Fecha de entrega:</strong> </td><td>".$fecha_entrega. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Pedido:</strong> </td><td>" .$key->no_pedido. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Proveedor:</strong> </td><td>" .$dato_prov['parametro']->nombre_prove. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Producto:</strong> </td><td>" .$nombre_prod['parametro']->nombre_producto. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Cantidad:</strong> </td><td>" . $key->cantidad_solicitada. "</td></tr>";
			    $messagependiente .= "<tr ><td colspan='2'><p><i>Correo generado de forma autom&aacute;tica por el sistema </i></p></td></tr>";
			    $messagependiente .= "</table>";
			    $messagependiente .= "</body></html>";
			//--------------- pedido pendiente a confirmar-------------
    
			    if($fecha > $fecha_entrega)
			      {
			       $this->email->message($messagependiente);
			       echo $messagependiente;
			        $this->email->send();
			      } 
        endforeach;
        $this->SendMail_Transito();
    }

    public function SendMail_Transito()
    {
	    
	     $configuraciones['mailtype']='html';
	     $resultado = $this->modelogeneral->mostrar_pedidos_transito();
	     $this->email->initialize($configuraciones);
	    foreach($resultado as $key):
                
			    $this->email->from('sistema@keysolutions.com.bo','Postmaster');
			    $this->email->to('dalena@keysolutions.com.bo');
			    $this->email->cc('gpestana@keysolutions.com.bo,acassinelli@keysolutions.com.bo,rpestana@keysolutions.com.bo');
			    $this->email->subject('Pedidos Pendientes'); 

			    $row = $this->modelogeneral->tomar_pedido($key->id_pedido_prov); 
			    $row_paquete = $this->modelogeneral->buscar_paquete_transito($row->id_paquete);
			    $row_datospaquete = $this->modelogeneral->buscar_datos_paquete($row->id_paquete);
			    
			    $row_paquete = $this->modelogeneral->buscar_dato_transito($row_paquete->id_transporte_ext);
              	
			    $fecha_entrega = $row_paquete->fecha_llegada_aduana;
			    $id_proveedor  = $key->id_proveedor;
			    $id_prod = $key->id_producto;
    
			    $dato_prov['parametro']= $this->modelogeneral->datos_proveedor($id_proveedor);
			    $nombre_prod['parametro']= $this->modelogeneral->devolver_nombre_Producto($id_prod);
			    $fecha = date('Y-m-d');
			    $dia_alerta['parametro']= $this->modelogeneral->valor_alerta_correos();
			    $dia = $dia_alerta['parametro']->valor;
    
    			$fecha_notificacion = date("Y-m-d", strtotime("$fecha_entrega -$dia day"));

			    $message = '<html><head>';
			    $message .='<head>';
			    $message .='<meta charset="utf-8">';
			    $message .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			    $message .='<title>Panel de administracion Key</title>';
			    $message .='<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
			    $message .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/bootstrap/css/bootstrap.min.css">';
			    $message .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">';
			    $message .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
			    $message .='<link rel="stylesheet" href="  ase_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">';
			    $message .='<!-- Theme style -->';
			    $message .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/AdminLTE.min.css">';
			    $message .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/skins/_all-skins.min.css">';
			    $message .='<!--[if lt IE 9]>';
			    $message .='<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
			    $message .='<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			    $message .=' <![endif]-->';
			    $message .='</head>';
			    $message = '<html><body class="hold-transition skin-blue sidebar-mini">';
			    $message .= '<div class= "alert alert-success alert-dismissible">';
			    $message .= '<h1>Darle seguimiento a este pedido con su proveedor...</h1>';
			    $message .= '<p style="color: red"> A partir de Hoy: '.$fecha_notificacion.' Faltan '.$dia.' dia para la entrega del pedido.<p>';
			    $message .= '</div>';
			    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			    $message .= "<tr ><td bgcolor='#1696e0' colspan='2'><h3>Pedidos Pendientes</h3></td></tr >";
			    $message .= "<tr style='background: #eee;'><td><strong>Fecha de entrega:</strong> </td><td>" . $fecha_entrega. "</td></tr>";
			    $message .= "<tr><td><strong>No. Factura:</strong> </td><td>" .$row_datospaquete->no_factura. "</td></tr>";
			    $message .= "<tr><td><strong>Proveedor:</strong> </td><td>" .$dato_prov['parametro']->nombre_prove. "</td></tr>";
			    $message .= "<tr><td><strong>Producto:</strong> </td><td>" .$nombre_prod['parametro']->nombre_producto. "</td></tr>";
			    $message .= "<tr><td><strong>Cantidad:</strong> </td><td>" . $key->cantidad_solicitada. "</td></tr>";
			    $message .= "<tr ><td colspan='2'><p><i>Correo generado de forma autom&aacute;tica por el sistema </i></p></td></tr>";
			    $message .= "</table>";
			    $message .= "</body></html>";


			     //----------notificacion de pedido----------  
			      
			    if($fecha_notificacion == $fecha)
			      {
			        $this->email->message($message);
			        echo $message;
			        $this->email->send();
			      }

			    //----------------------Pedido listo-------------------
			    $messagelisto = '<html><head>';
			    $messagelisto .='<head>';
			    $messagelisto .='<meta charset="utf-8">';
			    $messagelisto .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			    $messagelisto .='<title>Panel de administracion Key</title>';
			    $messagelisto .='<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
			    $messagelisto .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/bootstrap/css/bootstrap.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="  ase_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">';
			    $messagelisto .='<!-- Theme style -->';
			    $messagelisto .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/AdminLTE.min.css">';
			    $messagelisto .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/skins/_all-skins.min.css">';
			    $messagelisto .='<!--[if lt IE 9]>';
			    $messagelisto .='<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
			    $messagelisto .='<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			    $messagelisto .=' <![endif]-->';
			    $messagelisto .='</head>';
			    $messagelisto = '<html><body class="hold-transition skin-blue sidebar-mini">';
			    $messagelisto .= '<div class= "alert alert-success alert-dismissible">';
			    $messagelisto .= '<h1>Hoy debe estar listo su pedido</h1>';
			    $messagelisto .= '</div>';
			    $messagelisto .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			    $messagelisto .= "<tr ><td bgcolor='#6dcb30' colspan='2'><h3>Pedidos Pendientes</h3></td></td></tr>";
			    $messagelisto .= "<tr style='background: #eee;'><td><strong>Fecha de entrega:</strong> </td><td>" . $fecha_entrega. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>No. Factura:</strong> </td><td>" .$row_datospaquete->no_factura. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Proveedor:</strong> </td><td>" .$dato_prov['parametro']->nombre_prove. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Producto:</strong> </td><td>" .$nombre_prod['parametro']->nombre_producto. "</td></tr>";
			    $messagelisto .= "<tr><td><strong>Cantidad:</strong> </td><td>" . $key->cantidad_solicitada. "</td></tr>";
			    $messagelisto .= "<tr ><td colspan='2'><p><i>Correo generado de forma autom&aacute;tica por el sistema </i></p></td></tr>";
			    $messagelisto .= "</table>";
			    $messagelisto .= "</body></html>";

			     //---------pedido listo----------           
			     
			    if($fecha == $fecha_entrega)
			      {
			       $this->email->message($messagelisto);
			       echo $messagelisto;
			       $this->email->send();
			       
			      }

			    //--------- Pendiente de confirmacion-----------------------

			    $messagependiente = '<html><head>';
			    $messagependiente .='<head>';
			    $messagependiente .='<meta charset="utf-8">';
			    $messagependiente .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			    $messagependiente .='<title>Panel de administracion Key</title>';
			    $messagependiente .='<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
			    $messagependiente .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/bootstrap/css/bootstrap.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="  ase_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">';
			    $messagependiente .='<!-- Theme style -->';
			    $messagependiente .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/AdminLTE.min.css">';
			    $messagependiente .='<link rel="stylesheet" href="http://sistema.keysolutions.com.bo/plantillas/dist/css/skins/_all-skins.min.css">';
			    $messagependiente .='<!--[if lt IE 9]>';
			    $messagependiente .='<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
			    $messagependiente .='<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			    $messagependiente .=' <![endif]-->';
			    $messagependiente .='</head>';
			    $messagependiente = '<html><body class="hold-transition skin-blue sidebar-mini">';
			    $messagependiente .= '<div class= "alert alert-success alert-dismissible">';
			    $messagependiente .= '<h1>Pedido Pendiente de confirmaci&oacute;n de llegada a aduana...</h1>';
			    $messagependiente .= '</div>';
			    $messagependiente .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			    $messagependiente .= "<tr ><td bgcolor='#e02015' colspan='2'><h3>Pedidos Pendientes  </h3></td></tr >";
			    $messagependiente .= "<tr style='background: #eee;'><td><strong>Fecha de entrega:</strong> </td><td>".$fecha_entrega. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>No. Factura:</strong> </td><td>" .$row_datospaquete->no_factura. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Proveedor:</strong> </td><td>" .$dato_prov['parametro']->nombre_prove. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Producto:</strong> </td><td>" .$nombre_prod['parametro']->nombre_producto. "</td></tr>";
			    $messagependiente .= "<tr><td><strong>Cantidad:</strong> </td><td>" . $key->cantidad_solicitada. "</td></tr>";
			    $messagependiente .= "<tr ><td colspan='2'><p><i>Correo generado de forma autom&aacute;tica por el sistema </i></p></td></tr>";
			    $messagependiente .= "</table>";
			    $messagependiente .= "</body></html>";
			//--------------- pedido pendiente a confirmar-------------
    
			    if($fecha > $fecha_entrega)
			      {
			       $this->email->message($messagependiente);
			       echo $messagependiente;
			        $this->email->send();
			      } 
        endforeach;
    }

}



