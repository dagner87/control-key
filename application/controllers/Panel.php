
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');		
        $this->load->model('modelogeneral');
		$this->load->library('grocery_CRUD');

	} 
	public function index() 

	{ 
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
		$mensaje = "
		    <div class='alert alert-info alert-dismissible'>
		    <h4><i class='icon fa fa-info'> </i> Bienvenidos a esta seccion de Almacen</h4>
		    <ul>
			    <li> Almacenes</li>
			    <li>Ventas</li>
			    <li>Clientes</li>
			    <li>Movimientos Internos</li>

		    </ul>
		    
	    	</div> ";

   $this->_example_output((object)array('output' => $mensaje  ,'breadcrum' => '' , 'js_files' => array() , 'css_files' => array()));
		
	}

	public function _example_output($output = null)
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
   
    
    //$id_almacen = 3;
	$resultadolapaz= $this->modelogeneral->get_Categorias();

	//$id_almacen = 2;
	$resultadosantacruz= $this->modelogeneral->get_Categorias();
    
    $output->count_entransito = $this->modelogeneral->count_entransito();
    $output->count_completado = $this->modelogeneral->count_completado();
    $output->count_enaduana   = $this->modelogeneral->count_enaduana();
    $output->count_pendientes = $this->modelogeneral->count_pendientes();
    
     $output->array1 = $resultadosantacruz;
     $output->array2 = $resultadolapaz;

     $this->load->view('admin/v_adminitrador',$output);  
        
	}

	public function almacen()
	{
	 if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
	         redirect(base_url() . 'login');
	     }

			try{
				$crud = new grocery_CRUD();

				$crud->set_theme('datatables');
				$crud->set_table('almacen');
				$crud->set_subject('Almacen');

				
	            $crud->add_action('Administrar Categorias', '', 'panel/categoria','ui-icon-plus');
				$output = $crud->render();
	            
	            $output->almacen = " ";

	            $output->breadcrum = array('index'=>'Inicio');
			    $output->breadcrum_actual = 'Almacenes';

				$this->_example_output($output);

			}catch(Exception $e){
				show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
	}

	public function venta()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('venta');
			$crud->set_subject('Venta');
			$crud->columns('fecha_venta','id_cliente','id_almacen','id_categoria','id_producto','cantidad_articulo');
			$crud->required_fields('cantidad_articulo','fecha_venta','id_almacen','id_categoria','id_cliente','id_producto');
			//-----------cliente---------------------------------------------
			$crud -> set_relation ( 'id_cliente' , 'cliente' , 'nombre_cli');
			$crud -> display_as ( 'id_cliente' , ' Cliente' );

			//-----------almacen---------------------------------------------	
      		$crud -> set_relation ( 'id_almacen' , 'almacen' , 'nombre_almacen');
		    $crud -> display_as ( 'id_almacen' , 'Almacen' );
		    //-----------Categoria---------------------------------------------
			$crud -> set_relation ( 'id_categoria' , 'categoria' , 'nombre_categoria');
			$crud -> display_as ( 'id_categoria' , ' Categoria' );

            //-----------Producto---------------------------------------------				
			$crud -> set_relation ( 'id_producto' , 'producto' , 'nombre_producto');
			$crud -> display_as ( 'id_producto' , 'Nombre del Producto');

            $crud->set_rules('cantidad_articulo','Cantidad','integer');

            $crud->callback_before_insert(array($this,'verificar_exitencia'));
            //$crud->set_rules('cantidad_articulo', 'Cantidad','callback_verificar_exitencia');

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
				
				'main_table' => 'venta',
				'main_table_primary' => 'id_venta',
				"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/' // path to method
				
				);
				$categories = new gc_dependent_select($crud, $fields, $config);

				// first method:
				//$output = $categories->render();

				//$output->breadcrum = array('index'=>'Inicio');
		       // $output->breadcrum_actual = 'Venta';


				// the second method:
				$js = $categories->get_js();
				$output = $crud->render();

				$output->breadcrum = array('index'=>'Inicio');
		        $output->breadcrum_actual = 'Venta'; 
				
				$output->output.= $js;
				$this->_example_output($output);

	}
