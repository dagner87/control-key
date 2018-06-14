
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ventas extends CI_Controller {

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
		$this->load->library('grocery_CRUD'); 

	} 
	public function index() 

	{ 
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
		$mensaje = "
		    <div class='alert alert-success alert-dismissible'>
		    <h4><i class='icon fa fa-info'> </i> Bienvenidos a esta seccion de administración</h4>
		    <p>Donde usted podrá administrar los Almacenes, Pedidos, Ventas, Proveedores, Clientes, Productos etc..</p>
	    	</div> ";

   $this->_example_output((object)array('output' => $mensaje  ,'breadcrum' => '' , 'js_files' => array() , 'css_files' => array()));
		
	}

	public function _example_output($output = null)
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }

        $id_almacen = $this->session->userdata('almacen');
        $resultado= $this->modelogeneral->get_Categorias($id_almacen);
	    $output->count_entransito = $this->modelogeneral->count_entransito();
	    $output->count_completado = $this->modelogeneral->count_completado();
	    $output->count_enaduana   = $this->modelogeneral->count_enaduana();
	    $output->count_pendientes = $this->modelogeneral->count_pendientes();
	    $output->array1 = $resultado;
	    
	    $data = array(
			"cantVentas"    => $this->Backend_model->rowCountVentas("ventas"),
			"cantUsuarios"  => $this->Backend_model->rowCount("usuario"),
			"cantClientes"  => $this->Backend_model->rowCount("cliente"),
			"cantProductos" => $this->Backend_model->rowCount("producto"),
			'ventas'        => $this->Ventas_model->getVentas($id_almacen), 
			'years'         => $this->Ventas_model->years()
			
		); 
        
   
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside",$output);
		$this->load->view("admin/dashboard",$data);
		$this->load->view("layouts/footer");
	}

	public function listar()
	{
	  if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }

        $id_almacen = $this->session->userdata('almacen');
        $data  = array(
			'ventas' => $this->Ventas_model->getVentas($id_almacen)
		);
        
   		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_listar_salidas",$data);
		$this->load->view("layouts/footer");
	}

	public function add_venta(){
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');
        if($id_almacen == 2){
        	$id = 3;
        }else
            {
              $id = $id_almacen;
            }
		$data = array(
			"tipocomprobantes" => $this->Ventas_model->getComprobantes($id),
			"clientes"         => $this->Clientes_model->getClientes(),
			"productos"        => $this->Ventas_model->getProductos_stockAlmacen($id_almacen) 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/add_venta",$data);
		$this->load->view("layouts/footer");
	}


	public function getguia($parametro){
		$id_almacen = $this->session->userdata('almacen');
		if ($parametro== "v") {
			if($id_almacen == 2){  // la paz
        	$id = 3; // factura la paz
        }else
            {
              $id = 1;// factura sc
            }
		 
		 }else
            {
              $id = 2; // GUIA
            } 
		$datos_guia = $this->Ventas_model->getDatosGuia($id);
		echo json_encode($datos_guia);
	}




	/*-------------------salida de productos de clientes-------------------*/

	
	public function add_salida_prodcliente(){
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');
		$data = array(
			"tipocomprobantes" => $this->Ventas_model->getGuias(),
			"clientes"         => $this->Clientes_model->getClientes()
			
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/add_salidaAl_Cli",$data);
		$this->load->view("layouts/footer");
	}

	/* guardar salida_almacenCli-------*/
public function salida_almacenCli(){

		$id_almacen    = $this->session->userdata('almacen');
		$fecha         = $this->input->post("fecha");
		$total         = $this->input->post("total");
		$idcomprobante = $this->input->post("idcomprobante");
		$idcliente     = $this->input->post("idcliente");
		$numero        = $this->input->post("numero");
		$serie         = $this->input->post("serie");
    
    	$contacto      = $this->input->post("contacto");
		$telf_contacto = $this->input->post("telf_contacto");
		$destino       = $this->input->post("destino");
		
		$idproductos = $this->input->post("idproductos");
		$cantidades  = $this->input->post("cantidades");
		
		$data = array(
			'fecha'               => $fecha,
			'total'               => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'id_cliente'          => $idcliente,
			'num_documento'       => $numero,
			'serie'               => $serie,
			'id_almacen'          => $id_almacen
		);

		if ($this->Ventas_model->save_venta($data)) {
			$idventa = $this->Ventas_model->lastID();
			$datos_guia = array(
									'id'       => $idventa,
									'contacto' => $contacto,
									'telefono' => $telf_contacto,
									'direccion'=> $destino
								  );
			$this->Ventas_model->save_datosGuia($datos_guia);
			$this->updateComprobante($idcomprobante);

			$this->save_detalleGuia($idproductos,$idventa,$cantidades,$idcliente,$id_almacen,$fecha);
			redirect(base_url()."ventas/listar_guias/");

		}else{
			redirect(base_url()."ventas/add_salida_prodcliente");
		}
}

protected function save_detalleGuia($productos,$idventa,$cantidades,$idcliente,$id_almacen,$fecha){
		for ($i=0; $i < count($productos); $i++) { 
			
			// llenar tabla almacen_clientes
			    $dato_alcli = array(
							'id_producto' => $productos[$i], 
							'id_cliente'  => $idcliente,
							'id_almacen'  => $id_almacen,
							'stock'       => $cantidades[$i],
							'fecha'       => $fecha, 
							'idventa'     => $idventa  
				);
				$data  = array(
					'producto_id' => $productos[$i], 
					'venta_id'    => $idventa,
					'precio'      => 0,
					'cantidad'    => $cantidades[$i], 
					'importe'     => 0
				);	
			$this->updateAlmacen_clientesResta($dato_alcli);		
		    $this->Ventas_model->save_detalle($data);
		
		}
}
protected function updateAlmacen_clientesResta($dato_alcli){
		$clie_stock = $this->Clientes_model->getAlmacen_Cliente($dato_alcli);
		$act_stock = $clie_stock->stock - $dato_alcli['stock'];
		$data = array(
			'id_cliente'  => $dato_alcli['id_cliente'],
			'id_almacen'  => $dato_alcli['id_almacen'],
			'id_producto' => $dato_alcli['id_producto'],
			'stock'       => $act_stock
		);
		$this->Clientes_model->updateAlmacen_clientes($data);
		//agrego a la tabla movimientos de salidas
	    $campos = array(
	    	            'fecha'            => $dato_alcli['fecha'],
	    	            'idventa'          => $dato_alcli['idventa'], 
	    	            'id_producto'      => $dato_alcli['id_producto'], 
						'id_almacen'       => $dato_alcli['id_almacen'],
						'id_cliente'       => $dato_alcli['id_cliente'],
						'cantidad_salida'  => $dato_alcli['stock'],
						'saldo'            => $act_stock

						
						 );
	    $this->Clientes_model->InsertMovAl_cli($campos);
}


public function listar_guias()
	{
	  if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
         $id_almacen = $this->session->userdata('almacen');

        $data  = array(
			'ventas' => $this->Ventas_model->getSalidasAlCli($id_almacen) 
		);
        
   		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_listar_salidasAlCli",$data);
		$this->load->view("layouts/footer");
	}

public function stock_clientes()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');

        $data  = array(
			//'ventas' => $this->Ventas_model->getVenta(),
			'stock' => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen)
			
		);
    	$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_stockAlCli",$data);
		$this->load->view("layouts/footer");
	}	

	/*-----------movimientos entre almacenes--------------*/

	public function movimientos_internos(){

		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
      $id_almacen = $this->session->userdata('almacen');
		$data = array(
			"productos" => $this->Ventas_model->getProductos_stockAlmacen($id_almacen)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_envio_otro_almacen",$data);
		$this->load->view("layouts/footer");
	}

	public function guardar_entradaAlmacen(){
	    if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacenActual = $this->session->userdata('almacen');

		$fecha      = $this->input->post("fecha");
		$cantidades = $this->input->post("cantidades");
		$productos  = $this->input->post("idproductos");
		$id_almacen  = $this->input->post("id_almacen");
	    $this->save_detalleEntradasAlmacen($productos,$fecha,$cantidades,$id_almacen,$id_almacenActual );
	    redirect(base_url()."ventas/stock/$id_almacenActual");
	}

	protected function save_detalleEntradasAlmacen($productos,$fecha,$cantidades,$id_almacen,$id_almacenActual){
		for ($i=0; $i < count($productos); $i++) { 
			
			$data_detalle  = array(
				'fecha_entrada' => $fecha,
				'id_almacen'    => $id_almacen, 
				'id_producto'   => $productos[$i], 
				'cantidad'      => $cantidades[$i] 
			);
			$data1  = array(
				'id_producto' => $productos[$i], 
				'stock'       => $cantidades[$i],
				'id_almacen'  => $id_almacen
			);
			$data_resta  = array(
				'id_producto' => $productos[$i], 
				'stock'       => $cantidades[$i],
				'id_almacen'  => $id_almacenActual // id_almacen del que estoy restando
			);
			$this->Ventas_model->save_detalleEntradas($data_detalle);
			$this->Ventas_model->updateStock($data1);
			$this->Ventas_model->updateStock_restar($data_resta);

		}
	}

  /*----------------entradas de productos al almacen----------------*/
	public function add_entrada(){

		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }

		$data = array(
			//"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"productos" => $this->modelogeneral->getProductosAll()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/add_entrada",$data);
		$this->load->view("layouts/footer");
	}

	public function guardar_entrada(){
	    if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }

		$fecha      = $this->input->post("fecha");
		$cantidades = $this->input->post("cantidades");
		$productos  = $this->input->post("idproductos");
		$id_almacen = $this->session->userdata('almacen');
   	 
	   $this->save_detalleEntradas($productos,$fecha,$cantidades,$id_almacen);
	 
	   redirect(base_url()."ventas/entrada_almacen/".$id_almacen);
	}	

	protected function save_detalleEntradas($productos,$fecha,$cantidades,$id_almacen){
		for ($i=0; $i < count($productos); $i++) { 
			
			$data_detalle  = array(
				'fecha_entrada' => $fecha,
				'id_almacen'    => $id_almacen, //almacen de la paz
				'id_producto'   => $productos[$i], 
				'cantidad'      => $cantidades[$i] 
				
			);
			$data1  = array(
				'id_producto' => $productos[$i], 
				'stock'       => $cantidades[$i],
				'id_almacen'  => $id_almacen
				
			);
			$this->Ventas_model->save_detalleEntradas($data_detalle);
			$this->Ventas_model->updateStock($data1);

		}
	}

	public function stock($id_almacen)
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');

        $data  = array(
			'ventas' => $this->Ventas_model->getVentas($id_almacen),
			'stock' => $this->Ventas_model->getProductos_stockAlmacen($id_almacen)
			
		);
    	$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_stock",$data);
		$this->load->view("layouts/footer");
	}

	public function entrada_almacen($id_almacen)
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');
        $data  = array(
			'entradas' => $this->Ventas_model->getEntradas_Almacen($id_almacen)
			);
        
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_entradas",$data);
		$this->load->view("layouts/footer");
	}

    // ver entrada y salidas de productos

	public function entradas_salidas(){
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');

        $data = array(
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"productos" => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen),
			"movimientos" => $this->Clientes_model->allMovProdAlCli()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_movimientos_generales",$data);
		$this->load->view("layouts/footer");
    }

    //mov entrada y salida 
    public function mov_entrada_salida(){
    	if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
		
		$id_almacen  = $this->session->userdata('almacen');
		$id_cliente  = $this->input->post("id_cliente");
		$id_producto = $this->input->post("id_producto");
		$mes         = $this->input->post("mes");
		if ($this->input->post("buscar")) {
			
			$datos = array( 
						'id_almacen'   => $id_almacen,
						'id_cliente'   => $id_cliente,
						'id_producto'  => $id_producto,
						'mes'          => $mes,
						'clientes'     => $this->Clientes_model->getClientes(),
						'productos'    => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen),
						'movimientos'      => $this->Ventas_model->getMovientosbyMes($id_producto,$id_cliente,$id_almacen,$mes)
	                 );
		}
		else{
			$datos = array( 
						'id_almacen'  => $id_almacen,
						'id_cliente'  => $id_cliente,
						'id_producto' => $id_producto,
						'mes'         => $mes,
						'clientes'    => $this->Clientes_model->getClientes(),
						'productos'   => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen)
						
	                 );
		     }
		
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
	    $this->load->view("reportes/v_movEntrada_salidas",$datos);
		$this->load->view("layouts/footer");
	}

	public function reporte_rango_fechas(){

		$fechainicio = $this->input->post("fechainicio");
		$fechafin    = $this->input->post("fechafin");
		$id_producto = $this->input->post("id_producto");
        $id_almacen  = $this->session->userdata('almacen');

		if ($this->input->post("buscar")) {
			$movimientos = $this->Ventas_model->getMovbyRango($fechainicio,$fechafin,$id_producto);
			$data = array(
							'movimientos' => $movimientos,
							'fechainicio' => $fechainicio,
							'fechafin'    => $fechafin,
							'productos'   => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen)
				         );
		}else{
			 $data = array('productos' => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen));
		     }
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
	    $this->load->view("reportes/v_movRango_fechas",$data);
		$this->load->view("layouts/footer");
	}


	/**reporte grafico de consmo mensual*/

	public function consumo_mensual_productos()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $id_almacen = $this->session->userdata('almacen');
        $data = array(
			'years'         => $this->Ventas_model->years(),
			'productos'    => $this->Ventas_model->getProductos_stockAlmacenCli($id_almacen)
			
		); 
        
   
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("reportes/v_grafico_consumo_mensual",$data);
		$this->load->view("layouts/footer");
	}


	/*--------almacen clientes-------*/

	public function almacen_clientes(){
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url().'login');
        }
        $data = array(
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"productos" => $this->modelogeneral->getProductosAll()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("ventas/v_almacen_clientes",$data);
		$this->load->view("layouts/footer");
 	}
	/*-------------------------------*/
	public function getproductos(){
		$valor = $this->input->post("valor");
		$clientes = $this->Ventas_model->getproductos($valor);
		echo json_encode($clientes);
	}

	public function getPrecioCliente(){
		$id_cliente = $this->input->get("id_cliente");
		$id_producto = $this->input->get("id_producto");
		$precio_clientes = $this->Clientes_model->getPrecioCliente($id_cliente,$id_producto);

		echo json_encode($precio_clientes);
	}

	/*obtener los productos de almacen clientes */

	public function getStockAlcli(){
		$id_almacen = $this->session->userdata('almacen');
		$id_cliente = $this->input->get("id_cliente");
		$prod_alcli = $this->Clientes_model->getProdAlCli($id_cliente,$id_almacen);

		echo json_encode($prod_alcli);
	}

	public function getAgencias_cli(){
		
		$id_cliente = $this->input->get("id_cliente");
		$prod_alcli = $this->Clientes_model->getAgencias_cli($id_cliente);

		echo json_encode($prod_alcli);
	}

	public function random($num){
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		for ($i = 0; $i < $num; $i++) {
		     $string .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $string;
	}
  
    // muestra el datalle de la salida venta
	public function view(){
		$this->load->library('ciqrcode');
		$this->load->helper('numeros');
		//hacemos configuraciones
		//$params['data'] = $this->random(30);

		$idventa = $this->input->post("id");
		$venta = $this->Ventas_model->getVenta($idventa);
		$noAutorizacion = '271401800008306';
		$codigo_control = 'C5-41-54-33-73';
		$params['data'] = "";
		
		$params['data'] .= $venta->documento; // nit del cliente
		$params['data'] .= '|'.$venta->num_documento;// no.factura
		$params['data'] .= '|'.$noAutorizacion; //no.autorizacion
		$params['data'] .= '|'.$venta->fecha;   //fecha de factura
		$params['data'] .= '|'.$venta->total;   //total de factura
		$params['data'] .= '|'.$codigo_control; //codigo de control
		$params['data'] .= '|0|0|0|0';          //codigo de control
		$params['level'] = 'H';
		$params['size'] = 3;
		//decimos el directorio a guardar el codigo qr, en este 
		//caso una carpeta en la raíz llamada qr_code
		$params['savename'] = FCPATH.'assets/uploads/qr_code/qrcode.png';
		//generamos el código qr
		$this->ciqrcode->generate($params);	

		$datas = array(
			'venta'          => $this->Ventas_model->getVenta($idventa),
			'detalles'       => $this->Ventas_model->getDetalle($idventa),
			'noAutorizacion' => $noAutorizacion,
			'codigo_control' => $codigo_control,
			'leyenda' => num_to_letras($venta->total),

		);
		$this->load->view("ventas/view_ventas",$datas);
	}

	 // muestra el datalle de la salida de las guias
	public function view_guia(){
		$idventa = $this->input->post("id");
		$data = array(
			"venta" => $this->Ventas_model->getAlCliGuias($idventa),
			"detalles" =>$this->Ventas_model->getDetalle($idventa)
		);
		$this->load->view("ventas/view_guias",$data);
	}

//--------------------salida de almacen------------------
	public function salida_almacen(){

		$fecha         = $this->input->post("fecha");
		$total         = $this->input->post("total");
		$idcomprobante = $this->input->post("idcomprobante");
		$idcliente     = $this->input->post("idcliente");
		$numero        = $this->input->post("numero");
		$serie         = $this->input->post("serie");

		$mantener_prod = $this->input->post("mantener_prod");
		
		$contacto      = $this->input->post("contacto");
		$telf_contacto = $this->input->post("telf_contacto");
		$destino       = $this->input->post("destino");
		
		$idproductos = $this->input->post("idproductos");
		$precios     = $this->input->post("precios");
		$cantidades  = $this->input->post("cantidades");
		$importes    = $this->input->post("importes");

		$id_almacen  = $this->session->userdata('almacen');

		$data = array(
			'fecha'               => $fecha,
			'total'               => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'id_cliente'          => $idcliente,
			'num_documento'       => $numero,
			'serie'               => $serie
		);

		if ($this->Ventas_model->save_venta($data)) {
			$idventa = $this->Ventas_model->lastID();
			$this->updateComprobante($idcomprobante);
			$this->save_detalle($idproductos,$idventa,$precios,$cantidades,$importes,$idcliente,$mantener_prod,$id_almacen,$fecha);
			redirect(base_url()."ventas/listar");

		}else{
			redirect(base_url()."ventas/add_venta");
		}
	}
	protected function save_detalle($productos,$idventa,$precios,$cantidades,$importes,$idcliente,$mantener_prod,$id_almacen,$fecha){
		for ($i=0; $i < count($productos); $i++) { 
			$data  = array(
				'producto_id' => $productos[$i], 
				'venta_id'    => $idventa,
				'precio'      => $precios[$i],
				'cantidad'    => $cantidades[$i], 
				'importe'     => $importes[$i]
			);
			// llenar tabla almacen_clientes
			if ($mantener_prod ==2) {
			    $dato_alcli = array(
							'id_producto' => $productos[$i], 
							'id_cliente'  => $idcliente,
							'id_almacen'  => $id_almacen,
							'stock'       => $cantidades[$i],
							'fecha'       => $fecha,
							'idventa'     => $idventa 
				);
			 $this->updateAlmacen_clientes($dato_alcli);		
		    }

			$this->Ventas_model->save_detalle($data);
			//actualizo el stock de productos
			$this->updateProducto($productos[$i],$cantidades[$i],$id_almacen);
			$this->updatePrecio_cliente($idcliente,$productos[$i],$precios[$i]);

		}
	}
	protected function updateAlmacen_clientes($dato_alcli){
		$row = $this->Clientes_model->getAlmacen_Cliente($dato_alcli);
		if ($row == false) {
			$campos_insert = array(
	    	          
	    	            'id_producto' => $dato_alcli['id_producto'], 
						'id_almacen'  => $dato_alcli['id_almacen'],
						'id_cliente'  => $dato_alcli['id_cliente'],
						'stock'       => $dato_alcli['stock']
						 );

		    $this->Clientes_model->InsertAlmacen_clientes($campos_insert);
		    //agregar a la tabla de movimientos esta entrada
		    $campos = array(
	    	            'fecha'            => $dato_alcli['fecha'],
	    	            'idventa'          => 0,// si es cero es porque es una entrada al almacen
	    	            'id_producto'      => $dato_alcli['id_producto'], 
						'id_almacen'       => $dato_alcli['id_almacen'],
						'id_cliente'       => $dato_alcli['id_cliente'],
						'cantidad_entrada' => $dato_alcli['stock'],
						'saldo'            => $dato_alcli['stock']
						 );
	        $this->Clientes_model->InsertMovAl_cli($campos);
		}else{
			  $stock = $row->stock + $dato_alcli['stock'];
			  $dato_act = array(
							'id_producto' => $dato_alcli['id_producto'], 
							'id_cliente'  => $dato_alcli['id_cliente'],
							'id_almacen'  => $dato_alcli['id_almacen'],
							'stock'       => $stock
				        );
		  	    $this->Clientes_model->updateAlmacen_clientes($dato_act);
		  	    //agregar a la tabla de movimientos esta entrada
		        $campos = array(
	    	            'fecha'            => $dato_alcli['fecha'],
	    	            'idventa'          => 0,// si es cero es porque es una entrada al almacen
	    	            'id_producto'      => $dato_alcli['id_producto'], 
						'id_almacen'       => $dato_alcli['id_almacen'],
						'id_cliente'       => $dato_alcli['id_cliente'],
						'cantidad_entrada' => $dato_alcli['stock'],
						'saldo'            => $stock
						

						 );
	            $this->Clientes_model->InsertMovAl_cli($campos);
		 	}
	}
	protected function updateProducto($idproducto,$cantidad,$id_almacen){
		$productoActual = $this->Productos_model->getProducto($idproducto,$id_almacen);
		$act_stock = $productoActual->stock - $cantidad ;
		$data = array(
			'stock' => $act_stock,
			'id_almacen' =>$id_almacen
		);
		$this->Productos_model->update_stock($idproducto,$data);
	}
	protected function updateComprobante($idcomprobante){
		$comprobanteActual = $this->Ventas_model->getComprobante($idcomprobante);
		$data  = array(
			'cantidad' => $comprobanteActual->cantidad + 1, 
		);
		$this->Ventas_model->updateComprobante($idcomprobante,$data);
	}
	protected function updatePrecio_cliente($idcliente,$idproducto,$precio){
		$row = $this->Clientes_model->getPrecioCliente($idcliente,$idproducto);
		
		if ($row == false) {
		$data = array(
			'id_cliente'  => $idcliente,
			'id_producto' => $idproducto,
			'precio_cli'  => $precio
			);	
		$this->Clientes_model->InsertPrecio_cliente($data);
			
		}else{
		    $data = array(
						  'id_cliente'  => $idcliente,
						  'id_producto' => $idproducto,
						  'precio_cli'  => $precio
		                 );
		$this->Clientes_model->updatePrecio_cliente($data);

		}
	}

	













//----------------------CONFIGURACION----------------------------------
    public function configuracion()
    {
        if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('configuracion');
            $crud->set_subject('Configuracion');
            $crud->unset_edit_fields('parametro');
            $crud->unset_delete();
         
            $output                   = $crud->render();
            $output->breadcrum        = array('index' => 'Inicio');
            $output->breadcrum_actual = 'Sistema/Configuraci&oacute;n';
            $output->mostrar          = "no";

            $this->_example_output($output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

        
/*-----------------Cotizaciones---*/

	public function cotizaciones()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('cotizacion');
			$crud->columns('id_producto','nombre_empresa','direccion','mensaje','fecha');
		    $crud->display_as('id_producto','Producto');
			$crud->set_subject('Administrar Cotizaciones');
			$crud->set_relation('id_producto','producto','nombre_producto');
			$crud->unset_add();
			$crud->unset_edit();

			//$output->almacen = " ";

			$output = $crud->render();
			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Cotizaciones';

			$this->_example_output($output);
	}

//-----------------Entrada de Producto al almacen----------------

	public function N_entrada_productos()
	{
		 if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
            }
           
		
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('entrada_producto');
			$crud->set_subject('Entrada de Producto');

			$crud->fields('id_almacen', 'id_categoria', 'id_producto' , 'fecha_entrada','cantidad_inicial');
			$crud->columns('fecha_entrada','id_almacen','id_producto','cantidad_inicial');
			$crud->required_fields('cantidad_inicial','fecha_entrada','id_almacen','id_categoria','id_producto');
			
			$crud -> display_as ( 'cantidad_inicial' , 'Cantidad entrada');
			
			//-----------almacen---------------------------------------------	
      		$crud -> set_relation ( 'id_almacen' , 'almacen' , 'nombre_almacen');
		    $crud -> display_as ( 'id_almacen' , 'Almacen' );
		    //-----------Categoria---------------------------------------------
			$crud -> set_relation ( 'id_categoria' , 'categoria' , 'nombre_categoria');
			$crud -> display_as ( 'id_categoria' , ' Categoria' );

            //-----------Producto---------------------------------------------				
			$crud -> set_relation ( 'id_producto' , 'producto' , 'nombre_producto');
			$crud -> display_as ( 'id_producto' , 'Nombre del Producto');

			
            $crud->set_rules('cantidad_inicial','Cantidad','integer');

            $crud->callback_before_insert(array($this,'sumar_exitencia'));


			$this->load->library('Gc_dependent_select');


			$fields = array(

				// first field:
				'id_almacen'       => array( // first dropdown name
				'table_name'       => 'almacen', // table of country
				'title'            => 'nombre_almacen', // country title
				'relate'           => null // the first dropdown hasn't a relation
				),
				// second field
				'id_categoria'     => array( // second dropdown name
				'table_name'       => 'categoria', // table of state
				'title'            => 'nombre_categoria', // state title
				'id_field'         => 'id_categoria', // table of state: primary key
				'relate'           => 'id_almacen', // table of state:
				'data-placeholder' => 'Select Categoria' //dropdown's data-placeholder:

                ),
			    // third field. same settings
				'id_producto'       => array(
				'table_name'       => 'producto',
				//'where'            =>"post_code>'167'",  // string. It's an optional parameter.
				//'order_by'         =>"state_title DESC",  // string. It's an optional parameter.
				'title'            => 'nombre_producto',  // now you can use this format )))
				'id_field'         => 'id_producto',
				'relate'           => 'id_categoria',
				'data-placeholder' => 'Select Producto'
				)
            );


			

			 $config = array(
				
				'main_table' => 'entrada_producto',
				'main_table_primary' => 'id_entrada',
				"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/' // path to method
				
				);
				$categories = new gc_dependent_select($crud, $fields, $config);

				// first method:
				//$output = $categories->render();

				// the second method:
				$js = $categories->get_js();
				$output = $crud->render();

				$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Entrada de Productos';


				$output->output.= $js;
				$this->_example_output($output);

	}


  function sumar_exitencia($post_array)
   {	
	
	$id_almacen = $post_array['id_almacen']; 
	$id_categoria = $post_array['id_categoria']; 
	$id_producto = $post_array['id_producto']; 
	$cantidad_inicial = $post_array['cantidad_inicial']; 
	$fecha = $post_array['fecha_entrada']; 

	$data= $this->modelogeneral->comprobar_ext($id_almacen,$id_categoria,$id_producto,$fecha);

	if($data == NULL)
	{
     $this->modelogeneral->insertar_ext($id_almacen,$id_categoria,$id_producto,$fecha,$cantidad_inicial);
	}else
	  {
       $sumatoria = $cantidad_inicial + $data->cantidad_existente;
       $this->modelogeneral->update_ext($id_almacen,$id_categoria,$id_producto,$fecha,$sumatoria);
	  }
	 
	return $post_array;
   }

   //--------------------------Reportes------------------------
   public function reporte_existencia()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud ->set_theme('datatables');
			$crud ->set_table('existencia');
			
			$crud ->set_relation('id_almacen','almacen','nombre_almacen');
			$crud ->set_relation('id_producto','producto','nombre_producto');
			$crud ->set_relation('id_categoria','categoria','nombre_categoria');
			

			$crud -> display_as ( 'id_almacen'   , 'Almacen');
			$crud -> display_as ( 'id_producto'  , 'Producto');
			$crud -> display_as ( 'id_categoria' , 'Categoria');
			$crud -> display_as ( 'ano' , 'Año');
			
		$crud ->columns('mes','ano','id_almacen','id_categoria','id_producto','cantidad_existente');
           
		    

			//$crud ->set_subject('Usuarios');
			
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			
			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Reportes de Entrada de Productos';

			$this->_example_output($output);
	}




