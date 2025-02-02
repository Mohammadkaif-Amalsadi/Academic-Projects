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

    // Prepare and execute a SQL query to fetch receptionist details
    $stmt = $conn->prepare("SELECT Receptionist_ID, Email FROM tbl_receptionist WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Receptionist found, redirect to Receptionist Home and store data in session
        $row = $result->fetch_assoc();
        $_SESSION['receptionist_id'] = $row['Recep_ID'];
        $_SESSION['receptionist_email'] = $email;
        header("Location: Receptionist_Home.php");
        exit();
    } else {
        // No receptionist found with the provided email and password
        echo "<script>
            alert('Login Failed. Please check your credentials.');
            window.location.href = 'Receptionist_Login.php'; // Redirect to the login page
          </script>";
    }
} else {
    // Invalid request, redirect to Receptionist Login page
    echo "<script>
            alert('Login Failed. Please check your credentials.');
            window.location.href = 'Receptionist_Login.php'; // Redirect to the login page
          </script>";
}

$conn->close();
?>
