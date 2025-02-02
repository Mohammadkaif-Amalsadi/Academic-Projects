<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "DBClinicmain";

    // Create a connection to the database
    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get user input from the registration form
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];

    // SQL query to insert the receptionist information into the "Receptionist" table
    $insertSql = "INSERT INTO tbl_patient (Email, Password, Patient_Name, DOB, Gender, Address, Contact_No) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($insertStmt = mysqli_prepare($conn, $insertSql)) {
        mysqli_stmt_bind_param($insertStmt, "sssssss", $email, $password, $name, $dob, $gender, $address, $contact);

        if (mysqli_stmt_execute($insertStmt)) {
            // Registration successful
            echo "Receptionist registration successful.";
            header("Refresh: 3; URL=Recep_Manager.php");
        } else {
            // Registration failed
            echo "Receptionist registration failed. Please try again later.";
        }

        mysqli_stmt_close($insertStmt);
    } else {
        // Error preparing the SQL statement
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // Redirect to the registration page if the form was not submitted
    header("Location: Receptionist_Reg.php");
    exit();
}
?>
