<?php
//Validamos que no exista otra clase " breadcrumb"
if(!function_exists('breadcrumb')){
//Creamos la funcion
 function breadcrumb(){
$ci = &get_instance();
$i=1;
$uri = $ci->uri->segment($i);
$link = '<ul>';
 
$link .= '<li><a href="'.base_url().'"><i></i></a></li>';
 
while($uri != ''){
$prep_link = '';
for($j=1; $j<=$i;$j++){
$prep_link .= $ci->uri->segment($j).'/';
}
 
if($ci->uri->segment($i+1) == ''){
$link.='<li>';
$link.=$ci->uri->segment($i).'</li> ';
}else{
$link.='<li> <a href="'.site_url($prep_link).'">';
$link.=$ci->uri->segment($i).'</a></li> ';
}
 
$i++;
$uri = $ci->uri->segment($i);
}
$link .= '</ul>';
return $link;
 }
}
?>