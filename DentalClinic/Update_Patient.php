
<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "DBClinicmain";

// Create a connection to the database
$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
    
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $patientID = $_POST['patientID'];
        $newPassword = $_POST['password'];
        $newPatientName = $_POST['patientName'];
        $newDOB = $_POST['dob'];
        $newGender = $_POST['gender'];
        $newAddress = $_POST['address'];
        $newPhone = $_POST['phone'];
        
        // SQL query to update the patient's information in the database based on patientID
        $updateSql = "UPDATE tbl_patient SET Password = ?, Patient_Name = ?, DOB = ?, Gender = ?, Address = ?, Contact_No = ? WHERE Patient_ID = ?";
        
        $stmt = mysqli_prepare($conn, $updateSql);
        if (!$stmt) {
            die("Error in preparing the SQL statement: " . mysqli_error($conn));
        }
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssssi", $newPassword, $newPatientName, $newDOB, $newGender, $newAddress, $newPhone, $patientID);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            echo "Profile updated successfully!";
            header("Refresh: 2; URL=Patient.php");
        } else {
            // Update failed
            echo "Error updating profile: " . mysqli_stmt_error($stmt);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    }
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>


<!-------------------------
//session_start();
//
//$host = "localhost";
//$dbUsername = "root";
//$dbPassword = "";
//$dbname = "DBClinicmain";
//
//// Create a connection to the database
//$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
//
//// Check the connection
//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//}
//
//// Check if the user is logged in
//if (isset($_SESSION['userName'])) {
//    $userName = $_SESSION['userName'];
//    
//    // Check if the form was submitted
//    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//        // Retrieve form data
//        $patientID = $_POST['patientID'];
//        $newEmail = $_POST['Email'];
//        $newPassword = $_POST['password'];
//        $newPatientName = $_POST['patientName']; // Added new patientName
//        $newDOB = $_POST['dob'];
//        $newGender = $_POST['gender'];
//        $newAddress = $_POST['address'];
//        $newPhone = $_POST['phone'];
//        
//        // Check if the new email already exists in any table (patient, receptionist, dentist)
//        $checkEmailSql = "SELECT Email FROM patient WHERE Email = ? 
//                          UNION ALL
//                          SELECT Email FROM receptionist WHERE Email = ? 
//                          UNION ALL
//                          SELECT Email FROM dentist WHERE Email = ?";
//        
//        $stmtCheck = mysqli_prepare($conn, $checkEmailSql);
//        if (!$stmtCheck) {
//            die("Error in preparing the SQL statement: " . mysqli_error($conn));
//        }
//        
//        // Bind parameters
//        mysqli_stmt_bind_param($stmtCheck, "sss", $newEmail, $newEmail, $newEmail);
//        
//        // Execute the statement
//        mysqli_stmt_execute($stmtCheck);
//        
//        // Store the result
//        mysqli_stmt_store_result($stmtCheck);
//        
//        // Check if the email already exists in any table
//        if (mysqli_stmt_num_rows($stmtCheck) > 0) {
//            echo "Email is already registered. Please choose a different email.(Redirecting in 2 seconds)";
//            header("Refresh: 2; URL=Patient_Profile.php");
//        } else {
//            // Email is not registered, proceed with the update
//            // SQL query to update the patient's information in the database based on patientID
//            $updateSql = "UPDATE patient SET Email = ?, Password = ?, PatientName = ?, DOB = ?, Gender = ?, Address = ?, Contact_Number = ? WHERE Patient_ID = ?";
//            
//            $stmt = mysqli_prepare($conn, $updateSql);
//            if (!$stmt) {
//                die("Error in preparing the SQL statement: " . mysqli_error($conn));
//            }
//            
//            // Bind parameters
//            mysqli_stmt_bind_param($stmt, "sssssssi", $newEmail, $newPassword, $newPatientName, $newDOB, $newGender, $newAddress, $newPhone, $patientID);
//            
//            // Execute the statement
//            if (mysqli_stmt_execute($stmt)) {
//                // Update successful
//                echo "Profile updated successfully!";
//                header("Refresh: 3; URL=Patient.php");
//            } else {
//                // Update failed
//                echo "Error updating profile: " . mysqli_stmt_error($stmt);
//            }
//            
//            // Close the statement
//            mysqli_stmt_close($stmt);
//        }
//        
//        // Close the check statement
//        mysqli_stmt_close($stmtCheck);
//    }
//} else {
//    // Redirect to login page if the user is not logged in
//    header("Location: login.php");
//    exit;
//}
//
//// Close the database connection
//mysqli_close($conn);-->

