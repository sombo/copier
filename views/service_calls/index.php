<style >
    a{cursor:pointer}

  #models_list  li {
        width: 20%;
        float: left
    }

#machine_model{

}

</style>
<div class="row" style="a{cursor:pointer}">
   
    
    <div class="col-md-5">
    צד שמאל
    </div> <!-- Left Column !-->

    <div class="col-md-7" style="a{cursor:pointer}">  <!-- Right Column !-->
         <h5>בחר יצרן</h5>
        <div> <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php $is_active="class=active";?>
                <?php foreach($this->brands as $brand){ ?>
                    <li role="presentation" <?php echo $is_active;$is_active=null;?> >
                        <a  href="#<?php echo $brand['brand'];?>" 
                            class="Brands_Logo"
                            aria-controls="<?php echo $brand['brand'];?>" 
                            role="tab"
                            data-toggle="tab">
                                <?php echo $brand['brand'];?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        
        <div class="tab-content" >    <!-- Tab panels -->
             <h5>בחר דגם</h5>
            <?php $is_active="active";?>
            <?php foreach($this->brands as $brand){ ?>
                <div role="tabpanel" 
                     class="tab-pane <?php echo $is_active;$is_active=null;?>"
                     id="<?php echo $brand['brand'];?>"
                     style="text-align:left;a{cursor:pointer}">
                     <ul class="list-group" style="text-align:left" id="models_list"> 
                        <?php 
                            $is_active_1 = "active";
                            foreach($this->tools as $tool){
                                if($tool['brand_id'] == $brand['brand_id']){?>
                                   <li class='list-group-item list-group-item-success machine_model'>
                                        <a><?= $tool['model']; ?></a>
                                   </li>
                          <?php } 
                            }
                        ?>
                    </ul> 
                </div>
            <?php } ?>
        </div>
    </div>
    
    <div id="Machine_Problems_Catgory">
        
    </div>
   
</div>



 