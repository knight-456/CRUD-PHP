<?php
$update = false;

$conn = mysqli_connect("localhost", "root", "", "employee");
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
// echo $_SERVER['REQUEST_METHOD'];
if (isset($_POST['done'])) {

    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];
    // $date = $_POST['date'];
    $sql = "UPDATE `employee` SET `id`=$id,`name`='$name',`email`='$email',`designation`='$designation',`salary`= '$salary',`date`= current_timestamp() WHERE 'employee'.'id' = $id ";

    $query = mysqli_query($conn, $sql);
    if ($query) {
        $update = true;
      } else {
        echo "We could not update the record successfully";
      }

    header('location:index.php');
}
// else{
//     header('location:update.php');

//     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
//     <strong>Success!</strong> Please Enter All fields.
//     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//       <span aria-hidden='true'>×</span>
//     </button>
//   </div>";

// }

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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

    <div class="container my-4">
        <form method="POST">
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
            <div>
                <button type="submit" class="btn btn-primary btn-block btn-lg" id="btn" name="done" value="submit">Submit</button>
            </div>
            </formy </body>

</html>