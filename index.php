<?php
	require_once("./correus.php");
	require_once("./passwords.php");

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$trobat = false;
		for ($i = 0; $i <= 3; $i++)
		{
			$correu = CORREUS[$i];
			$password = PASSWORDS[$i] ;
			if(base64_decode($_POST["mailHidden"])==$correu && password_verify(base64_decode($_POST["passHidden"]),password_hash($password, PASSWORD_DEFAULT))){
				$trobat = true;
				header("Location: https://educem.com/");
			}
		}
		if(!$trobat){
			echo '<script type="text/javascript">
			alert("Revisi usuari i contrassenya");
			window.location.href="index.php";
			</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="./css/styles.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto cardLogin">
		<form name="login" class="text-center p-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validarForm()">
			<p class="h4 mb-4 pb-4">Login</p>
			<input name="mail" type="email" class="form-control mb-4" placeholder="E-mail">
			<input name="pass" type="password" class="form-control mb-4" placeholder="Password">
			<input name="mailHidden" type="hidden">
			<input name="passHidden" type="hidden">
			<button class="btn btn-primary btn-block my-4" type="submit">Sign in</button>
			<div class="d-flex justify-content-around pt-5">
				<a href="#">Forgot password?</a>
			</div>
		</form>
      </div>
    </div>
  </div>
  <script>
	function validarForm()
	{
		document.forms["login"]["mailHidden"].value = btoa(document.forms["login"]["mail"].value);
		document.forms["login"]["passHidden"].value = btoa(document.forms["login"]["pass"].value);				
	}
</script>
</body>
</html>