//---------------------------------------------------------------	


	/*public function datos_venta()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
		
	 $id_producto = 40;	
      $this->load->model('modelogeneral');
      $dataa = $this->modelogeneral->getVentas($id_producto);
      
      $data = $this->modelogeneral->devolver_nombre_Producto($id_producto);
	  
	  
	  
      
	  $datos = array(
                       'nombre_producto'   =>   $data ,
                        'paquete'=> $dataa
                      
                     		                                         
 
	  	             );
       
	  echo json_encode($dataa);
        
	}*/

	


	/*-----------------Usuarios---*/

	public function usuarios()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud ->set_theme('datatables');
			$crud ->set_table('usuario');

			$crud ->set_subject('Usuarios');
			
			$crud ->set_relation('id_nivel','nivel','nombre_nivel');
			$crud -> display_as ( 'id_nivel' , 'Nivel');
			//$crud ->set_rules('pass','Contraseña','md5');
			
			$crud ->columns('nombre','email','direccion','pass','id_nivel');
           
		    $crud ->display_as('nombre','Nombre Usuario');
		    $crud ->display_as('pass','Contraseña');
		    $crud->set_field_upload('img','assets/uploads/files');
			
			//$crud->unset_add();
			//$crud->unset_edit();

			
			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Usuarios';	

			$this->_example_output($output);
	}



	

	public function clientes()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_table('cliente');
			
			//$crud->columns('customerName','contactLastName');
			
			$crud->display_as('nombre_cli','Nombre del Cliente');
			$crud->display_as('direccion_cli','Direccion del Cliente');
			$crud->display_as('telefono_cli','Telefono');
			$crud->set_field_upload('logo','assets/uploads/files');
			$crud->required_fields('logo','nombre_cli');	 
			$crud->set_subject('nuevo registro');
			
		//	$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Clientes';


			$this->_example_output($output);
	}

