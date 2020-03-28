<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $duration = "";
$name_err = $address_err = $duration_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate duration
    $input_duration = trim($_POST["duration"]);
    if(empty($input_duration)){
        $address_err = "Please enter a duration.";     
    } else{
        $duration = $input_duration;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($duration_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO intern (name, address, duration) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_duration);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_duration = $duration;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../d3.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
    <header role="banner">
      <h1>Optimum Tech</h1>
      <ul class="utilities">
        <li class="users"><a href="#">Admin</a></li>
        <li class="logout warn"><a href="">Log Out</a></li>
      </ul>
    </header>

    <nav role="navigation">
      <ul class="main">
        <li><a href="#"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Manage Student</a></li>
        <li><a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> Manage Employees</a></li>
        <li><a href="#"><i class="fa fa-suitcase" aria-hidden="true"></i> Manage Interns</a></li>
        <li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> Manage Expenses</a></li>
        <li><button class="dropdown-btn"><i class="fa fa-file" aria-hidden="true"></i> Report
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a href="#">Student</a>
            <a href="#">Employee</a>
            <a href="#">Expense</a>
          </div>
        </li>
          <li><button class="dropdown-btn"><i class="fa fa-user" aria-hidden="true"></i> Accounts
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-container">
            <a href="account/staff/index.php">Staff</a>
            <a href="#">Others</a>
          </div>
        </li>
      </ul>
    </nav>

    <main role="main">
      <section class="panel important">
        <h2>Welcome to Your Dashboard </h2>
        <ul>
          <li>This is the Admin Panel</li>
          <li>Hi! This is admin</li>
          <li>Welcome to Optimum Tech</li>
        </ul>
      </section>
      <section class="panel">
        <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add intern record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($duration_err)) ? 'has-error' : ''; ?>">
                            <label>duration</label>
                            <input type="text" name="duration" class="form-control" value="<?php echo $duration; ?>">
                            <span class="help-block"><?php echo $duration_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>  
      </section>
  </main>
  <footer role="contentinfo">Admin Panel by Hassan Tahawar</footer>


  <script>
    //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>