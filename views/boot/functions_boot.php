<?php

function ddown($ddpwn)
{
	
}

function button($name,$link,$color,$size,$_dd)
{
	
	$col['gray']='';
	$col['blue']='btn-primary';	
	$col['teal']='btn-info';
	$col['green']='btn-success';	
	$col['orange']='btn-warning';
	$col['red']='btn-danger';


if($_dd=='')
{ // NORMAL BUTTON
	?>
	<a class="btn <?=$col[$color];?>" href="<?=$link;?>"><?=$name;?></a>
	<?
}
else
{	//DROP DOWN BUTTON WITH DIVIDER
	?>
	 <div class="btn-group">
          <a class="btn <?=$col[$color];?> dropdown-toggle" data-toggle="dropdown" href="#"><?=$name;?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
		  <? foreach(array_keys($_dd[$name]) as $n)
			  {
				  if($n=='_divider')
				  	{
						           ?><li class="divider"></li><?
					}
					else
					{
				?>  
            <li><a href="<?=$_dd[$n];?>" ><?=$n;?></a></li>
			  <?
					}
              }
			  ?>
			
            

          </ul>
        </div><!-- /btn-group -->
	<?
}
}

function make_nav_simple ($project_name,$_nav,$_nav_active,$_ndd)
{
	//$but=1;
	$sub=1;
	
	?>
    
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="starter-template.html#"><?=$project_name;?></a>
          <div class="nav-collapse">
            <ul class="nav">
              <? foreach(array_keys($_nav) as $n)
			  {
				  
				  if($_ndd[$n]!='')
				  {
					  ?>
                      <li class="dropdown">
              			<a href="<?=$_nav[$n];?>" class="dropdown-toggle" data-toggle="dropdown"><?=$n;?> <b class="caret"></b></a>
             			 <ul class="dropdown-menu">
							<?
                            foreach(array_keys($_ndd[$n]) as $nd)
								  {
									  if($nd=='_divider')
										{
													   ?><li class="divider"></li><?
										}
										else
										{
									?>  
								<li><a href="<?=$_ndd[$n][$nd];?>" ><?=$nd;?></a></li>
								  <?
										}
								  }
					?>
										</ul>
					</li>
						  <?
				  }
				  else
				  {
					  
					  if($but==1)
						  {
							  button($n,$_nav[$n],teal,$size);
						  }
					  else
						  {
							?><li <? if($_nav_active==$n){ echo 'class="active"'; } ?>> <a href="<?=$_nav[$n];?>" ><?=$n;?></a></li>	<?
						  } // END ($_ndd[$n]!='')
				  }
				  
				  
			  }
			  ?>
              
            </ul>
          </div><!--/.nav-collapse -->
         
        </div>
      </div>
    </div>
     
    <?
}



function make_dropdown($nav,$_ndd)
{
	foreach(array_keys($nav) as $n)
		{
			if($_ndd[$n]=='')
			{
				?><li><a href="<?=$_nav[$n];?>" ><?=$n;?></a></li><?
			}
			else
			{
				?>
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$n;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <?
                      foreach(array_keys($_ndd[$n]) as $nd)
							{
								 if($nd=='_divider')
										{
													   ?><li class="divider"></li><?
										}
										else
										{
                     		 	?><li><a href="<?=$_ndd[$n][$nd];?>" ><?=$nd;?></a></li><?
										}
							}
						?>
                    </ul>
	            </li>
      <?
			}
		}
}
/*
<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Buttons <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#buttonGroups">Button groups</a></li>
          <li><a href="#buttonDropdowns">Button dropdowns</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Navigation <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#navs">Nav, tabs, pills</a></li>
          <li><a href="#navbar">Navbar</a></li>
          <li><a href="#breadcrumbs">Breadcrumbs</a></li>
          <li><a href="#pagination">Pagination</a></li>
        </ul>
      </li>
      <li><a href="#labels">Labels</a></li>
      <li><a href="#thumbnails">Thumbnails</a></li>
      <li><a href="#alerts">Alerts</a></li>
      <li><a href="#progress">Progress bars</a></li>
      <li><a href="#misc">Miscellaneous</a></li>
*/
function nav_dropdown($nav,$_ndd,$tt)
{
	?>

    <ul class="nav <?=$tt;?>">
    <? make_dropdown($nav,$_ndd); ?>
    </ul>

  <?
}


// FACEBOOK

function fb_like($webpage)
{
	?>
	<iframe src="https://www.facebook.com/plugins/like.php?href=<?=$webpage;?>"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
	<?
}

function share_this_page()
{
	?>
    <div class="row">

<div class="span2">
<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div class="span2">
<!-- Place this tag where you want the +1 button to render -->
<g:plusone></g:plusone>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>


<div class="span2">
<a name="fb_share"></a> 
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
        type="text/javascript">
</script><!-- Place this tag where you want the +1 button to render -->
</div>


</div>
<?
}
?>