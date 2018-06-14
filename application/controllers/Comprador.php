 
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Comprador extends CI_Controller {

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
		switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
	 	   }

        
		$mensaje = "
		    <div class='alert alert-success alert-dismissible'>
		    <h4><i class='icon fa fa-info'> </i>
		     Bienvenidos a esta seccion de Solicitud de Pedidos</h4>
		    <p> Donde usted podrá administrar Pedidos,Proveedores.</p><br>
		    ";

   $this->_example_output((object)array('output' => $mensaje ,'widgets' =>'','breadcrum_actual'=>'','breadcrum' => '' , 'js_files' => array() , 'css_files' => array()));
		
	}

	public function _example_output($output = null)
	{
			switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
	 	   }
	   
	    $output->count_entransito = $this->modelogeneral->count_entransito();
	    $output->count_completado = $this->modelogeneral->count_completado();
	    $output->count_enaduana   = $this->modelogeneral->count_enaduana();
	    $output->count_pendientes = $this->modelogeneral->count_pendientes();
	    $output->arrayLpedidos    = $this->modelogeneral->showAllpedidosT();
	    
	    
        $this->load->view('admin/v_comprador',$output);
        
	}
 

	public function facturas_proveedores($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
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
	    
        
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view("cuentasXpagar/v_factProvedores",$output);
		$this->load->view("cuentasXpagar/footer");
        
	}

	public function facturas_proveedoresPagadas($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
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
	    $output['arraypedidosKey']          = $this->modelogeneral->showFacturasProvee_pagadas(); 
	    
       

       	$this->load->view("cuentasXpagar/header",$output,$output);
		$this->load->view("cuentasXpagar/aside",$output,$output);
		$this->load->view('cuentasXpagar/v_factprovPagadas',$output);
		$this->load->view("cuentasXpagar/footer");
        
	}



	

