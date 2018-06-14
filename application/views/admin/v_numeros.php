<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Convertir números a letras con PHP/CodeIgniter 2</title>
        <!--
        La ausencia de http: en el link de abajo NO es un error:
        http://encosia.com/3-reasons-why-you-should-let-google-host-jquery-for-you/#protocolless
        -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
    </head>
    <body>
        <?php $precio = 500; ?>
        <form name="forma1" action="" method="post">
            <input id="cantidad" type="text" name="cantidad" value="<?php echo isset($_POST['cantidad']) ? $_POST['cantidad'] : ''; ?>" size="50" maxlength="21" /> 
            <input  type="hidden" value= '<?php echo $precio; ?>'        name = "precio"/>
            <input id="boton1" type="button" name="boton1" value="Convertir..." />
            <br/>
            <p></p>
            <!--textarea id="cantidad_letras" cols="100" rows="5"><?php //echo isset($_POST['cantidad']) ? numtoletras($_POST['cantidad']) : ''; ?></textarea -->
        </form>
         <span id="lblImporteLetras3"></span>
        

        <script type="text/javascript" charset="utf-8">
            /* debes personalizar esta url para apuntar a tu servidor */
            var url_post = 'numeros/convertir/';
          
            window.onload = (function(){
            try{
                $("input").on('keyup', function(e) {
                    e.preventDefault();
                    
                    $.ajax({
                        url: url_post
                                , type: 'post'
                                , dataType: 'json'
                                , data: {
                                    cantidad: $('#cantidad').val()
                                }
                                , success: function(response) {
                            
                            $('#lblImporteLetras3').html(response.leyenda);
                            
                        }
                    });
                });
            }catch(e){}

        });

            
        </script>
    </body>
</html>
