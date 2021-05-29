<!DOCTYPE html>
<html lang="en">
<head>
  <title>Smart Intelligent Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;width:70%;margin-left:15% }

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 10%;
  border-radius: 50%;
}

.sitms_container {
  padding: 16px;
  
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

</style>
</head>
<body>
 
<div class="container">
  <center><h2>Smart Intelligent Management System</h2></center>
  <div class="panel panel-info">
      <div class="panel-heading">Report an Incident</div>
      <div class="panel-body">
	   <form action="sitms_report_incident.php" method="post">

	  <div class="imgcontainer">
		<img src="road_incident.png" alt="Avatar" class="avatar">
	  </div>

	<button type="button" class="btn btn-info"><a href="home_page.php" role="button" aria-pressed="true">Back to Home page</a></button>
    
	<button type="button" class="btn btn-info"><a href="login_panel.php" role="button" aria-pressed="true">Log out</a></button>
	
	<div class="sitms_container">
    <div class="dropdown">
      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Type of road incidents
        <span class="caret"></span></button>
		<ul class="dropdown-menu" name="incident_name">
		  <li><a href="#">Dharna</a></li>
		  <li><a href="#">Encroachments</a></li>
		  <li><a href="#">Road Accident</a></li>      
		  <li><a href="#">Baarat/Party</a></li>      
		  <li><a href="#">Rains</a></li>      
		</ul>
  </div>

<input type='hidden' id='hidden_incident' value='' name="hidden_incident" />

<script>
document.querySelectorAll('li').forEach( function(el) {
            
    el.addEventListener('click', function() {
        document.querySelector('.dropdown-toggle').innerText = el.textContent;
        document.querySelector('#hidden_incident').value = el.textContent;
    });
});
</script>

  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select Location
	<span class="caret"></span></button>
    <ul class="dropdown-menu" name="incident_name">
     <li><a href="#">Himayatnagar</a></li>
      <li><a href="#">Narayanguda</a></li>
      <li><a href="#">Barkatpura</a></li>      
      <li><a href="#">Hyderguda</a></li>      
      <li><a href="#">Secunderabad</a></li> 
    </ul>
  </div>
<input type='hidden' id='hidden_loc' value='' name="hidden_loc" />
<script>
document.querySelectorAll('li').forEach( function(el) {
            
    el.addEventListener('click', function() {
        document.querySelector('.dropdown-toggle').innerText = el.textContent;
        document.querySelector('#hidden_loc').value = el.textContent;
    });
});
</script>

  <label for="comment">Description:</label>
  <textarea class="form-control" rows="5" name="description"></textarea>

    <label for="reported"><b>Reported by:</b></label>
    <input type="text" name="reported_name">

		
    <button type="submit" style="background-color:#5bc0de">Report</button>
  </div>
	</form>

	  </div><!--Closing tag of panel body-->
    </div>

  

</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $db="sitms";

      $conn = new mysqli("localhost", "root", "", $db);
      
      $sql = "INSERT INTO sitms_report_incident (incident_name, incident_desc, incident_date,incident_time,incident_location,incident_user) VALUES ('".$_POST['hidden_incident']."','".$_POST['description']."', '".date("d-m-y")."','".date("h:i:s")."','".$_POST['hidden_loc']."','".$_POST['reported_name']."')";
	  
      if(mysqli_query($conn, $sql)){
        echo "Records inserted successfully.";
	  } else{
			echo "ERROR: Could not able to execute $sql. ";
		}
}

?>