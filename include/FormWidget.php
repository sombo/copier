<?php
/**
* 
*/
class FormWidget 
{
	
	public $type;
	public $name;
	public $data = array();

	function __construct($type,$name,$data,$is_disabled =''){
		// $this->forigen_key = $forigen_key;
		$this->type = $type;
		// $this->name = ($forigen_key === '') ? $name : $forigen_key;

		$this->name = $name;
		$this->data = $data;
		$this->disabled= $is_disabled;
	}

	
}



?>