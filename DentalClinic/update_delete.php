<?php
// Database connection details
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "dbclinicmain"; // Make sure to use the correct database name

// Create a database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $action = $_POST["action"];
    $tableName = ($_POST["table"] == "dentist") ? "tbl_dentist" : "tbl_receptionist";
    if ($action == "Delete") {
        // Determine whether to delete from "dentist" or "staff" table based on the action
       
        if($tableName == "tbl_dentist")
        {
            $sql = "DELETE FROM $tableName WHERE Dentist_ID = $id";
        }
        else {
            $sql = "DELETE FROM $tableName WHERE Receptionist_ID = $id";
        }
        if ($conn->query($sql) === TRUE) {
            // Deletion was successful
            echo "Record deleted successfully.";
            header("Refresh: 2; URL=admin.php");
        } else {
            // Error occurred during deletion
            echo "Error deleting record: " . $conn->error;
        }
    } elseif ($action == "Update") {
        // Redirect to the update page with the ID
        
        header("Location: update.php?id=$id&table=$tableName");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
