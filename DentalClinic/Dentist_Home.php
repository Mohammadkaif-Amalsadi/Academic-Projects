<?php
session_start(); // Start or resume a session

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "dbclinicmain";

// Create a database connection
$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables for dentist details
$dentistID = "";
$dentistName = "";
$dentistGender = "";
$dentistAddress = "";
$dentistEmail = "";
$dentistContactNo = "";
$dentistPassword = "";

if (isset($_SESSION['dentist_email'])) {
    $dentistEmail = $_SESSION['dentist_email'];

    // Fetch dentist details based on the user's email
    $sql = "SELECT * FROM dentist WHERE Email = '$dentistEmail'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Dentist found, get their details
            $row = mysqli_fetch_assoc($result);
            $dentistID = htmlspecialchars($row["Dentist_id"]);
            $dentistName = htmlspecialchars($row["Dentist_Name"]);
            $dentistGender = htmlspecialchars($row["Gender"]);
            $dentistAddress = htmlspecialchars($row["Address"]);
            $dentistContactNo = htmlspecialchars($row["Contact_No"]);
            $dentistPassword = htmlspecialchars($row["Password"]);
        } else {
            echo "<p>No dentist found with the provided email.</p>";
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
    <title>Dentist Dashboard</title>
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li {
            margin: 0;
            padding: 0;
        }

        /* Improved styling for the navbar */
        .navbar {
            background-color: #17a2b8;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 24px;
            color: #fff;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .dentist-welcome {
            color: #fff;
            margin-right: 10px;
        }

        .welcome-icon {
            color: #fff;
            font-size: 24px;
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

        /* Attractive content styling */
        .welcome-section {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-section h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .welcome-section p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
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
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <a class="navbar-brand" href="#">Bracewell Clinic</a>
        </div>
        <div class="navbar-right">
            <span class="dentist-welcome">Welcome, Dr. <?php echo $dentistName; ?></span>
            <i class="welcome-icon fas fa-user"></i>
        </div>
    </nav>

    <!-- Your HTML code for the dashboard -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="#">Patients</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="Main.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome, Dr. <?php echo $dentistName; ?>!</h1>
        <div class="welcome-section">
            <h2>Your Dentist Dashboard</h2>
            <p>Welcome to your dentist dashboard. You can manage appointments, view patient records, and configure settings from the sidebar navigation.</p>
        </div>
    </div>
</body>
</html>
