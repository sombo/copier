<table id=<?php echo $this->table_name;?> class='table table-hover lp <?php echo $this->table_name;?> '>
	<tr class='headers success'>
		<td>#</td>
		<?php for($i=1; $i < $fieldsLength; $i++){ ?>
			<td><?php echo $this->Get_Table_Headers($i);?></td>
		<?php } ?>	
	</tr>


<?
if($order!='')
	$table_records = $this->obj->OrderArrayByKey($this->table_name,$order);
	
	$t = 1 ;
foreach ($table_records as $key => $value) {

	echo "<tr class='indexTable' id = line_".$t." title='לחץ לפרטים נוספים...'><td>".$t++."</td>";
	foreach ($value as $field => $val) {
		if($this->obj->keys[$field] == "forigen"){
			$tableName = $this->Get_Table_Name_From_Forigen_Key($field);

			if($this->obj->Has_One[$tableName] != null)
		 		$lab = $this->obj->Has_One[$tableName];
			else
				$lab = $this->obj->Belongs_To[$tableName];
				

			$tempDb = new Database($tableName,null,true);
			$tableName = ucfirst($tableName);

			$tempModel = new $tableName($tempDb->Find_By($val));

			echo "<td>".$tempModel->object_Records[$lab]."</td>";

			$tempModel = null;
			$tempDb = null;
		}
		else if($this->obj->keys[$field] != "primary"){
			/* Check if data are in DATE format if true display it in preetier format */
			$temp_val = ($field == "updated_at" || $field == "created_at") ? $this->prettyDate($val) : $val ; 
			echo "<td id=$field>".$this->Translate($temp_val)."</td>";
		}
		else if($this->obj->keys[$field] == "primary"){
			echo "<td style=display:none id=obj_id>".$val."</td>";
		}
		
	}
	 echo "</tr>";
}

?>

</table>