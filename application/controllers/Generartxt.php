<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generartxt extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('modelogeneral');
		$this->load->library('zip');
		$this->load->helper('download');

	}

   function index(){
	 $output['arraypedidosKey']   = $this->modelogeneral->showPedidos_key();
	$this->load->view('contenedor',$output);
   }

    public function generate_zip()
    {
    	$output['arraypedidosKey']   = $this->modelogeneral->showPedidos_key();

    	$hoy = date("d-m-y H:i:s"); 
    	$name ='Backup'.$hoy.'.txt';
    	$data ='Backup para contabilidad '.$hoy;
    	$this->zip->add_data($name,$data);
    	$this->zip->archive('./assets/uploads/files/archivos.zip');

        
     }

     public function camaraview(){
   //$output['arraypedidosKey']   = $this->modelogeneral->showPedidos_key();
  $this->load->view('camara');
   }



    public function download(){
       /* if(!empty($id)){
            
            //get file info from database
           // $fileInfo = $this->file->getRows(array('id' => $id));
            */
            //file path

           // $file = 'uploads/files/'.$fileInfo['file_name'];
       	$file = './assets/uploads/files/archivos.zip';
            
            //download file from directory
            force_download($file, NULL);


        
     }

}

