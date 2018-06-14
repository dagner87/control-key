
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {

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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
            redirect(base_url() . 'login');
        }
        
		$mensaje = "
		    <div class='callout callout-info alert-dismissible'>
		    <h4><i class='icon fa fa-info'> </i> Bienvenidos a esta seccion de administración</h4>
		    <p>Donde usted podrá administrar los Almacenes, Pedidos, Ventas, Proveedores, Clientes, Productos etc..</p>
	    	</div> ";

   $this->_example_output((object)array('output' => $mensaje  ,'breadcrum' => '' , 'js_files' => array() , 'css_files' => array()));
		
	}

	public function _example_output($output = null)
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
            redirect(base_url().'login');
        }
        
   
	    $id_almacen = 3;
	    $resultado                = $this->modelogeneral->get_Categorias($id_almacen);
	    $resul_prod               = $this->modelogeneral->get_productos($id_almacen);
	    $output->count_entransito = $this->modelogeneral->count_entransito();
	    $output->count_completado = $this->modelogeneral->count_completado();
	    $output->count_enaduana   = $this->modelogeneral->count_enaduana();
	    $output->count_pendientes = $this->modelogeneral->count_pendientes();
	    
	     $output->array1 = $resultado;
	     $output->array2 = $resul_prod;

	     $this->load->view('admin/v_cliente',$output);
	        
	}

	
	public function n_pedido_cli()
	{
	 if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
            redirect(base_url().'login');
        }
	   
     $id_cliente = 8;
     $result_sucursal  = $this->modelogeneral->getSucursal($id_cliente);
     $result_productos  = $this->modelogeneral->getProductos_cliente($id_cliente);

     
     //$dato->sucursal =  $result_sucursal;

     $data = array( 'consulta'       => $result_sucursal, 
                    'productos_cli'  => $result_productos                   
                   
    	         );

     $this->load->view('admin/advanced',$data);
   	
	}

	public function ajax_list()
	{
		$list = $this->modelogeneral->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->firstName;
			$row[] = $person->lastName;
			//$row[] = $person->gender;
			//$row[] = $person->address;
			//$row[] = $person->dob;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all(),
						"recordsFiltered" => $this->person->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



//---------------------------------------------------	
	public function venta()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('venta');
			$crud->set_subject('Venta');
			$crud->columns('fecha_venta','id_cliente','id_almacen','id_categoria','id_producto');
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
		
	public function verificar_exitencia($post_array)
    {
     	if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
            redirect(base_url() . 'login');
            }
        $id_almacen = $post_array['id_almacen']; 
		$id_categoria = $post_array['id_categoria']; 
		$id_producto = $post_array['id_producto']; 
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
			
			$crud->add_action('Confirmar Pedido', '', 'ventas/confirmar_pedido','ui-icon-check');
			$crud->callback_column('estado_solicitado',array($this,'mostrar_estado'));
			
			$crud->callback_column('fecha_entrega',array($this,'mostrar_estado_pendiente'));
			
			$crud->callback_column('cantidad_solicitada',array($this,'mostrar_input_cantidad'));
			
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

		function mostrar_input_cantidad($value, $row)
		{
		
	     return "<input type='text' class='form-control'   name='telefono' value=".$value."required>";		
		}
    
    //--------------------pedidos en transito------------------------
    public function pedido_transito()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
			
					   
			$crud->add_action('Confirmar Aduana', '', 'ventas/confirmar_Aduana','ui-icon-check');
			
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
			
			$crud->add_action('Finalizar Pedido', '', 'ventas/finalizar_pedido','ui-icon-check');
			
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
            redirect(base_url() . 'login');
        }
        
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('proveedor');
			$crud->set_subject('Proveedor');

			//$crud->required_fields('lastName');

			//$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();

			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Proveedores';


			$this->_example_output($output);
	 }

	//-------------modulo solicitud pedido cliente-------------------------------------
	 public function confirmar_pedido_cliente($id)
    {
    
      $this->modelogeneral->update_pedido_cliente($id);
      //redirect('ventas/pedido_proveedor');
          
    }



  //---------------------confirmar_pedido------------------------------------

     public function confirmar_pedido($id)
    {
    
      $this->modelogeneral->update_pedido($id);
      redirect('ventas/pedido_proveedor');
          
    }
		
   //---------------------confirmar_llegadaAduana------------------------------------
    public function confirmar_Aduana($id)
    {
    
      $this->modelogeneral->update_transito_aduana($id);
      redirect('ventas/pedido_transito');
          
    }
   
    //----------------------------finalizar_pedido------------------------
      public function finalizar_pedido($id)
    {
    
      $this->modelogeneral->finalizar_pedido($id);
      redirect('ventas/pedido_aduana');
          
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
        if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
		 if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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


	public function datos_venta()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
        
	}

	public function clientes()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
			if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'cliente') {
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