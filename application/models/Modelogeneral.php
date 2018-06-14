
<?php 
class Modelogeneral extends CI_Model {
  

  var $table = 'persons';
  var $column = array('firstname','lastname','gender','address','dob'); //set column field database for order and search
  var $order = array('id' => 'desc'); // default order 

	
  public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }


	public function get_categoria($id_categoria)
  	{
  		
       $this->db->where('id_categoria',$id_categoria); 
       $query = $this->db->get('categoria');
       
       return $query-> row(); 
       
  	}
//--------------obtener el precio unitario de los productos--------------
    public function datosproducto(){
        $id_producto = $this->input->get('id_producto');
        $this->db->where('id_producto', $id_producto);
        $query = $this->db->get('producto');
        if($query->num_rows() > 0){
          return $query->row();
        }else{
          return false;
        }
    } 

      public function devolver_usuarios($id) {
    
   $this->db->where('id_usuario',$id);
   $query = $this->db->get('usuario');
   
   return $query-> row();
  
   }



//--------------obtener los datos de un pedido--------------
    public function datospedidos_prov(){
        $id_pedido_prov = $this->input->get('id_pedido_prov');
        $this->db->where('id_pedido_prov', $id_pedido_prov);
        $query = $this->db->get('pedido_proveedor');
        if($query->num_rows() > 0){
          return $query->row();
        }else{
          return false;
        }
    }


  public function showtranp()
  {
    $id = $this->input->get('id_transporte_ext');
    $this->db->where('id_transporte_ext', $id);
    $query = $this->db->get('transporte_externo');

    if($query->num_rows() > 0){
      
       $mostarProductos= null;
       $result = $this->listar_paquete_transito($id);
       $collapse = "";
        foreach($result as  $value):
              //lista todos los paquete de la tabla paq_ped_prov dado el id_paquete
              $result_paquetepedido= $this->listar_paquete_pedidos($value->id_paquete);

              //devuelve la row con los datos  de la tabla paquete dado el id_paquete
              $row =$this->tomar_datosPaquete($value->id_paquete);
              $collapse ="collapse".$value->id_paquete;
              $mostarProductos .="<div class='box-header with-border'><h4 class='box-title'>";
              $mostarProductos.= "<a data-toggle='collapse' data-parent='#accordion' href='#".$collapse."'>
                            ".$row->no_factura."</a></h4>";
              $mostarProductos.="</div>";
              $mostarProductos.= "<div id='".$collapse."' class='panel-collapse collapse'>";
              $mostarProductos.= "<div class='box-body'>";
              $mostarProductos.= "<ul>";

             //recorro el resultado de la tabla paq_ped_prov      
            foreach ($result_paquetepedido as  $values):
                //saco los datos de la tabla producto y los devuelvo la row en  datos_producto
                $datos_producto = $this->tomar_producto($values->id_pedido_prov);
                $mostarProductos.= "<li><strong>Producto :".$datos_producto->nombre_producto."</strong></li>";
                $mostarProductos.= "<li><strong>Cantidad : ".$datos_producto->cantidad_solicitada."</strong></li>";
             endforeach ;
             $mostarProductos.= "</ul>";
             if($row->factura_doc != null){
                  $mostarProductos.= "<strong><a href='".base_url('assets/uploads/respaldos').'/'.$row->factura_doc."' target='_blank'> Ver Factura </a></strong></li>";
                  }
               
                $mostarProductos.= "</div>";
                $mostarProductos.= "</div>";

          endforeach ;
      return $mostarProductos;
       }else{
         return false;
       }
  }

    public function showtranp1()
  {
    $id = $this->input->get('id_transporte_ext');
    $this->db->where('id_transporte_ext', $id);
    $query = $this->db->get('transporte_externo');

    if($query->num_rows() > 0){
      
       $mostarProductos= null;
       $result = $this->listar_paquete_transito($id);
        foreach($result as  $value):
              //lista todos los paquete de la tabla paq_ped_prov dado el id_paquete
              $result_paquetepedido= $this->listar_paquete_pedidos($value->id_paquete);

              //devuelve la row con los datos  de la tabla paquete dado el id_paquete
              $row =$this->tomar_datosPaquete($value->id_paquete);

              if($row->factura_doc != null){

                $mostarProductos.= "<tr align='center' style='background: #eee;'><td colspan='2'>
              <strong><a href='".base_url('assets/uploads/respaldos').'/'.$row->factura_doc."' target='_blank'>".$row->no_factura."</a></strong></td></tr>";

              }else{
                $mostarProductos.= "<tr align='center' style='background: #eee;'><td colspan='2' >
              <strong>".$row->no_factura."</strong></td></tr>";
              }

              $mostarProductos.="<tr style='background: #eee;'>
                    <th><strong>Producto</strong></th>
                    <th><strong>Cantidad</strong></th>
                  </tr>
                  </thead>";
             //recorro el resultado de la tabla paq_ped_prov      
            foreach ($result_paquetepedido as  $values):
                //saco los datos de la tabla producto y los devuelvo la row en  datos_producto
                $datos_producto = $this->tomar_producto($values->id_pedido_prov);
                $mostarProductos.= "<tr><td>".$datos_producto->nombre_producto."</td>";
                $mostarProductos.= "<td>".$datos_producto->cantidad_solicitada."</td></tr>";
            endforeach ;
       endforeach ;

      return $mostarProductos;
       }else{
         return false;
       }
  }



  public function showdatosfact()
  {
    $id = $this->input->get('id_paquete');
    $this->db->where('id_paquete', $id);
    $query = $this->db->get('paquete');

    if($query->num_rows() > 0){
      
       $mostarProductos= null;
       $result_paquetepedido= $this->listar_paquete_pedidos($id);
        
        $row =$this->tomar_datosPaquete($id);
       
        $mostarProductos.= "<tr><td colspan=''>".$row->no_factura."</td>";
        if($row->factura_doc != null){
          $mostarProductos.= "<td colspan=''><a target='_blank' href='".base_url('assets/uploads/respaldos').'/'.$row->factura_doc."'> Ver</a></td></tr>";

         }else{

           $mostarProductos.= "<td colspan='' style='color:red'>No hay datos adjuntos</td></tr>";
         }
       
        $mostarProductos.= " <th><strong>Producto</strong></th>
          <th><strong>Cantidad</strong></th>";
        
          foreach ($result_paquetepedido as  $values):
                $datos_producto = $this->tomar_producto($values->id_pedido_prov);
                
                $mostarProductos.= "<tr><td>".$datos_producto->nombre_producto."</td>";
                $mostarProductos.= "<td>".$datos_producto->cantidad_solicitada."</td></tr>";
                
          endforeach ;
      
      return $mostarProductos;
       }else{
         return false;
       }
  } 

   public function showdatosfacturasTransporte()
  {
    $query_paq = $this->get_Facturas_Transporte();
    
       $mostarProductos= null;
       $collapse = "";
        foreach($query_paq as  $value):
              //lista todos los paquete de la tabla paq_ped_prov dado el id_paquete
              $result_paquetepedido= $this->listar_paquete_pedidos($value->id_paquete);

              //devuelve la row con los datos  de la tabla paquete dado el id_paquete
             // $row =$this->tomar_datosPaquete($value->id_paquete);
              $collapse ="collapse".$value->id_paquete;
              $mostarProductos .="<div class='box-header with-border'><h4 class='box-title'>";
              $mostarProductos.= "<a data-toggle='collapse' data-parent='#accordion' href='#".$collapse."'>
                            ".$value->no_factura."</a></h4>";
              $mostarProductos.="</div>";
              $mostarProductos.= "<div id='".$collapse."' class='panel-collapse collapse'>";
              $mostarProductos.= "<div class='box-body'>";
              $mostarProductos.= "<ul>";

             //recorro el resultado de la tabla paq_ped_prov      
            foreach ($result_paquetepedido as  $filas):
                //saco los datos de la tabla producto y los devuelvo la row en  datos_producto
                $datos_producto = $this->tomar_producto($filas->id_pedido_prov);
                $mostarProductos.= "<li><strong>Producto :".$datos_producto->nombre_producto."</strong></li>";
                $mostarProductos.= "<li><strong>Cantidad : ".$datos_producto->cantidad_solicitada."</strong></li>";
            endforeach ;
            $mostarProductos.= "</ul>"; 
           if($value->factura_doc != null){
              $mostarProductos.= "<strong><a href='".base_url('assets/uploads/respaldos').'/'.$value->factura_doc."' target='_blank'> Ver Factura </a></strong>";
            
               }

              $mostarProductos.= "</div>";
              $mostarProductos.= "</div>"; 

             
       endforeach ;
      // $mostarProductos.= "</div>";

      return $mostarProductos;
       
       
  }



   public function get_Facturas_Transporte()
      {
       // $this->db->join('paq_ped_prov as paq_ped','paq_ped.id_paquete= paquete.id_paquete', 'inner');
        //$this->db->join('pedido_proveedor as ped','ped.id_pedido_prov= paq_ped.id_pedido_prov','inner'); 
       $this->db->where('estado_pac_entransito', 0);
       $this->db->where('via_transporte', 'terrestre');
        $query = $this->db->get('paquete');
       return $query->result();
           
      }


   public function  mostrar_productos_Factura($id_paquete)
       {
        $this->db->join('paquete as pa','pa.id_paquete= ppp.id_paquete', 'inner');
        $this->db->join('pedido_proveedor  as pe','ppp.id_paquete= pe.id_paquete', 'inner');
        $this->db->where('ppp.id_paquete', $id_paquete);
        $query = $this->db->get('paq_ped_prov as ppp');
       return $query->result();
       }

   

 public function editpedido_prove(){
    $id = $this->input->get('id_pedido_prov');
    $this->db->where('id_pedido_prov', $id);
    $query = $this->db->get('pedido_proveedor');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  }
