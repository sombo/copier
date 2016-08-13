<?php
session_start();

// include'Inflect.php';
/**
*
*/
class Controller{

	public $Site_Name;
	public $obj ;
	public $model;
	public $d ;
	public $forgien_keys_widget = array();
	public $tempp = array();
	public $form_error = array();
	public $Page_Title;
	public $lead;
	public $form_objects = array();
	public $temp_keys = array();

	//public $resources = array();
	//public $matches = array();

	function __construct($hasModel){

		$this->resources = $_POST['resources'];
		$this->matches = $_POST['matches'];
		
		$this->Site_Name = $_POST["site_name"];

		$this->Get_Model();

		$this->Page_Title = (isset($this->Page_Title)) ? $this->Page_Title : ucwords($this->model);
		echo $_POST["action"];
		if($hasModel)
			$this->d =  new Database($this->model,null,false);
		
		
		if(isset($_SESSION["errors"])){
			$this->form_error  = $_SESSION["errors"];
			// print_r($_SESSION);
			$_SESSION["errors"]=null;
		}


		if (isset($_GET["edit"])){
			if($this->Check_If_Object_Exists($_GET["edit"]) != null)
				$this->edit();
			else
				die("error Object Not Found...(  (edit)");
		}
		else if(isset($_GET["new"]))
			$this->create();

		else if(isset($_GET["id"])){
			if($this->Check_If_Object_Exists($_GET["id"]) != null)
				$this->show();
			else
				die("error Object Not Found...(   (show)");
		}
		// else if (isset($_GET["root"]))
		// 	$this->$_GET["root"]();

		else if(isset($_POST["delete"]))
			$this->delete();
		else if(isset($_POST["new"]))
			$this->Set_New_Records("new");
		else if(isset($_POST["edit"]))// die("here");
			// die("hello World!!!!");
			$this->Set_New_Records("edit");


		else
			// die("root");
			$this->index();

		//$this->render("index");
	}

	function Check_If_Object_Exists($object_Id){
		return $this->d->Find_By($object_Id);
	}
	
	public function get_json($hiddenField,$visual){
		echo json_encode($this->tempp[$hiddenField]);
		//$this->tempp=null;
	}

	function Pretty_Array($arr=null){

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
		// die($str)
		$str[strlen($str)-2] = "]";
		$str.="</p>";
		echo $str;
	}

	function Translate($word,$lang=''){
		require 'translate.php';
		$translated_word = (isset($heb[$word])) ? $heb[$word] : $word;
		//die($word);
		return $translated_word;
	}
	
	function Get_Table_Name_From_Forigen_Key($key_name){

		$pieces = explode("_",$key_name);// cut the field_id to get last field
		// if(sizeof($pieces)>)
		$mod = Inflect::pluralize($pieces[sizeof($pieces)-2]);// make it plural for model
		// die($mod);
		$len = sizeof($pieces);
		$str= ""; // table name
		for ($i=0; $i < $len -2 ; $i++)
			 $str.=$pieces[$i].'_';
			 	
		return $str.=$mod;
	}

	function Get_Value_From_Field($table,$field){

	}
	function Set_Forigen_Table_Data($forigen_key_table_name,$label,$record){
		$table = new Database($forigen_key_table_name,null,true);
		
		foreach ($table->tableRecord as $record ) {
			
			if($record[$label]!=null){
						
				if($this->obj->Has_One[$forigen_key_table_name] != null)
					$this->forgien_keys_widget[$label][$record[$label]] = $record[$this->obj->Has_One[$forigen_key_table_name]];
				else if($this->obj->Belongs_To[$forigen_key_table_name] != null)
					$this->forgien_keys_widget[$label][$record[$label]] = $record[$this->obj->Belongs_To[$forigen_key_table_name]];
			}
				
		}
		
	}

	function Get_Name_For_Label($forigen_key_table_name,$key='false'){
		/* get pretty name for input $label instead of *_id($key) */
		
		$temp = ($key==='true') ? $this->Get_Table_Name_From_Forigen_Key($forigen_key_table_name) : $forigen_key_table_name;	
		if($this->obj->Has_One[$temp]!=null)
			$lab = $this->obj->Has_One[$temp];
		else
			$lab = $this->obj->Belongs_To[$temp];
	
		return $lab;
	}