//--------------------------verificar_exitencia-----------------
		
	function verificar_exitencia($post_array)
    {
        $id_almacen        = $post_array['id_almacen']; 
		$id_categoria      = $post_array['id_categoria']; 
		$id_producto       = $post_array['id_producto']; 
		$cantidad_articulo = $post_array['cantidad_articulo']; 
		

		$data = $this->modelogeneral->comprobar_existencia_venta($id_almacen,$id_categoria,$id_producto);

		if($data == NULL)
		{
	      return FALSE;
		}else
		  {
	       $resultado_existente = $data->cantidad_existente - $cantidad_articulo;
	       $this->modelogeneral->update_extente_venta($id_almacen,$id_categoria,$id_producto,$resultado_existente);
		  }
		 
		return $post_array;
	}


//-----------------------------MODULO PEDIDO--------------------------------
   //---------------Pedidos a Proveedor--------------------

    public function pedido_proveedor()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();
            //bootstrap

			$crud->set_theme('datatables');
			$crud->where('estado_solicitado','1');
			$crud->set_table('pedido_proveedor');
			$crud->set_subject('Pedido');
			$crud->columns('no_pedido','fecha_pedido','fecha_entrega','id_proveedor','id_producto','cantidad_solicitada','estado_solicitado');
		    
		    $crud->field_type('estado_transito','hidden');
		    $crud->field_type('estado_enaduana','hidden');
		    $crud->field_type('estado_solicitado','hidden');

		    $crud->display_as('id_producto','Producto');
		    $crud->display_as('id_proveedor','Proveedor');
		    $crud->display_as('estado_solicitado','Estado');

		    $crud->required_fields('fecha_pedido','fecha_entrega','id_proveedor','id_producto','cantidad_solicitada','costo');
           
			$crud->unset_edit();
			$crud->fields('no_pedido','fecha_pedido','fecha_entrega','id_proveedor','id_producto','cantidad_solicitada','costo');
			
			$crud->add_action('Confirmar Pedido', '', 'panel/confirmar_pedido','ui-icon-check');
			$crud->callback_column('estado_solicitado',array($this,'mostrar_estado'));
			
			$crud->callback_column('fecha_entrega',array($this,'mostrar_estado_pendiente'));
			
			$crud->callback_add_field('no_pedido', function (){
				$dato['parametro'] = $this->modelogeneral->getValorInicialPedido();  
				$valor_pedido = $dato['parametro']->valor+1;
			    $i = 8;
			    $n_pedido= str_pad($valor_pedido, $i, 0, STR_PAD_LEFT);
			    $html="<input type= 'hidden'  value='".$n_pedido."'  name='no_pedido'>";
		     return  "<strong>".$n_pedido."</strong>".$html; 
			
			});

			$crud->callback_after_insert(array($this,'updatevalor_noPedido'));

          //------------------------------------------------------------------    
			$crud->set_relation('id_producto','producto','nombre_producto');
			$crud->set_relation('id_proveedor','proveedor','nombre_prove');
			
			$this->load->library('Gc_dependent_select');
			$fields = array(

				// first field:
				'id_proveedor'       => array( // first dropdown name
				'table_name'       => 'proveedor', // table of country
				'title'            => 'nombre_prove', // country title
				'relate'           => null // the first dropdown hasn't a relation
				),
				// third field. same settings
				'id_producto'       => array(
				'table_name'       => 'producto',
				//'where'            =>"post_code>'167'",  // string. It's an optional parameter.
				//'order_by'         =>"state_title DESC",  // string. It's an optional parameter.
				'title'            => 'nombre_producto',  // now you can use this format )))
				'id_field'         => 'id_producto',
				'relate'           => 'id_proveedor',
				'data-placeholder' => 'Select Producto'
				)
            );
            $config = array(
				
				'main_table' => 'pedido_proveedor',
				'main_table_primary' => 'id_pedido_prov',
				"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/' // path to method
				
				);
			$pedido = new gc_dependent_select($crud, $fields, $config);
            
            $js = $pedido->get_js();
			$output = $crud->render();
			
			$output->output.= $js;

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Pedido';

			$this->_example_output($output);
	}
    //---------------------estado de pedido--------------------------
	function mostrar_estado($value, $row)
		{
			
			if ($value==1) {
				$html= "<span class='label label-primary'><strong>Solicitado</strong></span>";
			}
			

		return $html;
		}
		

	function mostrar_estado_pendiente($value, $row)
		{
		
		 $fecha_actual= date("Y-m-d");
		 if($fecha_actual >= $value)
			 {
			   
			  return "<span class='label label-danger'><strong>".$value."</strong></span>";		
			 
			 }else{
			 	 return $value;
			 }
		
		}	
    
    //--------------------pedidos en transito------------------------
    public function pedido_transito()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();
            //bootstrap
            
			$crud->set_theme('datatables');
			$crud->where('estado_transito','1');
			$crud->set_table('pedido_proveedor');
			
			$crud->columns('no_pedido','fecha_salida_transporte','fecha_llegada_aduana','nombre_chofer','telefono_chofer','id_producto','cantidad_solicitada','estado_transito');
		    
		    $crud->display_as('fecha_salida_transporte','Fecha salida Proveedor');
		    $crud->display_as('fecha_llegada_aduana','Fecha llegada Aduana');
		    $crud->display_as('nombre_chofer','Nombre Chofer');
		    $crud->display_as('telefono_chofer','Telefono Chofer');
            $crud->display_as('no_factura','No Factura Proveedor');
		    $crud->display_as('id_producto','Producto');
		    $crud->display_as('factura_doc','Factura');
            $crud->display_as('costo_transporte','Costo Trasporte');
            $crud->display_as('paquin_list','Paking List');
            $crud->display_as('srt','SRT');
            $crud->display_as('contrato_transporte','Contrato Trasporte');
            $crud->display_as('factura_trasporte','Factura Trasporte');
            $crud->display_as('estado_transito','Estado');
		    $crud->fields(  'no_pedido',
							'no_factura',
							'fecha_salida_transporte',
							'fecha_llegada_aduana',
							'nombre_chofer',
							'telefono_chofer',
							'costo_transporte',
							'factura_doc',
						    'paquin_list',
						    'srt',
						    'contrato_transporte',
						    'factura_trasporte'
			             );	

		    $crud->set_field_upload('factura_doc','assets/uploads/respaldos');
		    $crud->set_field_upload('paquin_list','assets/uploads/respaldos');
		    $crud->set_field_upload('srt','assets/uploads/respaldos');
		    $crud->set_field_upload('contrato_transporte','assets/uploads/respaldos');
		    $crud->set_field_upload('factura_trasporte','assets/uploads/respaldos');
		   
		   
		   
		    $crud->set_rules('telefono_chofer', 'Telefono', 'required|numeric|min_length[8]|integer');			
			$crud->set_rules('no_factura','No Factura','numeric|min_length[8]');
			$crud->set_rules('costo_transporte','Costo Transporte','numeric');
			
			$crud->required_fields('no_factura',
							       'fecha_salida_transporte',
							       'fecha_llegada_aduana',
							       'nombre_chofer',
							       'telefono_chofer',
							       'costo_transporte',
							       'factura_doc',
						           'paquin_list',
						           'srt',
						           'contrato_transporte',
						           'factura_trasporte'
			                      );	

			$crud->unset_add();	
			$crud->unset_delete();
			//$crud->unset_edit('no_pedido');			
			$crud->callback_edit_field('no_pedido',array($this,'edit_field_callback_1'));
			
					   
			$crud->add_action('Confirmar Aduana', '', 'panel/confirmar_Aduana','ui-icon-check');
			
			$crud->callback_column('estado_transito',array($this,'mostrar_estado_transito'));
			
			
			
			$crud->callback_after_insert(array($this,'updatevalor_noPedido'));

          //------------------------------------------------------------------    
			$crud->set_relation('id_producto','producto','nombre_producto');
			$crud->set_relation('id_proveedor','proveedor','nombre_prove');
			
			$this->load->library('Gc_dependent_select');
			$fields = array(

				// first field:
				'id_proveedor'       => array( // first dropdown name
				'table_name'       => 'proveedor', // table of country
				'title'            => 'nombre_prove', // country title
				'relate'           => null // the first dropdown hasn't a relation
				),
				// third field. same settings
				'id_producto'       => array(
				'table_name'       => 'producto',
				//'where'            =>"post_code>'167'",  // string. It's an optional parameter.
				//'order_by'         =>"state_title DESC",  // string. It's an optional parameter.
				'title'            => 'nombre_producto',  // now you can use this format )))
				'id_field'         => 'id_producto',
				'relate'           => 'id_proveedor',
				'data-placeholder' => 'Select Producto'
				)
            );
            $config = array(
				
				'main_table' => 'pedido_proveedor',
				'main_table_primary' => 'id_pedido_prov',
				"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/' // path to method
				
				);
			$pedido = new gc_dependent_select($crud, $fields, $config);
            
            $js = $pedido->get_js();
			$output = $crud->render();
			
			$output->output.= $js;

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Pedido/Transito';

			$this->_example_output($output);
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
    
    //--------------------pedidos en aduana------------------------
    public function pedido_aduana()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();
            //bootstrap
            
			$crud->set_theme('datatables');
			$crud->where('estado_enaduana','1');
			$crud->set_table('pedido_proveedor');
			//$crud->set_subject('Pedido');
			$crud->columns('no_pedido','fecha_llegada_aduana','id_producto','estado_enaduana');
		    
		    $crud->display_as('fecha_llegada_aduana','Fecha llegada Aduana');
		    $crud->display_as('rua','RUA');
		    $crud->display_as('id_producto','Producto');
		    $crud->display_as('estado_enaduana','Estado');
			$crud->set_field_upload('rua','assets/uploads/respaldos');	
			$crud->unset_add();	
			$crud->unset_delete();
			//$crud->unset_edit('no_pedido');			
			$crud->callback_edit_field('no_pedido',array($this,'edit_field_callback_1'));
			
			$crud->fields('no_pedido','fecha_llegada_aduana','costo_aduana','rua');	
		    
		    $crud->set_rules('costo_aduana', 'Costo Aduana', 'required|numeric');			
			$crud->required_fields('fecha_llegada_aduana','costo_aduana','rua');			
			
			$crud->add_action('Finalizar Pedido', '', 'panel/finalizar_pedido','ui-icon-check');
			
			$crud->callback_column('estado_enaduana',array($this,'mostrar_estado_aduana'));
			
			$crud->callback_after_insert(array($this,'updatevalor_noPedido'));

          //------------------------------------------------------------------    
			$crud->set_relation('id_producto','producto','nombre_producto');
			$crud->set_relation('id_proveedor','proveedor','nombre_prove');
			
			$this->load->library('Gc_dependent_select');
			$fields = array(

				// first field:
				'id_proveedor'       => array( // first dropdown name
				'table_name'       => 'proveedor', // table of country
				'title'            => 'nombre_prove', // country title
				'relate'           => null // the first dropdown hasn't a relation
				),
				// third field. same settings
				'id_producto'       => array(
				'table_name'       => 'producto',
				//'where'            =>"post_code>'167'",  // string. It's an optional parameter.
				//'order_by'         =>"state_title DESC",  // string. It's an optional parameter.
				'title'            => 'nombre_producto',  // now you can use this format )))
				'id_field'         => 'id_producto',
				'relate'           => 'id_proveedor',
				'data-placeholder' => 'Select Producto'
				)
            );
            $config = array(
				
				'main_table' => 'pedido_proveedor',
				'main_table_primary' => 'id_pedido_prov',
				"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/' // path to method
				
				);
			$pedido = new gc_dependent_select($crud, $fields, $config);
            
            $js = $pedido->get_js();
			$output = $crud->render();
			
			$output->output.= $js;

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Pedido/Aduana';

			$this->_example_output($output);
	}
	 //--------------------pedidos en aduana------------------------
    public function pedido_enkey()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();
            //bootstrap
            
			$crud->set_theme('datatables');
			$crud->where('estado_entregado','1');
			$crud->set_table('pedido_proveedor');
			
			$crud->columns('no_pedido','no_factura','id_proveedor','id_producto','costo_total');
		    
		    $crud->display_as('id_producto','Producto');
		    		
			$crud->unset_add();	
			$crud->unset_delete();
			$crud->unset_edit();			
	
          //------------------------------------------------------------------    
			$crud->set_relation('id_producto','producto','nombre_producto');
			$crud->set_relation('id_proveedor','proveedor','nombre_prove');
			
			
          
			$output = $crud->render();
			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Pedido/Key';

			$this->_example_output($output);
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
	 return '<strong>'.$value.'</strong><input type="hidden" maxlength="50" value="'.$value.'" name="phone" style="width:462px">';
	}

	
	
	//--------------------proveedor--------

    public function proveedor()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('proveedor');
			$crud->set_subject('Proveedor');

			$crud->display_as('tiemp_pag_facts','Tiempo Pago Facturas');
			
			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Proveedores';


			$this->_example_output($output);
	 }

	 

  //---------------------confirmar_pedido------------------------------------

     public function confirmar_pedido($id)
    {
    
      $this->modelogeneral->update_pedido($id);
      redirect('panel/pedido_proveedor');
          
    }
		
   //---------------------confirmar_llegadaAduana------------------------------------
    public function confirmar_Aduana($id)
    {
    
      $this->modelogeneral->update_transito_aduana($id);
      redirect('panel/pedido_transito');
          
    }
   
    //----------------------------finalizar_pedido------------------------
      public function finalizar_pedido($id)
    {
    
      $this->modelogeneral->finalizar_pedido($id);
      redirect('panel/pedido_aduana');
          
    }

      public function dar_entrada($id)
    {
    	echo "<script>alert('DAR ENTRADA'+$id)</script>";
     // $this->modelogeneral->finalizar_pedido($id);
      redirect('panel/mercaderia_almacen');
          
    }

	//------------------------actualizar valor_noPedido--------------------------------------------
	
     function updatevalor_noPedido($post_array)
        {
        	 $actno_pedido = $post_array['no_pedido'];
             $this->modelogeneral->aumentar_valor_nopedido($actno_pedido);          

            return true;
        }
