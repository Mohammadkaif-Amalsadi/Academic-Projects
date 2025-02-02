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

// Check if the patient has already booked an appointment
$checkAppointmentSQL = "SELECT a.*, t.Treatment_Name
                        FROM tbl_appointment a
                        LEFT JOIN tbl_treatment t ON a.Treatment_ID = t.Treatment_ID
                        WHERE a.Patient_ID = '$userID'";
$appointmentResult = mysqli_query($conn, $checkAppointmentSQL);

$hasBookedAppointment = mysqli_num_rows($appointmentResult) > 0;
$bookedTreatmentName = '';

if ($hasBookedAppointment) {
    $row = mysqli_fetch_assoc($appointmentResult);
    $bookedTreatmentName = $row['Treatment_Name'];
}

// Fetch treatments data from the treatment table, including related dentist information
$sql = "SELECT t.Treatment_ID, t.Treatment_Name, t.Treatment_Desc, t.Cost, d.Dentist_Name, t.Status
        FROM treatment t
        LEFT JOIN dentist d ON t.Dentist_id = d.Dentist_id";
$result = mysqli_query($conn, $sql);

$treatments = []; // Initialize an array to store treatment data

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $treatments[] = $row;
        }
    } else {
        echo "<p>No treatments found.</p>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Treatments</title>
    <style>
        /* Paste the CSS styles from Patient.php here */
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

        /* Style for treatment cards */
        .treatment-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .treatment-card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .treatment-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Book Now button (same as in patient.php) */
        .book-now-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        /* Responsive design for smaller screens (same as in patient.php) */
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
    <!-- Your HTML code for the sidebar (same as in patient.php) -->
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
        <h1>Available Treatments</h1>
    <?php
    if ($hasBookedAppointment) {
        // Display a message at the top indicating that the patient has already booked an appointment
        echo "<p>You have already booked an appointment for treatment: <a href='booked.php'>$bookedTreatmentName</a></p>";
    }


        foreach ($treatments as $treatment) {
        ?>
        <div class="treatment-card">
            <h2><?php echo htmlspecialchars($treatment["Treatment_Name"]); ?></h2>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($treatment["Treatment_Desc"]); ?></p>
            <p><strong>Cost:</strong> $<?php echo htmlspecialchars($treatment["Cost"]); ?></p>
            <p><strong>Dentist:</strong> <?php echo htmlspecialchars($treatment["Dentist_Name"]); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($treatment["Status"]); ?></p>
            
            <?php if (!$hasBookedAppointment) { // Check if the patient has not booked an appointment ?>
                <!-- Add a "Book Now" button that links to a booking page -->
                <a href="book_treatment.php?treatment_id=<?php echo $treatment["Treatment_ID"]; ?>" class="book-now-button">Book Now</a>
            <?php } else { ?>
                <!-- Display a message and disable the "Book Now" button -->
              
                <button disabled>Book Now</button>
            <?php } ?>
        </div>
        <?php
        }   
        ?>
    </div>
</body>
</html>