//------------------------facturas de polizas aduana bolivia
	public function facturas_aduanaBol($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
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
	    $output['arrayFactxPagarAduBol']          = $this->modelogeneral->showFactxPagarAduBol();
	    
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_aduanaBol',$output);
		$this->load->view("cuentasXpagar/footer");

        
	}

	public function facturas_PagasaduanaBol($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
	    $output['arrayFactxPagarAduBol']    = $this->modelogeneral->showFactPagadasAduBol();
	    
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_aduanaBolPagada',$output);
		$this->load->view("cuentasXpagar/footer");
        
        
	}

	public function facturas_transpInt($output = null)
	{
	   switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
	    $output['arrayFactTransBol']          = $this->modelogeneral->showFactxPagarTransBol();
	    
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_tranpBol',$output);
		$this->load->view("cuentasXpagar/footer");


    }
	
	public function facturas_PagasTransBol($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
		    $output['arrayFactTransBol']          = $this->modelogeneral->showFactPagadasTransBol();
		    
	        $this->load->view("cuentasXpagar/header",$output);
		    $this->load->view("cuentasXpagar/aside",$output);
		    $this->load->view('cuentasXpagar/v_facturas_tranpBolPagadas',$output);
		    $this->load->view("cuentasXpagar/footer");
	        
    }

	
	//------------factura de transporte ext--------------

	public function facturas_transpExt($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
	    $output['arrayFactTranExt']         = $this->modelogeneral->showFactTranExt();
	  
	    
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_transpExt',$output);
		$this->load->view("cuentasXpagar/footer");

        
	}

	//-----------------------facturas_transpExtPagadas----------

	public function facturas_transpExtPagadas($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
	    $output['arrayFactTranExt']         = $this->modelogeneral->FactTranExtPagada();
	  
	    
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_transpExtPagadas',$output);
		$this->load->view("cuentasXpagar/footer");
       
        
	}

	//-----------------facturas aduana Peru------------------

	public function facturas_aduanaPeru($output = null)
	{   
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
	    $output['arrayFactAduPeru']         = $this->modelogeneral->showFactAduPeru();

	    
        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_aduanaPeru',$output);
		$this->load->view("cuentasXpagar/footer");

        
	}

   
	//-----------------facturas aduana Peru Pagadas------------------
	public function facturas_aduanaPeruPagadas($output = null)
	{
		 switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
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
	    $output['arrayFactAduPeru']         = $this->modelogeneral->showFactPagadasAduPeru();

        $this->load->view("cuentasXpagar/header",$output);
		$this->load->view("cuentasXpagar/aside",$output);
		$this->load->view('cuentasXpagar/v_facturas_aduanaPeruPagada',$output);
		$this->load->view("cuentasXpagar/footer");

        
	}


	public function reportes($output = null)
	{
			if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador' )
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
	    $output['datosproveedor']           = $this->modelogeneral->getProveedor();


	    
        $this->load->view('reportes/v_reporte_especifico',$output);
        
	}


	 public function search()
    {
     if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador' )
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
	    $output['datosproveedor']           = $this->modelogeneral->getProveedor();
    	
       
        $proveedor  = $this->input->get("proveedor", true);
        $factura    = $this->input->get("factura", true);

        if ($proveedor || $factura)
         {
          $this->session->set_flashdata("factura_flas", $factura);
          $this->session->set_flashdata("proveedor_flas", $proveedor);	
         $output['reportes'] = $this->modelogeneral->verificar($proveedor,$factura);
         $output['pedidos_entregados'] = $this->modelogeneral->mostrar_pedidosEntregados($proveedor); 
            
        } else {
            $this->session->set_flashdata("factura_flas", false);
            $this->session->set_flashdata("proveedor_flas", false);
            $output['reportes']  = NULL;
        }
        $this->load->view('reportes/v_reporte_especifico', $output);

    }




	public function reportes_graficos($output = null)
	{
			if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador' )
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
      
        $this->load->view('reportes/v_reporte_graficas',$output);
        
	}

	public function reportes_generales($output = null)
	{
			if($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador')
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
      
        $this->load->view('reportes/v_reporte_tiempo',$output);
        
	}

	



	//-----------------------------MODULO PEDIDO--------------------------------
	//--------------------proveedor--------

    public function proveedor()
	{
		switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
	 	   }
   		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('proveedor');
		$crud->set_subject('Proveedor');

		$crud->display_as('nombre_prove','Nombre');
		$crud->display_as('tiemp_pag_facts','Tiempo pago Facturas');
		$crud->display_as('direccion_prove','Dirección');
		$crud->unset_texteditor('direccion_prove','comentario');
		$crud->required_fields('nombre_prove','direccion_prove','telefono','tiemp_pag_facts');			
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Proveedores';
	    $output->widgets ="no";
		$this->_example_output($output);
	}

   //---------------------------------categorias---------------
	 public function categorias()
	{
		switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
	 	   }
        $crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('categoria');
		$crud->set_subject('Categoria');
		$crud->required_fields('nombre_categoria');	
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Categorías';
	    $output->widgets ="no";
		$this->_example_output($output);
	}

	//-----------------productos--------------------------------- 

	  public function productos()
	{
		switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
	 	   }
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('producto');
		$crud->set_subject('Producto');
		$crud->display_as('id_proveedor','Proveedor');
		$crud->display_as('id_categoria','Categoria');
		$crud->display_as('description','Descripción');
		$crud->display_as('items','Código');

		$crud->unset_texteditor('description');
		
		$crud->required_fields('id_proveedor','id_categoria','nombre_producto','precio_unitario','peso_neto');
		$crud->callback_add_field('precio_unitario', function () {
         return 'USD <input type="text" maxlength="20" value="" name="precio_unitario">';
         });
		$crud->callback_add_field('peso_neto', function () {
         return 'Kg <input type="text" maxlength="20" value="" name="peso_neto">';
         });
		$crud->set_relation('id_categoria','categoria','nombre_categoria');
		$crud->set_relation('id_proveedor','proveedor','nombre_prove');
		
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Productos';
	    $output->widgets ="no";
		$this->_example_output($output);
	}

	//-------------------clientes----------------------------------------------
	public function clientes()
	{
		switch ($this->session->userdata('perfil')) {
			case '':
				redirect(base_url() . 'login');
				break;
			case 'comprador':
			    break;
			case 'gerencia':
			    break;
			case false:
			    redirect(base_url() . 'login');
				break;			    		
	 	   }
 		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('cliente');
		$crud->set_subject('Cliente');
	 	$crud->display_as('nombre_cli','Nombre del Cliente');
		$crud->display_as('direccion_cli','Dirección del Cliente');
		$crud->display_as('telefono_cli','Teléfono');
		$crud->display_as('numero','NIT');
		$crud->columns( 'nombre_cli',
			            'numero',
			            'contacto',
			            'telefono_cli'
			               );
		$crud->display_as('tipo_cliente_id','Tipo de Cliente');
		
		$crud->set_relation('tipo_cliente_id','tipo_cliente','nombre');
		$crud->unset_texteditor('direccion_cli','observacion');
		$crud->field_type('estado','hidden');
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Administrar Clientes';
	    $output->widgets ="no";
		$this->_example_output($output);
	}

	//---------------Pedidos a Proveedor--------------------

    public function pedido_proveedor()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }

        	$crud = new grocery_CRUD();
           	$crud->set_theme('datatables');
			$crud->where('estado_solicitado','1');
			$crud->set_table('pedido_proveedor');
			$crud->set_subject('Pedido');
			$crud->columns(
				           'fecha_pedido',
			               'fecha_entrega',
			               'id_proveedor',
			               'id_producto',
			               'cantidad_solicitada',
			               'estado_solicitado'
			               );
		   
		    $crud->field_type('no_pedido','hidden');
		    $crud->field_type('no_factura','hidden');
		    $crud->field_type('fecha_salida_transporte','hidden');
		    $crud->field_type('fecha_llegada_aduana','hidden');
		    $crud->field_type('precio_unitario','hidden');
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
		   
		    $crud->display_as('cantidad_solicitada','Cantidad');
            $crud->display_as('id_producto','Producto');
		    $crud->display_as('id_proveedor','Proveedor');
		    $crud->display_as('estado_solicitado','Estado');
		    $crud->display_as('id_almacen','Lista Almacenes');
		    $crud->display_as('orden_prod','Orden de Producción');
		    $crud->display_as('orden_compra','Orden de Compra');

            $crud->set_field_upload('orden_prod','assets/uploads/respaldos');
            $crud->set_field_upload('orden_compra','assets/uploads/respaldos');

            $crud->unset_edit();
            $crud->unset_print(); 
			
			$crud->fields('no_pedido','fecha_pedido','fecha_entrega','id_proveedor','id_producto','cantidad_solicitada','costo_total','id_almacen','orden_prod','orden_compra','precio_unitario');
			
			$crud->required_fields('fecha_pedido','fecha_entrega','id_proveedor','id_producto','cantidad_solicitada','costo_total','id_almacen','orden_prod');
				
			$crud->add_action('Confirmar Pedido', '', 'comprador/confirmar_pedido','ui-icon-check');
			
			$crud->set_relation('id_almacen','almacen','nombre_almacen');
			
			$crud->callback_column('estado_solicitado',array($this,'mostrar_estado'));
			
			$crud->callback_add_field('costo_total', function () {
             return 'USD <input type="text" maxlength="50" value="" name="costo_total">';
             });
			$crud->callback_edit_field('costo_total', function () {
             return 'USD <input type="text" maxlength="50" value="" name="costo_total">';
             });
			
			$crud->callback_column('cantidad_solicitada',array($this,'mostrar_boton_dividir'));
			$crud->callback_column('fecha_entrega',array($this,'mostrar_estado_pendiente'));
			
			$crud->callback_add_field('cantidad_solicitada',function () {
			return '<input type="text" maxlength="50" value="" name="cantidad_solicitada"> <span style="font-size: 1em;" class="" id="descripcion"></span>';
			});
			/*$crud->callback_add_field('no_pedido', function (){
				$dato['parametro'] = $this->modelogeneral->getValorInicialPedido();  
				$valor_pedido = $dato['parametro']->valor+1;
			    $i = 8;
			    $n_pedido= str_pad($valor_pedido, $i, 0, STR_PAD_LEFT);
			    $html="<input type= 'hidden'  value='".$n_pedido."'  name='no_pedido'>";
		     return  "<strong>".$n_pedido."</strong>".$html; 
			
			});*/
			$crud->callback_before_insert(array($this,'buscar_no_pedido'));

		    $crud->callback_before_delete(array($this,'pedido_before_delete'));




    ///---------------editar-------------------------------------------
			//$crud->callback_edit_field('destino',array($this,'mostrar_destino'));
			
			$crud->callback_edit_field('cantidad_solicitada',function () {
			return '<input type="text" maxlength="50" value="" name="cantidad_solicitada"> <span style="font-size: 1em;" class="" id="descripcion"></span>';
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
			$output->titulo ="Crear Pedido";
			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Administrar Pedido';
		    $output->widgets ="no";


			$this->_example_output($output);
	}

	public function pedido_before_delete($primary_key)
	{
		$this->modelogeneral->eliminar_almacen_pedido($primary_key);
	}

	
	public function buscar_no_pedido($post_array)
	{
	$dato['parametro'] = $this->modelogeneral->getValorInicialPedido();  
	$valor_pedido = $dato['parametro']->valor+1;
	$i = 8;
	$post_array['no_pedido'] = str_pad($valor_pedido, $i, 0, STR_PAD_LEFT);

	return $post_array;		    
    }



	function mostrar_destino()
	{
     return '<input type="radio" name="destino" value="1" /> Cliente
             <input type="radio" name="destino" value="0" /> Almacen
            ';
    }

   
	 //--------------armado de paquetes-----------------
	  public function paquete()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');

			$crud->where('estado_pac_entransito','0');
			$crud->set_table('paquete');

			$crud->set_subject('Pedidos Facturados');

			$crud->field_type('estado_pac_entransito','hidden');
			
			$crud->unset_read();

			$crud->field_type('via_transporte','dropdown', array('terrestre' => 'Terrestre','aereo' => 'Aereo','local' => 'Local'));
			
			$crud->columns('no_factura',
				           'lista_pedido',
			               'peso_total',
			               'fecha_tope_pago_fact',
			               'via_transporte'
			               );

			$crud->callback_column('peso_total',array($this,'mostrar_kg'));

		    $crud->fields('no_factura','lista_pedido','factura_doc','paquin_list','via_transporte');
			
			$crud->required_fields('via_transporte');             
			$crud->set_rules('no_factura', 'No. Factura','min_length[4]|max_length[20]|required');
			
			$crud->display_as('no_factura','No.Factura Proveedor');
			$crud->display_as('factura_doc','Respaldo de Factura');
			$crud->display_as('paquin_list','Paquin List');
			$crud->display_as('via_transporte','Vía de Transporte');
			$crud->display_as('fecha_tope_pago_fact','Fecha Tope de Pago');
			$crud->display_as('lista_pedido','Listado Productos');
			$crud->display_as('costo_transp_ext','Costo Transporte Externo');
			
			$crud->set_field_upload('factura_doc','assets/uploads/respaldos');
			$crud->set_field_upload('paquin_list','assets/uploads/respaldos');
			
			$crud->set_relation_n_n('lista_pedido', 'paq_ped_prov', 'pedido_proveedor', 'id_paquete', 'id_pedido_prov','{nombre_producto} - {cantidad_solicitada}','prioridad','estado_solicitado = 0 AND estado_transito = 0');
			
			$crud->callback_after_insert(array($this,'actualizar_pedido_transito'));

			$crud->callback_before_delete(array($this,'paquete_before_delete'));
			

			$output = $crud->render();
			$output->breadcrum = array('index'=>'Inicio');
		    $output->breadcrum_actual = 'Armar Factura de Envio';
		    $output->widgets ="no";


			$this->_example_output($output);
	}

	public function paquete_before_delete($primary_key)
	{
		$result= $this->modelogeneral->listar_paquete_pedidos($primary_key);
		
		foreach ($result as $value): 
		        $this->modelogeneral->eliminar_almacen_pedido($value->id_pedido_prov);	
		
		endforeach;
		
	}

    
    //---------------llenar campo fecha--------------------

    
	//---------------------------------------------------
	function actualizar_pedido_transito($post_array,$primary_key)
	{
	    $suma_peso_total = 0;
		$result = $this->modelogeneral->listar_paquete_pedidos($primary_key);
        foreach ($result as  $value):
	        $this->modelogeneral->update_pedido_transito($value->id_pedido_prov);

	        $datos['parametro_pedido'] = $this->modelogeneral->tomar_producto($value->id_pedido_prov);
	        $datos['parametro_producto'] = $this->modelogeneral->devolver_nombre_Producto($datos['parametro_pedido']->id_producto);
	        $peso_total = $datos['parametro_pedido']->cantidad_solicitada * $datos['parametro_producto']->peso_neto;
	        $suma_peso_total += $peso_total;

	        $datos['parametro_proveedor'] = $this->modelogeneral->datos_proveedor($datos['parametro_pedido']->id_proveedor);
	        $dias_pago = $datos['parametro_proveedor']->tiemp_pag_facts;
	        $fecha_entrega = $datos['parametro_pedido']->fecha_entrega;

	        $fecha_tope_pago_fact = date("Y-m-d", strtotime("$fecha_entrega +$dias_pago day"));

	    endforeach ;
                
        $this->modelogeneral->update_peso_total($primary_key,$suma_peso_total,$fecha_tope_pago_fact);
   
       
    return true;
	}

	//----------------asignar transporte-------------
	public function transporte()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }		
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->where('estado_transito','1');
		$crud->set_table('transporte_externo');
		
		$crud->field_type('estado_transito','hidden');
        $crud->field_type('estado_entregado','hidden');
        $crud->field_type('estado_enaduana','hidden');
      	$crud->columns('fecha_salida_transporte','fecha_llegada_aduana','facturas_pedido','nombre_chofer','telefono_chofer','estado_transito');
		
		$crud->fields(  'fecha_salida_transporte',
						'fecha_llegada_aduana',
						'nombre_chofer',
						'telefono_chofer',
						'no_placa',
						'no_licencia',
						'contrato_transporte_ext'
				 	 );	

		$crud->display_as('fecha_salida_transporte','Fecha salida Transporte');
	    $crud->display_as('fecha_llegada_aduana','Fecha llegada Aduana Bol');
	    $crud->display_as('nombre_chofer','Nombre Chofer');
	    $crud->display_as('estado_transito','Estado');
	    $crud->display_as('telefono_chofer','Telefono Chofer');
	    $crud->display_as('contrato_transporte_ext','Contrato de Transporte');
        $crud->display_as('facturas_pedido','Lista Productos Facturados');
        $crud->display_as('factura_transporte_ext','Factura Transporte');
         $crud->display_as('no_placa','No. Placa');
         $crud->display_as('no_licencia','No.Licencia');

        $crud->unset_read();
        $crud->unset_print();
        $crud->unset_edit();
        
        $crud->set_field_upload('contrato_transporte_ext','assets/uploads/respaldos');
	    
	    $crud->callback_column('estado_transito',array($this,'mostrar_estado_transito'));
	    
	    $crud->required_fields('fecha_salida_transporte',
	                           'fecha_llegada_aduana',
	                           'nombre_chofer');

	    $crud->set_rules('telefono_chofer', 'Telefono', 'required|numeric|min_length[8]|integer');
	    			
		$crud->set_relation_n_n('facturas_pedido', 'paquete_trans_ext', 'paquete', 'id_transporte_ext', 'id_paquete', 'no_factura','prioridad','estado_pac_entransito = 0 AND via_transporte= "terrestre"');
		
		$crud->add_action('Asignar Facturas', '', '','ui-icon-plus',array($this,'asignar_paquete'));
		$crud->add_action('Confirmar Aduana', '', 'comprador/confirmar_Aduana','ui-icon-check');
		
		$crud->callback_column('fecha_salida_transporte',array($this,'cambio_llegadaAduana'));
		$crud->callback_column('facturas_pedido',array($this,'ver_detalleFactura'));
		
		

		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
		$output->breadcrum_actual = 'Asignar Transporte';
		$output->widgets ="no";
		 
		$this->_example_output($output);
	}

	function just_a_test($primary_key , $row){
		if (isset($row->facturas_pedido)){
			echo "<script>alert('Debe seleccionar una factura antes de confirmar Aduana')</script>";
		}else{
			return site_url('comprador/confirmar_Aduana').'/'.$primary_key;		
		    }

	}

	function ver_detalleFactura($value, $row)
		{
		 return "<div class='form-group'>
		 		        <div class='row'>
		 		        <br>
			 	          <div class='col-md-6'>
			                 <span style='font-size: 1em;' class=''><strong>".$value."</strong></span> 
 			              </div> 
	                      <div class='col-md-6'>
	                         <button class='btn btn-default btn-sm' onclick='mostrar_detalle(".$row->id_transporte_ext.")' title='Ver Detalles'><i class='fa fa-eye'></i>
	                         </button>
		                  </div> 		
	                    </div> 
	                 </div>
	                </div>";
		}

		/*----------editar fecha de llegada aduana y salida aduana ---------*/
		function cambio_llegadaAduana($value, $row)
		{
		
		$value =    date("d/m/Y",strtotime($value));
			 
			  return "<div class='form-group'>
		 		        <div class='row'>
		 		        <br>
			 	          <div class='col-md-6'>
			                 <span style='font-size: 1em;' class=''><strong>".$value."</strong></span> 
 			              </div> 
	                      <div class='col-md-6'>
	                         <button class='btn btn-info btn-sm' onclick='modif_fechaTransporte(".$row->id_transporte_ext.")' title='Cambiar Fecha salida Transporte'><i class='fa fa-calendar'></i>
	                         </button>
		                  </div> 		
	                    </div> 
	                 </div>
	                </div>";

           }

	function asignar_paquete($primary_key , $row)
	{
	return site_url('comprador/asignar_facturas/').'/'.$primary_key.'/add';
	}

	//------------------transporte en key---------------
	public function mercaderia_key()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }

		$crud = new grocery_CRUD();
		//bootstrap
		//flexigrid

		$crud->set_theme('datatables');

		$crud->where('estado_entregado','1');
		$crud->where('costos_aprobados','0');
		$crud->set_table('paquete');

		$crud->display_as('fecha_key','Fecha llegada Key');
		$crud->display_as('lista_pedido','Listado de Productos');
		$crud->display_as('respaldo_costoaereo','Respaldo Costo Aereo');

		$crud->display_as('no_recibo_adext','No.Recibo Aduana Perú');
		$crud->display_as('costo_aduana_ext','Monto Aduana-Perú');

		
		$crud->display_as('no_poliza','No. Poliza Bolivia');
        $crud->display_as('monto_poliza','Monto Poliza');
		$crud->display_as('respaldo_poliza','Respaldo de Poliza');
		
		
		$crud->display_as('dui','DUI');
		
		$crud->display_as('no_factura_traint','No.Factura Transporte Bolivia');
	    $crud->display_as('costo_transporte_bol','Monto Transporte-Bolivia');
		$crud->display_as('factura_transporte_int','Respaldo Factura Transporte Bolivia');
	
		$crud->display_as('otros_gastos','Otros Gastos-Bolivia');
		
		$crud->display_as('fecha_tope_pago_fact','Fecha Tope de Pago');	
		$crud->display_as('costo_articulo','Total Gastos');	
		
		$crud->field_type('estado_entregado','hidden');
		$crud->field_type('estado_pac_entransito','hidden');
		$crud->field_type('estado_pagado','hidden');
		$crud->field_type('via_transporte','hidden');

    	$crud->set_rules('fecha_key','Fecha Key','required');
		
		$crud->columns( 'no_factura',
				        'lista_pedido',
			            'costo_articulo',
			            'via_transporte'
			            );

		$crud->edit_fields('fecha_key',
			               'lista_pedido',
			               'costo_aereo',
			               'respaldo_costoaereo',
			               
			               'no_recibo_adext',
			               'costo_aduana_ext',
			               'dui',
			               
			               'no_poliza',
			               'monto_poliza',
			               'respaldo_poliza',
			               
			               'no_factura_traint', 
			               'costo_transporte_bol',
			               'factura_transporte_int',
			               'otros_gastos',
			               'via_transporte'
			               );


		$crud->add_action('Aprobar Costos', '', 'comprador/aprobar_costo','ui-icon-check');
		$crud->set_field_upload('respaldo_costoaereo','assets/uploads/respaldos');
		$crud->set_field_upload('respaldo_poliza','assets/uploads/respaldos');
		$crud->set_field_upload('factura_transporte_ext','assets/uploads/respaldos');
	    $crud->set_field_upload('dui','assets/uploads/respaldos');
	    $crud->set_field_upload('factura_transporte_int','assets/uploads/respaldos');
		
		$crud->set_relation_n_n('lista_pedido', 'paq_ped_prov', 'pedido_proveedor', 'id_paquete', 'id_pedido_prov','{nombre_producto} - {cantidad_solicitada}','prioridad','estado_entregado = 1');
				
		$crud->callback_column('peso_total',array($this,'mostrar_kg'));
		$crud->callback_column('costo_articulo',array($this,'mostrar_costo_total'));

		$crud->callback_after_update(array($this,'agregar_infoTransporte'));
		
        $crud->unset_add(); 
		//$crud->unset_edit(); 
		//$crud->unset_bootstrap();
		$crud->unset_delete();
		$crud->unset_print();
		
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
		$output->breadcrum_actual = 'PVP neto';
		$output->widgets ="no";
		 
		$this->_example_output($output);
	}

	//-----------------------------Aprobar costos---------------------------

	function aprobar_costo($value)
	{

	 $dato['parametro']= $this->modelogeneral->mostrar_costo_totalpedido($value);
      if ($dato['parametro']->costo_total == 0) {
      	
      	 header( "refresh:0; url=../mercaderia_key" );
      	 echo "<script>alert('Debe completar los costos..')</script>";
      }else{
      	    $this->modelogeneral->aprobar_costos($value);
      	    redirect('comprador/mercaderia_key');
           }

	}

	//------------------productos_listo para entrar a almacen---------------

	public function mercaderia_aprobada()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }

		$crud = new grocery_CRUD();
		//bootstrap
		//flexigrid

		$crud->set_theme('datatables');

		$crud->where('costos_aprobados','1');
		$crud->set_table('paquete');

		$crud->display_as('fecha_key','Fecha llegada Key');
		$crud->display_as('lista_pedido','Listado de Productos');
		$crud->display_as('respaldo_costoaereo','Respaldo Costo Aereo');

		$crud->display_as('no_recibo_adext','No.Recibo Aduana Perú');
		$crud->display_as('costo_aduana_ext','Monto Aduana-Perú');

		
		$crud->display_as('no_poliza','No. Poliza Bolivia');
        $crud->display_as('monto_poliza','Monto Poliza');
		$crud->display_as('respaldo_poliza','Respaldo de Poliza');
		
		
		$crud->display_as('dui','DUI');
		
		$crud->display_as('no_factura_traint','No.Factura Transporte Bolivia');
	    $crud->display_as('costo_transporte_bol','Monto Transporte-Bolivia');
		$crud->display_as('factura_transporte_int','Respaldo Factura Transporte Bolivia');
	
		$crud->display_as('otros_gastos','Otros Gastos-Bolivia');
		
		$crud->display_as('fecha_tope_pago_fact','Fecha Tope de Pago');	
		$crud->display_as('costo_articulo','Total Gastos');	
		
		$crud->field_type('estado_entregado','hidden');
		$crud->field_type('estado_pac_entransito','hidden');
		$crud->field_type('estado_pagado','hidden');
		$crud->field_type('via_transporte','hidden');

    	$crud->set_rules('fecha_key','Fecha Key','required');
		
		$crud->columns( 'no_factura',
				        'lista_pedido',
			            'costo_articulo',
			            'via_transporte'
			            //'acciones'
			            );

		$crud->edit_fields('fecha_key',
			               'lista_pedido',
			               'costo_aereo',
			               'respaldo_costoaereo',
			               
			               'no_recibo_adext',
			               'costo_aduana_ext',
			               'dui',
			               
			               'no_poliza',
			               'monto_poliza',
			               'respaldo_poliza',
			               
			               'no_factura_traint', 
			               'costo_transporte_bol',
			               'factura_transporte_int',
			               'otros_gastos',
			               'via_transporte'
			               );


		$crud->set_field_upload('respaldo_costoaereo','assets/uploads/respaldos');
		$crud->set_field_upload('respaldo_poliza','assets/uploads/respaldos');
		$crud->set_field_upload('factura_transporte_ext','assets/uploads/respaldos');
	    $crud->set_field_upload('dui','assets/uploads/respaldos');
	    $crud->set_field_upload('factura_transporte_int','assets/uploads/respaldos');
		
		$crud->set_relation_n_n('lista_pedido', 'paq_ped_prov', 'pedido_proveedor', 'id_paquete', 'id_pedido_prov','{nombre_producto} - {cantidad_solicitada}','prioridad','estado_entregado = 1');
				
		//$crud->callback_column('via_transporte',array($this,'mostrar_boton_via_transp'));
		$crud->callback_column('peso_total',array($this,'mostrar_kg'));
		$crud->callback_column('costo_articulo',array($this,'mostrar_costo_total'));
		//$crud->callback_column('acciones',array($this,'mostrar_detalle_fact_aprobadas'));

		$crud->callback_after_update(array($this,'agregar_infoTransporte'));
		
        $crud->unset_add(); 
		$crud->unset_edit(); 
		$crud->unset_delete();
		$crud->unset_print();
		//$crud->unset_read(); 

		
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
		$output->breadcrum_actual = 'PVP neto Aprobado';
		$output->widgets ="no";
		 
		$this->_example_output($output);
	}

		//---------------------estado en aduana----------------------------
	function mostrar_detalle_fact_aprobadas($value, $row)
	{    
	    $html = "<div class='form-group'>
		 		        <div class='row'>
		 		        <br>
			 	          <div class='col-md-8'>
			                 <span style='font-size: 1em;' class=''><strong>".$value."</strong></span>
 			              </div> 
	                      <div class='col-md-4'>
	                         <button class='btn btn-default' onclick='mostrar_detalleFactAprob(".$row->id_paquete.")' title='Ver detalles'><i class='fa fa-eye'>Ver</i>
	                         </button>
		                  </div> 		
	                    </div> 
	                 </div>
	                </div>";

	     
	 return $html;
	}


	function agregar_infoTransporte($post_array,$primary_key)
		{
		  if ($post_array['via_transporte']=="terrestre")
		   {
		   	 $this->modelogeneral->comprobardatosTransBol($primary_key);
		   }

    	}

	function edit_field_costo_aereo($value, $primary_key)
		{

		 $dato_paqt['paquete'] = $this->modelogeneral->buscar_datos_paquete($primary_key);
         $via = $dato_paqt['paquete']->via_transporte;
          if ($via =="terrestre")
            {
           return '<input type="hidden" value="'.$value.'" name="costo_aereo" style="width:462px">
           				

           ';
                      	
            }else{
            	return '<input id="field-costo_aereo" class="form-control" name="costo_aereo" type="text" value="'.$value.'" maxlength="20">';


            }           
		
		}

		function edit_field_costo_terrestre($value, $primary_key)
		{
		 $dato_paqt['paquete'] = $this->modelogeneral->buscar_datos_paquete($primary_key);
         $via = $dato_paqt['paquete']->via_transporte;
          if ($via =="aereo")
            {
           return '<input type="text" value="'.$value.'"name="costo_transp_ext" style="width:462px" disabled="true" data-placeholder="No se puede ingresar datos">';
                      	
            }else{
            	return '<input id="field-costo_transp_ext" class="form-control" name="costo_transp_ext" type="text" value="'.$value.'" maxlength="20">';


            }           
		
		}


	//-------------------tranporte aereo-----------------

	public function transporte_aereo()
	{
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }
 		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('paquete');
		$crud->where('via_transporte','aereo');
		$crud->where('estado_pac_entransito','0');

		$crud->field_type('estado_entregado','hidden');
		$crud->field_type('estado_pac_entransito','hidden');

		$crud->display_as('fecha_tope_pago_fact','Fecha Tope de Pago');
		$crud->columns(    'no_factura',
				           'lista_pedido',
			               'via_transporte',
			               'acciones'
			               );
		$crud->unset_edit();
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_read();

		$crud->callback_column('no_factura',array($this,'mostrar_facturaAdjunta'));
		$crud->callback_column('peso_total',array($this,'mostrar_kg'));

		$crud->callback_column('acciones',array($this,'confirmar_ped_key'));
		
		$crud->set_relation_n_n('lista_pedido', 'paq_ped_prov', 'pedido_proveedor', 'id_paquete', 'id_pedido_prov','{nombre_producto} - {cantidad_solicitada}','prioridad','estado_entregado = 1');
     	
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Transporte Aereo';
	    $output->widgets ="no";
		$this->_example_output($output);
	}

	function confirmar_ped_key($value, $row)
		{

		return "<br>
		<div class='form-group'>
			 		 <div class='row'>
			 		  <div class='col-md-2'>
		             
		               </div> 
		              <div class='col-md-6'>
		               <button class='btn btn-default btn-sm' onclick='agregar_fechapedidoAereo(".$row->id_paquete.")' title='Confirmar entrega Key'><i class='fa fa-check'></i> Confirmar Entrega</button>
			          </div> 		
		            </div> 
		            </div>";
		}

