<?php
	$requestAjax = true;
	require ('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$get_DB = new PDO (SGDB);

	//$sexo = $_POST['sexod'];
	//print_r($sexo);
	//$lugarN = $_GET['lugarN'];

	$c = $_POST['sexod'];
	//$d= $c;
	if($_POST['sexod'] == $c){
		$sexo= $get_DB-> query("Select PK_IdSexo ,Nombre_Sexo from [dbo].[PSC.Sexo] where Descripcion = '$c'");
		$sexo= $sexo ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($sexo as $se):
			?>
			<option value="<?php echo $se['PK_IdSexo']; ?>">
				<?php echo $se['Nombre_Sexo']; ?>
			</option>
			<?php
		endforeach;
	}


	$d = $_POST['lugarN'];

	if($_POST['lugarN'] == $d){
		$luna= $get_DB-> query("Select [PK_IdEstado] as pkE, [Nombre_Estado] as nombreE from [dbo].[PSC.Estado] where Abrebiatura_Estado ='$d'");
		$luna= $luna ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($luna as $lu):
	?>
			<option value="<?php echo $lu['pkE']; ?>">
				<?php echo $lu['nombreE']; ?>
			</option>
	<?php
			endforeach;
	}
	//Sexo combo
/*	if($_GET['sexo'] == 'm'){
		$sexo= $get_DB-> query("Select PK_IdSexo ,Nombre_Sexo from [dbo].[PSC.Sexo] where Pk_idSexo =1");
		$sexo= $sexo ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($sexo as $se):
	?>
		<option value="<?php echo $se['PK_IdSexo']; ?>">
			<?php echo $se['Nombre_Sexo']; ?>
		</option>
	<?php
		endforeach;
	}
	if($_GET['sexo'] == 'h') {
	$sexo= $get_DB-> query("Select PK_IdSexo ,Nombre_Sexo from [dbo].[PSC.Sexo] where Pk_idSexo =2");
	$sexo= $sexo ->fetchAll(); //genera un arreglo de los resultados de la consulta
	foreach($sexo as $se):
	?>
		<option value="<?php echo $se['PK_IdSexo']; ?>">
			<?php echo $se['Nombre_Sexo']; ?>
		</option>
	<?php
		endforeach;
	}

/*	if($_GET['luna'] == 'df'){
		$luna= $get_DB-> query("Select [PK_IdEstado] as pkE, [Nombre_Estado] as nombreE from [dbo].[PSC.Estado] where Abrebiatura_Estado ='DF'");
		$luna= $luna ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($luna as $lu):
	?>
			<option value="<?php echo $lu['pkE']; ?>">
				<?php echo $lu['nombreE']; ?>
			</option>
	<?php
			endforeach;
	}
	else{
		$luna= $get_DB-> query("Select [PK_IdEstado] as pkE, [Nombre_Estado] as nombreE from [dbo].[PSC.Estado] where Abrebiatura_Estado ='TC'");
		$luna= $luna ->fetchAll(); //genera un arreglo de los resultados de la consulta
		foreach($luna as $lu):
	?>
			<option value="<?php echo $lu['pkE']; ?>">
				<?php echo $lu['nombreE']; ?>
			</option>
	<?php
			endforeach;
	}*/

?>
