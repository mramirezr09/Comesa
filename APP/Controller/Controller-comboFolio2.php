<?php
    
	require ('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$get_DB = new PDO (SGDB);
	
	$folio=$_POST["modfrente"];
	
	if($_POST["modfrente"] == $folio){
		
		
		$folio= $get_DB-> query("SELECT [PK_IdODS],[ODS_Comesa] FROM [PRO_SERVER_COMESA].[dbo].[PSC.ODS] where FK_Idfrente = $folio order by Numero_Comesa desc");
		$folio= $folio ->fetchAll(); //genera un arreglo de los resultados de la consulta
		?>
                               <script> $('.selectpicker').selectpicker('show'); 
							        
							   
							   </script>
                           
						   <div class="form-group">
		                     <label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="folio">Folio</label>
						
								<select class="selectpicker show-tick col-md-4 col-sm-6 col-xs-12" data-live-search="true" name="mod_ods1" id="mod_ods1" >
									<option selected disable hidden style="display:none" value="">-- Selecciona Folio --</option>
									<?php 
									
		foreach ($folio as $fo):
		?>		
		
		<option value="<?php echo $fo['PK_IdODS'];?>">
			<?php echo utf8_encode($fo['ODS_Comesa']);?>
		</option>
		<?php
		endforeach;
			?>
								</select>
								</div>
							
								

		<?php
								
	}

	
?>