	function Generate_Displayble_Object_Properties($order='primary'){
		// $arr = $this->obj->OrderArrayByKey()
		$arr = array();
		// die("wowow");
		foreach ($this->obj->object_Records as $field_name => $field_value) {
			if($this->obj->keys[$field_name] === "primary")
				$arr["index"] = $field_value;
			else if($this->obj->keys[$field_name] === "forigen"){
				$temp_field_name = $this->Get_Name_For_Label($field_name,'true');
				$table_name = $this->Get_Table_Name_From_Forigen_Key($field_name);
				//die($field_name);
				$tempDb = new Database($table_name,null,true);
				$table_name = ucfirst($table_name);

				$tempModel = new $table_name($tempDb->Find_By($field_value));
				
				$arr[$temp_field_name] = $tempModel->object_Records[$temp_field_name];
				$tempModel = null;
				$tempDb = null;

			}
			else
				$arr[$field_name] = $field_value;		
			
		}
		return $arr;
	}
	function Generate_Form($action){

		require_once("FormWidget.php");
		require_once("ForgienKeySelect.php");

		$root_path = ($action=="edit") ? "../../" : "../" ;
		
		$widgets = array();

		$data = array();
		
		$w_index = 0;
		
		$is_disabled='';
		// $selected_id='';
		
		foreach ($this->obj->form as $label => $wtype) {

			if($this->obj->keys[$label]=="forigen"){ 

			/* Create Select Widget with all the data that related */

			 	$forigen_key_table_name = $this->Get_Table_Name_From_Forigen_Key($label);
			 	
			 	$this->Set_Forigen_Table_Data($forigen_key_table_name,$label,$record);

			 	$label_name = $this->Get_Name_For_Label($forigen_key_table_name);

				$selected_id = $this->obj->object_Records[$label];
				try{
					foreach ($this->forgien_keys_widget[$label] as $id => $value) 
						$data[$id] = $value;
					}
				catch(Exception $e){
					die( "label : ".$label."<br/>id : ".$id."<br/>value : ".$value);
				}
				$forigen_key_name = $label;
				$widgets[$w_index] = new ForgienKeySelect($forigen_key_name,$selected_id,"select",$label_name,$data);
				
			}
			else if ($label == "phone") {
				$widgets[$w_index] = new FormWidget("tel",$label,$data);
			}
	 		else if ($wtype == "textarea"){
	 			$widgets[$w_index] = new FormWidget($wtype,$label,"");
	 		}
			else{
				$data[$w_index] = $this->obj->object_Records[$label];
				$widgets[$w_index] = new FormWidget($wtype,$label,$data);	
			}
			$w_index++;
			$data = null;
		}

		return $widgets;	
	}
	function Get_Values_From_Keys($table_record){
		foreach ($table_record as $field => $value) {
			if($this->obj->keys[$field] == 'forigen'){
				$tbl_name = $this->Get_Table_Name_From_Forigen_Key($field);
				$tempDb = new Database($tbl_name,null,true);
				$tbl_name = ucfirst($tbl_name);
				$temp_Model_Record = new $tbl_name($tempDb-Find_By($table_record[$field]));
				$this->Get_Values_From_Keys($temp_Model_Record);
				$this->temp_keys[$table_record[0]][$field] = $value; 
			}
			else
				$this->temp_keys[$table_record[0]][$field] = $value;

		}
		print_r("rec_end");
		return $this->temp_keys;
	}
	function Set_New_Records($action){
		
		foreach ($_POST as $key => $value) {
			
			if($key != $action || $this->obj->keys[$key] != "unique")
		 		$this->obj->object_Records[$key] = $value;
		 		
		 	}
			
			/*if(is_array($this->obj->Before_Save)){
				foreach ($this->obj->Before_Save as $func)
					$this->obj->$func();
			}*/
			
			// $insertQuery=false;
			// if($action=="new"){$insertQuery=true;}

			$insertQuery = ($action === "new") ? true : false ;
			
			if($this->obj->Save($insertQuery)){
				echo "success";
				//header("Location: ../".$this->model."/".$_GET["id"]);

			}
			else{
				// die(print_r($this->obj->errors));
			 	$_SESSION["errors"] = $this->obj->errors;
			 	if($action=='edit')
					echo " edit failed";
					//header("Location: ../".$this->model."/".$_GET['edit']."/edit");
				else
					echo "new failed";	
				//	header("Location: ../".$this->model."/new");

			}
	}
	
