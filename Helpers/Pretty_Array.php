<?php
function Pretty_Array($this,$arr=null){
		die($this);
		$str = "";
		//$temp = array();
		if($arr=="errors"){
			if(empty($this->form_error))
				return false;

			$str.="<p class=error_array>[";
			foreach ($this->form_error as $key )
				$str.= $key.", ";
		}
		else{
			if(empty($this->obj->object_Records))
				return false;

			$str.="<p class=info_array>[";
			foreach ($this->obj->object_Records as $key => $value)
				$str.= $key." : ".$value.", ";
		}

		$str[strlen($str)-2] = "]";
		$str.="</p>";
		echo $str;

	}
?>