//-----------------------------fin MODULO PEDIDO-------------------------------

//----------------------CONFIGURACION----------------------------------
    public function configuracion()
    {
        if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
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
		 if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
            }
           
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('entrada_productos');
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
	
	$id_almacen       = $post_array['id_almacen']; 
	$id_categoria     = $post_array['id_categoria']; 
	$id_producto      = $post_array['id_producto']; 
	$cantidad_inicial = $post_array['cantidad_inicial']; 
	$fecha            = $post_array['fecha_entrada']; 

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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
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
			
		$crud ->columns('fecha','id_almacen','id_categoria','id_producto','cantidad_existente');
           
		    

			//$crud ->set_subject('Usuarios');
			
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			
			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Reportes de Entrada de Productos';

			$this->_example_output($output);
	}




//------------------datos venta---------------------------------------------	


	public function datos_venta()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
		
	 $id_producto = 40;	
      $this->load->model('modelogeneral');
      $dataa = $this->modelogeneral->getVentas($id_producto);
      
      $data = $this->modelogeneral->devolver_nombre_Producto($id_producto);
	  
	  
	  
      
	  $datos = array(
                       'nombre_producto'   => $data ,
                        'paquete'          => $dataa
                      
                     		                                         
 
	  	             );
       
	  echo json_encode($dataa);
        
	}

	


	/*-----------------Usuarios---*/

	public function usuarios()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud ->set_theme('datatables');
			$crud ->set_table('usuario');

			$crud ->set_subject('Usuarios');
			$crud ->display_as('nombre','Nombre Usuario');
		    $crud ->display_as('pass','Contraseña');
			$crud->field_type('pass', 'password');
			$crud ->columns('nombre','email','perfil','direccion');
			$crud->field_type('perfil','dropdown', array('administrador' => 'Administrador', 'comprador' => 'Comprador','ventas' => 'Ventas' ,'gerencia' => 'Gerencia', 'cliente' => 'Cliente'));
          
            $crud->unset_texteditor('direccion'); 
		    $crud->set_relation('id_almacen','almacen','nombre_almacen');
		    $crud->set_field_upload('img','assets/uploads/files');
			$crud->callback_before_insert(array($this,'password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback_editxx'));
			
			$crud->set_rules('usuario','Usuario','required|min_length[4]');
            $crud->set_rules('nombre','Nombre','required|min_length[4]');
            $crud->set_rules('perfil','Perfil','required');
            $crud->set_rules('pass','Contraseña','required|min_length[6]');
            

			
			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Usuarios';	

			$this->_example_output($output);
	}

	 function password_callback($post_array)
     {
        if(!empty($post_array['pass']))
          {
          $post_array['pass'] = md5($post_array['pass']);
         }
         else
             {
              unset($post_array['pass']);
              }
         
      return $post_array;
    }

	public function encrypt_password_callback_editxx($post_array, $primary_key) {
      
      $datos['usuario'] = $this->modelogeneral->devolver_usuarios($primary_key);
      
      if($datos['usuario']->pass == $post_array['pass'])
      {
        return $post_array;  
      }else
        {
        $post_array['pass'] = md5($post_array['pass']);
        return $post_array; 
        }
    } 



