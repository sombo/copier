<?php
	
	cool_arr($this->obj->Parent_Records);
	echo $this->machines[1]["tool_id"];



function cool_arr($arr){
		foreach ($arr as $key => $value) {
			echo $key."  :  ".$value."<br/>";
		}
	}
?>