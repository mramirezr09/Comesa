<?PHP
require_once('APP/Controller/funcion.class.SGMX_Controller.php');
$sgmx = new sgmx_Controller();
?>

<footer class="footer">
   
 <strong><a target="_blank" href=""></a> © <?php echo date('Y');?>. </strong>  Ver. 1.0 



            


   <?php 
		   $ip__= ($sgmx->obtener_ip()!=null)? $sgmx->obtener_ip() :""; 
		   echo $ip__; ?>
</footer>
