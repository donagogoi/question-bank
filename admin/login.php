<?php 

$core = Core::getInstance();

$error = '';

if(isset($_POST['submit'])){
		// check for email and password

	$username = addslashes(strip_tags(trim($_POST['username'])));
	$password = addslashes(strip_tags(trim($_POST['password'])));
	$password = md5($password);

	$q = "SELECT * FROM login WHERE username=:username AND password=:password AND active='1'";
	$stmt = $core->dbh->prepare($q);
	$stmt->bindParam(':username',$username, PDO::PARAM_STR);
	$stmt->bindParam(':password',$password, PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() > 0){
			// we will set a session value 
		$result = $stmt->fetchObject();

		$_SESSION['user_id'] = $result->user_id;
		$_SESSION['username'] = $result->username;
		$error = "Successfully logged in: ".$_SESSION['username'];
		// redirect to dashboard
		echo "<script>window.location.href='http://localhost/question-bank/';</script>";

	}else{
			// wrong username and password
		$error = "Wrong username or password";
	}
}

?>

<div class="container">
	<div style="display: flex; align-items: center; justify-content: center; height: 90vh">
		<form method="post">
			<h4>Login here</h4>
			<?php if($error != ""){
				?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
				<?php 
				}
				?>

			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1">
			</div>

			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			
			
		</form>
	</div>
</div>