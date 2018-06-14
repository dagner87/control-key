

<?php
class Usuario extends CI_Model {

	
	
	public function getUsuario($email = '')
	{
		
    // me devuelve todos los datos de la tabla usuario donde el nombre del email sea igual que el que le pasan por parametro.

     $result = $this->db->query(" SELECT * FROM usuario WHERE email = '".$email."' LIMIT 1 ");
     
         if ($result->num_rows() > 0) {
         	
             return	$result->row();
         
         }else{
                return null;
               }
     
	}

}