/*-----------------obtener datos Transporte externo------------*/
 
  public function editTransporte(){

    $id_transporte_ext = $this->input->get('id_transporte_ext');
    $this->db->where('id_transporte_ext', $id_transporte_ext);
    $query = $this->db->get('transporte_externo');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  }
 
  //---------------editpedido_terrestre----------
   public function editpedido_terrestre(){
    $id = $this->input->get('id_transporte_ext');
    $this->db->where('id_transporte_ext', $id);
    $query = $this->db->get('transporte_externo');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  }

 //------------------

   public function editpedido_aereo(){
    $id = $this->input->get('id_paquete');
    $this->db->where('id_paquete', $id);
    $query = $this->db->get('paquete');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  }



  public function datosproductos_post($id_producto){
      $this->db->where('id_producto', $id_producto);
      $query = $this->db->get('producto');
      
       return $query->row();
      
    }

     public function buscar_id_insertado()
     {
      $this->db->select('id_pedido_prov');
      $this->db->from('pedido_proveedor');
      $this->db->order_by("id_pedido_prov","DESC");
      $this->db->limit('1');
      $query = $this->db->get();

     return $query->row();
    }

     public function insertar_pedidoN($field_insertar){
      
      $this->db->insert('pedido_proveedor',$field_insertar);

      return true;
     }

     public function buscar_id($id)
     {
      $this->db->where('id_paquete', $id);
      $query = $this->db->get('costos_terreste');
      
       return $query->row();
     }
   
   //----------- devuelve los datos del paquete---------
     
    public function buscar_datos_paquete($id)
    {
      $this->db->where('id_paquete', $id);
      $query = $this->db->get('paquete');
      return $query->row();
      
    }

   ///-----------agregar costos terrestres-----------------------
   
   public function addcosto_terrestre(){
     
    
    $field = array(
        'id_paquete'           =>$this->input->post('id_paquete'),
        'costo_transp_ext'     =>$this->input->post('costo_transp_ext'),
        'costo_aduana_ext'     =>$this->input->post('costo_aduana_ext'),
        'costo_aduana_bol'     =>$this->input->post('costo_aduana_bol'),
        'costo_transporte_bol' =>$this->input->post('costo_transporte_bol'), 
        'costo_trans_bol_int'  =>$this->input->post('costo_trans_bol_int')
        );
      $this->db->insert('costos_terreste', $field);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }


  //------------------agregar costo aereo-----------------------
   public function addcosto_aereo(){
    $field = array(
        'id_paquete'   =>$this->input->post('id_paquete'),
        'costo_aereo'  =>$this->input->post('costo_aereo')
        );
      $this->db->insert('pedido_aereo', $field);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }
    

    public function editcosto_aereo(){
    $id = $this->input->get('id_paquete');
    $this->db->where('id_paquete', $id);
    $query = $this->db->get('paquete');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  }

    public function update_fact()
  {
    $id = $this->input->post('id_paquete');
    $observacion = $this->input->post('observacion');
    $field = array(
                  'fecha_pago_fact'=>$this->input->post('fecha_pago_fact'), 
                  'estado_pagado'  =>'1',
                  'observacion'  =>$observacion
                  
                  );
    $this->db->where('id_paquete', $id);
    $this->db->update('paquete', $field);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }


  
   //---------------actualizar costo aereo----------------
     
  public function updatecosto_aereo()
  {
    $id = $this->input->post('id_paquete');
    $field = array(
                  'fecha_key'            =>$this->input->post('fecha_key'), 
                  'costo_aereo'          =>$this->input->post('costo_aereo'),
                  'no_poliza'            =>$this->input->post('no_poliza'),
                  'respaldo_flete'       =>$this->input->post('respaldo_flete'),
                  'costo_trans_bol_int'  =>$this->input->post('costo_trans_bol_int')
                  );
    $this->db->where('id_paquete', $id);
    $this->db->update('paquete', $field);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }


