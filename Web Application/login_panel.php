<?php
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $db="sitms";

      $conn = new mysqli("localhost", "root", "", $db);
      $myusername = $_POST['uname'];
      $mypassword = $_POST['psw'];
      
      $sql = "SELECT * FROM sitms_login_table WHERE username = '$myusername' and password = '$mypassword'";
      $result = $conn->query($sql);

		if ($result->num_rows > 0) {
		           header("location: home_page.php");
		} else {
		   $error = "Your Login Name or Password is invalid";
		   echo $error;
		}
}
?>

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
      <div class="panel-heading">Enter your Login Details</div>
      <div class="panel-body">
	   <form action="login_panel.php" method="post">

	  <div class="imgcontainer">
		<img src="img_avatar2.png" alt="Avatar" class="avatar">
	  </div>

	  <div class="sitms_container">
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="uname" required>

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="psw" required>
			
		<button type="submit">Login</button>
	  </div>
	</form>

	  </div><!--Closing tag of panel body-->
    </div>

  

</body>
</html>
