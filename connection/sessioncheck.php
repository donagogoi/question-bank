<?php
if(!isset($_SESSION)){


		
		session_start();


}else{

 
	 

$user_category='';
if(isset($_SESSION['category']))
{
	

	$user_category=$_SESSION['category'];
	if($user_category=='admin')
	{
		$username=$_SESSION['admin'];
		/*echo $username;*/
		 

	}
	else if($user_category=='user')
	{
		$username=$_SESSION['user'];
		 
	}
	 
}

else if(!isset($_SESSION['category']))
{
header('location:index.php');
}
}
?>