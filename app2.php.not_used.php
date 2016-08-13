<!DOCTYPE html>
<html lang="he" dir="rtl">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?echo $this->Page_Title;?></title>
	
		<!-- Bootstrap -->
    	<link href="css/bootstrap.min.css" rel="stylesheet"> 
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
      		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->

    	<style type="text/css">
      		.navbar-custom a{color:#1c6b4f !important;}
        	/*background-color: #080808*/
        	html {
          		/*text-align: right;*/
  				position: relative;
  				min-height: 100%;
			}
			body {
  				/* Margin bottom by footer height */
  				margin-bottom: 60px;
			}
			.footer {
  				position: absolute;
  				bottom: 0;
  				width: 100%;
  				/* Set the fixed height of the footer here */
  				height: 60px;
  				background-color: #f5f5f5;
			}
			p{
  				border: 1px solid #080808;
			}

			/* Custom page CSS
			-------------------------------------------------- */
			/* Not required for template or sticky footer method. */

			body > .container {
  				padding: 60px 15px 0;
			}
			.container .text-muted {
  				margin: 20px 0;
			}

			.footer > .container {
  				padding-right: 15px;
  				padding-left: 15px;
			}

    	</style>

</head>
<style type="text/css">
	/*a{
		margin-right: 5px;
	}

	#debug_Status{
		border: 1px solid green;
		background-color: #ddd;
		clear: both;
	}
	.all_Objects{
		border: 1px solid #EFF;
		background-color: #DDD;
		margin-top: 3px;
		width: 150px;
		float: left;
		margin-bottom: 10px;
		margin-right: 20px;
	}
	.form{
		margin-left: 420px;
		margin-bottom: 10px;
		width: 380px;
		border: 1px solid #ddd;
		font-family: "Arial, Helvetica, sans-serif";
	}
	.form h3{text-align: center;}
	input[type="button"], input[type="submit"], input[type="reset"] {
		width:100px;
	}
	#buttons{
		text-align: center;
		
	}
	#tblForm{margin:auto;}
	select{width:155px;}
	input{width:150px;}
	.error_array{
		font-size: 10px;
		font-family: arial;
		background: #C10;
	}
	.info_array{
		font-family: arial;

		background: #C90;
	}
	.wow{	font-family: arial;
		background: #C90}*/
</style>
<body>
	
<?php

	
	include $_SESSION["yield"];
	$_SESSION["yield"] = null;
	//	session_destroy();
	
	
	echo "<div id=debug_Status>no errors</div>";
?>

<script type="text/javascript">
	 String.prototype.trim = function () {
    	return this.replace(/^\s*/, "").replace(/\s*$/, "");
	 }
	 $(function(){
			$(".del").click(function(){
				alert("dfd");
				var id = $(this).parent().attr("id");
				var thiss = $(this).parent();
				//$(this).parent().remove();
				var url = window.location.href;
				var urlSplit = url.split("/"); 
				var controller = urlSplit[urlSplit.length-1];
				
				$.ajax({
					url: controller,
					data:"delete="+id,
					type:'POST',
					dataType:'text',
					success:function(msg){
						if(msg.trim() == "ok")
							thiss.remove();
						
						else
							console.log(msg);
					},
				});
				//$(this).parent().remove();
				return false;
			});
	 });
	 
	//$('p',$('.all_Objects')).filter(':even').css('background-color', 'yellow');
</script>
</body>
</html>


