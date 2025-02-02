<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Custom Styles */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007BFF;
            color: #fff;
        }

        .navbar-brand {
            font-size: 24px;
            color: #fff;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 20px auto;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border: 2px solid #007BFF;
            border-radius: 5px;
        }

        .btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .remember-me {
            margin-top: 10px;
        }

        /* Style for the Show/Hide Password button */
        .password-toggle-btn {
            position: absolute;
            top: 75%; /* Center vertically */
            right: 10px;
            transform: translateY(-50%); /* Center vertically */
            cursor: pointer;
        }

        /* Style for the Password input */
        .password-input {
            padding-right: 35px;
        }

        /* Style for the Admin Login button */
        .admin-login-btn {
            background-color: #ff0000; /* Red color, you can change it */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            position: absolute;
            top: 10px; /* Adjust the top position as needed */
            right: 10px;
        }

        .admin-login-btn:hover {
            background-color: #cc0000; /* Darker red on hover */
        }

        /* Style for the New Account link */
        .new-account-link {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .new-account-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .new-account-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="Main.php">Bracewell Clinic</a>
            <!-- Admin Login button to the top right -->
            <button class="admin-login-btn" data-toggle="modal" data-target="#adminPasswordModal">Admin Login</button>
        </div>
    </nav>

<div class="container">
    <h2 class="mt-4">Patient Login</h2>
    <form action="process_login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group position-relative">
            <label for="password">Password:</label>
            <input type="password" class="form-control password-input" id="password" name="password" required>
            <span class="password-toggle-btn" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye-slash" id="toggleIcon"></i>
            </span>
        </div>
        <div class="form-group form-check remember-me">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <div class="text-left">
        <button type="submit" class="btn">Login</button>
        </div>
    </form>
        
        <!-- New Account Link -->
        <div class="new-account-link">
            Don't have an account? <a href="Register.php">New Account?</a>
        </div>
    </div>

    <!-- Admin Password Modal -->
    <div class="modal" id="adminPasswordModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="adminPasswordForm">
                        <div class="form-group">
                            <label for="adminPassword">Password:</label>
                            <input type="password" class="form-control" id="adminPassword" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="checkAdminPassword()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript and Bootstrap scripts (add these if not already included) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to toggle password visibility
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.className = "fas fa-eye";
            } else {
                passwordInput.type = "password";
                toggleIcon.className = "fas fa-eye-slash";
            }
        }

        // Function to check the Admin Password
        function checkAdminPassword() {
            const enteredPassword = $('#adminPassword').val();
            // Replace 'yourAdminPassword' with the actual admin password
            if (enteredPassword === 'Kaif0014') {
                // Redirect to the admin login page
                window.location.href = 'admin.php';
            } else {
                alert('Invalid admin password. Please try again.');
                $('#adminPassword').val('');
            }
        }
        
    </script>
    
    
</body>
</html>
