<?php
//$server_name=$_SERVER['SERVER_NAME'] . ':81';
$server_name="localhost/~kfircohen/MyFrame/";
$_serv="http://" . $server_name;

// include_once ("../boot/functions_boot.php");

?>

<!DOCTYPE html>
<html dir="rtl" lang="he/il" >
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?echo $this->site_name."/".$this->Page_Title;?></title>
	
	<meta name="description" content="">
  <meta name="author" content="">
	
	<? @include_once ("../views/boot/top.php");?>

	<!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css"> -->
     <link rel="stylesheet" href="http://<?=$server_name?>/assets/css/bootstrap.css"> 
     <link rel="stylesheet" href="http://<?=$server_name?>/assets/stylesheets/application.css"> 
    <!-- <link href="<?php $_serv?>/assets/css.old/bootstrap.css" rel="stylesheet">  -->
</head>

<body>
<!-- header -->
<? @include_once ("../views/shared/_head.php");?>
<div class="container">
      <!-- <div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
      </div> -->
      <div class="row">
        <?		
			   include $_SESSION["yield"];
			   $_SESSION["yield"] = null;
		    ?>
    </div>
</div>
<!-- <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
</footer> -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://<?=$server_name?>/assets/js/bootstrap.min.js"></script>
    <script src="http://<?=$server_name?>/assets/scripts/application.js"></script>
	<? #@include_once ("../views/shared/_foot.php");?>
	<? #@include_once ("../views/shared/scripts.php");?>
</body>
</html>


