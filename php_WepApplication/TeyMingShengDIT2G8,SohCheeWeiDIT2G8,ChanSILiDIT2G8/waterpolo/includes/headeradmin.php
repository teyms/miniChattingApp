<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $PAGE_TITLE ?></title>
    <link rel="stylesheet" href="includes/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    
<style>
	#logo1{
		float:left;
		display:inline-block;
		vertical-align:top;
		
  	  }
	  #logo2{
		width:100px;
		height:100px;
		margin: 0px 15px 0px -25px;
	  }
</style>
  </head>
  <body>
      

  <div class="header">
    
    
        <div id="logo1">
    	<img src="includes/img/waterpoloLogo.jpg" id="logo2"/>
    	</div>
        <div style="display:inline-block;">
      	<h3 class="logo">WOLVES</h3>
        </div>
    
    <input type="checkbox" id="chk">
    <label for="chk" class="show-menu-btn">
      <i class="fas fa-ellipsis-h"></i>
    </label>
    
<?php
//$link12 = (isset($id))?printf("home.php?id=$id"):printf("home.php");
?>
<ul class="menu">
      <!--<h3 class="logo">WOLVES</h3>-->
      <a href=<?php (isset($id))?printf("listing.php?id=$id"):printf("loginadmin.php") ?>>List Account</a>
      <a href="<?php (isset($id))?printf("listpar.php?id=$id"):printf("loginadmin.php") ?>">List Participant</a>
      <label for="chk" class="hide-menu-btn">
        <i class="fas fa-times"></i>
      </label>
      

    </ul>
  </div>



  </header>
</html>