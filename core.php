<?php

	if ($_POST['email'] and $_POST['pwd']){
		$sql 	= "select * from users where email_user = '{$_POST['email']}'";
		$user 	= mysql_query($sql) or die ("Erro ao executar query do login");
		$user 	= mysql_fetch_array($user) or die ("
			<script language=\"JavaScript\">
				alert('Login inv\u00e1lido, tente novamente.');
			</script>
			<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>");
		$email 	= $user[email_user];
		$pwd 	= $user[pwd_user];
		$pwd_login = md5($_POST['pwd']);
		$_SESSION['id_user'] = $user['id_user'];
	}elseif ($_POST){
 	if ($_POST['txtLatitude'] and $_POST['txtLongitude']){

 		switch (escolha_user_no_form('update', 'new', 'del')) {
		    case 'update':
		        $sql = "update coordenadas set 
 					latitude = '{$_POST['txtLatitude']}', 
 					longitude = '{$_POST['txtLongitude']}',
 					nm_coordenada =  '{$_POST['nm_coordenada']}'
 					where id_user = {$_SESSION['id_user']} and id_coordenada = {$_POST['id_coordenada']}";
 				$msg = "Ponto atualizado com sucesso";
		    break;

		    case 'new':
		        $sql = "insert into coordenadas
		        	(id_user, latitude, longitude, nm_coordenada)
		        	values 
		        	({$_SESSION['id_user']}, '{$_POST['txtLatitude']}', '{$_POST['txtLongitude']}', '{$_POST['nm_coordenada']}') ";
		        $msg = "Ponto cadastrado com sucesso";
		    break;

		    case 'del':
		        $sql = "delete from coordenadas
		        	where id_user = {$_SESSION['id_user']} and id_coordenada = {$_POST['id_coordenada']}";
		        $msg = "Ponto excluído com sucesso";
		    break;

		    default:
		        //no action sent
		}

 		mysql_query($sql) or die ("Erro ao executar sql das coordenadas.");
 		echo "
 			<script type='text/javascript'>
	 			window.setTimeout(function() {
	        		alerta('{$msg}', 'alerta', 3000);
	    		}, 500);
			</script>
 		";
 	}

}
$id_coordenada = $_GET['id_coordenada'];
if ($id_coordenada){
	$sql = "select * from coordenadas where id_user = {$_SESSION['id_user']} and id_coordenada = {$id_coordenada}";
	$coordenadas = mysql_query($sql) or die ("<br /> Erro ao executar query das coordenadas");
	$coordenadas = mysql_fetch_array($coordenadas);
	$latitude 		= $coordenadas['latitude'];
	$longitude 		= $coordenadas['longitude'];
	$nm_coordenada 	= $coordenadas['nm_coordenada'];
	$id_coordenada	= $coordenadas['id_coordenada'];
}
if ($_SESSION['id_user']){
	$sql = "select * from coordenadas where id_user = {$_SESSION['id_user']}";
	$todas_coord = mysql_query($sql) or die ("<br /> Erro ao executar query das coordenadas");
}elseif(!$_POST['email'] and !$_POST['pwd'])
	echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";




function escolha_user_no_form($name)
{
    $params = func_get_args();

    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}
?>