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

<?php
//hello

$pf_img = "assets/pfp2.png";
$worktime = array(array("09h30", "19h30"), array("09h30", "19h30"), array("09h30", "19h30"), array("09h30", "19h30"), array("09h30", "19h30"), array("", ""), array("09h30", "19h30"));
$pricing = array(array("Consultation simple", "100 £"), array("Consultation avec acte", "200 £"));
$dq = array(array("1977", "Diplôme d'État de docteur en médecine - Université Paris 11 - Paris-Saclay"), array("1977", "D.E.S. Dermatologie et vénéréologie - UFR de médecine Lariboisière-Saint-Louis"));
$language = array("Anglais", "Francais", "Espagnol");
?>


<?php include("components/navbar.php"); 


define("DB_NAME","Client");

if(!isset($_SESSION))
{
session_start();
}
if(isset($_SESSION["usertype"]) && $_SESSION["usertype"]=='doctor') {


	$old_email= $_SESSION["email"];
	    $old_name=$_SESSION["name"];
      $old_password=$_SESSION["password"];
	    $old_bday=$_SESSION["bday"];
      $old_phone=$_SESSION["phone"];
	  $old_speciality=$_SESSION["speciality"];
      if (isset($_SESSION["location"])){
      $old_location=$_SESSION["location"];
      }
	/*if (isset($_SESSION["pf_img"])) {
		$old_pf_img=$_SESSION["pf_img"] ;
	}*/
	if (isset($_SESSION["description"])) {
		$old_description=$_SESSION["description"] ;
	}
	if (isset($_SESSION["worktime"])) {
		$old_worktime=$_SESSION["worktime"] ;
	}
	if (isset($_SESSION["pricing"])) {
		$old_pricing=$_SESSION["pricing"] ;
	}
	if (isset($_SESSION["dq"])) {
		$old_dq=$_SESSION["dq"] ;
	}
	if (isset($_SESSION["language"])) {
		$old_language=$_SESSION["language"] ;
	}
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $new_name=$_POST["name"];
        $new_email=$_POST['email'];
        $confirm_password=$_POST['old_password'];
        $new_password=$_POST['new_password'];
        $new_phone=$_POST["phone"];
        $new_bday=$_POST["bday"];
        $new_location=$_POST["location"];
		$new_speciality=$_POST["speciality"];
		$new_description=$_POST["description"];
		//$new_worktime=$_POST["worktime"];
		//$new_pricing=$_POST["pricing"];
		//$new_dq=$_POST["dq"];
		//$new_language=$_POST["language"];

		$conn = mysqli_connect('localhost', 'root', '', DB_NAME);

	    if($conn->connect_error){
		echo "$conn->connect_error";
       die("Connection Failed : ". $conn->connect_error);
	    }else { 

		   if ($new_email){
			$stmt = $conn->prepare("SELECT email FROM patient WHERE email = ? UNION SELECT email FROM doctor WHERE email = ?");
			$stmt->bind_param("ss", $new_email , $new_email);
			$stmt->execute();
			$result = $stmt->get_result();
			if ( $new_email != $old_email  &&  $result->num_rows > 0) {
			  echo "email already exists";
  
		  }else{
			$stmt = $conn->prepare("UPDATE doctor SET  email = ? WHERE id = ?");
			$stmt->bind_param("si", $new_email, $_SESSION["id"]);
			$stmt->execute(); 
			$_SESSION["email"]= $new_email;
		  }       
			  }
		   if( $new_name  && $new_name!=$old_name ){
			$stmt = $conn->prepare("UPDATE doctor SET name = ? WHERE id = ?");
			$stmt->bind_param("si", $new_name, $_SESSION["id"]);
			$stmt->execute();
			$_SESSION["name"]=$new_name;
		   }
  
		   if($new_phone && $new_phone!=$old_phone ){
			$stmt = $conn->prepare("UPDATE doctor SET phone = ? WHERE id = ?");
			$stmt->bind_param("si", $new_phone, $_SESSION["id"]);
			$stmt->execute();
			$_SESSION["phone"]=$new_phone;
		   }
			if($new_bday  && $new_bday!=$old_bday ){
			$stmt = $conn->prepare("UPDATE doctor SET bday = ? WHERE id = ?");
			$stmt->bind_param("si", $new_bday, $_SESSION["id"]);
			$stmt->execute();
			$_SESSION["bday"]=$new_bday;
		   }
		   if($new_location && $new_location!=$old_location ){
			$stmt = $conn->prepare("UPDATE doctor SET location = ? WHERE id = ?");
			$stmt->bind_param("si", $new_location, $_SESSION["id"]);
			$stmt->execute();
			$_SESSION["location"]=$new_location;
		   }
		   if($new_speciality && $new_speciality!=$old_speciality ){
			$stmt = $conn->prepare("UPDATE doctor SET speciality = ? WHERE id = ?");
			$stmt->bind_param("si", $new_speciality, $_SESSION["id"]);
			$stmt->execute();
			$_SESSION["speciality"]=$new_speciality;
		   }
		   if($new_description && $new_description!=$old_description ){
			$stmt = $conn->prepare("UPDATE doctor SET description = ? WHERE id = ?");
			$stmt->bind_param("si", $new_description, $_SESSION["id"]);
			$stmt->execute();
			$_SESSION["description"]=$new_description;
		   }
		   if ($new_password && $confirm_password && !password_verify($new_password ,$old_password)) {
			   if(password_verify($confirm_password,$old_password)) {
				  $password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
				  $stmt = $conn->prepare("UPDATE doctor SET password = ? WHERE id = ?");
				  $stmt->bind_param("si",$password_hashed , $_SESSION["id"]);
				  $stmt->execute();
				  $_SESSION["password"]=$password_hashed;
		  } 
		
		}

		} 
	} 

	?>

