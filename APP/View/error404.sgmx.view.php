 <style>
.MSG
{
	justify-content:center
	display: flex;
	align-items: center;
}
.MSG h2,.MSG strong
{
	color: #f30;

}	
</style>
   <div>
   <p class="text-center"> <i class = "zmdi zmdi-cloud-off zmdi-hc-5x"> </i></p>
     <hr>
	

<div class="MSG">
	<h2 class = "text-center">  No se encontro lo que estas buscando !</h2>
  <h2  class = " lead text-center"> Favor de validar la URL que ingresaste. En caso de continuar con el error, favor de notificarlo al administrador </h2>
  <hr>
  <hr>
<div style="width:15%; height:15%">
	<a href="mailto:angelv@sinergialt.com.mx">
    	<img src="/web/img/Mail.png" width="60%" height="60%" style="justify-content:center;"></a></div> 
	 <?php 
	 echo $_SERVER["SERVER_PROTOCOL"]." ".http_response_code()." Cliente: ".$_SERVER['REMOTE_ADDR'];?>
     	<hr>
     
     <div style="width:15%; height:15%">
        	<img src="/web/img/pagopro.png" width="50%" height="50%"  style="justify-content:center;" >
        </div>
       <strong>
	<?php echo "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'] ?>
    </strong>
     
     </p>
   </div>
   
   </div> 
   
   
   