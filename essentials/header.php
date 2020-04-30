<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Question Bank</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://localhost/question-bank/index.php">Question Bank</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="search_paper.php">Search Paper</a>
      </li>
       <?php
      if(isset($_SESSION['user_id'])){
?>
<li class="nav-item">
        <a class="nav-link" href="paper_master.php">Paper Master</a>
      </li>
<?php
      }
    ?>
      
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
    <?php
      if(isset($_SESSION['user_id'])){
?>
<button class="btn" >as : <?php echo $_SESSION['username']; ?></button>
<a href="connection/logout.php"><button class="btn" >Logout</button></a>
<?php
      }else{
    ?>
    <a href="admin_login.php"><button class="btn" >Admin Login</button></a>
  <?php } ?>
  </div>
</nav>