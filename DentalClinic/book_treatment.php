<?php
session_start();
$userID = $_SESSION['userID'];
$userName = $_SESSION['userName'];

// Check if the user is logged in (you can implement your login logic here)
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirect to the login page
    exit;
}

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "DBClinicmain";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookAppointment'])) {
    // Process the appointment booking

    $patientID = $_SESSION['userID'];
    $treatmentID = $_POST['treatment_id'];
    $selectedDate = $_POST['selected_date'];

    // Check if the selected_time is set before trying to use it
    if (isset($_POST['selected_time'])) {
        $selectedTime = $_POST['selected_time'];

        // Check if the selected time slot is available
        $checkAvailabilitySQL = "SELECT * FROM tbl_Appointment WHERE Date = '$selectedDate' AND Time = '$selectedTime'";
        $result = mysqli_query($conn, $checkAvailabilitySQL);

        if (mysqli_num_rows($result) == 0) {
            // The time slot is available, insert the appointment
            $insertAppointmentSQL = "INSERT INTO tbl_Appointment (Patient_ID, Treatment_ID, Date, Time, Status) 
                                     VALUES ('$patientID', '$treatmentID', '$selectedDate', '$selectedTime', 'Pending')";
            if (mysqli_query($conn, $insertAppointmentSQL)) {
                echo '<script>alert("Appointment booked successfully!");</script>';
                header("Refresh: 2; Treatments.php");
            } else {
                echo '<script>alert("Error booking appointment: ' . mysqli_error($conn) . '");</script>';
                
            }
        } else {
            echo '<script>alert("Selected time slot is already booked. Please choose another time. Redirecting to treatments page in 2 seconds..");</script>';
             header("Refresh: 2; Treatments.php");
        }
    } else {
        echo '<script>alert("Selected time is not set. Please select a time slot.");</script>';

    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        /* Reset some default styles */
        body, h1, p, label {
            margin: 0;
            padding: 0;
        }

        /* Center the content vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Style for the form container */
        .form-container {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Style for the calendar */
        #selected_date {
            margin: 10px 0;
            padding: 5px;
            width: 100%;
        }

        /* Style for the time slots container */
        .time-slots {
            max-height: 200px;
            overflow-y: auto;
            text-align: center;
        }

        /* Style for the available time slots */
        .available-time-slot {
            padding: 10px;
            margin: 5px;
            background-color: #e0e0e0;
            cursor: pointer;
        }

        .available-time-slot:hover {
            background-color: #c0c0c0;
        }

        /* Style for the Book Now button */
        .book-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the Back button */
        .back-button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        /* Add responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .form-container {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <!-- Your HTML content for the page -->
    <div class="form-container">
        <h1>Book Appointment</h1>
        <form method="post" action="book_treatment.php" id="appointmentForm">
            <input type="hidden" name="treatment_id" value="<?php echo $_GET['treatment_id']; ?>">
            <label for="selected_date">Select Date:</label>
            <input type="date" name="selected_date" id="selected_date" min="<?php echo date('Y-m-d'); ?>" required>
            <br>
            <label for="selected_time">Select Time:</label>
            <div class="time-slots" id="time_slots"></div>
            <input type="hidden" name="selected_time" id="selected_time">
            <br>
            <button type="submit" name="bookAppointment" class="book-button">Book Now</button>
            <br>
            <a href="Treatments.php" class="back-button">Back</a>
        </form>
    </div>
    <script>
        // Function to show a success message in a popup
        function showSuccessPopup(message) {
            const popup = document.createElement('div');
            popup.classList.add('popup');
            popup.textContent = message;
            document.body.appendChild(popup);

            setTimeout(() => {
                popup.style.display = 'none';
                document.body.removeChild(popup);
            }, 3000); // Hide the popup after 3 seconds (adjust as needed)
        }

        document.getElementById('selected_date').addEventListener('change', function () {
            // Clear previously selected time slots
            document.getElementById('time_slots').innerHTML = '';

            // Fetch available time slots based on the selected date from the server
            const selectedDate = this.value;

            // Implement logic to fetch available time slots for selectedDate and populate the 'time_slots' div
            // Example: Fetch available time slots from the server and append them as div elements to 'time_slots' div
            const availableTimeSlots = ['09:00 AM', '10:00 AM', '11:00 AM', '02:00 PM', '03:00 PM', '04:00 PM'];

            availableTimeSlots.forEach(timeSlot => {
                const timeSlotDiv = document.createElement('div');
                timeSlotDiv.classList.add('available-time-slot');
                timeSlotDiv.textContent = timeSlot;
                timeSlotDiv.dataset.time = timeSlot;
                timeSlotDiv.addEventListener('click', function () {
                    // Set the selected time to the hidden input field
                    document.querySelector('#selected_time').value = this.dataset.time;

                    // Change background color of the selected time slot
                    const allTimeSlots = document.querySelectorAll('.available-time-slot');
                    allTimeSlots.forEach(slot => {
                        slot.style.backgroundColor = ''; // Reset background color for all slots
                    });
                    this.style.backgroundColor = '#7FFF00'; // Change background color for the selected slot
                });
                document.getElementById('time_slots').appendChild(timeSlotDiv);
            });
        });

        // Validation for time slot selection before submitting the form
        document.getElementById('appointmentForm').addEventListener('submit', function (event) {
            const selectedTime = document.querySelector('#selected_time').value;
            if (!selectedTime) {
                event.preventDefault(); // Prevent form submission if no time slot is selected
                alert('Please select a time slot before booking.');
            }
        });
    </script>
</body>
</html>
