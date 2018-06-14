
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gerencia extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');		
        $this->load->model('modelogeneral');
        $this->load->model('Ventas_model');
        $this->load->model('Backend_model');
        $this->load->model('Productos_model');
        $this->load->model("Clientes_model"); 
		
	} 
	public function index() 
    { 
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia') {
            redirect(base_url() . 'login');
        }
    	$mensaje = "
		    <div class='alert alert-success alert-dismissible'>
		    <h4><i class='icon fa fa-info'> </i>
		     Bienvenidos a esta seccion de Comparador</h4>
		    <p> Donde usted podrá administrar Pedidos,Proveedores.</p><br>
		    ";

   $this->_example_output((object)array('output' => $mensaje  ,'breadcrum' => '' , 'js_files' => array() , 'css_files' => array()));
		
	}

	public function _example_output($output = null)
	{
			if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia')
			  {
	            redirect(base_url() . 'login');
	          }
	        
	   
	   
	    $output->count_entransito = $this->modelogeneral->count_entransito();
	    $output->count_completado = $this->modelogeneral->count_completado();
	    $output->count_enaduana   = $this->modelogeneral->count_enaduana();
	    $output->count_pendientes = $this->modelogeneral->count_pendientes();
	    $output->arrayLpedidos    = $this->modelogeneral->showAllpedidosT();

	    $output->count_PenSolicitado      = $this->modelogeneral->count_PenSolicitado();	
	    $output->arraypedidos_solitados   = $this->modelogeneral->showPedidos_Sol();
	    $output->arraypedidos_transito    = $this->modelogeneral->showPedidos_Transito();
	    $output->arraypedidos_aduana      = $this->modelogeneral->showPedidos_Aduana();
	    $output->arraypedidosKey          = $this->modelogeneral->showPedidos_key();
	    $data = array(
			"cantVentas"    => $this->Backend_model->rowCount("ventas"),
			"cantPropuestas"  => $this->Backend_model->rowCount("propuesta"),
			"cantClientes"  => $this->Backend_model->rowCount("cliente"),
			"cantProductos" => $this->Backend_model->rowCount("producto"),
			'ventas'        => $this->Ventas_model->getVentasGeneral(), 
			'years'         => $this->Ventas_model->years()
			
		); 
	    
  	
	    $this->load->view("layouts/header");
		$this->load->view("gerencia/aside",$output);
		$this->load->view("gerencia/dashboard",$data);
		$this->load->view("cuentasXpagar/footer");
  	}

public function add_propuesta(){

		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia') {
            redirect(base_url().'login');
        }

        $dato['parametro'] = $this->modelogeneral->getValorInicialPropuesta();  
	    $valor = $dato['parametro']->valor+1;
	    $i = 8;
	    $no_propuesta = str_pad($valor, $i, 0, STR_PAD_LEFT);


		$data = array(
			"no_propuesta" => $no_propuesta,
			"clientes" => $this->Clientes_model->getClientes(),
			"productos" => $this->modelogeneral->getProductosAll()
 		);

		$this->load->view("layouts/header");
		$this->load->view("gerencia/aside");
		$this->load->view("gerencia/add",$data);
		$this->load->view("layouts/footer");
	}


