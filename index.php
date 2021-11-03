<?php
$insert = false;
$update = false;
$delete = false;
//connect to database

$conn = mysqli_connect("localhost", "root", "", "employee");
if (!$conn) {
  die("Sorry we failed to connect: " . mysqli_connect_error());
}
//  else {
//   echo "connection successful!";
// }
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `employee` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}
// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

    // Sql query to be executed
    $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else {
    // $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $designation = $_POST["designation"];
    $salary = $_POST["salary"];
    // $date = $_POST["date"];


    // Sql query to be executed
    $sql = "INSERT INTO `employee` (`id`, `name`, `email`, `designation`, `salary`, `date`) VALUES (NULL, '$name', '$email', '$designation', '$salary', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $insert = true;
      // echo "The record was inserted successfully";
    } else {
      echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
    }
  }
  // exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD OPERATION</title>
  <link rel="stylesheet" href="css/styles.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


</head>

<body id="body">




  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CRUD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Settings
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Dashboard</a>
            <a class="dropdown-item" href="#">Shortcuts</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Help</a>
          </div>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <div style="text-align: center;">
    <h2>Popup</h2>

    <div class="popup" onclick="myFunction()">Click me to toggle the popup!
      <span class="popuptext" id="myPopup">This is a Simple Popup!</span>
    </div>
  </div>



  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Employee details has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Employee Details has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php

  session_start();
  $msg = '';

  // If user has given a captcha!
  if (isset($_POST['input']) && sizeof($_POST['input']) > 0)

    // If the captcha is valid
    if ($_POST['input'] == $_SESSION['captcha'])
      $msg = '<span style="color:green">SUCCESSFUL!!!</span>';
    else
      $msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
  else{
    $msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
  }
  ?>

  <div class="container my-4">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="my-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="my-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
      </div>
      <div class="my-3">
        <label for="designation" class="form-label">Designation</label>
        <input type="text" class="form-control" id="designation" name="designation" required>
      </div>
      <div class="my-3">
        <label for="salary" class="form-label">Salary</label>
        <input type="number" class="form-control" name="salary" id="salary" required>
      </div>
      <div class="my-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
      </div>
      <div class="container">

        <strong>
          Type the text in the image to prove
          you are not a robot
        </strong>

        <div style='margin:15px'>
          <img src="/captcha.php">
        </div>

        <form method="POST" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
          <input type="text" name="input" />
          <input type="hidden" name="flag" value="1" />
          <input type="submit" value="Submit" name="submit" />
        </form>

        <div style='margin-bottom:5px'>
          <?php echo $msg; ?>
        </div>

        <div>
          Can't read the image? Click
          <a href='<?php echo $_SERVER['PHP_SELF']; ?>'>
            here
          </a>
          to refresh!
        </div>
      </div>
      <div>
        <button type="submit" class="btn btn-primary btn-block btn-lg" id="btn" value="submit">Submit</button>
      </div>
      <!-- <tr>
        <td align="right" valign="top"> Validation code:</td>
        <td><img src="captcha.php?rand=<?php //echo rand(); 
                                        ?>" id='captchaimg'><br>
          <label for='message'>Enter the code above here :</label>
          <br>
          <input id="captcha_code" name="captcha_code" type="text">
          <br>
          Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.
        </td>
      </tr>
      <tr>
        <td> </td>
        <td><input name="Submit" type="submit" onclick="return validate();" value="Submit" class="button1"></td>
      </tr> -->

    </form>
  </div>
  <hr>

  <div class="container my-6">
    <table class="table table-responsive" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Designation</th>
          <th scope="col">Salary</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `employee`";
        $result = mysqli_query($conn, $sql);
        $id = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $id + 1;
          echo "<tr>
            <th scope='row'>" . $id . "</th>
            <td>" . $row['name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['designation'] . "</td>
            <td>" . $row['salary'] . "</td>
            <td>" . $row['date'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary'><a href ='update.php?id=" . $row['id'] . "' class = 'text-white'>Edit</a></button> <button class='delete btn btn-sm btn-primary' id=d" . $row['id'] . ">Delete</button>  </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>

  </div>
  <hr>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        id = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete the details!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${id}`;

        } else {
          console.log("no");
        }
      })
    })
  </script>
  <script>
    // When the user clicks on div, open the popup
    function myFunction() {
      var popup = document.getElementById("myPopup");
      popup.classList.toggle("show");
    }
  </script>


</body>

</html>