//-------------------actualizar costos terrestres
  public function updatecosto_terrestre()
  {
    $id = $this->input->post('id_paquete');
    $field = array(
    'costo_transp_ext'     =>$this->input->post('costo_transp_ext'),
    'costo_aduana_ext'     =>$this->input->post('costo_aduana_ext'),
    'costo_aduana_bol'     =>$this->input->post('costo_aduana_bol'),
    'costo_transporte_bol' =>$this->input->post('costo_transporte_bol'), 
    'costo_trans_bol_int'  =>$this->input->post('costo_trans_bol_int'),
    'fecha_key'            =>$this->input->post('fecha_key'), 
    'respaldo_flete'       =>$this->input->post('respaldo_flete'),
    'no_poliza'            =>$this->input->post('no_poliza')
    
    );
    $this->db->where('id_paquete', $id);
    $this->db->update('paquete', $field);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

  public function updatecosto()
  {
    $id = $this->input->post('id_paquete');
    $field = array(
    'costo_transp_ext'     =>$this->input->post('costo_transp_ext'),
    'costo_aduana_ext'     =>$this->input->post('costo_aduana_ext'),
    'costo_aduana_bol'     =>$this->input->post('costo_aduana_bol'),
    'costo_transporte_bol' =>$this->input->post('costo_transporte_bol'), 
    'costo_trans_bol_int'  =>$this->input->post('costo_trans_bol_int'),
    'fecha_key'            =>$this->input->post('fecha_key'), 
    'respaldo_flete'       =>$this->input->post('respaldo_flete'),
    'no_poliza'            =>$this->input->post('no_poliza')
    
    );
    $this->db->where('id_paquete', $id);
    $this->db->update('paquete', $field);
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

//-------------------------update fecha de entrega--------------

   public function updateFechaPedido_prove(){
    $id_pedido_prov = $this->input->post('id_pedido_prov');
    $fecha_entrega  = $this->input->post('fecha_entrega');
    $observacion    = $this->input->post('observacion');
    
    
    $field = array(
     'fecha_entrega' =>$fecha_entrega,
     'observacion'   =>$observacion
    );
    
    $this->db->where('id_pedido_prov', $id_pedido_prov);
    $this->db->update('pedido_proveedor', $field);
     
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }


//-------------------------update fecha de salida Transporte--------------

   public function updateFechaTransporte(){

    $id_transporte_ext  = $this->input->post('id_transporte_ext');

    $field = array(
      'fecha_salida_transporte'  => $this->input->post('fecha_salida_transporte'),
      'fecha_llegada_aduana '    => $this->input->post('fecha_llegada_aduana'),
      'observacion_aduana'       => $this->input->post('observacion_aduana')
       );
    
    $this->db->where('id_transporte_ext', $id_transporte_ext);
    $this->db->update('transporte_externo', $field);
     
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }


//---------------------update_Pagofacturas--------------------

  public function update_Pagofacturas(){
    $id_paquete       = $this->input->post('id_paquete');
    $fecha_pago_fact  = $this->input->post('fecha_pago_fact');
    $parametro        = $this->input->post('parametro');
   
    $field = array(
     'fecha_pago'  => $fecha_pago_fact,
     'estado_pago' => 1
    );
    
    $this->db->where('id_paquete', $id_paquete);
    $this->db->where('parametro', $parametro);
    $this->db->update('tiempo_pago', $field);
     
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

//-----------------pago de facturas Transporte Peru--------------
  public function update_PagofacTrasPeru(){
    $id_mercatrans       = $this->input->post('id_mercatrans');
    $fecha_pago_fact  = $this->input->post('fecha_pago_fact');
    $observacion  = $this->input->post('observacion');
   
    $field = array(
     'fecha_pago'  => $fecha_pago_fact,
     'estado_pago' => 1,
     'observacion' => $observacion
     
    );
    
    $this->db->where('id_mercatrans', $id_mercatrans);
    $this->db->update('merca_transpoext', $field);
     
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }


    public function update_PagofacAduaPeru()
    {
  
    $id_mercperu       = $this->input->post('id_mercperu');
    $fecha_pago_fact  = $this->input->post('fecha_pago_fact');
    $observacion  = $this->input->post('observacion');

   
    $field = array(
     'fecha_pago'  => $fecha_pago_fact,
     'estado_pagoperu' => 1,
     'observacion_aduanaP' => $observacion
    );
    
    $this->db->where('id_mercperu',$id_mercperu);
    $this->db->update('merca_aduanaperu', $field);
     
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

  public function update_PagofacAduaBol()
   {
        $id_mercaduanabol       = $this->input->post('id_mercaduanabol');
        $fecha_pago_fact  = $this->input->post('fecha_pago_fact');
        $observacion  = $this->input->post('observacion');
       
        $field = array(
         'fecha_pago'  => $fecha_pago_fact,
         'estado_pago' => 1,
         'observacion_aduanaBol' => $observacion

        );
        
        $this->db->where('id_mercaduanabol',$id_mercaduanabol);
        $this->db->update('merca_aduanabol', $field);
         
        if($this->db->affected_rows() > 0){
      return true;
        }else{
          return false;
        }
   }

     public function update_PagofacTransBol()
   {
        $id_mercatransbol = $this->input->post('id_mercatransbol');
        $fecha_pago_fact  = $this->input->post('fecha_pago_fact');
        $observacion      = $this->input->post('observacion');
        
        $field = array(
         'fecha_pago'  => $fecha_pago_fact,
         'estado_pago' => 1,
         'observacion' => $observacion
        );
        
        $this->db->where('id_mercatransbol',$id_mercatransbol);
        $this->db->update('merca_trans_bol', $field);
         
        if($this->db->affected_rows() > 0){
      return true;
        }else{
          return false;
        }
   }



  

  




 //-----------------------updateFechaPedidoTerrestre-------
   public function updateFechaPedidoTerrestre()
   {
   
    $id_transporte_ext  = $this->input->post('id_transporte_ext');
    $fecha_llegadaAd    = $this->input->post('fecha_llegadaAd');
    $fecha_salidaAd     = $this->input->post('fecha_salidaAd');

    $parametro ="pago_aduana_bol";
    $dia_alerta['parametro']= $this->modelogeneral->valor_configuracion($parametro);
    $dia = $dia_alerta['parametro']->valor;
    $fecha_top_pago = date("Y-m-d", strtotime("$fecha_salidaAd + $dia day"));

    $this->modelogeneral->finalizar_pedido($id_transporte_ext);
   
    $result= $this->modelogeneral->listar_paquete_transito($id_transporte_ext);
     
    foreach ($result as  $value):

         $this->modelogeneral->update_fecha_PaquetesAduana($fecha_llegadaAd,$fecha_salidaAd,$value->id_paquete);
          
         $data = array('id_paquete' => $value->id_paquete);   
         $this->modelogeneral->insertar_merca_aduanabol($data); 
         
         $this->modelogeneral->update_finalizar_pedido($value->id_paquete);
      
         $result_paquete= $this->listar_paquete($value->id_paquete);
         foreach ($result_paquete as  $values):
         $this->modelogeneral->update_fin_pedido_prov($values->id_pedido_prov);
         endforeach ;
    endforeach ;
   }


  //-----------------------editar Paquete de pedido aereo-------
   public function updateFechaPedidoAereo()
   {
   
    $id      = $this->input->post('id_paquete');
    $fecha_llegadaAd = $this->input->post('fecha_llegadaAd');
    $fecha_salidaAd  = $this->input->post('fecha_salidaAd');
    
    $field = array(
     'fecha_llegadaAd'  => $fecha_llegadaAd,
     'fecha_salidaAd'   => $fecha_salidaAd
    );
    
    $this->db->where('id_paquete', $id);
    $this->db->update('paquete', $field);
     
    if($this->db->affected_rows() > 0){

      $this->modelogeneral->update_finalizar_pedido($id);
      $result= $this->modelogeneral->listar_paquete_transito_aereo($id);
      foreach ($result as  $value):
        $this->modelogeneral->update_fin_pedido_prov($value->id_pedido_prov);      
            
       endforeach ;   
      return true;
    }else{
      return false;
    }
  }


   //------------------------------------------------------------  
    

  public function updatePedido_prove(){

    $id_pedido_prov            = $this->input->post('id_pedido_prov');
    $id_producto               = $this->input->post('id_producto');
    $cantidad_solicitada       = $this->input->post('cantidad_solicitada');//modificada
    $no_pedido                 = $this->input->post('no_pedido');
    $fecha_pedido              = $this->input->post('fecha_pedido');
    $fecha_entrega             = $this->input->post('fecha_entrega');
    $id_proveedor              = $this->input->post('id_proveedor');
    $id_producto               = $this->input->post('id_producto');
    $nombre_producto           = $this->input->post('nombre_producto');
    $costo_total               = $this->input->post('costo_total');
    $precio_unitario           = $this->input->post('precio_unitario');
    $id_almacen                = $this->input->post('id_almacen');
    $cantidad_solicitada_resto = $this->input->post('cantidad_solicitada_resto');
    
   
    $costo_total_act = $precio_unitario * $cantidad_solicitada;
    $costo_total_resto = $precio_unitario * $cantidad_solicitada_resto;

    $field_insertar = array(
     'no_pedido'          =>$no_pedido,
     'fecha_pedido'       =>$fecha_pedido,
     'fecha_entrega'      =>$fecha_entrega,
     'id_proveedor'       =>$id_proveedor,
     'id_producto'        =>$id_producto,
     'nombre_producto'    =>$nombre_producto,
     'cantidad_solicitada'=>$cantidad_solicitada_resto,
     'costo_total'        =>$costo_total_resto,
     'precio_unitario'    =>$precio_unitario,     
     'id_almacen'         =>$id_almacen
    );
   
    $this->insertar_pedidoN($field_insertar);

    $dato['parametro'] = $this->buscar_id_insertado();
    $field_almacen = array( 'id_almacen'=> $id_almacen,
                    'id_pedido_prov'=> $dato['parametro']->id_pedido_prov
                  );
              $this->db->insert('almacen_pedido_prov',$field_almacen);         

    $field = array(
    'cantidad_solicitada'=> $cantidad_solicitada,
    'costo_total'=> $costo_total_act
    );

    $this->db->where('id_pedido_prov', $id_pedido_prov);
    $this->db->update('pedido_proveedor', $field);
     
    if($this->db->affected_rows() > 0){
      return true;
    }else{
      return false;
    }
  }
    


   public function insert_cli($param){
      $this->db->insert('cliente',$param);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }

  public function insert_prov($param){
    $this->db->insert('proveedor',$param);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }
  public function insert_cat($param){
    $this->db->insert('categoria',$param);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }

  public function insert_prod($param){
    $this->db->insert('producto',$param);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }
  








  public function getSucursal($id_cliente)
      {
       
         $this->db->where("id_cliente",$id_cliente);
         $query = $this->db->get('sucursal');

       return $query->result();
           
      } 


  public function getProductos_cliente($id_cliente)
      {
       
       
        $this->db->where("id_cliente",$id_cliente);
        $this->db->from('productoxcliente'); 
       // $this->db->order_by("cantidad_articulo", "asc"); 
        $this->db->join('producto','producto.id_producto = productoxcliente.id_producto', 'inner');
        $query = $this->db->get();
       return $query->result();
           
      } 

  public function get_productos($id_almacen)
      {
       
         $this->db->where("id_almacen", $id_almacen);
         $query = $this->db->get('producto');

       return $query->result();
           
      } 

  public function getProductosAll(){
    $resultados = $this->db->get("producto");
    return $resultados->result();
  } 
  

/*--------------guardar propuesta---------------*/

public function save_propuesta($data){
   $this->db->insert("propuesta",$data);
  }

public function lastID(){
    return $this->db->insert_id();
  }  

public function save_detallepropuesta($data){
    $this->db->insert("detalle_propuesta",$data);
  }


public function getPropuestas(){
    $this->db->select("pro.*,c.nombre_cli");
    $this->db->from("propuesta pro");
    $this->db->join("cliente c","pro.id_cliente = c.id_cliente");
    $resultados = $this->db->get();
    if ($resultados->num_rows() > 0) {
      return $resultados->result();
    }else
    {
      return false;
    }
  }

public function getdatosPropuesta($id){
    $this->db->select("pro.*,c.*");
    $this->db->from("propuesta pro");
    $this->db->join("cliente c","pro.id_cliente = c.id_cliente");
    $this->db->where("pro.id_propuesta",$id);
    $resultado = $this->db->get();
    return $resultado->row();
  }

public function getDetallePropuesta($id){
    $this->db->select("dt.*,p.items,p.nombre_producto");
    $this->db->from("detalle_propuesta dt");
    $this->db->join("producto p","dt.id_producto = p.id_producto");
    $this->db->where("dt.id_propuesta",$id);
    $resultados = $this->db->get();
    return $resultados->result();
  }  




public function Precio_cliente($data){
  
  $this->db->where("id_cliente",$data['id_cliente']);
  $this->db->where("id_producto",$data['id_producto']);
  $this->db->from("precio_cliente");
  $resultados = $this->db->get();
  if($resultados->num_rows() > 0){

      $this->db->where("id_cliente",$data['id_cliente']);
      $this->db->where("id_producto",$data['id_producto']);
      $this->db->set('precio_cli', $data["precio_cli"], FALSE);
      $this->db->update("precio_cliente");

    }else{
          $this->db->insert("precio_cliente",$data);
         }
}  


 public function listar_tipo_documento()
   {
    
     $query = $this->db->get('tipo_documento');
     return $query->result();
   }


public function listar_tipo_cliente()
   {
    
     $query = $this->db->get('tipo_cliente');
     return $query->result();
   }




  /*-------------fin guardar propuesta-------------*/   

   public function listarclientes()
   {
    
     $query = $this->db->get('cliente');
     return $query->result();
   }  
   
   public function listarproductos()
   {
    
     $query = $this->db->get('producto');
     return $query->result();
   }        


  public function get_almacen($id_almacen)
    {
      
       $this->db->where('id_almacen',$id_almacen);
       $query = $this->db->get('almacen');
       
       return $query-> row();
       
    }

   public function get_almacen_pedido_prov($id_pedido_prov)
    {
      
       $this->db->where('id_pedido_prov',$id_pedido_prov);
       $query = $this->db->get('almacen_pedido_prov');
       
       return $query-> row();
       
    }  



  public function get_existencia($id_producto)
    {
     $this->db->where('id_producto',$id_producto);
     $query = $this->db->get('existencia');
    
     return $query-> row();
    }

    public function count_Pentransito()
  {
    $this->db->from('pedido_proveedor');
    $this->db->where('estado_transito','1');
    return $this->db->count_all_results();
  }
    public function count_PenSolicitado()
  {
    $this->db->from('pedido_proveedor');
    $this->db->where('estado_solicitado','1');
    return $this->db->count_all_results();
  }
    public function count_PenAduana()
  {
    $this->db->from('pedido_proveedor');
    $this->db->where('estado_enaduana','1');
    return $this->db->count_all_results();
  }

    //-----------------count_entransito-----------------------   
 public function count_entransito()
  {
    $this->db->from('transporte_externo');
    $this->db->where('estado_transito','1');
    return $this->db->count_all_results();
  }

  
  //-----------------cantidad de pedidos completados-------------
   public function count_completado()
  {
    $this->db->from('paquete');
    $this->db->where('estado_entregado','1');
    return $this->db->count_all_results();
  }
   //-----------------cantidad de pedidos aduana-------------
    public function count_enaduana()
  {
    $this->db->from('transporte_externo');
    $this->db->where('estado_enaduana','1');
    return $this->db->count_all_results();
  }
    public function count_pendientes()
  {
    $fecha_actual= date('Y-m-d');
    $this->db->from('pedido_proveedor');
    $this->db->where('estado_solicitado','1');
    $this->db->where('fecha_entrega <=',$fecha_actual);
     return $this->db->count_all_results();
  }

 //----------------retornar pedidos pendientes------------
    public function pedidos_pendientes()
  {
    $fecha_actual= date('Y-m-d');
    $this->db->where('estado_solicitado','1');
    $this->db->where('fecha_entrega <=',$fecha_actual);
    $query = $this->db->get('pedido_proveedor');
    return $query->row();
  }
  
   public function mostrar_pedidos_pendientes()
  {
    $fecha_actual= date('Y-m-d');
    $this->db->where('estado_solicitado','1');
    $query = $this->db->get('pedido_proveedor');
    return $query->result();
  }
 //---------------mostrar pedido en transito-------
  public function mostrar_pedidos_transito()
  {
    
    $this->db->where('estado_transito','1');
    $query = $this->db->get('pedido_proveedor');
    return $query->result();
  }
  
  //-------mostrar_costo total del pedido--------
    public function mostrar_costo_totalpedido($id)
  {
  
    $query = $this->db->query("SELECT costo_aereo+costo_aduana_ext+monto_poliza+costo_transporte_bol+otros_gastos AS costo_total FROM paquete WHERE id_paquete=".$id."");
       
    return $query->row();
  }


  //-------seleccionar_nombre proveedor--------
    public function datos_proveedor($id)
  {
    $this->db->where('id_proveedor',$id);
    $query = $this->db->get('proveedor');
    return $query->row();
  }

//--mostrar todos los proveedores---------

  public function getProveedor(){
    $resultados = $this->db->get("proveedor");
    return $resultados->result();
  }


  //-------seleccionar_datos de tiempos pago de facturas--------
    public function datos_tiemposPagos($id_paquete,$parametro)
  {
    $this->db->where('id_paquete',$id_paquete);
    $this->db->where('parametro',$parametro);
    $query = $this->db->get('tiempo_pago');
    return $query->row();
  }

  //---------------mostrar reporte pedidos entregados-----

  public function showAllpedidosT(){
    $this->db->order_by('no_pedido','desc');
    $this->db->where('estado_entregado',1);
    $query = $this->db->get('pedido_proveedor');
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

   public function mostrar_pedidosEntregados($id_proveedor)
  {
    
    $this->db->where('estado_entregado','1');
    $this->db->where('id_proveedor',$id_proveedor);
    $query = $this->db->get('pedido_proveedor');
    return $query->result();
  }

  

   public function showPedidos_Sol(){
    $this->db->order_by('no_pedido','desc');
    $this->db->where('estado_solicitado',1);
    $query = $this->db->get('pedido_proveedor');
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }
  //--------muestra los pedidos en transito------------

   public function showPedidos_Transito(){
    $this->db->order_by('no_pedido','desc');
    $this->db->where('estado_transito',1);
    $query = $this->db->get('pedido_proveedor');
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

  public function showPedidos_Aduana(){
    $this->db->order_by('no_pedido','desc');
    $this->db->where('estado_enaduana',1);
    $query = $this->db->get('pedido_proveedor');
    if($query->num_rows() > 0){
      return $query->result();
    }else{
      return false;
    }
  }

   public function showPedidos_key()
   {
    $this->db->order_by('fecha_key','asc');
    //$this->db->where('estado_entregado',1);
    $this->db->where('estado_pagado',0);
    $query = $this->db->get('paquete');
     return $query->result();
    
  }

     public function showFacturasProvee_pagadas()
   {
    $this->db->order_by('fecha_key','asc');
    $this->db->where('estado_pagado',1);

    $query = $this->db->get('paquete');
     return $query->result();
    
  }

   public function showPedidos_keyTer()
   {
    $this->db->order_by('fecha_key','asc');
    $this->db->where('via_transporte','terrestre');
    $this->db->where('estado_entregado',1);
    $query = $this->db->get('paquete');
     return $query->result();
    
  }

 

   public function showFactTranExt()
   {
    //$this->db->order_by('fecha_salida_transporte','asc');
    $this->db->where('estado_pago',0);
    $query = $this->db->get('merca_transpoext');
  
    return $query->result();
  
  }
    public function FactTranExtPagada()
   {
    //$this->db->order_by('fecha_salida_transporte','asc');
    $this->db->where('estado_pago',1);
    $query = $this->db->get('merca_transpoext');
  
    return $query->result();
  
  }

    public function showFactAduPeru()
  {
    $this->db->select('*');
    $this->db->from('merca_aduanaperu');  
    $this->db->join('paquete','merca_aduanaperu.id_paquete= paquete.id_paquete', 'inner');
    $this->db->where('estado_pagoperu',0);
    $query = $this->db->get();

    return $query->result();
  }

  public function showFactPagadasAduPeru()
  {
    $this->db->select('*');
    $this->db->from('merca_aduanaperu');  
    $this->db->join('paquete','merca_aduanaperu.id_paquete= paquete.id_paquete', 'inner');
    $this->db->where('estado_pagoperu',1);
    $query = $this->db->get();

    return $query->result();
  }  
   

//---------------------------------------------------------
 public function showFactxPagarAduBol()
  {
    $this->db->select('*');
    $this->db->from('merca_aduanabol');  
    $this->db->join('paquete','merca_aduanabol.id_paquete= paquete.id_paquete', 'inner');
    $this->db->where('estado_pago',0);
    $query = $this->db->get();

    return $query->result();
  } 

///-------------facturas pagadas de aduana Bolivia------------
 
 public function showFactPagadasAduBol()
  {
    $this->db->select('*');
    $this->db->from('merca_aduanabol');  
    $this->db->join('paquete','merca_aduanabol.id_paquete= paquete.id_paquete', 'inner');
    $this->db->where('estado_pago',1);
    $query = $this->db->get();

    return $query->result();
  }  

//-------------------facturas de transporte bolivia------------

  //---------------------------------------------------------
 public function showFactxPagarTransBol()
  {
    $this->db->select('*');
    $this->db->from('merca_trans_bol');  
    $this->db->join('paquete','merca_trans_bol.id_paquete= paquete.id_paquete', 'inner');
    $this->db->where('estado_pago',0);
    $query = $this->db->get();

    return $query->result();
  } 

///-------------facturas pagadas de aduana Bolivia------------
 
 public function showFactPagadasTransBol()
  {
    $this->db->select('*');
    $this->db->from('merca_trans_bol');  
    $this->db->join('paquete','merca_trans_bol.id_paquete= paquete.id_paquete', 'inner');
    $this->db->where('estado_pago',1);
    $query = $this->db->get();

    return $query->result();
  } 


   public function comprobardatosTransBol($id_paquete){
    $this->db->where('id_paquete',$id_paquete);
    $query = $this->db->get('merca_trans_bol');
    if($query->num_rows() > 0){
     return false; 
    }else{

         $data = array('id_paquete' => $id_paquete);
         $this->db->insert('merca_trans_bol',$data);
      return true;
    }
  }

 public function TranExt($id_paquete)
   {
    
    $this->db->where('id_paquete',$id_paquete);
    $query = $this->db->get('merca_transpoext');
  
    return $query->row();
  
   }

  //-------------devolver_nombre Producto------------------

  public function devolver_nombre_Producto($id_producto)
    {
      $this->db->where('id_producto',$id_producto);
      $query = $this->db->get('producto');
     
     return $query-> row();
    
    }
  
   //-------------devuelve el valor de la ropuesta-------
  public function getValorInicialPropuesta()
  {
    $this->db->where('parametro','no_propuesta');
    $query = $this->db->get('configuracion');
    return $query->row();
 }   

  //-------------devuelve la fila no_inicial_pedido--------
  public function getValorInicialPedido()
  {
    $this->db->where('parametro','pedido_inicial');
    $query = $this->db->get('configuracion');
    return $query->row();
 }   

  //-------------devuelve la fila no_inicial_pedido--------
  public function valor_alerta_correos()
  {
    $this->db->where('parametro','alerta_correos');
    $query = $this->db->get('configuracion');
    return $query->row();
 } 

//-------------devuelve la fecha tope de transporte  peru--------
  public function valor_configuracion($parametro)
  {
    $this->db->where('parametro',$parametro);
    $query = $this->db->get('configuracion');
    return $query->row();
  } 

 
  //-------------devuelve la fecha tope de transporte--------
  public function valor_transp_ext()
  {
    $this->db->where('parametro','transp_peru');
    $query = $this->db->get('configuracion');
    return $query->row();
  } 

  public function aumentar_valor_no_propuesta($aumento)
    {
     $data = array('valor' => $aumento);
     $this->db->where('parametro','no_propuesta');
     $this->db->update('configuracion',$data);

    } 
    




//-------------aumentar el valor_pedido------------
  public function aumentar_valor_nopedido($aumento)
    {
     $data = array('valor' => $aumento);
     $this->db->where('parametro','pedido_inicial');
     $this->db->update('configuracion',$data);

    }

  public function update_pedido_cliente($id)
    {

     $data = array('estado_solicitado' => "0",
                   'estado_transito'   => "1",
                   'estado_entregado'  => "0"

                  );
     $this->db->where('id_pedido_cl',$id);
     $this->db->update('pedido_cliente',$data);
    
     }

  public function update_pedido($id)
    {

     $data = array('estado_solicitado'  => "0");
     $this->db->where('id_pedido_prov',$id);
     $this->db->update('pedido_proveedor',$data);
    }

  public function aprobar_costos($id)
    {
     $data = array('costos_aprobados'  => "1");
     $this->db->where('id_paquete',$id);
     $this->db->update('paquete',$data);

    $resul = $this->listar_paquete_pedidos($id);

    foreach ($resul as $key ) {
      $row = $this->tomar_producto($key->id_pedido_prov);
      $datos_prod = $this->devolver_nombre_Producto( $row->id_producto);
      $costo_total = $this->mostrar_costo_totalpedido($key->id_paquete);
      $rowid = $this->get_almacen_pedido_prov($key->id_pedido_prov);
      $costo_almacen = $costo_total / $row->cantidad_solicitada;
      $costo_alm = round($costo_almacen, 2);
      $field_insertar = array(
             'id_producto'    => $row->id_producto,
             'codigo'         => $datos_prod->items,
             'nombre'         => $row->nombre_producto,
             'precio_almacen' => $costo_alm,// es la suma de los gastos entre la cantidad de productos
             'stock'          => $row->cantidad_solicitada,
             'id_categoria'   => $datos_prod->id_categoria,
             'id_categoria'   => $datos_prod->id_categoria,
             'id_almacen'     => $rowid->id_almacen,
             'estado'         =>1

            );
          $this->db->insert('productos_stock',$field_insertar);
    }


    }   
 

  public function update_pedido_aduana($id_pedido_prov)
    {

     $data = array('estado_transito' => "2",'estado_enaduana' => "1");
     $this->db->where('id_pedido_prov',$id_pedido_prov);
     $this->db->update('pedido_proveedor',$data);
    
     }

   //--------------------devuelve la cantidad de facturas por asignarle transporte----------
   
    public function contar_mercad_factProveedor()
    {
      $this->db->where('estado_pac_entransito',0);
      $this->db->where('via_transporte','terrestre');

      $resultados = $this->db->get('paquete');

      return $resultados->num_rows();
    }  

   //----------------- LISTA TODOS LOS PAQUETES PROV------------
  public function listar_paquete_pedidos($id_paquete)
    {
       $this->db->where('id_paquete',$id_paquete);
       $query = $this->db->get('paq_ped_prov');
       
       return $query-> result();
       
    }


    public  function dias_transcurridos($fecha_i,$fecha_f)
      {
        $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias   = abs($dias); $dias = floor($dias);   
        return $dias;
      }


  public function listar_paquete_transito($id_transporte_ext)
    {
      
       $this->db->where('id_transporte_ext',$id_transporte_ext);
       $query = $this->db->get('paquete_trans_ext');
       
       return $query-> result();
       
    }

    public function listar_paquete_transito_aereo($id_paquete)
    {
      
       $this->db->where('id_paquete',$id_paquete);
       $query = $this->db->get('paq_ped_prov');
       
       return $query-> result();
       
    }



  
  public function insertar_cliente_pedido($id_cliente,$id_pedido_prov)
    {

     $data = array('id_cliente'      => $id_cliente,
                   'id_pedido_prov'  => $id_pedido_prov
                   );
     
     $this->db->insert('cliente_pedido_prov',$data);
    
     }

  public function insertar_almacen_pedido($id_almacen,$id_pedido_prov)
    {

     $data = array('id_almacen'      => $id_almacen,
                   'id_pedido_prov'  => $id_pedido_prov
                   );
     
     $this->db->insert('almacen_pedido_prov',$data);
    
     }

   public function eliminar_almacen_pedido($id_pedido_prov)
    {
      $this->db->where('id_pedido_prov', $id_pedido_prov);
      $this->db->delete('almacen_pedido_prov');
     if($this->db->affected_rows() > 0){
        return true;
       }else{
            return false;
            }
  }  
   

  //-----------------------update estado de transporte------------
   public function update_transporte($id_paquete)
  {

   $data = array('estado_pac_entransito'  => "1");
   $this->db->where('id_paquete',$id_paquete);
   $this->db->update('paquete',$data);
  
   }

   public function update_pedido_transito($id)
  {

   $data = array('estado_transito' => "1");
   $this->db->where('id_pedido_prov',$id);
   $this->db->update('pedido_proveedor',$data);
  
   }
   
    public function tomar_producto($id_pedido_prov)
  {

    $this->db->where('id_pedido_prov',$id_pedido_prov);
    $query = $this->db->get('pedido_proveedor');
     
   return $query-> row();
  
   }


  public function insertar_tiempoPago($data)
    {
 
     $this->db->insert('tiempo_pago',$data);
    
     }  
//-----------------insertar paquete transporte Externo(Peru)
  public function insertar_paqueteTranspExt($data)
    {
 
     $this->db->insert('paquete_trans_ext',$data);
    
     }  

//-----------------insertar Aduana(Peru)

   public function insertar_merca_aduanaperu($data)
    {
 
     $this->db->insert('merca_aduanaperu',$data);
    
     }

//----------------insertar aduana bolivia-------------
      public function insertar_merca_aduanabol($data)
    {
 
     $this->db->insert('merca_aduanabol',$data);
    
     }    
  


  //----------------listar datos de transporte--------
  public function buscar_paquete_transito($id_paquete)
   {
      
    $this->db->where('id_paquete',$id_paquete);
    $query = $this->db->get('paquete_trans_ext');
    
     return $query-> row();
       
   }
   //-----------------me da los datos de transito-----------
   public function buscar_dato_transito($id_transporte_ext)
   {
      
    $this->db->where('id_transporte_ext',$id_transporte_ext);
    $query = $this->db->get('transporte_externo');
     if($query->num_rows() > 0){
         return $query-> row();
       }else{
             return false;
            }
    }

//-------------toma los datos del paguete --------------
  public function tomar_datosPaquete($id_paquete)
  {
    $this->db->where('id_paquete',$id_paquete);
    $query = $this->db->get('paquete');
     return $query-> row();
   }


  //-------------toma los pedidos --------------
    public function tomar_pedido($id_pedido_prov)
  {
    $this->db->where('id_pedido_prov',$id_pedido_prov);
    $query = $this->db->get('paq_ped_prov');
     return $query-> row();
   }


/*-----------------devuelve  la row de pedidos------------------- */
     public function Get_pedido($id_pedido_prov)
  {

    $this->db->where('id_pedido_prov',$id_pedido_prov);
    $query = $this->db->get('pedido_proveedor');
     
   return $query-> result();
  
   }
   public function update_peso_total($id,$peso_total,$fecha_tope_pago_fact)
  {

   $data = array('peso_total' => $peso_total,
                 'fecha_tope_pago_fact' => $fecha_tope_pago_fact
                );
   $this->db->where('id_paquete',$id);
   $this->db->update('paquete',$data);
  
   }
   
   //---------------update_transito_aduana-------------
   public function update_transito_aduana($id_transporte_ext)
    {
     $data = array('estado_transito' => "0",'estado_enaduana' => "1");
     $this->db->where('id_transporte_ext',$id_transporte_ext);
     $this->db->update('transporte_externo',$data);
    }

//----------finalizar proceso de transito del pedido.--------------------------
   public function update_finalizar_pedido($id)
  {

   $data = array('estado_pac_entransito' => "2",'estado_entregado' => "1");
   $this->db->where('id_paquete',$id);
   $this->db->update('paquete',$data);
  
   }

     public function update_fecha_PaquetesAduana($fecha_llegadaAd,$fecha_salidaAd,$id)
  {

   $data = array('fecha_llegadaAd' => $fecha_llegadaAd,'fecha_salidaAd' => $fecha_salidaAd);
   $this->db->where('id_paquete',$id);
   $this->db->update('paquete',$data);
  
   }
//-------------listar paquetes pedidos proveedor para actualizar---
    public function listar_paquete($id_paquete)
  {
    
     $this->db->where('id_paquete',$id_paquete);
     $query = $this->db->get('paq_ped_prov');
     
     return $query-> result();
     
  }

   public function update_fin_pedido_prov($id_pedido_prov)
  {

     $data = array('estado_transito' => "2",'estado_enaduana' => "2",'estado_entregado' => "1");
                  
   $this->db->where('id_pedido_prov',$id_pedido_prov);
   $this->db->update('pedido_proveedor',$data);
  
   }

      
     //---------------finalizar_transito_aduana-------------
   public function finalizar_pedido($id)
  {

   $data = array(
                 'estado_enaduana'   => "0",
                 'estado_entregado'  => "1"
                 
                );

   $this->db->where('id_transporte_ext',$id);
   $this->db->update('transporte_externo',$data);

   $result= $this->listar_paquete_transito($id);

   foreach ($result as  $value):
         $this->modelogeneral->update_finalizar_pedido($value->id_paquete);
      
         $result_paquete= $this->listar_paquete($value->id_paquete);
      
         foreach ($result_paquete as  $values):
         $this->modelogeneral->update_fin_pedido_prov($values->id_pedido_prov);
         endforeach ;

   endforeach ;

   
    return true;
  
   }


  public function get_CategoriaxAlmacen($id_almacen)
  {
    
     $this->db->where('id_almacen',$id_almacen);
     $query = $this->db->get('categoria');
     
     return $query-> row();
     
  }

  public function get_usuario($id_usuario)
  {
    $this->db->where('id_usuario',$id_usuario);
    $query = $this->db->get('usuario');
    return $query-> row();
  }

  /*---------------------administrar categorias-------- */
  public function get_Categorias()
      {
       $query = $this->db->get('categoria');
       return $query->result();
      }

  public function editar_cat($id){
    
    $this->db->where('id_categoria',$id);
    $query = $this->db->get('categoria');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  } 
  //update categoria----------------------
  public function udpdateCat($param)
  {
    $campos = array(
                     'nombre_categoria'  => $param['nombre_categoria']
                     );
     $this->db->where('id_categoria',$param['id_categoria']);
     $this->db->update('categoria',$campos);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  }

  /*-------------clientes-------------------*/ 

    public function editar_cli($id){
    
    $this->db->where('id_cliente',$id);
    $query = $this->db->get('cliente');
    if($query->num_rows() > 0){
      return $query->row();
    }else{
      return false;
    }
  } 
    //update clientes----------------------
  public function udpdateCli($param)
  {
   
     $this->db->where('id_cliente',$param['id_cliente']);
     $this->db->update('cliente',$param);
      if($this->db->affected_rows() > 0){
        return true;
      }else{
        return false;
      }
  } 


  /*-----------------------------------------------------*/
public  function suma($id_producto) 
  {    
    $this->db->select ('SUM(cantidad_inicial) as cantidad_existente');
    $this->db->from('entrada_producto');
    $this->db->where('id_producto',$id_producto); 

    $query=$this->db->get();    
  return $query-> row();
  }

public function update_cantidad_final($cantidad_existente,$id_producto)
  {
     
     
     //$this->db->update('entrada_producto', $existente_cantidad);     
     $this->db->where('id_producto',$id_producto);   
     //$query = $this->db->get('usuario');

     
     return $this->db->update('entrada_producto', $cantidad_existente );  
     
  }


  public function getVentas($id_producto)
  {
    
     $this->db->select('cantidad_articulo,fecha_venta');
     $this->db->where("id_producto", $id_producto);
     $this->db->order_by("fecha_venta", "asc");
     $query = $this->db->get('venta');
          
     return $query->result_array();
     
  }
    public function getVentasxProducto()
  {
    
    $this->db->select('nombre_producto, cantidad_articulo,fecha_venta');
    $this->db->from('venta'); 
    $this->db->order_by("cantidad_articulo", "asc"); 
    $this->db->join('producto','producto.id_producto = venta.id_producto', 'inner');
       
    $query = $this->db->get();
    
    return $query-> row();
     
  }
  
   public function devolver_datos_almacen($id_almacen)
    {
        
     $this->db->where('id_almacen',$id_almacen);
     $query = $this->db->get('almacen');
     
     return $query-> row();
     
    }

    public function comprobar_ext($id_almacen,$id_categoria,$id_producto)
    {
   
     $this->db->where('id_almacen',$id_almacen);
     $this->db->where('id_categoria',$id_categoria);
     $this->db->where('id_producto',$id_producto);
     $query = $this->db->get('existencia');
     return $query-> row();
     
    }

     public function comprobar_existencia_venta($id_almacen,$id_categoria,$id_producto)
    {
 
     $this->db->where('id_almacen',$id_almacen);
     $this->db->where('id_categoria',$id_categoria);
     $this->db->where('id_producto',$id_producto);
        
     $query = $this->db->get('existencia');
     
     return $query-> row();
     
    }


    public function insertar_ext($id_almacen,$id_categoria,$id_producto,$fecha,$cantidad_inicial)
    {
        
     $porciones = explode("/",$fecha);
     $mes = $porciones[1];
     $ano = $porciones[2];
     
      $data = array(
                    'id_almacen'         => $id_almacen,
                    'id_categoria'       => $id_categoria,
                    'id_producto'        => $id_producto,
                    'cantidad_existente' => $cantidad_inicial,
                     'fecha'             => $fecha
                   );

        $this->db->insert('existencia',$data);

        return true;
     
    }


     public function get_Proveedores()
      {
       $query = $this->db->get('proveedor');
       return $query->result();
      }

    public function update_ext($id_almacen,$id_categoria,$id_producto,$fecha,$sumatoria)
    {
        
     $porciones = explode("/",$fecha);
     $mes = $porciones[1];
     $ano = $porciones[2];
     
      $data = array(
                    'cantidad_existente' => $sumatoria
                   );

         $this->db->where('id_almacen',$id_almacen);
         $this->db->where('id_categoria',$id_categoria);
         $this->db->where('id_producto',$id_producto);
        // $this->db->where('mes',$mes);
         //$this->db->where('ano',$ano);
         $this->db->update('existencia',$data);

         return true;
     
    }

    public function update_extente_venta($id_almacen,$id_categoria,$id_producto,$resultado_existente)
    {
        
     
      $data = array(
        'cantidad_existente' => $resultado_existente);

         $this->db->where('id_almacen',$id_almacen);
         $this->db->where('id_categoria',$id_categoria);
         $this->db->where('id_producto',$id_producto);
         $this->db->update('existencia',$data);

         return true;
     
    }

    public function verificar($id_proveedor, $factura)
    {
             
        $this->db->select("*");
        $this->db->join("paq_ped_prov pe", "pe.id_paquete = p.id_paquete");
        $this->db->join("pedido_proveedor ped", "ped.id_pedido_prov = pe.id_pedido_prov");
        $this->db->join("proveedor pro", "ped.id_proveedor = pro.id_proveedor");
        $this->db->join("paquete_trans_ext paqt", "p.id_paquete = paqt.id_paquete");
        $this->db->join("merca_transpoext mertrans", "mertrans.id_transporte_ext = paqt.id_transporte_ext");
        
        if ($id_proveedor !== null) {
            $this->db->where("pro.id_proveedor", $id_proveedor);
        }
       
        if ($factura != null) {
            $this->db->where('p.no_factura', $factura);
        }
        $resultados = $this->db->get('paquete p');
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }








}




