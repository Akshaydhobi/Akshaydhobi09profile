<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "form";   // change to your database name

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

// Check form submit
if(isset($_POST['submit'])){

    // Get and validate form data
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $age = isset($_POST['age']) ? trim($_POST['age']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';

    // Validate that required fields are not empty
    if(empty($name) || empty($lname) || empty($gender) || empty($age) || empty($phone) || empty($address)){
        echo "All fields are required!";
    } else {
        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO `login` (`fname`, `lname`, `gender`, `age`, `phone`, `address`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $lname, $gender, $age, $phone, $address);

        if(mysqli_stmt_execute($stmt)){
            echo "Data inserted successfully";
        } else {
            echo "Error: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($con);
?>
