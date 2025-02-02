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
    <title>Profile Management</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li {
            margin: 0;
            padding: 0;
        }

        /* Styling for the sidebar (same as the dashboard) */
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

        /* Styling for the content area (same as the dashboard) */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        /* Improved styling for the patient details form */
        .patient-details-form {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .patient-details-form h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .patient-details-form p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #555;
        }

        /* Responsive design for smaller screens (same as the dashboard) */
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
    <!-- Your HTML code for the profile management form -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="Test1.php">Back</a></li>
            <li><a href="Patient.php">Home</a></li>
            <li><a href="#">Manage Profile</a></li>
            <li><a href="Treatments.php">Browse Treatments</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome <?php echo $patientName; ?>!</h1>
        <div class="patient-details-form">
            <h2>Manage Your Profile</h2>
            <form action="Update_Patient.php" method="post">
                <p><strong>ID:</strong> <?php echo $patientID; ?></p>
                <p><strong>Email:</strong> <?php echo $patientEmail; ?></p>
<!--                <label for="Email">Change email:</label>-->
                <input type="hidden" id="Email" name="Email" class="form-input" placeholder="New Email" value="<?php echo $patientEmail; ?>">
                <input type="hidden" name="patientID" value="<?php echo $patientID; ?>">
                <label for="password">Change Password:</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="New Password">
                <label for="patientName">Change name:</label>
                <input type="text" id="patientName" name="patientName" class="form-input" placeholder="New Name" value="<?php echo $patientName; ?>">
                <label for="dob">Date Of Birth:</label>
                <input type="date" id="dob" name="dob" class="form-input" value="<?php echo $patientDOB; ?>">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" class="form-input">
                    <option value="Male" <?php if ($patientGender == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if ($patientGender == "Female") echo "selected"; ?>>Female</option>
                    <option value="Other" <?php if ($patientGender == "Other") echo "selected"; ?>>Other</option>
                </select>
                <label for="address">Address:</label>
                <textarea id="address" name="address" class="form-input" rows="4"><?php echo $patientAddress; ?></textarea>
                <label for="phone">Contact:</label>
                <input type="text" id="phone" name="phone" class="form-input" placeholder="Contact Number" value="<?php echo $patientPhone; ?>">
                <input type="submit" value="Update Profile" class="form-button">
            </form>
        </div>
    </div>
</body>
</html>
