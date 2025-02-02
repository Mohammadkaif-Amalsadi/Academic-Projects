<?php
session_start(); // Start or resume a session

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

// Initialize variables for patient details
$patientName = "";
$patientEmail = "";
$patientPassword = ""; // Initialize the password variable
$patientDOB = "";
$patientGender = "";
$patientAddress = "";
$patientID = ""; // Initialize the patient ID variable
$patientPhone = ""; // Initialize the patient phone variable

if (isset($_SESSION['userID'], $_SESSION['userName'])) {
    // Both $_SESSION['userID'] and $_SESSION['userName'] are set
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];

    // Fetch patient details based on the user's name (assuming 'PatientName' is unique)
    $sql = "SELECT * FROM tbl_patient WHERE Patient_ID = '$userID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Patient found, get their details
            $row = mysqli_fetch_assoc($result);
            $patientID = htmlspecialchars($row["Patient_ID"]);
            $patientName = htmlspecialchars($row["Patient_Name"]);
            $patientEmail = htmlspecialchars($row["Email"]);
            $patientPassword = htmlspecialchars($row["Password"]);
            $patientDOB = htmlspecialchars($row["DOB"]);
            $patientGender = htmlspecialchars($row["Gender"]);
            $patientAddress = htmlspecialchars($row["Address"]);
            $patientPhone = htmlspecialchars($row["Contact_No"]);
            
        } else {
            echo "<p>No patient found with the provided name.</p>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li {
            margin: 0;
            padding: 0;
        }

        /* Improved styling for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
            transition: width 0.3s;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        /* Styling for the content area */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        /* Improved styling for patient details */
        .patient-details {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .patient-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .patient-details p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100px;
            }

            .content {
                margin-left: 100px;
            }

            .sidebar h2 {
                font-size: 20px;
            }

            .sidebar ul {
                padding-left: 20px;
            }

            .sidebar li {
                margin-bottom: 5px;
            }

            .sidebar a {
                padding: 5px;
            }

            .content h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Your HTML code for the dashboard -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="Test1.php">Back</a></li>
            <li><a href="Patient.php">Home</a>
            <li><a href="Patient_Profile.php">Manage Profile</a></li>
            <li><a href="Treatments.php">Browse Treatments</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="Main.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome <?php echo $patientName; ?>!</h1>
        <div class="patient-details">
            <h2>Your Details:</h2>
            <p><strong>ID:</strong> <?php echo $patientID; ?></p>
            <p><strong>Email:</strong> <?php echo $patientEmail; ?></p>
            <p><strong>Password:</strong> <?php echo $patientPassword; ?></p>
            <p><strong>Name:</strong> <?php echo $patientName; ?></p>
            <p><strong>Date Of Birth:</strong> <?php echo $patientDOB; ?></p>
            <p><strong>Gender:</strong> <?php echo $patientGender; ?></p>
            <p><strong>Address:</strong> <?php echo $patientAddress; ?></p>
            <p><strong>Contact:</strong> <?php echo $patientPhone; ?></p>
        </div>
        <p>This is your patient dashboard. You can access your profile and settings from the sidebar.</p>
    </div>
</body>
</html>
