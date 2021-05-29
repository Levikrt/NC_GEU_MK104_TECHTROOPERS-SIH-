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
      <div class="panel-heading">View the incidents</div>
      <div class="panel-body">
	   <form action="sitms_list_incidents.php" method="post">
	  <div class="sitms_container">
<button type="button" class="btn btn-info"><a href="home_page.php" role="button" aria-pressed="true">Back to Home page</a></button>


	<button type="button" class="btn btn-info"><a href="login_panel.php" role="button" aria-pressed="true">Log out</a></button>
<!--Dropdown div-->
	  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select Location
    <span class="caret"></span></button>
    <ul class="dropdown-menu" name="incident_loc">
      <li><a href="#">Himayatnagar</a></li>
      <li><a href="#">Narayanguda</a></li>
      <li><a href="#">Barkatpura</a></li>      
      <li><a href="#">Hyderguda</a></li>      
      <li><a href="#">Secunderabad</a></li>      
    </ul>
  </div><!--Closing tag of drop down-->
  <input type='hidden' id='hidden_loc' value='' name="hidden_loc" />
<button type="submit" style="background-color:#5bc0de">Get Data</button>

<script>
document.querySelectorAll('li').forEach( function(el) {            
    el.addEventListener('click', function() {
        document.querySelector('.dropdown-toggle').innerText = el.textContent;
        document.querySelector('#hidden_loc').value = el.textContent;
    });
});
</script>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
		<th>Incident name</th>
		<th>Description</th>
        <th>Incident Date</th>
        <th>Incident Time</th>
        <th>Reported by</th>
      </tr>
    </thead>
    <tbody>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
$db="sitms";
$conn = new mysqli("localhost", "root", "", $db);

$sql = "select * from sitms_report_incident where incident_location='".$_POST['hidden_loc']."'";
$result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
	?>
      <tr>	  
		<td><?php echo $row['incident_name']; ?></td>
        <td><?php echo $row['incident_desc']; ?></td>
        <td><?php echo $row['incident_date']; ?></td>
        <td><?php echo $row['incident_time']; ?></td>
        <td><?php echo $row['incident_user']; ?></td>
		</tr>
		<?php
			}//closing for if
		}//closing for while
}//Closing for if
		?>      
    </tbody>
  </table>
  </div>
	</form>
	  </div><!--Closing tag of panel body-->
    </div>
</body>
</html>
