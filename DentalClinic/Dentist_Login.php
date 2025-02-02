<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentist Login</title>
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
            background-color: #17a2b8; /* Dentist-specific color, you can change it */
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
            border: 2px solid #17a2b8; /* Dentist-specific color, you can change it */
            border-radius: 5px;
        }

        .btn {
            background-color: #17a2b8; /* Dentist-specific color, you can change it */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #117a8b; /* Darker color on hover */
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

        /* Style for the New Dentist link */
        .new-dentist-link {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .new-dentist-link a {
            color: #17a2b8; /* Dentist-specific color, you can change it */
            text-decoration: none;
        }

        .new-dentist-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="Main.php">Bracewell Clinic - Dentist Portal</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mt-4">Dentist Login</h2>
        <form action="Dentist_login_process.php" method="post">
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
            <div class="text-left">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
        
        <!-- New Dentist Link -->
        <div class="new-dentist-link">
            Don't have a Dentist account? <a href="DentistRegistration.php">New Dentist?</a>
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
    </script>
    
</body>
</html>
