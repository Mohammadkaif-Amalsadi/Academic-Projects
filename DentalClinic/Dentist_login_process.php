<?php
session_start(); // Start or resume a session

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "dbclinicmain";

// Create a database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute a SQL query to fetch dentist details
    $stmt = $conn->prepare("SELECT Dentist_ID, Email FROM dentist WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Dentist found, redirect to Dentist Home and store data in session
        $row = $result->fetch_assoc();
        $_SESSION['dentist_id'] = $row['Dentist_ID'];
        $_SESSION['dentist_email'] = $email;
        header("Location: Dentist_Home.php");
        exit();
    } else {
        // No dentist found with the provided email and password
     

          echo "<script>
            alert('Login Failed. Please check your credentials.');
            window.location.href = 'Dentist_Login.php'; // Redirect to the login page
          </script>";
    }
} else {
    // Invalid request, redirect to Dentist Login page
  echo "<script>
            alert('Login Failed. Please check your credentials.');
            window.location.href = 'Dentist_Login.php'; // Redirect to the login page
          </script>";
}

$conn->close();
?>
