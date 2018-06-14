
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_general extends CI_Controller {

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

        $data  = array(
			'categorias' => $this->modelogeneral->get_Categorias() 
		);
        
   		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin_general/v_admin_categorias",$data);
		$this->load->view("layouts/footer");
	}

	   public function editar_cat()
    {
  	    $id_categoria = $this->input->get('id');
		$resultado = $this->modelogeneral->editar_cat($id_categoria);
		echo json_encode($resultado);
	}


	


	//update categoria
	public function udpdateCat()
    {
    	 
    	$param['id_categoria']     = $this->input->post('id_categoria');
        $param['nombre_categoria'] = $this->input->post('nombre_categoria');
        $result = $this->modelogeneral->udpdateCat($param);
         $msg['success'] = false;
       if($result){
        $msg['success'] = true;
      }
      echo json_encode($msg);

    }

   /*-------------Admin productos-----------*/
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

        $data  = array(
			'productos' => $this->Productos_model->allProductos(), 
			'proveedores' => $this->modelogeneral->get_Proveedores(),
			'categorias' => $this->modelogeneral->get_Categorias() 
		);
        
   		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin_general/v_admin_productos",$data);
		$this->load->view("layouts/footer");
	}
   /*-----------------------------------------*/ 

   /*-------------Admin proveedores-----------*/
   	public function proveedores()
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

        $data  = array(
			'proveedores' => $this->Productos_model->allProveedores() 
		);
        
   		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin_general/v_admin_proveedores",$data);
		$this->load->view("layouts/footer");
	}
   /*-----------------------------------------*/ 

   /*-------------Admin clientes-----------*/
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

        $data  = array(
			'clientes'       => $this->modelogeneral->listarclientes(), 
			'tipo_documento' => $this->modelogeneral->listar_tipo_documento(), 
			'tipo_cliente' => $this->modelogeneral->listar_tipo_cliente() 
			

		);
        
   		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin_general/v_admin_clientes",$data);
		$this->load->view("layouts/footer");
	}

	//editar cliente

	public function editar_cli()
    {
  	    $id_cliente = $this->input->get('id');
		$resultado = $this->modelogeneral->editar_cli($id_cliente);
		echo json_encode($resultado);
	}

	//update cli
	public function udpdateCli()
    {
    	 
    	$param['id_cliente']    = $this->input->post('id_cliente');
        $param['nombre_cli']    = $this->input->post('nombre_cli');
        $param['numero']        = $this->input->post('numero');
        $param['contacto']      = $this->input->post('contacto');
        $param['correo']        = $this->input->post('correo');
        $param['telefono_cli']  = $this->input->post('telefono_cli');
        $param['direccion_cli'] = $this->input->post('direccion_cli');
        $result = $this->modelogeneral->udpdateCli($param);
         $msg['success'] = false;
       if($result){
        $msg['success'] = true;
      }
      echo json_encode($msg);

    }
   /*-----------------------------------------*/ 



    public function insert_cli()
    {
        $param['tipo_cliente_id']    = $this->input->post('tipo_cliente_id');
        $param['tipo_documento_id']  = $this->input->post('tipo_documento_id');
        $param['nombre_cli']         = $this->input->post('nombre_cli');
        $param['numero']             = $this->input->post('numero_cli');
        $param['contacto']           = $this->input->post('contacto');
        $param['correo']             = $this->input->post('correo');
        $param['telefono_cli']       = $this->input->post('telefono_cli');
        $param['direccion_cli']      = $this->input->post('direccion_cli');
        $param['estado']             = 1;
    
        $result = $this->modelogeneral->insert_cli($param);
	       $msg['comprobador'] = false;
	       if($result)
	         {
	           $msg['comprobador'] = TRUE;
	         }
	        echo json_encode($msg);
          
          
         } 


    public function insert_prov()
    {
        $param['nombre_prove']    = $this->input->post('nombre_prove');
        $param['direccion_prove'] = $this->input->post('direccion_prove');
        $param['telefono']        = $this->input->post('telefono');
        $param['tiemp_pag_facts'] = $this->input->post('tiemp_pag_facts');
        $param['comentario']      = $this->input->post('comentario');

        $result = $this->modelogeneral->insert_prov($param);
	       $msg['comprobador'] = false;
	       if($result)
	         {
	           $msg['comprobador'] = TRUE;
	         }
	        echo json_encode($msg);
    }   

    public function insert_cat()
    {
        $param['nombre_categoria']    = $this->input->post('nombre_categoria');
        $result = $this->modelogeneral->insert_cat($param);
	       $msg['comprobador'] = false;
	       if($result)
	         {
	           $msg['comprobador'] = TRUE;
	         }
	        echo json_encode($msg);
    }

     public function insert_prod()
    {
        $param['id_proveedor']     = $this->input->post('id_proveedor');
        $param['id_categoria']     = $this->input->post('id_categoria');
        $param['items']            = $this->input->post('items');
        $param['nombre_producto']  = $this->input->post('nombre_producto');
        $param['precio_unitario']  = $this->input->post('precio_unitario');
        $param['description']      = $this->input->post('description');
        $param['peso_neto']        = $this->input->post('peso_neto');
        
        $result = $this->modelogeneral->insert_prod($param);
	       $msg['comprobador'] = false;
	       if($result)
	         {
	           $msg['comprobador'] = TRUE;
	         }
	        echo json_encode($msg);
    }           
   

	





}