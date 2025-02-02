<?php
session_start(); // Start or resume a session

$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];
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

// Query to fetch appointment details including patient, treatment, and dentist information
$appointmentDetailsSQL = "SELECT
    p.Patient_Name, p.DOB, p.Gender, p.Email, p.Address,
    t.Treatment_Name, t.Treatment_Desc, t.Cost,
    d.Dentist_Name, d.Gender AS Dentist_Gender, d.Email AS Dentist_Email,
    a.Date, a.Time, a.Status
FROM tbl_Appointment a
LEFT JOIN tbl_Patient p ON a.Patient_ID = p.Patient_ID
LEFT JOIN tbl_Treatment t ON a.Treatment_ID = t.Treatment_ID
LEFT JOIN tbl_Dentist d ON t.Dentist_ID = d.Dentist_ID
WHERE a.Patient_ID = '$userID'";

$appointmentDetailsResult = mysqli_query($conn, $appointmentDetailsSQL);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Appointment Details</title>
    <style>
        /* CSS styles for the appointment details page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .treatment-card {
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
        }

        .nested-card {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
            padding: 10px;
        }

        .treatment-card h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .treatment-card h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .treatment-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Define text colors based on the appointment status */
        .status-pending {
            color: orange;
        }

        .status-approved {
            color: green;
        }

        .status-declined {
            color: red;
        }
    </style>
</head>
<body>
    <!-- HTML code for displaying the navbar with a back button -->
    <div class="navbar">
        <a href="Treatments.php">&#8592; Back</a>
    </div>

    <!-- HTML code for displaying appointment details in card format -->
    <?php
    if ($appointmentDetailsResult && mysqli_num_rows($appointmentDetailsResult) > 0) {
        $appointmentDetails = mysqli_fetch_assoc($appointmentDetailsResult);
        $statusClass = ''; // Initialize CSS class for status text color

        switch ($appointmentDetails["Status"]) {
            case "Pending":
                $statusClass = 'status-pending';
                break;
            case "Approved":
                $statusClass = 'status-approved';
                break;
            case "Declined":
                $statusClass = 'status-declined';
                break;
            default:
                $statusClass = '';
        }
    ?>
    <div class="treatment-card">
        <h1>Appointment Details</h1>

        <!-- Nested card for Patient Information -->
        <div class="nested-card">
            <h2>Patient Information</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($appointmentDetails["Patient_Name"]); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($appointmentDetails["DOB"]); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($appointmentDetails["Gender"]); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($appointmentDetails["Email"]); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($appointmentDetails["Address"]); ?></p>
        </div>

        <!-- Nested card for Treatment Information -->
        <div class="nested-card">
            <h2>Treatment Information</h2>
            <p><strong>Treatment Name:</strong> <?php echo htmlspecialchars($appointmentDetails["Treatment_Name"]); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($appointmentDetails["Treatment_Desc"]); ?></p>
            <p><strong>Cost:</strong> $<?php echo htmlspecialchars($appointmentDetails["Cost"]); ?></p>
        </div>

        <!-- Nested card for Dentist Information -->
        <div class="nested-card">
            <h2>Dentist Information</h2>
            <p><strong>Dentist Name:</strong> <?php echo htmlspecialchars($appointmentDetails["Dentist_Name"]); ?></p>
            <p><strong>Dentist Gender:</strong> <?php echo htmlspecialchars($appointmentDetails["Dentist_Gender"]); ?></p>
            <p><strong>Dentist Email:</strong> <?php echo htmlspecialchars($appointmentDetails["Dentist_Email"]); ?></p>
        </div>

        <!-- Nested card for Appointment Information -->
        <div class="nested-card">
            <h2>Appointment Information</h2>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($appointmentDetails["Date"]); ?></p>
            <p><strong>Time:</strong> <?php echo htmlspecialchars($appointmentDetails["Time"]); ?></p>
            <p class="<?php echo $statusClass; ?>"><strong>Status:</strong> <?php echo htmlspecialchars($appointmentDetails["Status"]); ?></p>
        </div>
    </div>
    <?php
    } else {
        echo "<p>No appointment details found.</p>";
    }
    ?>
</body>
</html>