//--------------administrar clientes------------------------------	

	public function clientes()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			
			$crud->set_table('cliente');
			$crud->set_subject('Cliente');
		 	$crud->display_as('nombre_cli','Nombre del Cliente');
		 	$crud->display_as('tipo_cliente_id','Tipo de  Cliente');
		 	$crud->display_as('tipo_documento_id','Tipo de  Documento');
			$crud->display_as('direccion_cli','Direccion del Cliente');
			$crud->display_as('telefono_cli','Telefono');
			
			
			$crud -> set_relation ( 'tipo_documento_id' , 'tipo_documento' , 'nombre');
			$crud -> set_relation ( 'tipo_cliente_id' , 'tipo_cliente' , 'nombre');
			
			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Clientes';


			$this->_example_output($output);
	}


	

	//------------------Dar entrada Mercaderia Almacen La Paz----------------

	 public function mercaderia_almacenLaPaz()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        $crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->where('estado_entregado','1');
		$crud->where('id_almacen','2');// La Paz
		$crud->set_table('pedido_proveedor');
		$crud->set_subject('Mercadería');

		$crud->columns('nombre_producto',
				       'cantidad_solicitada',
				       'fecha_key',
				       'costo_almacen'
			           );

		$crud->display_as('id_almacen','Almacen');

		   
	    $crud->field_type('estado_solicitado','hidden');
	    $crud->field_type('estado_transito','hidden');
	    $crud->field_type('estado_enaduana','hidden');
	    $crud->field_type('estado_entregado','hidden');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_read();
		 $crud->set_relation_n_n('fecha_key','paq_ped_prov', 'paquete','id_paquete', 'id_pedido_prov');

		$crud->add_action('Dar Entrada', '', 'comprador/dar_entrada','ui-icon-check');

		
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Almacen Santa Cruz';
		$this->_example_output($output);
	}

	//------------------Dar entrada Mercaderia Almacen Santa Cruz----------------

	 public function mercaderia_almacenScz()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
            redirect(base_url() . 'login');
        }
        $crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->where('estado_entregado','1');
		$crud->where('id_almacen','1');// Santa Cruz
		$crud->set_table('pedido_proveedor');
		$crud->set_subject('Mercadería');

		$crud->columns('nombre_producto',
				       'cantidad_solicitada',
				       'costo_almacen'
			           );

		$crud->display_as('id_almacen','Almacen');

		    $crud->field_type('no_factura','hidden');
		    $crud->field_type('fecha_salida_transporte','hidden');
		    $crud->field_type('fecha_llegada_aduana','hidden');
		    $crud->field_type('nombre_chofer','hidden');
		    $crud->field_type('telefono_chofer','hidden');
		    $crud->field_type('costo_transporte','hidden');
		    $crud->field_type('factura_doc','hidden');
		    $crud->field_type('paquin_list','hidden');
		    $crud->field_type('srt','hidden');
		    $crud->field_type('destino','hidden');
		    $crud->field_type('contrato_transporte','hidden');
		    $crud->field_type('factura_trasporte','hidden');
		    $crud->field_type('costo_aduana','hidden');
		    $crud->field_type('rua','hidden');
		    $crud->field_type('nombre_producto','hidden');
		    $crud->field_type('estado_solicitado','hidden');
		    $crud->field_type('estado_transito','hidden');
		    $crud->field_type('estado_enaduana','hidden');
		    $crud->field_type('estado_entregado','hidden');



			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_read();

			$crud->add_action('Dar Entrada', '', 'comprador/dar_entrada','ui-icon-check');

		    //$crud->set_relation('id_almacen','almacen','nombre_almacen');
		
		
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Almacen Santa Cruz';
		$this->_example_output($output);
	}

//--------------catergoria-------------------------
 public function categorias()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }
        $crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('categoria');
		$crud->set_subject('Categoria');
		$crud->required_fields('nombre_categoria');	
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Categorías';
		$this->_example_output($output);
	}

//-------------- SUCURSAL----------------

	public function sucursal()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'administrador') {
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