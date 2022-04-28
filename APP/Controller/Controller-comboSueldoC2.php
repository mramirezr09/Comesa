<?php
	require ('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$get_DB = new PDO (SGDB);

$fase=$_POST["fase"];

	
		if($_POST["fase"] == $fase){
		
		$fa= $get_DB-> query("SELECT [PK_IdFase],[Nombre_Fase] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Fase_Puesto] where PK_IdFase=$fase");
		$fa= $fa ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach ($fa as $s):
		?>		
		<option value="<?php echo $s['PK_IdFase'];?>">
			<?php echo utf8_encode($s['Nombre_Fase']);?>
		</option>
		<?php
		endforeach;
	}
?>