<?php
if(!isset($_SESSION)){


		
		session_start();


}else{
if(isset($_SESSION['user_id']))
{
	

	// all okay
	 
}

else if(!isset($_SESSION['user_id']))
{
header('location:index.php');
}
}
?>