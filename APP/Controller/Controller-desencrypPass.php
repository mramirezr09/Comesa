<?php
	require_once('APP/Model/SGMXModel.php');

	$conx = sqlsrv_connect(SERVER,CONNINF); //metodo de para conectar DB

	
	$query = "SELECT 	   
		[Apallido_Paterno]+ ' ' + [Apallido_Materno]+ ' '+[Nombre] as nombreC,
		[Login] as login,
		[Password] as contraseña
      
		FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia]
		where FK_IdPerfil = 2 and Password not in('K3BiU1p1UFpJUVE4OE5Ha3FjV1c4Zz09')";

	$query1 = sqlsrv_query($conx,$query,PARAMS,OPTION); //ejecucion de un query

	$numN = sqlsrv_num_rows($query1); //contar numero de resultados

	if ($numN > 0) {
		?>
			<!--Encabezado html-->
			<table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					<th class="column-title">Nombre </th>
                    <th class="column-title">Login </th>					
                    <th class="column-title"><?php echo(utf8_encode("Contraseñas"));?></th>     
                    <th class="column-title no-link last"><span class="nobr"></span></th><!--Ajusta encabezado-->
                    </tr>
                </thead>

                <tbody>
		<?php
			//INSERTAR RESULTADOS DE TABLA
			while ($res=sqlsrv_fetch_array($query1)) { //inserta datos en tabla desde sql
				$nombre=utf8_encode ($res['nombreC']);
				$login=utf8_encode ($res['login']);
				$pass=$res['contraseña'];
				$desCp = SGMXModel:: passdecryption ($pass);
		?>		
					<tr class="even pointer"> <!--inserta datos en tabla a html-->
						<td><?php echo $nombre;?></td>
						<td><?php echo $login;?></td>
						<td><?php echo $desCp; ?></td>
						<td ><span class="pull-right">
					</tr>
				</tbody>			
		<?php
			}
		?>
		</table>
		<?php
	}	
?>
