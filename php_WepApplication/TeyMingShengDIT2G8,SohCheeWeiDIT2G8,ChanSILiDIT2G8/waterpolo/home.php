<head>
    <link rel="stylesheet" href="includes/home-style.css">
</head>
<?php  
    require_once('includes/helper.php');
    $hideform = false;
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if(empty($_GET['id'])){
            $hideform=true;
        }
        else{
        //get, to retreive the id from query string.
        $id = trim($_GET['id']);
        //$username = strtoupper(trim($_GET['username']));
        //$password = strtoupper(trim($_GET['password']));
        
        $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
        
        $sql = "SELECT * FROM Register WHERE RegisterID = '$id'";
        //$sql = "SELECT * FROM Register WHERE User = '$username' AND Pass = '$password'";
        
        $result = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        while($row = mysqli_fetch_array($result)){
            extract($row);
            
            //record found, read the value.
            $id = $RegisterId;
            $name = $RegisterName;
            $username = $User;
            $gender = $RegisterGender;
            $email = $RegisterEmail;
            $password = $Pass;
            $type = $Type;
        }
        
//        if(mysqli_num_rows($result) <= 0)
//        {
//            echo 'Opps, Record not found.';
//            $hideform = true;
//        }
          //printf("| %d | %s | %s | %s | %d | %s | %s |",$id,$name,$gender,$email,$type,$username,$password); 
        }
        
    }
?>

<?php
$PAGE_TITLE = 'Home';
if($hideform==false){
printf("<a href='home.php'>$name 's account | </a>");
printf("<a href='home.php'>log out</a>");
}
else
{
printf("<a href='login.php'>Login | </a>");
printf("<a href='register.php'>Register</a>");    
}
include('includes/header.php');
?>

<html>
    <body>
        <div class="section page header_section">
        <div class="gradient gradient_red_blue gradient_header_section"></div>
	<div class="section_container header_section_container flex_container flex_header_container">
		<div class="text header_text">
			<h1>Team Wolves</h1>
		</div>
		<div class="text body_text flex_item flex_header_item">
			<h2 class="header_quote">Join us on our Society. Come WaterPolo, come Swim and have fun with us!</h2>
		</div>
	</div>
</div>
        
        <div class="section page second_section">
<a name="team"></a>
	<div class="section_container second_section_container flex_container flex_center">
		<div class="text header_text text_grad_purple_yellow">
                    <h2>Event Countdown</h2>
		</div>
                        
                <p id="demo"></p>

			
		
	</div>
</div>
        
        <div class="section page third_section">
<a name="contact"></a>
	<div class="gradient gradient_red_yellow gradient_third_section"></div>
	<div class="section_container third_section_container flex_container flex_center">
		<div class="text header_text">
			<h1>Offers</h1>
		</div>
		<a href="#link6"><div class="feature offer flex_feature_item offer1 text-center">
                <h2 class="heading">Tarcian</h2>
                <span class="price"><sup>$</sup> <span class="number">10</span></span>
                <span class="excerpt d-block">per entry</span>
	            
	            <h3 class="heading-2 my-4">Enjoy Our Event</h3>
                    <ul class="pricing-text">
                        <li>Conference Seats</li>
                        <li>Coffee Breaks</li>
                        <li>Lunch</li>
                        
	            </ul>
		</div></a>
		<div class="feature offer flex_feature_item offer2 text-center">
			<h2 class="heading">Non-Tarcian</h2>
                <span class="price"><sup>$</sup> <span class="number">20</span></span>
                <span class="excerpt d-block">per entry</span>
	            
	            <h3 class="heading-2 my-4">Enjoy Our Event</h3>
                    <ul class="pricing-text">
                        <li>Conference Seats</li>
                        <li>Coffee Breaks</li>
                        <li>Lunch</li>
                        
	            </ul>
                <a href="#" class="btn btn-primary d-block px-2 py-3">Buy Ticket</a>

                    </div>
		
	</div>
</div>
        <script>
// Set the date we're counting down to
var countDownDate = new Date("Nov 21, 2019 08:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
    </body>
    
    
</html>
