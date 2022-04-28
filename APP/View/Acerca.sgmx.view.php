  <div class="right_col" role="main"> <!-- page content -->
  <script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>
        <div class="">
            <div class="page-title">
            <br>
                <div class="row">
            	    <div class="col-md-6 col-md-offset-3">
                        <h1>© Todos los derechos reservados</h1>
                        <p> A <strong><a target="_blank" href="https://www.visionyestrategias.com/">VISION. Y. ESTRATEGIA. DE. NEGOCIOS. SA DE CV</a></strong> creadores del <a>Control de Asistencia</a>.</p>

                        <br><br>

                        <h1 style="text-align: center;">Nosotros</h1>
                        <h3></h3>
                        <p>Somos una firma especializada en servicios integrales de Administración de Personal y Nómina, sustentados en procesos especializados y ejecutivos calificados, fortalecidos por el soporte jurídico profesional y conocimiento experto de la legislación aplicable.</p>

<!--tabla-->
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Conocenos mejor</h3>
      </div>
      <div class="panel-body">
   
<table class="table">
  <thead>
    <tr>
      <th width="7%">#</th>
      <th width="70%">Nombre del Archivo</th>
      <th width="13%">Descargar</th>

    </tr>
  </thead>
  <tbody>
<?php
$archivos = scandir("Web/Documentos/Misc/");
$num=0;
for ($i=2; $i<count($archivos); $i++)
{$num++;
?>
<p>  
 </p>
         
    <tr>
      <th scope="row"><?php echo $num;?></th>
      <td><?php echo $archivos[$i]; ?></td>
      <td><a title="Descargar Archivo" href="http://170.247.128.26:8080/Web/Documentos/Misc/<?php echo $archivos[$i]; ?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;"> <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> </a></td>
      
    </tr>
 <?php }?> 

  </tbody>
</table>
</div>
</div>
<!-- Fin tabla--> 
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->
