<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Reset some default styles */
        body, h1, h2, p, ul, li {
            margin: 0;
            padding: 0;
        }

        /* Improved styling for the navbar */
        .navbar {
            background-color: #ffc107;
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

        .recep-welcome {
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

        /* Receptionist registration form styling */
        .registration-form {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .registration-form label {
            display: block;
            margin-bottom: 5px;
        }

        .registration-form input[type="text"],
        .registration-form input[type="email"],
        .registration-form input[type="password"],
        .registration-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .registration-form select {
            padding: 10px;
        }

        .registration-form input[type="submit"] {
            background-color: #ffc107;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Back button styling */
        .back-button {
            margin-top: 20px;
        }

        .back-button a {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button a:hover {
            background-color: #555;
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
            <span class="recep-welcome">Welcome, Receptionist Name</span>
            <i class="welcome-icon fas fa-user"></i>
        </div>
    </nav>

    <!-- Sidebar and Content -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="Recep_Manager.php">Patients</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="Main.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome, Receptionist Name!</h1>
        <div class="welcome-section">
            <h2>Your Receptionist Dashboard</h2>
            <p>Welcome to your receptionist dashboard. You can manage appointments, view patient records, and configure settings from the sidebar navigation.</p>
        </div>

        <!-- Receptionist Registration Form -->
        <div class="registration-form">
            <h2>Receptionist Registration</h2>
            <form action="Recptionist_Regg.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br>

                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" required><br>

                <input type="submit" value="Register">
            </form>
        </div>

        <!-- Back Button -->
        <div class="back-button">
            <a href="Recep_Manager.php">Back to Manager</a>
        </div>
    </div>
</body>
</html>
