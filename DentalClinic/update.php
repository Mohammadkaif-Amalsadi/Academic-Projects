<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select.form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .btn-back {
            background-color: #555;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #333;
        }
        .btn-submit {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Record</h2>
        
        <?php
        // Database connection details (replace with your actual database credentials)
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

        // Initialize variables for form fields
        $id = $_GET['id'];
        $tableName = $_GET['table'];
        $name = "";
        $gender = "";
        $address = "";
        $email = "";
        $contact = "";
        $password = "";
        
        
        // Check if the form was submitted for updating
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $address = $_POST["address"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $password = $_POST["password"];
            
            // Determine whether to update "dentist" or "receptionist" based on the table parameter
            if ($tableName == "tbl_dentist") {
                $sql = "UPDATE tbl_dentist SET Dentist_Name='$name', Gender='$gender', Address='$address', Email='$email', Contact_No='$contact', Password='$password' WHERE Dentist_ID = $id";
            } else if ($tableName == "tbl_receptionist") {
                $sql = "UPDATE tbl_receptionist SET Receptionist_Name='$name', Gender='$gender', Address='$address', Email='$email', Contact_No='$contact', Password='$password' WHERE Receptionist_ID = $id";
            }

            if ($conn->query($sql) === TRUE) {
                // Update was successful, redirect to Admin.php after displaying success popup
                echo '<script>alert("Record updated successfully."); window.location.href = "Admin.php";</script>';
                exit();
            } else {
                // Error occurred during update, redirect with error message
                header("Location: update.php?id=$id&table=$tableName&error=" . urlencode($conn->error));
                exit();
            }
        } else {
            // If not a form submission, retrieve the existing record
            if ($tableName == "tbl_dentist") {
                $sql = "SELECT * FROM tbl_dentist WHERE Dentist_ID = $id";
            } else if ($tableName == "tbl_receptionist") {
                $sql = "SELECT * FROM tbl_receptionist WHERE Receptionist_ID = $id";
            }

            $result = $conn->query($sql);

            // Check if the record exists
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Populate form fields with existing values

                if($tableName == "tbl_dentist"){
                    $name = $row["Dentist_Name"];
                }
                else
                {
                    $name = $row["Receptionist_Name"];
                }
                $gender = $row["Gender"];
                $address = $row["Address"];
                $email = $row["Email"];
                $contact = $row["Contact_No"];
                $password = $row["Password"];
            } else {
                echo "Record not found.";
            }
        }

        // Close the database connection
        $conn->close();
        ?>

        <form action="update.php?id=<?php echo $id; ?>&table=<?php echo $tableName; ?>" method="post">
            <!-- Include hidden fields for ID and table -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="table" value="<?php echo $tableName; ?>">

            <!-- Add input fields for updating the record -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Male</option>
                    <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Female</option>
                    <option value="other" <?php if ($gender == "other") echo "selected"; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
            </div>

            <!-- Add a back button -->
            <div class="btn-container">
                <a href="Admin.php" class="btn-back">Back</a>

                <!-- Add a submit button -->
                <button type="submit" class="btn-submit" name="update">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
