<?php
session_start();
require_once 'classes/Membership.php';
$membership = new Membership();

// If the user clicks the "Log Out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$membership->log_User_Out();
}

// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
	$response = $membership->validate_User($_POST['username'], $_POST['pwd']);
}
														

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login de acceso al Registro de Pesos</title>

<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

<link rel="stylesheet" type="text/css" href="css/default.css" />
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/main2.js"></script>
</head>

<body>

<div id="login" class="myform">
	<form id="form" name="form" method="post" action="">
		<h1>Página de Login</h1>
		<p></p>
		
	<label>Usuario
		<span class="small">Nombre de usuario</span>
	</label>
	<input type="text" name="username" id="username" />

	<label>Contraseña
	<span class="small">Contraseña de usuario</span>
	</label>
	<input type="password" name="pwd" id="pwd" />

	<button type="submit">Login</button>
	<div class="spacer"></div>

	</form>
	<?php if(isset($response)) echo "<h4 class='alert'>" . $response . "</h4>"; ?>
</div>

<!--
<div id="login">	
	<form method="post" action="">
    	<h2>Login <small>introduce tus credenciales</small></h2>
        <p>
        	<label for="name">Usuario: </label>
            <input type="text" name="username" />
        </p>
        
        <p>
        	<label for="pwd">Contraseña: </label>
            <input type="password" name="pwd" />
        </p>
        
        <p>
        	<input type="submit" id="submit" value="Login" name="submit" />
        </p>
    </form>
    <?php if(isset($response)) echo "<h4 class='alert'>" . $response . "</h4>"; ?>
</div>

-->
</body>
</html>