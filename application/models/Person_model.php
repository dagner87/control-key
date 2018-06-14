

<?php

	require  __DIR__  .  ' /../autoload.php ' ; 
	use  Mike42 \ Escpos \ PrintConnectors \ FilePrintConnector ; 
	use  Mike42 \ Escpos \ Printer ; 
	$connector  =  new  FilePrintConnector ( " php: //stdout " ); 
	$printer  =  nueva  impresora($conector); 
	$printer  -> text ( " Hello World! \n "); 
	$printer  -> cut ();
	$printer  -> close ();


defined('BASEPATH') OR exit('No direct script access allowed');

class Person_model extends CI_Model {

	var $table = 'cotizacion';
	var $column = array(
		                'id_producto',
						'nombre_empresa',
	 					'nit',
	 					'nombre_apellidos',
	 					'cargo',
	 					'correo',
	 					'direccion',
	 					'telefono_fijo',
	 					'celular',
	 					'mensaje',
	 					'fecha'
	 					
); //set column field database for order and search
	//var $order = array('id_usuario' => 'desc'); // es el id_usuario

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_by_id_productos($id)
	{
		$this->db->select('descripcion_producto');
		$this->db->from('producto');
		$this->db->where('id_producto',$id);
		$query = $this->db->get();

		return $query->row();
	}	


	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_usuario',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		
	$this->db->insert($this->table, $data);
	return $this->db->insert_id();
	
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	/*public function delete_by_id($id)
	{
		$this->db->where('id_usuario', $id);
		$this->db->delete($this->table);
	}*/


}


