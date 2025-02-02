<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        /* Styling for patient boxes */
        .patient-box {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative; /* Add this for positioning */
        }

        .patient-box h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .patient-box p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Buttons for delete and update */
        .patient-box .buttons {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .patient-box .buttons a {
            text-decoration: none;
            color: inherit;
        }

        .patient-box .buttons i {
            margin-left: 10px;
            cursor: pointer;
        }

        /* Edit form (initially hidden) */
        .edit-form {
            display: none;
        }

        /* Back button */
        .back-button {
            margin-top: 20px;
            display: none;
        }

        /* Filter section styles */
        .filter {
            margin-bottom: 20px;
        }

        .filter select,
        .filter input[type="text"],
        .filter button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Filter section -->


    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="Receptionist_Home.php">Home</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="Recep_Manager.php">Patients</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="Main.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Patients List</h1>
            <div class="filter">
        <select id="filterCriteria">
            <option value="all">All</option>
            <option value="Patient_ID">Patient ID</option>
            <option value="PatientName">Patient Name</option>
            <option value="DOB">Date of Birth</option>
            <option value="Address">Address</option>
            <option value="Email">Email</option>
            <option value="Contact_Number">Contact Number</option>
        </select>
        <input type="text" id="filterValue" placeholder="Enter value to filter">
        <button id="applyFilter">Apply Filter</button>
        <button id="showAddPatientForm" ><a href="Receptionist_Reg.php">Add New Patient Details</a></button>
    </div>
        

        <?php
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "dbclinicmain";

        $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the delete parameter is set in the URL
        if (isset($_GET['delete'])) {
            $patient_id = $_GET['delete'];

            // Display a confirmation dialog before proceeding with deletion
            echo '<script>
                    var confirmDelete = confirm("Are you sure you want to delete this patient record?");
                    if (confirmDelete) {
                        window.location.href = "?confirmed_delete=" + ' . $patient_id . ';
                    }
                </script>';
        }

        // Check if the confirmed delete parameter is set in the URL
        if (isset($_GET['confirmed_delete'])) {
            $patient_id = $_GET['confirmed_delete'];

            // Delete the patient record
            $sql = "DELETE FROM tbl_Patient WHERE Patient_ID='$patient_id'";

            if (mysqli_query($conn, $sql)) {
                echo "Patient record deleted successfully.";
                // Redirect back to the same page to reflect the changes
                echo '<script>window.location.href = window.location.pathname;</script>';
                exit();
            } else {
                echo "Error deleting patient record: " . mysqli_error($conn);
            }
        }

        // Check if the update_patient form is submitted
        if (isset($_POST['update_patient'])) {
            $patient_id = $_POST['patient_id'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $contact_number = $_POST['contact_number'];

            $sql = "UPDATE tbl_Patient SET Email='$email', DOB='$dob', Gender='$gender', Address='$address', Contact_No='$contact_number' WHERE Patient_ID='$patient_id'";

            if (mysqli_query($conn, $sql)) {
                echo "Patient record updated successfully.";
                // Redirect back to the same page to reflect the changes
                echo '<script>window.location.href = window.location.pathname;</script>';
                exit();
            } else {
                echo "Error updating patient record: " . mysqli_error($conn);
            }
        }

        // Fetch patient details from the database
        $sql = "SELECT * FROM tbl_Patient";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($patient = mysqli_fetch_assoc($result)) {
                echo '<div class="patient-box">';
                echo '<div class="patient-card">'; // Read-only card

                echo '<div class="buttons">';
                echo '<a class="delete-button" href="?delete=' . $patient["Patient_ID"] . '"><i class="fas fa-trash-alt"></i></a>'; // Delete button
                echo '<a class="edit-button" href="#"><i class="fas fa-edit"></i></a>'; // Edit button
                echo '</div>';

                echo '<h2 class="PatientName">' . htmlspecialchars($patient["Patient_Name"]) . '</h2>';
                echo '<p class="Patient_ID"><strong>ID:</strong> ' . htmlspecialchars($patient["Patient_ID"]) . '</p>';
                echo '<p class="Email"><strong>Email:</strong> ' . htmlspecialchars($patient["Email"]) . '</p>';
                echo '<p class="DOB"><strong>Date Of Birth:</strong> ' . htmlspecialchars($patient["DOB"]) . '</p>';
                echo '<p class="Gender"><strong>Gender:</strong> ' . htmlspecialchars($patient["Gender"]) . '</p>';
                echo '<p class="Address"><strong>Address:</strong> ' . htmlspecialchars($patient["Address"]) . '</p>';
                echo '<p class="Contact_Number"><strong>Contact:</strong> ' . htmlspecialchars($patient["Contact_No"]) . '</p>';

                echo '</div>'; // End of read-only card

                echo '<div class="edit-form" style="display: none;">';
                echo '<form action="" method="POST">'; // Update to your update script
                echo '<input type="hidden" name="patient_id" value="' . $patient["Patient_ID"] . '">';
                echo '<label for="email">Email:</label>';
                echo '<input type="text" name="email" value="' . htmlspecialchars($patient["Email"]) . '"><br>';
                echo '<label for="dob">Date Of Birth:</label>';
                echo '<input type="date" name="dob" value="' . htmlspecialchars($patient["DOB"]) . '"><br>';
                echo '<label for="gender">Gender:</label>';
                echo '<select name="gender">';
                echo '<option value="Male" ' . ($patient["Gender"] === "Male" ? 'selected' : '') . '>Male</option>';
                echo '<option value="Female" ' . ($patient["Gender"] === "Female" ? 'selected' : '') . '>Female</option>';
                echo '<option value="Other" ' . ($patient["Gender"] === "Other" ? 'selected' : '') . '>Other</option>';
                echo '</select><br>';
                echo '<label for="address">Address:</label>';
                echo '<input type="text" name="address" value="' . htmlspecialchars($patient["Address"]) . '"><br>';
                echo '<label for="contact_number">Contact Number:</label>';
                echo '<input type="text" name="contact_number" value="' . htmlspecialchars($patient["Contact_No"]) . '"><br>';
                echo '<input type="submit" name="update_patient" value="Update">';
                echo '</form>';
                echo '<button class="back-button">Back</button>';
                echo '</div>'; // End of edit form

                echo '</div>'; // End of patient-box
            }
        } else {
            echo "No patients found.";
        }

        mysqli_close($conn);
        ?>
    </div>
    <script>
        $(document).ready(function () {
            // Toggle between read-only and edit mode
            $(".edit-button").click(function () {
                var parentBox = $(this).closest(".patient-box");
                parentBox.find(".patient-card").toggle();
                parentBox.find(".edit-form").toggle();
                parentBox.find(".back-button").toggle();
            });

            // Handle back button click
            $(".back-button").click(function () {
                var parentBox = $(this).closest(".patient-box");
                parentBox.find(".patient-card").toggle();
                parentBox.find(".edit-form").toggle();
                parentBox.find(".back-button").toggle();
            });

            // Filter patients when Apply Filter button is clicked
            $("#applyFilter").click(function () {
                var criteria = $("#filterCriteria").val();
                var filterValue = $("#filterValue").val().toLowerCase();

                $(".patient-box").each(function () {
                    var patientData = $(this).find("." + criteria).text().toLowerCase();
                    if (criteria === "all" || patientData.includes(filterValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
