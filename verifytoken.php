
<?php include ('includes/connection.php'); ?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>

<?php
if (!empty($_GET['token'])) {	
$token = mysqli_real_escape_string($conn , $_GET['token']);
$query = "SELECT token FROM users WHERE token = '$token' ";
$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run) > 0) {
	?>
	<div class="login-card">
    <h1>Change Password</h1><br>
  <form action = "" method="POST">
    <input type="password" name="password" placeholder="Enter New Password" required="">
    <input type="password" name="repassword" placeholder="Confirm New Password" required="">
     <input type="submit" name="change" class="login login-submit" value="submit">
  </form>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<?php 
     if (isset($_POST['change'])) {
     	$password = mysqli_real_escape_string($conn , $_POST['password']);
     	$repassword = mysqli_real_escape_string($conn , $_POST['repassword']);
     	if (strlen($password) < 6 ) {
     		echo "<center> <font color = 'red' >La contraseña debe tener al menos 6 caracteres!</font><center> ";
     	} 
     	else if ($password == $repassword) {
     	$newpassword = password_hash("$password" , PASSWORD_DEFAULT);
	$query1 = "UPDATE users SET token = '' , password = '$newpassword' WHERE token = '$token' ";
	$run = mysqli_query($conn , $query1) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0) {
		echo "<center> <font color = 'green' > Contraseña cambiada con éxito </font><center> " . " " . "<a href='login.php'>login</a>" ;
	}
	else {
		echo "<center> <font color = 'red' > Se produjo un error !</font><center> " ;
	}
}
else {
	echo "<center> <font color = 'red' > Las contraseñas no coinciden</font><center> " ;
	}
}
}
else {
	echo "something went wrong " . " <a href=recoverpassword.php> Inténtalo de nuevo </a> ";
}
}
else {
	header("location: index.php");
}
?>
