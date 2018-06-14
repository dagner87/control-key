<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

	public function getProductos(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos_stock p");
		$this->db->join("categorias c","p.id_categoria = c.id_categoria");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	
	public function getProducto($id_producto,$id_almacen){
		$this->db->where("id_producto",$id_producto);
		$this->db->where("id_almacen",$id_almacen);
		$resultado = $this->db->get("productos_stock");
		return $resultado->row();
	}
	public function save($data){
		return $this->db->insert("productos_stock",$data);
	}

	public function update_stock($id_producto,$data){
		$this->db->where("id_producto",$id_producto);
		$this->db->where("id_almacen",$data['id_almacen']);
		return $this->db->update("productos_stock",$data);
	}

	public function allProductos(){
		$resultados = $this->db->get('producto');
		return $resultados->result();
	}
	public function allProveedores(){
		$resultados = $this->db->get('proveedor');
		return $resultados->result();
	}

}