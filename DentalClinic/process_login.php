<?php
// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "DBClinicmain";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user input
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to fetch user with the given email and password
$sql = "SELECT * FROM tbl_patient WHERE Email = '$email' AND Password = '$password'";

$result = mysqli_query($conn, $sql);

// Check if there is a matching user
if (mysqli_num_rows($result) > 0) {
    // Authentication successful, show a success message in a modal popup
// Redirect to Test1.php with email and password as URL parameters
header("Location: Test1.php?email=" . urlencode($email) . "&password=" . urlencode($password));
exit();

    
    exit();
} else {
    // Authentication failed, show an error message in a modal popup
    echo "<script>
            alert('Login Failed. Please check your credentials.');
            window.location.href = 'Login.php'; // Redirect to the login page
          </script>";
}

// Close the database connection
mysqli_close($conn);
?>
