<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher Tool</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('img/image5.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
            text-align: center; /* Center text in the body */
        }

        .container {
            width: 100%;
        }

        h1, h3 {
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-size: cover;
            background-position: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            border: none;
            cursor: pointer;
        }

        .option-btn {
            width: 300px;
            height: 200px;
            font-size: 24px;
            font-weight: bold;
        }

        /* Add styles for the about button */
        .about-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            /* background-color: transparent; */
            border: none;
            color: white;
            cursor: pointer;
            font-size: 18px;
            background-color: #800020;
            border: none;
            font-size: 20px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1>Vigenere Cipher Tool</h1>
                <h3>Choose an option:</h3>

                <div class="text-center">
                    <button class="btn btn-primary btn-lg option-btn" onclick="redirectTo('text')" style="background-image: url('img/image2.jpg');">Text Encrypt</button>
                    <button class="btn btn-primary btn-lg ml-3 option-btn" onclick="redirectTo('image')" style="background-image: url('img/image3.jpg');">Image Encrypt</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add About button -->
    <button class="about-btn" onclick="redirectTo('about')">About</button>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

    <script>
        function redirectTo(option) {
            if (option === 'text') {
                window.location.href = 'text_encrypt.php';
            } else if (option === 'image') {
                window.location.href = 'image_encrypt.php';
            } else if (option === 'about') {
                // Add the link to your about page
                window.location.href = 'about.php';
            }
        }
    </script>
</body>

</html>
