<div class="col-xs-6">
	<h3 style="text-align:center;">מכונות ששייכות ללקוח : </h3>
	<hr>
<table border='0' id='pools' class='table table-hover'>
	<tr class="headers success">
		<td>#</td>
		<td>יצרן</td>
		<td>קטגוריה</td>
		<td>דגם</td>
	</tr>
	<?php
		$t=1;
		// $this->bla("tools",$this->object_id);
		foreach ($this->pools as $pool) {
			echo "<tr class=indexTable><td>"
											.$t++.
										"</td>
										<td id=obj_id style=display:none;>
											$pool[pool_id]</td>
										<td>$pool[brand]</td>
										<td>$pool[type]</td>
										<td>$pool[model]</td>
					</tr>";
		}
	?>
</table>
</div>
<br />


<div class="form col-xs-6">
	
 	
<?php 
		$object_prop = $this->Generate_Displayble_Object_Properties();
		foreach ($object_prop as $key => $value) {
		?>	<div class="prop_line">
			<label class = 'details' for ="<?php echo $key;?>" > <?php echo $this->Translate($key);?>  :   </label>
		<?php 
			if($key=="phone"){
		?>	
			<phone class ='details' name="<?php echo $key;?>" id="<?php echo $key; ?>" ><?php echo $value; ?></phone><br /></div>
		<?php }else{ ?>
			<span class="details" name="<?php echo $key; ?>" id="<?php echo $key; ?>"><?php echo $value; ?></span><br/>	</div>	
 			 <?php }?>
 
 <?php }?>
 		

	<a class="editLinks" href="http://localhost/~kfircohen/MyFrame/users/<? echo $this->obj->object_Records[user_id];?>/edit">עדכן</a>
	, <a class="dele" href="http://localhost/~kfircohen/MyFrame/users/<?echo $this->obj->object_Records[user_id];?>/delete">מחק</a> 
	  
</div>