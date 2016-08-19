<div class="col-xs-6"></div>
<div class = "col-xs-6">
    <select id="brand_select">
        <?php
            foreach ($this->brands as $brand) { ?> //close php
                <option id='<?php echo $brand["brand_id"]?>' 
                        value='<?php echo $brand["brand_id"]?>' >
                            
                            <?php echo $brand["brand"];?>
                </option>
           
           <?php }?>
        
        
        ?>
    </select>

     <select id="model_select">
        <!-- Jquery Load By Ajax.... !-->
    </select>

</div>


<script src="http://localhost/~kfircohen/MyFrame/assets/scripts/service_calls.js">

</script>