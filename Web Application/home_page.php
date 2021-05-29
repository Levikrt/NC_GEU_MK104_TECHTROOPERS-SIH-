<!DOCTYPE html>
<html lang="en">
<head>
  <title>Smart Intelligent Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
function check_traffic() {
  window.location.href="http://localhost:80443//SIH_project//sitms_list_incidents.php";
}
</script>
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
      <div class="panel-heading">Welcome to the Home Page</div>
      <div class="panel-body">
	   <form action="" method="">

	  <div class="imgcontainer">
		<img src="home_icon.jpg" alt="Avatar" class="avatar">
	  </div>

	  <div class="sitms_container">
		<button type="button" class="btn btn-info"><a href="sitms_list_incidents.php" role="button" aria-pressed="true">Check Traffic</a></button>
    <button type="button" class="btn btn-info"><a href="sitms_report_incident.php" role="button" aria-pressed="true">Report Incident</a></button>
	  </div>
	</form>

	  </div><!--Closing tag of panel body-->
    </div>

  

</body>
</html>
