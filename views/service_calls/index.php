<div class="col-xs-6"></div>
<div class = "col-xs-6">
<form id = "open_service" action="<?php echo '../controllers/'.$this->model.'_controller.php'?>" method="POST" enctype="multipart/form-data;charset=UTF-8">
<!-- <input type=hidden id="action" name="action" value="1" /> !-->
    <select id="brand_select">
        <?php
            foreach ($this->brands as $brand) { ?> 
                <option id='<?php echo $brand["brand_id"]?>' 
                        value='<?php echo $brand["brand_id"]?>' >
                                  <?php echo $brand["brand"];?>
                </option>
           
           <?php }?>
        
        
    
    </select>

     <select id="model_select">
        <!-- Jquery Load By Ajax.... !-->
    </select>
</form>
</div>


