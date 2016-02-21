<?
if($order!='')
	$tempTable = $this->obj->OrderArrayByKey($this->table_name,$order);

	$t = 1 ;
foreach ($tempTable as $key => $value) {

			echo "<tr class=indexTable title='לחץ לפרטים נוספים...'><td>".$t++."</td>";
			 $i++;
			 // die(print_r($this->d->tableRecord));

			foreach ($value as $field => $val) {
				if($this->obj->keys[$field] == "forigen"){
					$tableName = $this->getTableNameFromForgienKey($field);

					if($this->obj->Has_One[$tableName] != null){
				 		$lab = $this->obj->Has_One[$tableName];
						// die($lab);
					}
					else{

						$lab = $this->obj->Belongs_To[$tableName];
						//die($lab);
					}

					$tempDb = new Database($tableName,null,true);

					$tempModel = new $tableName($tempDb->Find_By($val));

					echo "<td>".$tempModel->object_Records[$lab]."</td>";

					$tempModel = null;
					$tempDb = null;
				}
				else
					echo "<td class=$field>".$val."</td>";

				$i++;
			}
			 echo "</tr>";
		}

?>