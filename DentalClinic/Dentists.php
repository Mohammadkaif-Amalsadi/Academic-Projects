<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Dentists</title>
    <!-- Link to Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #99ccff;
        }

        .navbar-brand {
            font-size: 24px;
            color: #fff;
        }

        .navbar .btn-back {
            background-color: #333;
            border: none;
            color: #fff;
            font-size: 20px;
            border-radius: 5px;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 20px auto; /* Center the container horizontally */
            max-width: 800px; /* Limit the container width for better readability */
        }

        .doctor {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out;
        }

        .doctor:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .doctor img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 50%;
        }

        .doctor h3 {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        .doctor p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <button class="navbar-brand btn-back"><a href="Main.php">Back</a></button>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="doctor">
                    <img src="" alt="Doctor 1">
                    <h3>Dr. John Doe</h3>
                    <p>Specialty: Dentistry</p>
                    <p>Dr. John Doe is a highly experienced dentist specializing in general dentistry. He has been serving patients for over 20 years and is known for his gentle and caring approach.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="doctor">
                    <img src="" alt="Doctor 2">
                    <h3>Dr. Jane Smith</h3>
                    <p>Specialty: Orthodontics</p>
                    <p>Dr. Jane Smith is a skilled orthodontist with a passion for creating beautiful smiles. She uses the latest techniques in orthodontics to provide the best possible care to her patients.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="doctor">
                    <img src="" alt="Doctor 3">
                    <h3>Dr. James Brown</h3>
                    <p>Specialty: Oral Surgery</p>
                    <p>Dr. James Brown is an experienced oral surgeon known for his precision and expertise in surgical procedures. He is dedicated to ensuring the comfort and safety of his patients.</p>
                </div>
            </div>
            
            <!-- Repeat the above doctor profiles to include more dentists -->
        </div>
    </div>
</body>
</html>
