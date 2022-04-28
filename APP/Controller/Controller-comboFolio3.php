<?php

	require ('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$get_DB = new PDO (SGDB);

	$folio=$_POST["folio"];

	if($_POST["folio"] == $folio){
		$folio= $get_DB-> query("SELECT [PK_IdODS] as ods,[ODS_Comesa] FROM [PRO_SERVER_COMESA].[dbo].[PSC.ODS] where FK_Idfrente = $folio order by Numero_Comesa desc");
		$folio= $folio ->fetchAll(); //genera un arreglo de los resultados de la consulta
?>
    <script> $('.selectpicker').selectpicker('show');</script>
		<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="folio">Folio</label>
		<select class="selectpicker show-tick col-md-4 col-sm-6 col-xs-12" data-live-search="true" name="frente" id="frente">
			<option  value="">-- Selecciona Folio --</option>
			<?php
				foreach ($folio as $fo):
			?>
			<option value="<?php echo $fo['ods'];?>">
				<?php echo utf8_encode($fo['ODS_Comesa']);?>
			</option>
			<?php
			endforeach;
			?>
		</select>
<?php
	}
?>
