<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "DBClinicmain";

    // Create a connection to the database
    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

    // Check if the connection was successful
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
    $contact = "+91" . $_POST["contact"]; // Add "+91" prefix to the contact number

    // Check if the email is already registered in any of the tables
    $checkEmailSql = "SELECT Email FROM tbl_patient WHERE Email = ? 
                      UNION ALL
                      SELECT Email FROM tbl_dentist WHERE Email = ? 
                      UNION ALL
                      SELECT Email FROM tbl_receptionist WHERE Email = ?";
    
    // Prepare the SQL statement
    if ($checkStmt = mysqli_prepare($conn, $checkEmailSql)) {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($checkStmt, "sss", $email, $email, $email);

        // Execute the statement
        mysqli_stmt_execute($checkStmt);

        // Store the result
        mysqli_stmt_store_result($checkStmt);

        // Check if the email already exists in any table
        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            echo "Email is already registered. Please choose a different email.(Redirecting in 2 seconds)";
            header("Refresh: 2; URL=Register.php");
        } else {
            // Email is not registered, proceed with registration
            // SQL query to insert the user information into the "Patient" table
            $insertSql = "INSERT INTO tbl_patient (Email, Password, Patient_Name, DOB, Gender, Address, Contact_No) VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Prepare the SQL statement
            if ($insertStmt = mysqli_prepare($conn, $insertSql)) {
                // Bind parameters to the statement
                mysqli_stmt_bind_param($insertStmt, "sssssss", $email, $password, $name, $dob, $gender, $address, $contact);

                // Execute the statement
                if (mysqli_stmt_execute($insertStmt)) {
                    // Registration successful
                    echo "Registration successful. You can now log in.";
                    header("Refresh: 2; URL=Login.php");
                } else {
                    // Registration failed
                    echo "Registration failed. Please try again later.";
                }

                // Close the statement
                mysqli_stmt_close($insertStmt);
            } else {
                // Error preparing the SQL statement
                echo "Error: " . mysqli_error($conn);
            }
        }

        // Close the check statement
        mysqli_stmt_close($checkStmt);
    } else {
        // Error preparing the SQL statement
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to the registration page if the form was not submitted
    header("Location: registration.php");
    exit();
}
?>