	function Get_Model(){
		$class = get_class($this);
		$pieces = explode("_",$class);
		$len = sizeof($pieces);
		if($len == 2)
			$this->model =  Inflect::pluralize($pieces[0]);
		else{
			for ($i=0; $i < $len-1 ; $i++) {
				$this->model.=$pieces[$i]."_";
			}
			$this->model[strlen($this->model)-1]='';
			$this->model = trim($this->model);
		}
	}
	
	function render($action,$layout=''){
		$params = explode("/",$_SERVER['REQUEST_URI']);
		if($action=="edit")
			$_SESSION["id"] = $params[4];

		if($layout==''){
	 		if(isset($this->layout))
	 			$layout = $this->layout;
	 		else
	 			$layout = "app";
	 	}


		$template = "../views/".$this->model."/".$action.".php";
		$_SESSION["yield"] = $template;
		include_once "../views/layouts/_".$layout.".php";
	}

	function ajax($msg){
		echo trim($msg);
	}
	
	function Get_Table_Headers($i){
		$lab = $this->obj->table_Fields_Names[$i];
		
		if($this->obj->keys[$this->obj->table_Fields_Names[$i]] == "forigen"){
			
			$str = $this->Get_Table_Name_From_Forigen_Key($this->obj->table_Fields_Names[$i]);

		 		if($this->obj->Has_One[$str] != null){
				 	$lab = $this->obj->Has_One[$str];
					//die("$lab");
				}
				else{

					$lab = $this->obj->Belongs_To[$str];
				}

		 	}
		 	//die($this->table_name);
			$lab = (isset($hebTranlation[$lab])) ? $hebTranlation[$lab] : $lab ;//check if translation exists

			return $this->Translate($lab);

	}
	function All($order=''){
		
		$this->table_name = $this->Get_Table_Name_From_Forigen_Key($this->obj->primary_key);
		$fieldsLength = sizeof($this->obj->table_Fields_Names);
		
		
		include('../views/shared/_records.php');
	

	}
	
	function prettyDate($date){ 
		 $time = @strtotime($date); 
		 $now = time(); 
		 $ago = $now - $time; 
		 if($ago < 60){ 
		 	$when = round($ago); 
		 	$s = ($when == 1)?"שנייה":"שניות"; 
		 	return "לפני $when $s "; 
		 }
		 elseif($ago < 3600){ 
		 	$when = round($ago / 60); 
		 	$m = ($when == 1)?"דקה":"דקות"; 
		 	return "לפני $when $m "; 
		 }
		 elseif($ago >= 3600 && $ago < 86400){ 
		 	$when = round($ago / 60 / 60); 
		 	$h = ($when == 1)?"שעה":"שעות"; 
		 	return "לפני $when $h "; 
		 }
		 elseif($ago >= 86400 && $ago < 2629743.83){ 
		 	$when = round($ago / 60 / 60 / 24); 
		 	$d = ($when == 1)?"יום":"ימים"; 
		 	return "לפני $when $d "; 
		 }
		 elseif($ago >= 2629743.83 && $ago < 31556926){ 
		 	$when = round($ago / 60 / 60 / 24 / 30.4375); 
		 	$m = ($when == 1)?"חודש":"חודשים"; 
		 	return "לפני $when $m "; 
		 }
		 else{ 
		 	$when = round($ago / 60 / 60 / 24 / 365); 
		 	$y = ($when == 1)?"שנה":"שנים"; 
		 	return "לפני $when $y "; 
		 } 
	} 


}
?>