public function guardar_propuesta(){
	if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia') {
            redirect(base_url().'login');
        }

		$no_propuesta = $this->input->post("no_propuesta");
        $duracion     = $this->input->post("duracion");
		$idcliente    = $this->input->post("idcliente");
		
		$fecha        = $this->input->post("fecha");
		$precios      = $this->input->post("precios");
		$cantidades   = $this->input->post("cantidades");
		$importes     = $this->input->post("importes");
		$total        = $this->input->post("total");
		$productos  = $this->input->post("idproductos");

		$data_pro = array(
			'fecha_propuesta'=>$fecha,
			'total'          =>$total,
			'id_cliente'     =>$idcliente,
			'no_propuesta'   =>$no_propuesta,
			'duracion'       =>$duracion
		);
	   
       $this->modelogeneral->save_propuesta($data_pro);
   	   $id_propuesta = $this->modelogeneral->lastID();
	   $this->save_detallepropuesta($productos,$id_propuesta,$precios,$cantidades,$importes,$idcliente);
	   $this->modelogeneral->aumentar_valor_no_propuesta($no_propuesta);
	   redirect(base_url()."gerencia/listar_propuestas");

	}	

	protected function save_detallepropuesta($productos,$id_propuesta,$precios,$cantidades,$importes,$idcliente){
		for ($i=0; $i < count($productos); $i++) { 
			
			$data_detalle  = array(
				'id_propuesta'   => $id_propuesta,
				'id_producto'    => $productos[$i], 
				'precio'         => $precios[$i],
				'cantidad'       => $cantidades[$i], 
				'importe'        => $importes[$i]
			);
			$data1  = array(
				'id_propuesta'   => $id_propuesta,
				'id_cliente'     => $idcliente,
				'id_producto'    => $productos[$i], 
				'precio_cli'     => $precios[$i]
				
			);
			$this->modelogeneral->save_detallepropuesta($data_detalle);
			$this->modelogeneral->Precio_cliente($data1);

		}
	}



public function listar_propuestas()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia') {
            redirect(base_url().'login');
        }

        $data  = array(
			'propuestas' => $this->modelogeneral->getPropuestas(), 
		);
        
   
		$this->load->view("layouts/header");
		$this->load->view("gerencia/aside");
		$this->load->view("gerencia/list_propuestas",$data);
		$this->load->view("layouts/footer");
	}


	public function detalle_propuesta(){
		$id_propuesta = $this->input->post("id");
		$data = array(
			"propuesta" => $this->modelogeneral->getdatosPropuesta($id_propuesta),
			"detalles" =>$this->modelogeneral->getDetallePropuesta($id_propuesta)
		);
		$this->load->view("gerencia/v_detalle",$data);
	}


/*-------------------propuesta--------------------*/	




public function reportes($output = null)
	{
	   if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia' )
		 {
	      redirect(base_url() . 'login');
	      }
	        
	    $output['count_entransito'] = $this->modelogeneral->count_entransito();
	    $output['count_completado'] = $this->modelogeneral->count_completado();
	    $output['count_enaduana']   = $this->modelogeneral->count_enaduana();
	    $output['count_pendientes'] = $this->modelogeneral->count_pendientes();
	    $output['arrayLpedidos']    = $this->modelogeneral->showAllpedidosT();


	    $output['count_PenSolicitado']      = $this->modelogeneral->count_PenSolicitado();	
	    $output['arraypedidos_solitados']   = $this->modelogeneral->showPedidos_Sol();
	    $output['arraypedidos_transito']    = $this->modelogeneral->showPedidos_Transito();
	    $output['arraypedidos_aduana']      = $this->modelogeneral->showPedidos_Aduana();
	    $output['arraypedidosKey']          = $this->modelogeneral->showPedidos_key();
	    
        $this->load->view('gerencia/v_reportes',$output);
        
	}

		public function reportes_generales($output = null)
	{
			if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'gerencia')
			  {
	            redirect(base_url() . 'login');
	          }
	        
	    $output['count_entransito']         = $this->modelogeneral->count_entransito();
	    $output['count_completado']         = $this->modelogeneral->count_completado();
	    $output['count_enaduana']           = $this->modelogeneral->count_enaduana();
	    $output['count_pendientes']         = $this->modelogeneral->count_pendientes();
	    $output['arrayLpedidos']            = $this->modelogeneral->showAllpedidosT();
	    $output['count_PenSolicitado']      = $this->modelogeneral->count_PenSolicitado();
	    $output['arraypedidos_solitados']   = $this->modelogeneral->showPedidos_Sol();
	    $output['arraypedidos_transito']    = $this->modelogeneral->showPedidos_Transito();
	    $output['arraypedidos_aduana']      = $this->modelogeneral->showPedidos_Aduana();
	    $output['arraypedidosKey']          = $this->modelogeneral->showPedidos_key();
      
        $this->load->view('gerencia/v_reporte_tiempo',$output);
        
	}

	
