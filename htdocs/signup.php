<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="index.css">
	<title>Visuals</title>
</head>
<body>

<?php include("components/navbar.php");

define("DB_NAME","USERDB");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email=$_POST['email'];
	$mdp=$_POST['mdp'];
	$nom=$_POST["nom"];
	$prenom=$_POST[prenom];
	$date_de_naissance=$_POST["date_de_naissance"];
	$tel=$_POST["tel"];
	$genre=$_POST["genre"];
	if ($email && $mdp && $nom && $prenom && $date_de_naissance && $tel && $genre ){
        
		$conn = mysqli_connect('localhost', 'root', '', DB_NAME);

		if($conn->connect_error){
			echo "$conn->connect_error";
			die("Connection Failed : ". $conn->connect_error);
		} else {
			$stmt = $conn->prepare("insert into DB_NAME (email, mdp, nom, prenom, date_de_naissance, tel, genre) values(?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssis", $email, $mdp, $nom, $prenom, $date_de_naissance, $tel, $genre);
			$execval = $stmt->execute();
			$stmt->close();
			$conn->close();
		}
	header("Location:login.php");
    exit();
	}
	}

	
?>

		<!--save-->
<div class="std_container">
	<div class="auth">
		<a href="#" class="auth_api">
			<img src="assets/gmail_logo.svg">
			Sign up with Gmail
		</a>
		<a href="#" class="auth_api">
			<img src="assets/outlook_logo.svg">
			Sign up with Outlook
		</a>
		<form id="auth_form" action="" method="POST">
			<div class="auth_form_field">
				<label>Nom complet</label>
				<input type="text">
			</div>
			<div class="auth_form_field">
				<label>Email</label>
				<input type="text">
			</div>
			<div class="auth_form_field">
				<label>Mot passe</label>
				<input type="text">
			</div>
			<div class="auth_form_field">
				<label>Numero telephone</label>
				<input type="text">
			</div>
			<div class="auth_form_captcha"></div>
			<input class="auth_form_submit" type="submit" value="Sign up">
			<div class="auth_form_tos">By clicking “Sign up”, you agree to our <a href="#">terms of service</a>, <a href="#">privacy policy</a> and <a href="#">cookie policy</a></div>
		</form>
		<div class="auth_ask">Already have an account? <a href="login.php">Log in</a></div>
	</div>
</div>

</body>
</html>