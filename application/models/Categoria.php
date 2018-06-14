


<?php
class Categoria extends CI_Model {

	
	public function getCategoria($number_per_page)
	{


	$this->db->select('*');
    $this->db->from('categoria');  
    $this->db->join('home_categoria', 'categoria.id_categoria = home_categoria.id_categoria', 'inner');
    $this->db->limit($number_per_page,$this->uri->segment(3)); 
    return $query = $this->db->get();

	}


	public function num_post()
	{
		
       // me devuelve todos los datos de la tabla post dondeel nombre del post sea igual que el que le pasan por parametro.

	 $number= $this->db->query ("SELECT count(*) as number FROM home_categoria")->row()->number;

      return intval($number);
     
	}
	

	function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
   }




	//-------------------------------------------------------


	public function getProductosxCategorias($id_categoria='')
	{
		
       // me devuelve todos los datos de la tabla producto donde el id_categoria del post sea igual que el que le pasan por parametro.
    
     $this->db->select('*');    
     $this->db->from('producto'); 
     $this->db->where("id_categoria", $id_categoria);
    //$this->db->limit($number_per_page,$this->uri->segment(3));
     $query = $this->db->get();

    
	   return  $query;
		     	
  
	}



//----------------------------------------------------------------

		public function getProductos_asociados($id_categoria='')
	{
		
       // me devuelve todos los datos de la tabla producto donde el id_categoria del post sea igual que el que le pasan por parametro.
    
     $this->db->select('*');    
     $this->db->from('producto'); 
     $this->db->where("id_categoria", $id_categoria);
    
     $query = $this->db->get();

    
	   return  $query;
		     	
  
	}

	public function getAlmacen()
	{
	 //$id_almacen= 1;
	 
	 $this->db->select('*');    
     $this->db->from('almacen'); 
     //$this->db->where("id_almacen", $id_almacen);
     
     return $query = $this->db->get();
       
	}

	public function getProductos()
	{
	 $id_almacen= 2;// almacen Santa Cruz
	 
	 $this->db->select('*');    
     $this->db->from('producto'); 
     $this->db->where("id_almacen", $id_almacen);
     
     return $query = $this->db->get();
       
	}



	

//----------DEVUELVE TODOS LOS DATOS DE UN PRODUCTO ESPECIFICO------------------

	public function get_all_Producto($id_producto='')
	{
		
       // me devuelve todos los datos de la tabla producto donde el id_categoria del post sea igual que el que le pasan por parametro.
    
     $this->db->select('*');    
     $this->db->from('producto'); 
     $this->db->where("id_producto", $id_producto);
    
     $query = $this->db->get();

    
	   return  $query;
	
	}

//-------------------------------------------------------
	public function get_Productos($id_producto='')
	{
		
       // me devuelve todos los datos de la tabla producto donde el id_categoria del post sea igual que el que le pasan por parametro.
    
     $this->db->select('id_categoria');    
     $this->db->from('producto'); 
     $this->db->where("id_producto", $id_producto);
    
     $query = $this->db->get();
     $result = $query->result_array(); //added
   
     return $result;
    
	   
	
	}



//devuelve todos los datos de las categorias
	public function getCategorias()
	{
	 $id_almacen= 1;
	 
	 $this->db->select('*');    
     $this->db->from('categoria'); 
     $this->db->where("id_almacen", $id_almacen);
     
     return $query = $this->db->get();
       
	}

	public function get_Categorias()
	{
	 $id_almacen= 2;
	 
     $this->db->where("id_almacen", $id_almacen);
     $query = $this->db->get('categoria');

	 return $query->result();
       
	}

	//devuelve todos los datos de los Clientes
	public function getClientes()
	{

	 $this->db->select('*');    
     $this->db->from('cliente'); 
        
     return $query = $this->db->get();
       
	}

//---------------------
	public function getServicios()
	{

	 $this->db->select('*');    
     $this->db->from('servicios'); 
    // $this->db->where("id_categoria", $id_categoria);
     
     return $query = $this->db->get();
       
	}

	public function getServicioEspecico($id_servicio)
	{

	 $this->db->select('*');    
     $this->db->from('servicios'); 
     $this->db->where("id_servicio", $id_servicio);
     
     return $query = $this->db->get();
       
	}

//------------------------------

	public function getNombreCategoria($id_categoria='')
	{

	 $this->db->select('*');    
     $this->db->from('categoria'); 
     $this->db->where("id_categoria", $id_categoria);
     
     return $query = $this->db->get();
       
	}

public function getCantidadProductos($id_categoria='')
	{
		
	 $this->db->from('producto')-> where('id_categoria',$id_categoria);
     
     return $this->db->count_all_results();
       
	}


	public function num_productos($id_categoria='')
	{
		
	 $number= $this->db->query("SELECT  count(*) as number FROM producto where id_categoria = $id_categoria")->row()->number;
	 //$this->db-> where('id_categoria',$id_categoria);
     
     return intval($number);
       
	}
	



}


