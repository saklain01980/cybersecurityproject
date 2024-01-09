<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Encryption/Decryption</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('img/image4.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
            text-align: center; 
        }
        form {
            background-color: #d3d3d3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <form id="imageEncryptionForm" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="originalImage">Original Image:</label>
                        <input type="file" class="form-control" name="originalImage" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="imageEncryptionKey">Key:</label>
                        <input type="text" class="form-control" name="imageEncryptionKey" placeholder="Enter an alphabetic key">
                    </div>
                    <button type="submit" class="btn btn-primary" name="encryptImage">Encrypt</button>
                    <div class="form-group mt-3">
                        <label for="encryptedImageView">Encrypted Image:</label>
                        <img id="encryptedImageView" class="img-fluid" alt="Encrypted Image">
                        <button type="button" class="btn btn-secondary mt-2" onclick="saveImage('encryptedImageView')">Save Encrypted Image</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <form id="imageDecryptionForm" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="decryptedImage">Encrypted Image:</label>
                        <input type="file" class="form-control" name="decryptedImage" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="imageDecryptionKey">Key:</label>
                        <input type="text" class="form-control" name="imageDecryptionKey" placeholder="Enter an alphabetic key">
                    </div>
                    <button type="submit" class="btn btn-primary" name="decryptImage">Decrypt</button>
                    <div class="form-group mt-3">
                        <label for="originalImageView">Original Image View:</label>
                        <img id="originalImageView" class="img-fluid" alt="Original Image">
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 text-center">
                <button class="btn btn-info" onclick="goToMainPage()">Back to Main Page</button>
            </div>
        </div>
    </div>

    <script>
        function saveImage(elementId) {
            const img = document.getElementById(elementId);
            const link = document.createElement('a');
            link.href = img.src;
            link.download = 'encrypted_image.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function goToMainPage() {
            window.location.href = 'index.php';
        }
    </script>

<?php

// Function to encrypt image data
function encryptImage($data, $key) {
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivSize);
    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);

    // Combine IV and encrypted data
    $encryptedDataWithIV = $iv . $encryptedData;

    return base64_encode($encryptedDataWithIV);
}

// Function to decrypt image data
function decryptImage($data, $key) {
    $data = base64_decode($data);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $ivSize);
    $encryptedData = substr($data, $ivSize);

    return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
}

// Process image encryption and decryption
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['encryptImage'])) {
        // Handle Image Encryption
        $rawImageData = file_get_contents("php://input");
        $key = $_POST['imageEncryptionKey'];

        // Encrypt the image data
        $encryptedImageData = encryptImage($rawImageData, $key);

        // Store the encrypted image data in the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cipher";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO encrypted_images (image_data) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $encryptedImageData);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    } elseif (isset($_POST['decryptImage'])) {
        // Handle Image Decryption
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cipher";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT image_data FROM encrypted_images ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Decrypt the image data
            $decryptedImageData = decryptImage($row["image_data"], $_POST['imageDecryptionKey']);

            // Output the decrypted image data
            header('Content-Type: image/jpeg');
            echo $decryptedImageData;
        } else {
            echo "No encrypted images found.";
        }

        $conn->close();
    }
}

?>

</body>

</html>
