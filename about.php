<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
         body {
            background-image: url('img/image\ 1.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
            text-align: center; /* Center text in the body */
            color: white;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        h1, h3 {
            font-weight: bold;
        }

        .overview-box {
            background-color: olive;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .team-member {
            background-color: #228B22;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: calc(50% - 20px); /* 50% width minus margin */
            margin-right: 20px; /* Margin between team members */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            float: left; /* Float left to create a two-column layout */
        }

        .team-member img {
            max-width: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .back-btn {
            background-color: #800020;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .text{
            color: white;
            
        }
    </style>
</head>

<body>
    <div class="container">
        

        <div class="overview-box">
            <h1>Project Overview</h1>
            <p><strong>
            Our project is a fun and educational tool that uses the Vigenere Cipher for text encryption and decryption. The Vigenere Cipher is like a secret code that we apply to messages to make them unreadable without the right key. Users can type in a message, choose a secret key, and our tool will encode the message using the Vigenere Cipher. It's like sending secret notes to friends! The project aims to make learning about encryption enjoyable and accessible, providing a hands-on experience with a classic cryptographic technique. We believe that understanding encryption can be both entertaining and educational, and our tool is a playful way to explore the world of secret codes.
            </strong>
            </p>
        </div>

        <h1 class="text"><b>Meet Our Team</b></h1>

        <div class="team-member">
            <img src="img/faravi1.jpg" alt="Team Member 1">
            <h4>MD. Shakawat Hossain Faravi</h4>
            <p>ID: 211002075</p>
        </div>

        <div class="team-member">
            <img src="img/atik1.jpg" alt="Team Member 2">
            <h4>Atik Hasan</h4>
            <p>ID: 211002076</p>
        </div>

        <div class="team-member">
            <img src="img/sak.png" alt="Team Member 3">
            <h4>Sakline Ahmed</h4>
            <p>ID: 211002079</p>
        </div>

        <div class="team-member">
            <img src="img/prince.jpg" alt="Team Member 4">
            <h4>Jannatul Sayed Prince</h4>
            <p>ID: 211002098</p>
        </div>

        <button class="back-btn" onclick="goToMainPage()">Back to Main Page</button>

    </div>


    <script>
        function goToMainPage() {
            window.location.href = 'index.php';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
