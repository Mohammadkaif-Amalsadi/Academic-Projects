<?php
// Database connection details
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "dbclinicmain";

// Create a database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $type = $_POST['type'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = "+91" . $_POST['contact']; // Add "+91" prefix to the contact number
    $password = $_POST['password'];

    // Check if the email exists in any of the tables (patient, dentist, receptionist)
    $checkSql = "SELECT 'patient' as type, Email FROM tbl_patient WHERE Email = '$email'
                 UNION ALL
                 SELECT 'dentist' as type, Email FROM tbl_dentist WHERE Email = '$email'
                 UNION ALL
                 SELECT 'receptionist' as type, Email FROM tbl_receptionist WHERE Email = '$email'";

    $checkResult = $conn->query($checkSql);

    if ($checkResult === FALSE) {
        // Error in executing the query
        echo "Error: " . $conn->error;
    } else {
        if ($checkResult->num_rows > 0) {
            echo "Error: Email already exists in the database.(Redirecting in 5 seconds.)";
            header("Refresh: 5; URL=admin.php");
        } else {
            // Define the table based on the selected type
            $table = ($type == 'dentist') ? 'tbl_dentist' : 'tbl_receptionist';

            // Insert data into the appropriate table
            if ($table == 'tbl_dentist') {
                $sql = "INSERT INTO tbl_dentist (Dentist_Name, Gender, Address, Email, Contact_No, Password) 
                        VALUES ('$name', '$gender', '$address', '$email', '$contact', '$password')";
            } else {
                $sql = "INSERT INTO tbl_receptionist (Receptionist_Name, Gender, Address, Email, Contact_No, Password) 
                        VALUES ('$name', '$gender', '$address', '$email', '$contact', '$password')";
            }

            if ($conn->query($sql) === TRUE) {
                echo ucfirst($type) . " record added successfully";
                header("Refresh: 3; URL=admin.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>
