<?php 

$core = Core::getInstance();

$error = '';

if(isset($_POST['submit'])){
		// check for email and password
	$username = addslashes(strip_tags(trim($_POST['username'])));
	$teacher_name = addslashes(strip_tags(trim($_POST['teacher_name'])));
	$teacher_id = addslashes(strip_tags(trim($_POST['teacher_id'])));
	$password = addslashes(strip_tags(trim($_POST['password'])));
	$password = md5($password);
	$confirm_password = addslashes(strip_tags(trim($_POST['confirm_password'])));
	$confirm_password = md5($confirm_password);

	// password are equal or not
	if($password == $confirm_password){

		// check if already user name exists
		$q = "SELECT * FROM login WHERE username=:username";
		$stmt = $core->dbh->prepare($q);
		$stmt->bindParam(':username',$username, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() == 0){
			// proceed to signup
			$role = 'TEACHER';
			$active=0;
			$q = "INSERT INTO login (username,teacher_name,teacher_id,password,role, active) VALUES(:username,:teacher_name,:teacher_id,:password,:role, :active)";
			$stmt = $core->dbh->prepare($q);
			$stmt->bindParam(':username',$username, PDO::PARAM_STR);
			$stmt->bindParam(':teacher_name',$teacher_name, PDO::PARAM_STR);
			$stmt->bindParam(':teacher_id',$teacher_id, PDO::PARAM_STR);
			$stmt->bindParam(':password',$password, PDO::PARAM_STR);
			$stmt->bindParam(':role',$role, PDO::PARAM_STR);
			$stmt->bindParam(':active',$active, PDO::PARAM_INT);
			if($stmt->execute()){
				echo '<script>alert("Successfully Created. You will receive an email for verification")</script>';	
			}else{
				echo '<script>alert("Something Went Wrong ")</script>';
			}

		
	


		}else{
			$error = 'Username already exists';
		}

	}else{
		$error = 'Password mismatched';
	}

	
}

?>

<div class="container">
	<div style="display: flex; align-items: center; justify-content: center; height: 90vh">
		<form method="post">
			<h4>Teacher Signup</h4>
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
				<label for="exampleInputPassword1">Teacher Name</label>
				<input type="text" name="teacher_name" class="form-control" placeholder="Teacher Name">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Teacher ID</label>
				<input type="text" name="teacher_id" class="form-control" placeholder="Teacher ID">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="text" name="password" class="form-control" placeholder="New Password">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Confirm Password</label>
				<input type="text" name="confirm_password" class="form-control" placeholder="Confirm Password">
			</div>

			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			
			
		</form>
	</div>
</div>