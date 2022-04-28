<?php
	$requestAjax = true;
	require ('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$get_DB = new PDO (SGDB);

	//$sexo = $_POST['sexod'];
	//print_r($sexo);
	//$lugarN = $_GET['lugarN'];

	$c = $_POST['est'];
//	print_r($c);
	if($_POST['est'] == $c){
		$est= $get_DB-> query("Select Num_CP, Estado from [dbo].[PSC.CP] where Num_CP = '$c' group by Num_CP, Estado");
		$est= $est ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($est as $edo):
			?>
			<option value="<?php echo $edo['Num_CP']; ?>">
				<?php echo $edo['Estado']; ?>
			</option>
			<?php
		endforeach;
	}

	$d = $_POST['mun'];
	if($_POST['mun'] == $d){
		$mun= $get_DB-> query("Select Num_CP, Municipio from [dbo].[PSC.CP] where Num_CP = '$d' group by Num_CP, Municipio");
		$mun= $mun ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($mun as $mn):
			?>
			<option value="<?php echo $mn['Num_CP']; ?>">
				<?php echo $mn['Municipio']; ?>
			</option>
			<?php
		endforeach;
	}
	$e = $_POST['col'];
	if($_POST['col'] == $e){
		$col= $get_DB-> query("Select PK_IdCP , Colonia from [dbo].[PSC.CP] where Num_CP = '$e'");
		$col= $col ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($col as $cl):
			?>
			<option value="<?php echo $cl['PK_IdCP']; ?>">
				<?php echo $cl['Colonia']; ?>
			</option>
			<?php
		endforeach;
	}
?>
