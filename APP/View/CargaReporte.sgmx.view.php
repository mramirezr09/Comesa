<?php 
    $id_u=$_SESSION['id_sgmx'];
	$conn = sqlsrv_connect(SERVER,CONNINF);

$query="
							SELECT 
							t1.PK_IdUsuario AS ID,
							t1.Nombre AS Nombre,
							t1.Mail AS Mail
							
							
							FROM [PSA.UsuarioAsistencia]t1
							LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
							LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
							LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario
							WHERE t1.PK_IdUsuario='$id_u'";
							
						$dat= sqlsrv_query($conn,$query,PARAMS,OPTION);
						while ($res = sqlsrv_fetch_array($dat)) {
							$ID=$res['ID'];
							$nombre=$res['Nombre'];
							$mail=$res['Mail'];
							}
							
						$get_DB = new PDO (SGDB); 
						$mes= $get_DB -> query ("Select PK_IdMes as FK_IdMes, Nombre from [dbo].[PSA.Mes_nomina]");
						$mes= $mes ->fetchAll();
						
						$nom= $get_DB -> query ("Select PK_IdNomina as FK_IdNomina, Nombre from [dbo].[PSA.Tipo_Nomina]");
						$nom= $nom ->fetchAll();
						
						$esq= $get_DB -> query ("Select PK_IdEsquema as FK_IdEsquema, Nombre from [dbo].[PSA.Esquema_Nomina]");
						$esq= $esq ->fetchAll();
						
						$peri= $get_DB -> query ("Select PK_IdPeriodo as FK_IdPeriodo, Nombre from [dbo].[PSA.Periodo_Nomina]");
						$peri= $peri ->fetchAll();
						
						$tipo= $get_DB -> query ("Select PK_IdTipoReporte as FK_IdTipoReporte, Nombre from [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Tipo_Reporte]");
						$tipo= $tipo ->fetchAll();
	
?>



<div class="right_col" role="main"><!-- page content -->
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="x_panel">
<div class="x_title">

<h2>Cargar Reportes</h2>

<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>

<div class="col-md-12">
<div class="well well-sm">
<div class="form-horizontal">
         
  <form action ="<?php echo SRVURL;?>APP/ajax/class.sgmx.reporteajax.php" 
         method = "POST" data-form="save" class="form-label-left input_mask FormularioAjax" 
         autocomplete="off" enctype ="multipart/form-data" class="form-horizontal">
         <fieldset>
        
       <legend class="text-center ayuda-us"></legend>
                        
        <input type="hidden" id="fkid" name="fk-id" value="<?php echo $ID;?>">
        
        <div class="form-group">
		
		 <?php
		
		   
			   $pro= $get_DB -> query ("Select PK_IdProyecto as FK_IdProyecto, Nombre from [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Proyecto] where PK_IdProyecto in (1,2,3)");
		       $pro= $pro ->fetchAll();
		   ?>
		          <label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="first-name">Unidad</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
           <select name="pro-re" class="form-control" required>
                <option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    <?php foreach($pro as $p):?>
          <option value="
    <?php echo $p['FK_IdProyecto']; ?>">
    <?php echo utf8_encode( $p['Nombre']); ?></option>
    <?php endforeach; ?>
           </select>
          </div>

		  
            <label class="control-label col-md-2 col-sm-6 col-xs-12 text-right" for="first-name">Usuario Autorizado</label>
          <div class="col-md-4 col-sm-4 col-xs-5">
             <input type="datetime" name="user-re"  value="<?php echo $nombre;?>"  class="form-control" readonly>
             <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
        </div>
           
		
		
        </div>
        
        <div class="ln_solid"></div>
        
        
        
        <div class="form-group"> 
         <label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="first-name">Tipo reporte</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
           <select name="tipo-re" class="form-control" required>
                <option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    <?php foreach($tipo as $ti):?>
          <option value="
    <?php echo $ti['FK_IdTipoReporte']; ?>">
    <?php echo utf8_encode( $ti['Nombre']); ?></option>
    <?php endforeach; ?>
           </select>
   </div>

          <label class="control-label col-md-2 col-sm-6 col-xs-12 text-right" for="first-name">Esquema</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="esq-re"  class="form-control" required>
          <option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    <?php foreach($esq as $es):?>
          <option value="
    <?php echo $es['FK_IdEsquema']; ?>">
    <?php echo $es['Nombre']; ?></option>
    <?php endforeach; ?>
    </select>
    </div>
  </div>
  
      <div class="form-group"> 
         <label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="first-name">Tipo Nomina</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
           <select name="nom-re"  class="form-control" required>
            <option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    <?php foreach($nom as $no):?>
          <option value="
    <?php echo $no['FK_IdNomina']; ?>">
    <?php echo $no['Nombre']; ?></option>
    <?php endforeach; ?>
           </select>
   </div>

          <label class="control-label col-md-2 col-sm-6 col-xs-12 text-right" for="first-name">Mes de Corte</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="mes-re" class="form-control" required>
          <option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    <?php foreach($mes as $me):?>
          <option value="
    <?php echo $me['FK_IdMes']; ?>">
    <?php echo $me['Nombre']; ?></option>
    <?php endforeach; ?>
    </select>
    </div>
  </div>
        
        
              <div class="form-group"> 
          <label class="control-label col-md-2 col-sm-6 col-xs-12 text-right" for="first-name">Periodo</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="peri-re" class="form-control" required>
             <option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    <?php foreach($peri as $pe):?>
          <option value="
    <?php echo $pe['FK_IdPeriodo']; ?>">
    <?php echo $pe['Nombre']; ?></option>
    <?php endforeach; ?>
    </select>
    </div>
  </div>
  
      <div class="ln_solid"></div>
      
        
        <div class="form-group">
               <label class="control-label col-md-2 col-sm-6 col-xs-12 text-right" for="first-name">Nombre del reporte</label>
          <div class="col-md-6 col-sm-4 col-xs-5">
             <input class="form-control" type="text" name="nombre-re" required="" maxlength="30" placeholder="Nombre del documento">
             <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
        </div>
        
        </div>
      
      <div class="form-group">                                       
               <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Cargar Reporte</label>                            
             <div class="col-md-6 col-sm-9 col-xs-12">
                  <input type="file" name="file-re" class="form-control" accept="application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
             </div>
         </div>

 
<div class="form-group">
<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left">Descripción<span class="required"></span>
</label>
<div class="col-md-6 col-sm-9 col-xs-12">
<textarea name="desc-re" class="form-control col-md-7 col-xs-12"  placeholder="Breve Descripción..." ></textarea>
</div>
</div>

            
       <div class="form-group">
        <div class="col-md-12 text-center">
                            
               <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
       
        </div>
           </div>
         
          </fieldset>
    
     <div class="RespuestaAjax"></div>
         </form>
           <div class="clearfix"></div>



<div class="x_content">
      </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
