<?php
	require ('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$get_DB = new PDO (SGDB);
	
$sueldo=$_POST["part"];
	
	if($_POST["part"] == $sueldo){
		
		$suel= $get_DB-> query("SELECT [PK_IdPuesto],[Sueldo_Mensual] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Puesto] where PK_IdPuesto=$sueldo");
		$suel= $suel ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach ($suel as $s):
		?>		
		<option value="<?php echo $s['PK_IdPuesto'];?>">
			<?php echo utf8_encode($s['Sueldo_Mensual']);?>
		</option>
		<?php
		endforeach;
	}
?>