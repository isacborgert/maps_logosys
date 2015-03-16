			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			    <head>
			        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

			        <title>Maps Test Logosys</title>

			        <link href=\"favicon.ico\" rel='shortcut icon' type='image/x-icon'/>
			        <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />
			        <link href="estilo.css" type="text/css" rel="stylesheet" />

			        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?AIzaSyB4MOFVxQL0RM_8OegHojnSiBvuCmuD5Zc&sensor=false"></script>
			        <script type="text/javascript" src="jquery.min.js"></script>
			        <script type="text/javascript" src="mapa.js"></script>
			        <script type="text/javascript" src="jquery-ui.custom.min.js"></script>
			        
			    </head>
<?php 
	session_start();
	require_once('mysql_connect.php');
	if ($_SESSION['id_user'] or ($_POST['email'] and $_POST['pwd']))
		require_once('core.php');

	if (!$_POST['email'] and !$_POST['pwd'] and !$_SESSION['email']){
?>
		     <body>

		        <div id="apresentacao">

		            <h1>Maps Test Logosys</h1>
		    	
		            <form method="post" action="index.php">
		                <fieldset>

		                    <legend>Maps Test Logosys</legend>
		            		
		                    <div class="campos">
		                        <label for="user">E-mail:</label> <input type="text" id="email" name="email" size=27 />
		    					<label for="pwd">Senha:</label> <input type="password" id="pwd" name="pwd" size=20 />
		    					<input type="submit" id="login" name="login" value="Entrar" />

		 					</div>

		                </fieldset>
		            </form>

		        </div>   
		    </body>
		</html>
<?php 
	}elseif ($_SESSION['email'] or ($_POST['email'] === $email and $pwd_login == $pwd)){ 
		$_SESSION['email'] = $_POST['email'] ? $_POST['email'] : $_SESSION['email'];
		if ($_POST['logoff']){
			session_destroy();
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
		}else{
?>			    
			    <body>
			    <form method="post" action="index.php">
			    	<input type="submit" value="Sair" name="logoff" />
			    </form>
			    <div id="sidebar"> 
					<input type="submit" name='coordenadas' value="Ver todos os pontos" onclick="location. href= 'todas_coordenadas/index.php' "> 
					<p><br>
<?php
			while ($row = mysql_fetch_array($todas_coord)){
				echo "
					<br />
					<input type='submit' name='coordenadas' value='{$row['nm_coordenada']}' onclick=\"location. href= 'index.php?id_coordenada={$row['id_coordenada']}'\">
				";
			}
?>	
				</div> 
		        <div id="apresentacao">

		            <h1>Maps Test Logosys</h1>
		    
		            <form method="post" action="index.php">
		                <fieldset>

		                    <legend>Maps Test Logosys</legend>
		            
		                    <div class="campos">
		                        <label for="txtEndereco">Endereço:</label>
		                        <input type="text" id="txtEndereco" name="txtEndereco" size=50 placeholder='Digite o endereço ou arraste o ponto para atualizar/cadastrar.'/>
		                        <input type="button" id="btnEndereco" name="btnEndereco" value="Mostrar no mapa" /><br><br>
		                    </div>

		                    <div id="mapa"></div>
		                    <div align="center">
		                    	<label for='txtEndereco'>Nome do ponto:</label>
<?php
						echo "
							<input type='text' id='nm_coordenada' name='nm_coordenada' VALUE='{$nm_coordenada}' size=30 required />
						";
						if ($coordenadas){
							echo "
								<input type='submit' value='Atualizar' name='update' id='update' />
								<input type='submit' value='Cadastrar como novo' name='new' id='new' />
								<input type='submit' value='Excluir' name='del' id='dell' />
								<INPUT TYPE='hidden' NAME='latitude' id='latitude' VALUE='{$latitude}'>
								<INPUT TYPE='hidden' NAME='longitude' id='longitude' VALUE='{$longitude}'>
								<INPUT TYPE='hidden' NAME='id_coordenada' id='id_coordenada' VALUE={$id_coordenada}>
								<!--<script type='text/javascript'>
								alert(document.getElementById('latitude').value);
							 	</script>-->
							";
						}else
							echo "
								<input type='submit' value='Cadastrar' name='new' id='new' />
								<INPUT TYPE='hidden' NAME='latitude' id='latitude' VALUE='-28.6792104'>
								<INPUT TYPE='hidden' NAME='longitude' id='longitude' VALUE='-49.3673277'>
							";
?>
			                    <input type="hidden" id="txtLatitude" name="txtLatitude" />
			                    <input type="hidden" id="txtLongitude" name="txtLongitude" />
		                    </div>
		                </fieldset>
		            </form>

		        </div>   
			    </body>
			</html>
<?php 
		}
	}else{
?>
		<script language="JavaScript">
			alert('Login inv\u00e1lido, tente novamente.');
		</script>
		<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>
<?php
	}
?>