/*-----------------------------------------------*/
	
	public function updatecosto_terrestre(){
		$result = $this->modelogeneral->updatecosto_terrestre();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	//---------mostrar reporte pedidos entregados----------------

	public function showAllpedidosT(){
		$result = $this->modelogeneral->showAllpedidosT();
		echo json_encode($result);
	}

	public function subirImagen(){
		$config['upload_path'] = './assets/respaldos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload("fileImagen")) {
            $data['error'] = $this->upload->display_errors();
			/*$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('vupload',$data);
			$this->load->view('layout/footer');*/
        } else {

            $file_info = $this->upload->data();

            $this->crearMiniatura($file_info['file_name']);

            $titulo = $this->input->post('titImagen');
            $imagen = $file_info['file_name'];
            
            $subir = $this->mupload->subir($titulo,$imagen);      
            $data['titulo'] = $titulo;
            $data['imagen'] = $imagen;

           /* $this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('vImagenSubida', $data);
			$this->load->view('layout/footer');*/
            
        }
    }

	public function addcosto_terrestre(){
		$result = $this->modelogeneral->addcosto_terrestre();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function addcosto_aereo(){
		$result = $this->modelogeneral->addcosto_aereo();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}


	public function update_fact(){
		$result = $this->modelogeneral->update_fact();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	
	

	



  //---------------------confirmar_pedido------------------------------------

     public function confirmar_pedido($id)
    {
    
      $this->modelogeneral->update_pedido($id);
      redirect('gerencia/pedido_proveedor');
          
    }


      //---------------------confirmar_entrega aerea-----------------------------------
     
      public function confir_entreg_aerea($id)
    {
      $this->modelogeneral->update_finalizar_pedido($id);
      $result= $this->modelogeneral->listar_paquete_transito_aereo($id);
      foreach ($result as  $value):
     
        $this->modelogeneral->update_fin_pedido_prov($value->id_pedido_prov);      
            
       endforeach ;   

      redirect('gerencia/transporte_aereo');
          
    }
   
   
    //----------------------------finalizar_pedido------------------------
      public function finalizar_pedido($id)
    {
    
      $this->modelogeneral->finalizar_pedido($id);
      redirect('gerencia/transporte_aduana');
          
    }

	//------------------------actualizar valor_noPedido--------------------------------------------
	
    function updatevalor_noPedido($post_array,$primary_key)
     {
       $actno_pedido = $post_array['no_pedido'];
       $this->modelogeneral->aumentar_valor_nopedido($actno_pedido);
       $result['datos'] = $this->modelogeneral->devolver_nombre_Producto($post_array['id_producto']);	
	   $nombre_producto =  $result['datos']->nombre_producto; 
	   $data = array('nombre_producto' => $nombre_producto);
	   $this->db->where('id_pedido_prov', $primary_key);
	   $this->db->update('pedido_proveedor',$data);  
        if($post_array['id_cliente'] != NULL){
         $this->modelogeneral->insertar_cliente_pedido($post_array['id_cliente'], $primary_key);
       }
       if($post_array['id_almacen'] != NULL){
         $this->modelogeneral->insertar_almacen_pedido($post_array['id_almacen'], $primary_key);
       }  



      return true;
     }
    //---------------------estado de pedido--------------------------
	function mostrar_estado($value, $row)
		{
		 if ($value==1) {
		 	$html= "<span style='font-size: 1em;'class='label label-primary'>
		 	        <strong>Solicitado</strong>
		 	        </span>
		           ";
			}
			

		return $html;
		}

	//-----------------mostrar estado pediente-------------------------------	

	function mostrar_estado_pendiente($value, $row)
		{
		
		 $fecha_actual = date("Y-m-d");
		 if($fecha_actual >= $value)
			 {
			   
			  return "<span style='font-size: 1em;' class='label label-danger'><strong>".$value."</strong></span>";		
			 
			 }else{
			 	 return $value;
			 }
		
		}

	 function mostrar_boton_dividir($value, $row)
		{
		
		 return "<div class='form-group'>
		 		 <div class='row'>
			 	  <div class='col-md-6'>
			       <span class=''><strong>".$value."</strong></span>
			      </div> 
	              <div class='col-md-6'>
	               <button class='btn btn-success btn-sm' onclick='div_pedido(".$row->id_pedido_prov.")' title='Dividir Pedido'><i class='fa fa-cut'></i></button>
		          </div> 		
	            </div> 
	            </div>";	
	         
		}

      /// mostrar boton paquete terminado.. si es terrestre o aereo
		function mostrar_boton_via_transp($value, $row)
		{
		
			if ($value =='terrestre') {

		    return "<div class='form-group'>
			 		 <div class='row'>
				 	  <div class='col-md-6'>
				       <span class=''><strong>".$value."</strong></span>
				      </div> 
		              <div class='col-md-6'>
		               <button class='btn btn-success btn-sm' onclick='editar_costos_terrestres(".$row->id_paquete.")' title='Agregar Costos'><i class='fa fa-truck'></i></button>
			          </div> 		
		            </div> 
		            </div>";
			    
		      }elseif ($value =='aereo') 
		       {
		      	return "<div class='form-group'>
			 		 <div class='row'>
				 	  <div class='col-md-6'>
				       <span class=''><strong>".$value."</strong></span>
				      </div> 
		              <div class='col-md-6'>
		               <button class='btn btn-info btn-sm' onclick='editar_costos_aereos(".$row->id_paquete.")' title='Agregar Costos Aereos'><i class='fa fa-plane'></i></button>
			          </div> 		
		            </div> 
		            </div>";
		       }
			
	         
		}


		function mostrar_kg($value, $row)
		{
		return $value.' Kg';
		}


    
	//---------------------------estado en transito-------------------
	function mostrar_estado_transito($value, $row)
	{
	 if($value==1)
	  {
	   $html= "<span class='label label-warning'><strong>Transito</strong></span>";
	  }
	return $html;
	}
    
   
	//---------------------confirmar_llegadaAduana------------------------------------
    public function confirmar_Aduana($id_transporte_ext)
    {
     $this->modelogeneral->update_transito_aduana($id_transporte_ext);
     $resultado = $this->modelogeneral->listar_paquete_transito($id_transporte_ext);
        foreach($resultado as $value):
      	    $resultado_paquete = $this->modelogeneral->listar_paquete_pedidos($value->id_paquete);
             foreach($resultado_paquete as $values):
                  $this->modelogeneral->update_pedido_aduana($values->id_pedido_prov);
             endforeach;
        endforeach;
    redirect('gerencia/transporte');
          
    }

	
	function mostrar_costo_total($value, $row)
	{
	 $id_paquete=$row->id_paquete;
	 $dato['parametro']= $this->modelogeneral->mostrar_costo_totalpedido($id_paquete);
	  $html= "$ ";
	
	  return $html.$dato['parametro']->costo_total;
	}
	
	//---------------------estado en aduana----------------------------
	function mostrar_estado_aduana($value, $row)
	{
	  if($value==1)
	    {
	     $html= "<span class='label label-info'><strong>Aduana</strong></span>";
		}
	  return $html;
	}



	function edit_field_callback_1($value, $primary_key)
	{
	 return '<strong>'.$value.'</strong><input type="hidden" maxlength="50" value="'.$value.'" name="no_pedido" style="width:462px">';
	}

	
	public function valueToUSD($value, $row)
	{
		return $value.' USD';
	}
//-----------------------------fin MODULO PEDIDO-------------------------------





	




	













	


}