//--------------catergoria-------------------------
public function categoria($valor)
	{
			if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
			$datos['id_almacen'] = $valor;
			
			$consulta['almacen'] = $this->modelogeneral->devolver_datos_almacen($datos['id_almacen']);			

			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');

         	$crud->set_table('categoria');
            $crud->where('id_almacen',$datos['id_almacen']);
            $crud->field_type('id_almacen','hidden',$datos['id_almacen']);
			
			$crud->columns('nombre_categoria','id_almacen','imagen_ref');
			$crud->callback_column('id_almacen',array($this,'_callback_colum_almacen'));
			
			$crud->display_as('nombre_categoria','Nombre Categoria');
			$crud->display_as('id_almacen','Almacen a que Pertenece');
			$crud->display_as('imagen_ref','Imagen de referencia');
			$crud->set_field_upload('imagen_ref','assets/uploads/files');
				 
			$crud->set_subject('Categoria');
			
		    

		    $crud->add_action('Producto', '', 'ventas/producto','ui-icon-plus');

			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio','almacen'=>$consulta['almacen']->nombre_almacen);
		    $output->breadcrum_actual = 'Categorias';


			$this->_example_output($output);
	}
   

	public function producto($valor)
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$datos['id_categoria'] = $valor;

			$crud->set_theme('datatables');

			$crud->set_table('producto');
			$crud->where('id_categoria',$datos['id_categoria']);
			$crud->set_subject('Nuevo Producto');
			$crud->set_rules('cantidad_inicial','Cantidad inicial','numeric');
            $crud->required_fields('fecha_entrada','nombre_producto','precio_unidad','id_proveedor'); 

			$crud->field_type('id_categoria','hidden',$datos['id_categoria']);

			$datos['categoria'] =  $this->modelogeneral->get_categoria($datos['id_categoria']);

			$crud->field_type('id_almacen','hidden',$datos['categoria']->id_almacen);

			$crud -> unset_texteditor ( 'descripcion_producto' ) ;	
			
			$crud->set_relation('id_proveedor','proveedor','nombre_prove');

			$crud->set_field_upload('imagen_producto','assets/uploads/files');

			//$crud->add_action('Entradas', '', 'ventas/entrada_productos','ui-icon-plus');
			
			$crud->display_as('id_proveedor','Proveedor');
			
			$crud->columns('nombre_producto','cantidad_existente','precio_unidad');

			$crud->callback_column('cantidad_existente',array($this,'cantidad_exist'));
			
			$crud->callback_column('precio_unidad',array($this,'valueToBs'));
			
			$output = $crud->render();

			$datos['almacen'] =  $this->modelogeneral->get_almacen($datos['categoria']->id_almacen);

			$output->breadcrum = array('index'=>'Inicio','almacen'=>$datos['almacen']->nombre_almacen,'producto'=>"Categoria ".$datos['categoria']->nombre_categoria);
		    $output->breadcrum_actual = 'Producto';


			$this->_example_output($output);
	}


	//--------------------ENTRADA DE PRODUCTOS-------------------

	

	

	//--------------------------------

	public function _callback_colum_almacen($value, $row)
    {
       $consulta['almacen'] = $this->modelogeneral->devolver_datos_almacen($value);
	   
	   return $consulta['almacen']->nombre_almacen;
    }

	

	public function valueToBs($value, $row)
	{
		return $value.' Bs';
	}


	public function cantidad_exist($value, $row)
	{
		$datos['cantidad_existente'] =  $this->modelogeneral->get_existencia($row->id_producto);
        if($datos['cantidad_existente'] != NULL)
        {
          return $datos['cantidad_existente']->cantidad_existente;
        }else
           {
           	return "-";
           }
		
	}

//-------------- SUCURSAL----------------

	public function sucursal()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'ventas') {
            redirect(base_url() . 'login');
        }
        
		$crud = new grocery_CRUD();

		$crud->set_table('sucursal');
		$crud->display_as('nombre_sucursal','Nombre Sucursal');
		$crud->display_as('direccion_suc','Direccion Sucursal');
		$crud->display_as('telefono_suc','Telefono Sucursal');
		
		$crud->set_relation_n_n('cliente', 'sucursal', 'cliente', 'id_cliente', 'id_sucursal', 'nombre_cli');
		
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('cliente', 'nombre_sucursal', 'direccion_suc' , 'telefono_suc');

		$output = $crud->render();

		$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Sucursal';

		$this->_example_output($output);
	}

	


}