<div class="std_container">
	<div class="ep_container">

	<h3>Gerer Compte</h3>

<form class="ep_form" action="" method="POST">
<div class="pf" >
	<div class="pf_header">
		<img src="<?php echo $pf_img ?>">
		<div class="pf_header_text">
		<div class="pf_header_text_name"><input type="text" value="<?php echo $old_name ?>" name="name" autocomplete="off"/></div>
			<div class="pf_header_text_speciality">
				<input type="text" value="<?php echo $old_speciality ?>" name="speciality" autocomplete="off"/>
			</div>
		</div>
	</div>
	<div class="pf_body">
		<div class="pf_body_field"><h3>Description</h3>
			<pre><textarea rows="5" cols="100" name="description"><?php echo $old_description ?></textarea></pre>
		</div>
		<div class="pf_body_field"><h3>Numero telephone</h3><input type="text" value="<?php echo $old_phone ?>" name="phone"  autocomplete="off"/></div>
		<div class="pf_body_field"><h3>Adresse</h3><textarea rows="1" cols="50" name="location"><?php echo $old_location ?></textarea></div>
		<div class="pf_body_field"><h3>Date Naissance</h3><input type="date" name="bday"></div>
		<div class="pf_body_field"><h3>Horaires de travail</h3>
			<pre>
				Dim:<textarea rows="1" cols="5"><?php echo $worktime[0][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[0][1] ?></textarea>
				Lun:<textarea rows="1" cols="5"><?php echo $worktime[1][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[1][1] ?></textarea>
				Mar:<textarea rows="1" cols="5"><?php echo $worktime[2][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[2][1] ?></textarea>
				Mer:<textarea rows="1" cols="5"><?php echo $worktime[3][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[3][1] ?></textarea>
				Jeu:<textarea rows="1" cols="5"><?php echo $worktime[4][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[4][1] ?></textarea>
				Ven:<textarea rows="1" cols="5"><?php echo $worktime[5][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[5][1] ?></textarea>
				Sam:<textarea rows="1" cols="5"><?php echo $worktime[6][0] ?></textarea> - <textarea rows="1" cols="5"><?php echo $worktime[6][1] ?></textarea>
			</pre>
		</div>
		<div class="pf_body_field"><h3>Tarifs</h3>
			<pre>
				<textarea rows="1" cols="50"><?php echo $pricing[0][0] ?></textarea><textarea rows="1" cols="10"><?php echo $pricing[0][1] ?></textarea>
				<textarea rows="1" cols="50"><?php echo $pricing[1][0] ?></textarea><textarea rows="1" cols="10"><?php echo $pricing[1][1] ?></textarea>
			</pre>
		</div>
		<div class="pf_body_field"><h3>Diplomes & Qualifications</h3>
			<pre>
				<textarea rows="1" cols="10"><?php echo $dq[0][0] ?></textarea><textarea rows="1" cols="50"><?php echo $dq[0][1] ?></textarea>
				<textarea rows="1" cols="10"><?php echo $dq[1][0] ?></textarea><textarea rows="1" cols="50"><?php echo $dq[1][1] ?></textarea>
			</pre>
		</div>
		<div class="pf_body_field"><h3>Langues parlées</h3>
			<textarea rows="1" cols="15"><?php echo $language[0] ?></textarea>,
			<textarea rows="1" cols="15"><?php echo $language[1] ?></textarea>,
			<textarea rows="1" cols="15"><?php echo $language[2] ?></textarea>
		</div>
		<div class="pf_body_images"><h3>∮ Images</h3></div>
	</div>
	<div>
	<div class="pf_body_field"><h3>Email</h3><input class="in_text" type="text"value="<?php echo $old_email ?>" name="email" autocomplete="off"/></div>
	<div class="pf_body_field"><h3>Password</h3><input class="in_text" type="password" placeholder="enter old password" name="old_password" autocomplete="off">
    <input class="in_text" type="password" placeholder="enter new password" name="new_password" autocomplete="off" ></div>
	</div>
</div>
<input type="submit" value="modifier">
</form>
	</div>
</div>

<script src="index.js"></script>
</body>
</html>
<?php   }else{

header("Location: index.php");
exit();

}  

?>


