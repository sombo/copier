<?php

/**
* 
*/


class ForgienKeySelect extends FormWidget
{
	public $forigen_key;
	public $selected_id;
	function __construct($forigen_key,$selected_id,$type,$name,$data,$is_disabled =''){
		$this->forigen_key = $forigen_key;
		$this->selected_id = $selected_id;
		parent::__construct($type,$name,$data,$is_disabled ='');

	}
}

?>