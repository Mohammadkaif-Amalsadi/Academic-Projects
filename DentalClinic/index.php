<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bracewell Clinic</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Custom Styles */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        .navbar-inverse {
            background-color: #333;
            border-color: transparent;
        }

        .navbar-brand {
            font-size: 28px;
            color: #333;
        }

        .navbar-nav > li > a {
            font-size: 18px;
            color: #333;
        }

        .header {
            padding: 100px 0;
            text-align: center;
            color: white;
            background-image: url("https://si-prod-cms-static-pz.b-cdn.net/thumbs/gumdisease_1280.jpg?v=201804115");
            background-size: cover;
            background-attachment: fixed;
            background-position: center top;
        }

        .header h2 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .doctors {
            padding: 50px;
        }

        .doctors h2 {
            font-size: 28px;
            color: #333;
        }

        .doctor {
            margin-bottom: 30px;
            padding: 20px;
            transition: transform 0.3s ease-in-out;
            text-align: center;
        }

        /* Background color for odd doctors */
        .doctor:nth-child(odd) {
            background-color: #E0E0E0;
        }

        /* Background color for even doctors */
        .doctor:nth-child(even) {
            background-color: #FFFFFF;
        }

        .doctor:hover {
            transform: scale(1.05);
        }

        .doctor img {
            width: 150px; /* Set a fixed width */
            height: 150px; /* Set a fixed height */
            object-fit: cover; /* Maintain aspect ratio while covering the container */
            border-radius: 50%;
        }

        .doctor h3 {
            font-size: 24px;
            color: #333;
        }

        .doctor p {
            font-size: 16px;
            color: #666;
        }

        .steps {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 50px;
            text-align: center;
        }

        .steps h2 {
            font-size: 36px;
        }

        .patient-stories {
            padding: 50px;
        }

        .patient-story {
            margin-bottom: 30px;
        }

        .patient-story img {
            max-width: 100%;
            border-radius: 5px;
        }

        .patient-story h3 {
            font-size: 24px;
            color: #333;
        }

        .patient-story p {
            font-size: 16px;
            color: #666;
        }

        .patient-feedback {
            background-color: #E0E0E0;
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .patient-feedback:hover {
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Bracewell Clinic</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Services <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Veneers</a></li>
                        <li><a href="#">Clear Aligners</a></li>
                        <li><a href="#">Implants</a></li>
                        <li><a href="#">Root Canals</a></li>
                    </ul>
                </li>
                <li><a href="#">New Patients</a></li>
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <div class="header">
        <h2>Ultimate Dental Clinic</h2>
        <h2>Management System</h2>
    </div>

    <!-- Doctors Section -->
    <div class="container doctors">
        <h2>Meet Our Doctors</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="doctor">
                    <img src="https://cdn1.edgedatg.com/aws/v2/abc/TheGoodDoctor/person/2057161/3b64a2c60ab1522e01e641c6231ced0a/512x288-Q90_3b64a2c60ab1522e01e641c6231ced0a.jpg" alt="Doctor 1">
                    <h3>Dr. John Doe</h3>
                    <p>Specialty: Dentistry</p>
                    <p>Dr. John Doe is a highly experienced dentist specializing in general dentistry. He has been serving patients for over 20 years and is known for his gentle and caring approach.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="doctor">
                    <img src="https://www.dgepress.com/storage/uploads/D7/A4/D7A472E6-7EA3-C5EE-CCFE-2FA4E8264665/152740_2772_V9-0x300.jpg" alt="Doctor 2">
                    <h3>Dr. Jane Smith</h3>
                    <p>Specialty: Orthodontics</p>
                    <p>Dr. Jane Smith is a skilled orthodontist with a passion for creating beautiful smiles. She uses the latest techniques in orthodontics to provide the best possible care to her patients.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="doctor">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQ0dcbZvwN6dJUCpgN-4BeFEpEiTcjY5SOtw&usqp=CAU" alt="Doctor 3">
                    <h3>Dr. James Brown</h3>
                    <p>Specialty: Oral Surgery</p>
                    <p>Dr. James Brown is an experienced oral surgeon known for his precision and expertise in surgical procedures. He is dedicated to ensuring the comfort and safety of his patients.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3 Simple Steps Section -->
    <div class="steps" style="background-image: url('https://si-prod-cms-static-pz.b-cdn.net/thumbs/gumdisease_1280.jpg?v=201804115'); background-size: cover; background-attachment: fixed;">
        <h2>3 SIMPLE STEPS FOR ACHIEVING YOUR BEST SMILE</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Step 1</h3>
                    <p>Consult with our experienced dentists to discuss your dental goals and concerns.</p>
                </div>
                <div class="col-md-4">
                    <h3>Step 2</h3>
                    <p>Receive personalized treatment plans and options tailored to your needs.</p>
                </div>
                <div class="col-md-4">
                    <h3>Step 3</h3>
                    <p>Experience top-quality dental care and achieve your best smile with us.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Stories Section -->
    <div class="container patient-stories">
        <h2>Patient Stories</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="patient-story">
                    <img src="patient-placeholder.jpg" alt="Patient 1">
                    <h3>John's Story</h3>
                    <p>John had been struggling with dental issues for years. He visited Bracewell Clinic, and Dr. Doe's expertise and caring approach made all the difference. John now enjoys a healthy and confident smile.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="patient-story">
                    <img src="patient-placeholder.jpg" alt="Patient 2">
                    <h3>Jane's Story</h3>
                    <p>Jane's journey to a perfect smile started with a visit to Bracewell Clinic. Dr. Smith's orthodontic skills and dedication exceeded her expectations. She can't stop smiling!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Feedback Section -->
    <div class="container patient-feedback">
        <h2>Patient Feedback</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="patient-feedback">
                    <h3>Feedback from John</h3>
                    <p>"I had a fantastic experience at Bracewell Clinic. The staff is friendly, and Dr. Doe did an excellent job with my dental work. I highly recommend them!"</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="patient-feedback">
                    <h3>Feedback from Jane</h3>
                    <p>"Bracewell Clinic is amazing! Dr. Smith is incredibly skilled, and the results of my orthodontic treatment exceeded my expectations."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>About Us: We are dedicated to providing the highest quality dental care to our patients.</p>
        <p>Contact: info@bracewellclinic.com</p>
        <p>Address: 123 Dental Street, Cityville, ZIP</p>
        <p>&copy; 2023 Bracewell Clinic</p>
        
<!--         Map Section -->
        <div style="height: 300px; margin-top: 20px;">
            <iframe
                width="100%"
                height="100%"
                frameborder="0"
                style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCqLXlmCckfJnU3PlJhUkT8xuRC7F-NOFs&q=123+Dental+Street,Cityville,ZIP"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</footer>

</body>
</html>
