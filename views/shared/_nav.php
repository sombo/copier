<nav class="navbar navbar-inverse navbar-custom">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu_for_phones" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $this->Translate($this->Site_Name);?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menu_for_phones">
      <!-- <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->Translate("user");?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        
      </ul> -->
    <?php  foreach ($this->resources as $model => $show_in_nav) { 
              if($show_in_nav){?>
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->Translate($model);?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class="pull-right" href="http://localhost/~kfircohen/MyFrame/<?php echo $model;?>" ><?php echo $this->Translate("show");?></a></li>
                      <li><a class="pull-right" href="http://localhost/~kfircohen/MyFrame/<?php echo $model;?>/new" ><?php echo $this->Translate("new");?></a></li>   
                    </ul>
                  </li>
                </ul>
      
      
    <?php }} ?>
    <ul class="nav navbar-nav navbar-right">
    <?php 
          foreach ($this->matches as $label => $path) {
         
          ?>
             <li><a class="pull-right" href="http://localhost/~kfircohen/MyFrame/<?php echo $path;?>" ><?php echo $this->Translate($label);?></a></li>
         
        <?php
          }
        ?>
   </ul>
      <form class="navbar-form navbar-right" role="search" action="../controllers/<?php echo $this->model;?>_controller.php" method=POST enctype=multipart/form-data;charset=UTF-8>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="<?php echo $this->Translate('search');?>">
        </div>
        <button type="submit" class="btn btn-default"><?php echo $this->Translate('submit');?></button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>