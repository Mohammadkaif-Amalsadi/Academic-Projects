<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Add your CSS styles for the dashboard here */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #007BFF;
            text-align: center;
            margin-top: 20px;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        form {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input {
            width: 34%;
            padding: 10px;
            border: 2px solid #007BFF;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        select {
            width: 35.5%;
            padding: 10px;
            border: 2px solid #007BFF;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('arrow.png') no-repeat right #fff;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 0 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-container {
            display: flex;
            justify-content: space-around;
        }

        .home-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin-right: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #0056b3;
        }
        
        .qq{
           
        }
    </style>
</head>
<body>
    <a class="home-btn" href="Main.php">Log out</a>
    <h1>Admin Dashboard</h1>

    <div class="container">
        <h2>Add New Dentist or Receptionist</h2>
        <form action="process_admin.php" method="post">
            <div class="form-group">
                <select id="type" name="type" required>
                    <option value="dentist" selected placeholder="Type">Dentist</option>
                    <option value="receptionist" placeholder="Type">Receptionist</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <select id="gender" name="gender" required>
                    <option value="male" selected placeholder="Gender">Male</option>
                    <option value="female" placeholder="Gender">Female</option>
                    <option value="other" placeholder="Gender">Other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="address" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" id="contact" name="contact" placeholder="Contact" required pattern="\d{10}" oninput="validateContact(this)">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn" name="submit">Add</button>
        </form>
    </div>

    <div class="container">
        <h2>Dentists</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Password</th>
                <th style="text-align: center">Action</th>
            </tr>

            <?php
            // Database connection (replace with your actual connection code)
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbname = "dbclinicmain";
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

            // Check if the connection was successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Function to fetch and display dentist records
            function fetchAndDisplayDentistRecords($conn) {
                $sql = "SELECT * FROM tbl_dentist";
                $result = $conn->query($sql);

                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Dentist_ID"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Dentist_Name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Gender"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Address"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Contact_No"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Password"]) . "</td>";
                        echo "<td class='btn-container'>";
                        echo "<form action='update_delete.php' method='post'>";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["Dentist_ID"]) . "'>";
                        echo "<input type='hidden' name='table' value='dentist'>";
                        echo "<input type='submit' name='action' value='Update' class='btn'>";
                        echo "<input type='submit' name='action' value='Delete' class='btn' onclick='return confirm(\"Are you sure you want to delete this dentist?\")'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No Dentist records found.</td></tr>";
                }
            }

            // Call the function to fetch and display dentist records
            fetchAndDisplayDentistRecords($conn);

            // Close the database connection
            $conn->close();
            ?>

        </table>
    </div>

    <div class="container">
        <h2>Receptionists</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Password</th>
                <th style="text-align: center">Action</th>
            </tr>

            <?php
            // Database connection (replace with your actual connection code)
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbname = "dbclinicmain";
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

            // Check if the connection was successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Function to fetch and display receptionist records
            function fetchAndDisplayReceptionistRecords($conn) {
                $sql = "SELECT * FROM tbl_receptionist";
                $result = $conn->query($sql);

                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Receptionist_ID"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Receptionist_Name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Gender"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Address"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Contact_No"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Password"]) . "</td>";
                        echo "<td class='btn-container'>";
                        echo "<form action='update_delete.php' method='post'>";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["Receptionist_ID"]) . "'>";
                        echo "<input type='hidden' name='table' value=' receptionist'>";
                        echo "<input type='submit' name='action' value='Update' class='btn'>";
                        echo "<input type='submit' name='action' value='Delete' class='btn' onclick='return confirm(\"Are you sure you want to delete this receptionist?\")'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No Receptionist records found.</td></tr>";
                }
            }

            // Call the function to fetch and display receptionist records
            fetchAndDisplayReceptionistRecords($conn);

            // Close the database connection
            $conn->close();
            ?>

        </table>
    </div>
    <script>
    function validateContact(input) {
        // Remove any non-numeric characters
        input.value = input.value.replace(/\D/g, '');

        // Limit the input to 10 digits
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    }
</script>


    <!-- Add more sections for updating and deleting records as needed -->

</body>
</html>
