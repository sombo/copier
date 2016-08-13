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
 		

	<a class="editLinks" href="http://localhost/~kfircohen/MyFrame/tools/<? echo $this->obj->object_Records[tool_id];?>/edit">עדכן</a>
	, <a class="dele" href="http://localhost/~kfircohen/MyFrame/users/<?echo $this->obj->object_Records[tool_id];?>/delete">מחק</a> 
	  
</div>