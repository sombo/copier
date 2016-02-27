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
	public $tempp = array();
	public $form_error = array();
	public $Page_Title;
	public $lead;

	function __construct($hasModel){

		$this->Site_Name = $_POST["site_name"];

		$this->Get_Model();

		$this->Page_Title = (isset($this->Page_Title)) ? $this->Page_Title : $this->Page_Title = ucwords($this->model);
		
		if($hasModel)
			$this->d =  new Database($this->model,null,false);


		if(isset($_SESSION["errors"])){
			// die("error");
			$this->form_error  = $_SESSION["errors"];
			$_SESSION["errors"]=null;
		}


		if (isset($_GET["edit"]))
			$this->edit();
		else if(isset($_GET["new"]))
			$this->create();
		else if(isset($_GET["id"]))
			$this->show();
		else if (isset($_GET["root"]))
			$this->$_GET["root"]();

		else if(isset($_POST["delete"]))
			$this->delete();
		else if(isset($_POST["new"]))
			$this->Set_New_Records("new");
		else if(isset($_POST["edit"]))
			$this->Set_New_Records("edit");


		else
			$this->index();

		//$this->render("index");
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
		
		return $translated_word;
	}
	function Generate_Form($action){
		// require 'translate.php';

		$root_path = ($action=="edit") ? "../../" : "../" ;
		
		$userFieldRequest;
		$modd;
		$is_disabled='';
		// include("../views/shared/_form.php");
		
		echo "<table border=0 id=tblForm class='table table-hover'><tbody>";
		echo "<form id = new_".Inflect::singularize($this->model)." action=".$root_path."controllers/".$this->model."_controller.php method=POST enctype=multipart/form-data;charset=UTF-8>";
		echo "<input type=hidden id=".$action." name=".$action." />";
		foreach ($this->obj->form as $label => $wtype) {

			if($this->obj->keys[$label]=="forigen"){ // if this input is forigen key get approve values
			 	$pieces = explode("_",$label);// cut the field_id to get last field
			 	$mod = Inflect::pluralize($pieces[sizeof($pieces)-2]);// make it plural for model
			 	$len = sizeof($pieces);
			 	$str= ""; // table name
			 	for ($i=0; $i < $len - 2 ; $i++)
			 		$str.=$pieces[$i].'_';

			 	$str.=$mod;

			 	$table = new Database($str,null,true);

				foreach ($table->tableRecord as $record ) {
					if($record[$label]!=null){
						if($this->obj->Has_One[$str] != null)
							$this->tempp [$label][$record[$label]]= $record[$this->obj->Has_One[$str]];
						else if($this->obj->Belongs_To[$str] != null)
							$this->tempp [$label][$record[$label]]= $record[$this->obj->Belongs_To[$str]];
					}
				}

				/* get pretty name for input $label instead of *_id($key) */

				if($this->obj->Has_One[$str]!=null)
					$lab = $this->obj->Has_One[$str];
				else
					$lab = $this->obj->Belongs_To[$str];

				/*/*/

				$lab = (isset($hebTranlation[$lab])) ? $hebTranlation[$lab] : $lab ;//check if translation exists

				echo "<tr><td><label for=$label >".$lab." :</label> </td>";

				echo "<td><select id=".$label." name=".$label." class=fields>";

				foreach ($this->tempp[$label] as $id => $value) {
						if($id == $this->obj->object_Records[$label])
							echo "<option value=".$id." selected='selected' >".$value."</option>";
						else
							echo "<option value=".$id."  >".$value."</option>";
				}
				echo "</select></tr>";
			 }
	 		else if ($wtype == "textarea"){

				$tempLabel = (isset($hebTranlation[$label])) ? $hebTranlation[$label] : $label ;

				echo "<tr><td><$label for=$label >".$tempLabel." :</label></td>";
				echo "<td><textarea name=$label id=".$label." ".$is_disabled.">lol</textarea></td></tr>";
	 		}
			else{

				$tempLabel = (isset($hebTranlation[$label])) ? $hebTranlation[$label] : $label ;

				if ($wtype != "hidden")
					echo "<tr ><td><$label for=$label >$tempLabel :</label></td>";

				echo "<td><input type=$wtype name=$label id=$label class=fields value=".$this->obj->object_Records[$label]." ".$is_disabled."></input></td></tr>";
			}

		}

		echo "<tr><th colspan=2 $class=form-actions><div class=controls><input type = submit value = שמור class=btn />  <input type = reset  value = אפס class=btn /></th></tr>";

		echo "</form>";
		echo "</tbody></table>";


	}


	function Set_New_Records($action){
		// die(print_r($this->obj->object_Records));
		 foreach ($_POST as $key => $value) {
		 	// if($this->obj->keys[$key]=="unique")

		 	if($key != $action || $this->obj->keys[$key] != "unique")
		 		$this->obj->object_Records[$key] = $value;
		 }
			// if(is_array($this->obj->Before_Save)){
			// 	foreach ($this->obj->Before_Save as $func)
			// 		$this->obj->$func();
			// }
			$insertQuery=false;
			if($action=="new"){$insertQuery=true;}

			if($this->obj->Save($insertQuery)){
				header("Location: ../".$this->model."/".$_GET["id"]);

			}
			else{
				// die(print_r($this->obj->errors));
			 	$_SESSION["errors"] = $this->obj->errors;
			 	if($action=='edit')
					header("Location: ../".$this->model."/".$_GET['edit']."/edit");
				else
					
					header("Location: ../".$this->model."/new");

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
	function All($order=''){
		require 'translate.php';

		$this->table_name = $this->getTableNameFromForgienKey($this->obj->primary_key);
		$fieldsLength = sizeof($this->obj->table_Fields_Names);
		echo "<table id=".$this->getTableNameFromForgienKey($this->obj->primary_key)." class='table table-hover lp $this->table_name'> ";
		echo "<tr class=headers>";
		echo "<th>#</th><th>מ.ז</th>";
		//echo $fieldsLength;

		for($i=1; $i < $fieldsLength; $i++){
			$lab = $this->obj->table_Fields_Names[$i];
			 if($this->obj->keys[$this->obj->table_Fields_Names[$i]] == "forigen"){

			 	$str = $this->getTableNameFromForgienKey($this->obj->table_Fields_Names[$i]);

		 		if($this->obj->Has_One[$str] != null){
				 	$lab = $this->obj->Has_One[$str];
					//die("$lab");
				}
				else{

					$lab = $this->obj->Belongs_To[$str];
					//die("$str");
				}

		 	}
		 	//die($this->table_name);
			$lab = (isset($hebTranlation[$lab])) ? $hebTranlation[$lab] : $lab ;//check if translation exists

			echo "<th>".$lab."</th>";
		}

		echo"</tr>";
		include('../views/shared/_records.php');
		echo "</table>";
		//die(print_r($this->d->tableRecord));
		$i = 0;





		// echo "<div  id=test><ul>";
		// foreach ($this->obj->tableRecord as $field => $value) {
		// 	echo "<li><div id=$field>";
		// 	echo   "<span class=content>".$value[$this->obj->table_Fields_Names[1]]."</span>";
		// 	echo   "<span class=timestamp>".$this->obj->prettyDate($value["updated_at"])."</span>";
		// 	echo   "<div id=act>";
		// 	echo   		"<a class=action href=".$field."/edit>ערוך</a>";
		// 	echo   		"<a class=action href=".$field.">הצג</a>";
		// 	echo   		"<a class='action del' href=".$this->obj->table." class=del>מחק</a><hr>";
		// 	echo 	"</div>";
		// 	echo  "</div></li>";
	 // 	}
		// 	echo "</div>";

	}
	public function getTableNameFromForgienKey($field){
		$pieces = explode("_",$field);// cut the field_id to get last field
		$mod = Inflect::pluralize($pieces[sizeof($pieces)-2]);// make it plural for model
		$len = sizeof($pieces);
		$str= ""; // table name

		for ($j=0; $j < $len-2  ; $j++)
			$str.=$pieces[$j].'_';

		return $str.=$mod;
}


}
?>