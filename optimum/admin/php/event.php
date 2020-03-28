<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<div id="viewport">
	  <!-- Sidebar -->
	  <div id="sidebar">
	    <header>
	      <img src="../../image/logo1.png" alt="Optimum Tech" style="width: 200px;height: 100px;">
	    </header>
	    <ul class="nav side_list" style="list-style: none;">
	      <li>
	        <a href="../index.html">
	          <i class="fa fa-home" aria-hidden="true"></i> Home
	        </a>
	      </li><hr>
	      <li>
	        <a href="student.php">
	          <i class="fa fa-graduation-cap" aria-hidden="true"></i> Add Student
	        </a>
	      </li><hr>
	      <li>
	        <a href="employee.php">
	          <i class="fa fa-briefcase" aria-hidden="true"></i> Add Employee
	        </a>
	      </li><hr>
	      <li>
	        <a href="intern.php">
	          <i class="fa fa-users" aria-hidden="true"></i> Add Intern
	        </a>
	      </li><hr>
	      <li>
	        <a href="expense.php">
	          <i class="fa fa-credit-card" aria-hidden="true"></i> Add Expense
	        </a>
	      </li><hr>
	      <li>
	        <a href="event.php">
	          <i class="fa fa-calendar" aria-hidden="true"></i> Add Events
	        </a>
	      </li><hr>
	     
	      <li>
	      	<div class="dropdown side_but">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  	<i class="fa fa-file-text" aria-hidden="true"></i>
				    Reports
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a class="dropdown-item" href="#">Student Record</a>
				    <a class="dropdown-item" href="#">Employee Record</a>
				    <a class="dropdown-item" href="#">Intern Record</a>
				    <a class="dropdown-item" href="#">Expense Record</a>
				  </div>
				</div>
	      </li><hr>
	    </ul>
	  </div>
	  <!-- Content -->
	  <div id="content" >
	    <nav class="navbar navbar-default">
	      <div class="container-fluid">
	        <ul class="nav navbar-nav navbar-right" style="list-style: none;">
	        
	          <li><a href="#" style="color: red;"><i class="fa fa-user-circle" aria-hidden="true"></i>Admin</a></li>
	          <li><a href="#" style="color: red;"><i class="fa fa-sign-out" aria-hidden="true"></i>Log-Out</a></li>
	        </ul>
	      </div>
	    </nav>
	    <div class="container-fluid">
	    	<div style="background-color: grey;">
	    	<p>Login => Date/Time: <span id="datetime"></span></p>

			<script>
			var dt = new Date();
			document.getElementById("datetime").innerHTML = dt.toLocaleString();
			</script>
	      	<h1>Welcome to Admin Dashboard</h1>
	      	<p>
	        	Make sure to keep all page content within the 
	        	<code>#content</code>.

	      	</p>
	        </div>
	        <h2>Event Record</h2>
	        <table border="2px" style="border-color: blue;border-width: 2px;">
				<tr><th>Id</th><th>Name</th><th>Date</th><th>Expense</th></tr>
		        <?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "optimum";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT id, name, date, expense FROM event";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {

	  					echo "<tr>";

						  echo "<td>" . $row['id'] . "</td>";

						  echo "<td>" . $row['name'] . "</td>";

						  echo "<td>" . $row['date'] . "</td>";

						  echo "<td>" . $row['expense'] . "</td>";

						echo "</tr>";

						}
				    }
				 else {
				    echo "0 results";
				}
				$conn->close();
				?>
			</table>
			
	    </div>
	  </div>
	</div>

	<!--Scripts-->
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	

</body>
</html>




