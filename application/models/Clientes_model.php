<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {
	public function getClientes(){
		$this->db->select("c.*,tc.nombre as tipocliente, td.nombre as tipodocumento");
		$this->db->from("cliente c");
		$this->db->join("tipo_cliente tc", "c.tipo_cliente_id = tc.id");
		$this->db->join("tipo_documento td", "c.tipo_documento_id = td.id");
		$this->db->where("c.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getCliente($id){
		$this->db->where("id_cliente",$id);
		$resultado = $this->db->get("cliente");
		return $resultado->row();

	}

	/*buscar si exite el producto en la tabla almacen_clientes*/
	public function getAlmacen_Cliente($data){
		$this->db->where("id_cliente",$data['id_cliente']);
		$this->db->where("id_producto",$data['id_producto']);
		$this->db->where("id_almacen",$data['id_almacen']);
		$resultado = $this->db->get("almacen_clientes");
		if($resultado->num_rows() > 0){
            return $resultado->row();
          }else{
          return false;
          }
		
	}

	public function InsertAlmacen_clientes($data){
		return $this->db->insert("almacen_clientes",$data);
	}



	public function updateAlmacen_clientes($data){
		$this->db->where("id_cliente",$data['id_cliente']);
		$this->db->where("id_producto",$data['id_producto']);
		$this->db->where("id_almacen",$data['id_almacen']);
		return $this->db->update("almacen_clientes",$data);
	}

	public function InsertMovAl_cli($data){
		return $this->db->insert("movi_al_cli",$data);
	}


	

	/*---buscar el precio de venta a un cliente dado un producto---*/

	public function getPrecioCliente($id_cliente,$id_producto){
		$this->db->where("id_cliente",$id_cliente);
		$this->db->where("id_producto",$id_producto);
		$resultado = $this->db->get("precio_cliente");
		if($resultado->num_rows() > 0){
          return $resultado->row();
        }else{
          return false;
        }
		
	}

	/*------------seleccionar productos de clientes-----------*/

	public function getProdAlCli($id_cliente,$id_almacen){
		$this->db->where("id_cliente",$id_cliente);
		$this->db->where("id_almacen",$id_almacen);
		$this->db->join("producto p","alcli.id_producto = p.id_producto");
		$resultado = $this->db->get("almacen_clientes alcli");
		if($resultado->num_rows() > 0){
          return $resultado->result();
        }else{
          return false;
        }
		
	}

	public function getAgencias_cli($id_cliente){
		$this->db->where("id_cliente",$id_cliente);
		$resultado = $this->db->get("agencias");
		if($resultado->num_rows() > 0){
          return $resultado->result();
        }else{
          return false;
        }
		
	}

		public function getMovProdAlCli($dato){
		$this->db->where("id_cliente",$dato['id_cliente']);
		$this->db->where("mov.id_producto",$dato['id_producto']);
		$this->db->where("id_almacen",$dato['id_almacen']);
		$this->db->where("MONTH(fecha)",$dato['mes']);
		$this->db->join("producto p","p.id_producto = mov.id_producto");
		$resultado = $this->db->get("movi_al_cli mov");
		if($resultado->num_rows() > 0){
          return $resultado->result();
        }else{
          return false;
        }
		
	}
	public function allMovProdAlCli(){
		$this->db->join("producto p","mov.id_producto = p.id_producto");
		//$this->db->join("distribucion_guia dq","dq.id_cliente = mov.id_cliente");
		$resultado = $this->db->get("movi_al_cli mov");
		if($resultado->num_rows() > 0){
          return $resultado->result();
        }else{
          return false;
        }
		
	}


	



	public function updatePrecio_cliente($data){
		$this->db->where("id_cliente",$data['id_cliente']);
		$this->db->where("id_producto",$data['id_producto']);
		return $this->db->update("precio_cliente",$data);
	}


	/*-------*/
	public function save($data){
		return $this->db->insert("cliente",$data);
	}
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("cliente",$data);
	}

	public function getTipoClientes(){
		$resultados = $this->db->get("tipo_cliente");
		return $resultados->result();
	}

	public function getTipoDocumentos(){
		$resultados = $this->db->get("tipo_documento");
		return $resultados->result();
	}

	public function InsertPrecio_cliente($data){
		return $this->db->insert("precio_cliente",$data);
	}
}