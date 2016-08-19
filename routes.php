<?php

	$this->project_Name = "קופי";
	$this->Root("welcome/index");

	$this->Resources("users");
	$this->Resources("tools");
	$this->Resources("pools");
	$this->Resources("problems");
	$this->Resources("service_calls",false);
	
	$this->Match("פתיחת תקלה","service_calls/index");
	// $this->Match("ערוך משתמש ראשון","users/1/edit");
	
	// echo "Route.php Has been read";
	// echo "\n";

	
	
?>