/*-----------mostrar factura adjunta de transporte aereo----------*/	

	

function mostrar_facturaAdjunta($value, $row)
		{

		return "<a href= '../assets/uploads/respaldos/".$row->factura_doc."' target='_blank' title='Ver factura adjunta'>".$row->no_factura."</a>";
		}



//----------------------actualizar_paquetes con trasporte asignados--------------
	function actualizar_paquete_transito($post_array,$primary_key)
	{
    	$this->modelogeneral->update_transporte($post_array['id_paquete']);
    	$data =  array(
    		           'id_paquete'        => $post_array['id_paquete'],
    		           'id_transporte_ext' => $post_array['id_transporte_ext']
                       );

    	$this->modelogeneral->insertar_paqueteTranspExt($data);
    
    return true;
	}



	

	//-----------------------mercaderia_local-------------
	
	public function mercaderia_local()
	 {
		if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }
 		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('paquete');
		$crud->where('via_transporte','local');
		$crud->where('estado_pac_entransito','0');
		$crud->field_type('estado_entregado','hidden');
		$crud->field_type('estado_pac_entransito','hidden');

		$crud->display_as('fecha_tope_pago_fact','Fecha Tope de Pago');
		$crud->columns(    'no_factura',
				           'lista_pedido',
			               'peso_total',
			               'fecha_tope_pago_fact',
			               'via_transporte'
			               );
		$crud->unset_edit();
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_read();
    
    	$crud->callback_column('peso_total',array($this,'mostrar_kg'));

		$crud->set_relation_n_n('lista_pedido', 'paq_ped_prov', 'pedido_proveedor', 'id_paquete', 'id_pedido_prov','{nombre_producto} - {cantidad_solicitada}','prioridad','estado_entregado = 1');
        
        $crud->add_action('Finalizar Pedido', '', 'comprador/finalizar_pedido_local','ui-icon-check');
		
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio');
	    $output->breadcrum_actual = 'Transporte Local';
	    $output->widgets ="no";
		$this->_example_output($output);
	}


	//------------------transporte en aduana---------------
	public function transporte_aduana()
	{
		
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->where('estado_enaduana','1');
		$crud->set_table('transporte_externo');
		$crud->field_type('fecha_salida_transporte','hidden');
		$crud->field_type('telefono_chofer','hidden');
		$crud->field_type('factura_transporte_ext','hidden');
		$crud->field_type('contrato_transporte_ext','hidden');
		$crud->field_type('nombre_chofer','hidden');
		$crud->field_type('estado_transito','hidden');
        $crud->field_type('estado_entregado','hidden');
        $crud->field_type('estado_enaduana','hidden');

        $crud->display_as('fecha_llegada_aduana','Fecha llegada Aduana');
		$crud->display_as('factura_transporte_int','Factura Transporte interno(Bolivia)');
		$crud->display_as('estado_enaduana','Estado');


		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_read();
		$crud->unset_delete();

		$crud->columns('fecha_llegada_aduana','facturas_pedido','estado_enaduana','acciones');
		
		$crud->set_relation_n_n('facturas_pedido', 'paquete_trans_ext', 'paquete', 'id_transporte_ext', 'id_paquete', 'no_factura','prioridad','estado_pac_entransito = 1');
		
		
		
		$crud->callback_column('facturas_pedido',array($this,'mostrar_facturas_pedido'));
		$crud->callback_column('estado_enaduana',array($this,'mostrar_estado_aduana'));
		$crud->callback_column('acciones',array($this,'confirmar_ped_keyTerrestre'));
	    
	          
		$output = $crud->render();
		$output->breadcrum = array('transporte'=>'Transporte' );
		$output->breadcrum_actual = 'Transporte en Aduana';
		$output->widgets ="no";
		 
		$this->_example_output($output);
	}



	function confirmar_ped_keyTerrestre($value, $row)
		{

		return "
		       <div class='form-group'>
			 		 <div class='row'>
			 		  <div class='col-md-2'>
		             
		              </div> 
		              <div class='col-md-6'>
		               <button class='btn btn-default btn-sm' onclick='agregar_fechapedidoTerrestre(".$row->id_transporte_ext.")' title='Confirmar Salida Aduana'><i class='fa fa-check'></i> Confirmar Salida Aduana</button>
			          </div> 		
		            </div> 
		        </div>";
		}

	
   //------------mostrar costo unitario-----------------------
	public function datosproducto()
	{
	 $result = $this->modelogeneral->datosproducto();
	 echo json_encode($result);
	}

	//------------mostrar datos de un pedido-----------------------
	public function datospedidos_prov()
	{
	 $result = $this->modelogeneral->datospedidos_prov();
	 echo json_encode($result);
	}

	public function editpedido_prove(){
		$result = $this->modelogeneral->editpedido_prove();
		echo json_encode($result);
	}


	public function showtranp(){
		$result = $this->modelogeneral->showtranp();
		echo json_encode($result);
	}

	/*----------------mostrar detalle de facutras aprobadas------------------------*/
	public function Detalles_factAprob(){
		$result = $this->modelogeneral->showtranp();
		echo json_encode($result);
	}

	//-------------------muestra las facturas para el transporte-------------

	public function mostrar_detalleFacturaTransporte(){
		$result = $this->modelogeneral->showdatosfacturasTransporte();// showdatosfacturasTransporte get_Facturas_Transporte
		echo json_encode($result);
	}
	//-------------------muestra las facturas para el transporte-------------

	public function mostrar_productos_Factura(){
		$id = $this->input->get('id_paquete');
		$result = $this->modelogeneral->mostrar_productos_Factura($id);//devuelve el resul de productos
		echo json_encode($result);
	}
	



	//---------mostrar detalle de facturas de  liquidacion de aduana bolivia	
	public function showdatosfact(){
		$result = $this->modelogeneral->showdatosfact();
		echo json_encode($result);
	}

	


	//---------mostrar detalle de facturas de  transporte Peru	
	public function showdatosfactPeru(){
		$result = $this->modelogeneral->showdatosfactPeru();
		echo json_encode($result);
	}

	

	//---------------editpedido_terrestre----------
	public function editpedido_terrestre(){
		$result = $this->modelogeneral->editpedido_terrestre();
		echo json_encode($result);
	}


	public function updateFechaPedidoTerrestre(){
		$result = $this->modelogeneral->updateFechaPedidoTerrestre();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

//-----------------pago de facturas Transporte Peru--------------
	public function update_PagofacTrasPeru()
	{
		$result = $this->modelogeneral->update_PagofacTrasPeru();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function update_PagofacAduaPeru()
	{
		$result = $this->modelogeneral->update_PagofacAduaPeru();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

		public function update_PagofacAduaBol()
	{
		$result = $this->modelogeneral->update_PagofacAduaBol();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

		public function update_PagofacTransBol()
	{
		$result = $this->modelogeneral->update_PagofacTransBol();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}



	


	public function update_Pagofacturas(){
		$result = $this->modelogeneral->update_Pagofacturas();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}



	



	



    //-------------editar paquete aereo------------------------
	
	public function editpedido_aereo(){
		$result = $this->modelogeneral->editpedido_aereo();
		echo json_encode($result);
	}

	public function updateFechaPedidoAereo(){
		$result = $this->modelogeneral->updateFechaPedidoAereo();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	//-----------------------------------

	public function updatePedido_prove(){
		$result = $this->modelogeneral->updatePedido_prove();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function updateFechaPedido_prove(){
		$result = $this->modelogeneral->updateFechaPedido_prove();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	/*-------------------------------------------------------------*/
	public function editTransporte(){
		$result = $this->modelogeneral->editTransporte();
		echo json_encode($result);
	}

	/*----------------actualizar fecha de salida Transporte---------------------*/

	public function updateFechaTransporte(){

		$result = $this->modelogeneral->updateFechaTransporte();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}


	
//--------editar costo aereo--------------
	public function editcosto_aereo(){
		$result = $this->modelogeneral->editcosto_aereo();
		echo json_encode($result);
	}

//-----------actualizar costos aereos--------------
	public function updatecosto_aereo(){
        

        $config['upload_path'] = './assets/uploads/respaldos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload("respaldo_flete")) {
            $data['error'] = $this->upload->display_errors();
            
	    } 

		$result = $this->modelogeneral->updatecosto_aereo();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function subirImagen(){
		
		$config['upload_path'] = './assets/uploads/respaldos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload',$config);

        if (!$this->upload->do_upload("respaldo_flete")) {
            $data['error'] = $this->upload->display_errors();
	    } 
    }

	
	/*public function updatecosto_terrestre(){

		$result = $this->modelogeneral->updatecosto_terrestre();
		$msg['success'] = true;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}*/

	public function updatecosto_terrestre()
	{

		$dato = $this->input->post('respaldo_poliza');
		$result = $this->modelogeneral->updatecosto();
	
		$config['upload_path'] = './assets/uploads/respaldos/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload',$config);

        $dato['respaldo_poliza']= $this->upload->data('file_name'); 
        echo var_dump($dato['respaldo_poliza']);

          

        if (!$this->upload->do_upload("dui")) {
            $data['error'] = $this->upload->display_errors();
      
	   // $this->load->view('admin/fomulario',$data);
        }
        if (!$this->upload->do_upload("srt")) {
            $data['error'] = $this->upload->display_errors();
      
	   // $this->load->view('admin/fomulario',$data);
        }

        if (!$this->upload->do_upload("respaldo_poliza")) {
            $data['error'] = $this->upload->display_errors();
      
	   // $this->load->view('admin/fomulario',$data);
        } 

    }


  /*  function cargar_archivo() {

        $mi_archivo = 'mi_archivo';
        $config['upload_path'] = "uploads/";
        $config['file_name'] = "nombre_archivo";
        $config['allowed_types'] = "*";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();
    }*/

   

	//---------mostrar reporte pedidos entregados----------------

	public function showAllpedidosT(){
		$result = $this->modelogeneral->showAllpedidosT();
		echo json_encode($result);
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


  //---------------------confirmar_pedido------------------------------------

     public function confirmar_pedido($id)
    {
    
      $this->modelogeneral->update_pedido($id);
      redirect('comprador/pedido_proveedor');
          
    }


      //---------------------confirmar_entrega aerea-----------------------------------
     
      public function confir_entreg_aerea($id)
    {
      $this->modelogeneral->update_finalizar_pedido($id);
      $result= $this->modelogeneral->listar_paquete_transito_aereo($id);
      foreach ($result as  $value):
     
        $this->modelogeneral->update_fin_pedido_prov($value->id_pedido_prov);      
            
       endforeach ;   

      redirect('comprador/transporte_aereo');
          
    }
   
   
    //----------------------------finalizar_pedido------------------------
      public function finalizar_pedido($id)
    {
    
      $this->modelogeneral->finalizar_pedido($id);
      redirect('comprador/transporte_aduana');
          
    }

       public function finalizar_pedido_local($id)
    {
      $this->modelogeneral->update_finalizar_pedido($id);
      $result= $this->modelogeneral->listar_paquete_transito_aereo($id);
      foreach ($result as  $value):
     
        $this->modelogeneral->update_fin_pedido_prov($value->id_pedido_prov);      
            
       endforeach ;   

      redirect('comprador/mercaderia_local');
          
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
			   $value =    date("d/m/Y",strtotime($value));
			  return "<div class='form-group'>
		 		        <div class='row'>
		 		        <br>
			 	          <div class='col-md-6'>
			                 <span style='font-size: 1em;' class='label label-danger'><strong>".$value."</strong></span> 
 			              </div> 
	                      <div class='col-md-6'>
	                         <button class='btn btn-info btn-sm' onclick='modif_fechapedido(".$row->id_pedido_prov.")' title='Cambiar Fecha de Entrega'><i class='fa fa-calendar'></i>
	                         </button>
		                  </div> 		
	                    </div> 
	                 </div>
	                </div>";		
			 
			 }else{
			 	 $value =    date("d/m/Y",strtotime($value));
			 	 return "<div class='form-group'>
		 		        <div class='row'>
		 		        <br>
			 	          <div class='col-md-6'>
			                 <span style='font-size: 1em;' class=''><strong>".$value."</strong></span>
 			              </div> 
	                      <div class='col-md-6'>
	                         <button class='btn btn-info btn-sm' onclick='modif_fechapedido(".$row->id_pedido_prov.")' title='Cambiar Fecha de Entrega'><i class='fa fa-calendar'></i>
	                         </button>
		                  </div> 		
	                    </div> 
	                 </div>
	                </div>";
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
		               <button class='btn btn-success btn-sm' onclick='mostrar_formulario_costo(".$row->id_paquete.")' title='Agregar Costos'><i class='fa fa-truck'></i></button>
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

	function mostrar_estado_pagado($value, $row)
	{
	 if($value==1)
	  {
	   $html= "<span class='label label-success' style='font-size: 1em;'><strong>FACTURA PAGADA</strong></span>";
	  }else{
	  	$html= "<span class='label label-warning' style='font-size: 1em;'><strong>FACTURA PENDIENTE</strong></span>";
	  }

	return $html;
	}

	function mostrar_fecha_tope_pago_fact($value, $row)
	{
		$tiempo = $this->modelogeneral->valor_transp_ext();
        $fecha_actual = date("Y-m-d");

		
		 if($fecha_actual >= $value)
			 {
			 	$html= "<span class='label label-danger' style='font-size: 1em;'><strong>".$value."</strong></span>";
			 }
	 
	  	
	 

	return $html;
	}

//---------------------asignar_facturas------------------------------------
	public function asignar_facturas($id_transporte_ext)
	    {

	   if ($this->session->userdata('perfil') == false || $this->session->userdata('perfil') != 'comprador') {
            redirect(base_url() . 'login');
        }
   		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->where('id_transporte_ext',$id_transporte_ext);
		$crud->set_table('merca_transpoext');
		$crud->set_subject('Facturas');

        $crud->display_as('id_paquete','Facturas Proveedores');
		$crud->display_as('no_facturaText','No Factura Transporte Peru');
		$crud->display_as('monto_transpoext','Monto ');
		$crud->display_as('fact_respaldo','Respaldo Factura');

		$crud->field_type('id_transporte_ext','hidden',$id_transporte_ext);
		$crud->field_type('fecha_pago','hidden');
		$crud->field_type('estado_pago','hidden');
		$crud->field_type('observacion','hidden');
		
		
		$crud->columns('no_facturaText','id_paquete','monto_transpoext','fact_respaldo');
		

		$crud->unset_read();
		$crud->unset_print();

		
		$crud->required_fields('id_paquete','no_facturaText','monto_transpoext','fact_respaldo');
        
        $crud->set_rules('id_paquete','Facturas Proveedores','required');
		$crud->set_rules('no_facturaText','No Factura Transporte Peru','required|min_length[8]');
		$crud->set_rules('monto_transpoext','Monto','required|min_length[2]');
		
		$crud->add_action('Regresar al camion', '', '','ui-icon-arrowreturn-1-w',array($this,'regresar'));

		$crud->callback_after_insert(array($this,'actualizar_paquete_transito'));

		$crud->set_relation('id_paquete','paquete','no_factura',array('estado_pac_entransito' => '0','via_transporte' => 'terrestre'));
     
        $crud->set_field_upload('fact_respaldo','assets/uploads/respaldos');

         $crud->callback_field('monto_transpoext',array($this,'field_callback_monto'));
	   
			
		$output = $crud->render();
		$output->breadcrum = array('index'=>'Inicio','transporte'=>'Transporte');
	    $output->breadcrum_actual = 'Añadir Facturas';
	    $output->widgets ="no";
		$this->_example_output($output);
	}

		function field_callback_monto($value = '', $primary_key = null)
			{
			return '$ <input type="text" maxlength="50" value="'.$value.'" name="monto_transpoext" style="width:462px">';
			}


		function regresar($primary_key,$row)
		{
		return site_url('comprador/transporte');
		}

	//---------------------confirmar_llegadaAduana------------------------------------
    public function confirmar_Aduana($id_transporte_ext)
    {	
    	
       $this->modelogeneral->update_transito_aduana($id_transporte_ext);
     
       $resultado = $this->modelogeneral->listar_paquete_transito($id_transporte_ext);
       
        foreach($resultado as $value):
      	    $resultado_paquete = $this->modelogeneral->listar_paquete_pedidos($value->id_paquete);

      	   //-------------insetar merca_aduanaperu aduana Peru---------------
           $data = array( 
           	             'id_paquete'       => $value->id_paquete,
           	             'id_transporte_ext' => $id_transporte_ext
           	             );	 	

                $this->modelogeneral->insertar_merca_aduanaperu($data);  
         
             foreach($resultado_paquete as $values):
       			   
       		    $this->modelogeneral->update_pedido_aduana($values->id_pedido_prov);

             endforeach;
        endforeach;
    redirect('comprador/transporte');
          
    }



	
	function mostrar_costo_total($value, $row)
	{
	 $id_paquete=$row->id_paquete;
	 $dato['parametro']= $this->modelogeneral->mostrar_costo_totalpedido($id_paquete);
     return "$ ".$dato['parametro']->costo_total;
	}
	
	//---------------------estado en aduana----------------------------
	function mostrar_facturas_pedido($value, $row)
	{    
	    $html = "<div class='form-group'>
		 		        <div class='row'>
		 		        <br>
			 	          <div class='col-md-8'>
			                 <span style='font-size: 1em;' class=''><strong>".$value."</strong></span>
 			              </div> 
	                      <div class='col-md-4'>
	                         <button class='btn btn-default' onclick='mostrar_detalle(".$row->id_transporte_ext.")' title='Ver detalles'><i class='fa fa-eye'></i>
	                         </button>
		                  </div> 		
	                    </div> 
	                 </div>
	                </div>";

	     
	 return $html;
	}

	function mostrar_estado_aduana($value, $row)
	{
	  if($value==1)
	    {
	     $html= "<span class='label label-info' style='font-size: 1em;'><strong>Aduana</strong></span>";
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