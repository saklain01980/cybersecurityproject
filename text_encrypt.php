
<?php
  
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $dbname = "cipher";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["encryptText"])) {
        $plainText = $conn->real_escape_string($_POST["plainText"]);
        $encryptionKey = $conn->real_escape_string($_POST["encryptionKey"]);
        $encryptedText = $conn->real_escape_string($_POST["encryptedText"]);

        $sql = "INSERT INTO encrypted_texts (plain_text, encryption_key, encrypted_text) VALUES ('$plainText', '$encryptionKey', '$encryptedText')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher - Text Encrypt</title>
    <link rel="stylesheet" href="css/style.css">
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
            <!-- Left Part --->
            <div class="col-lg-6">
                <!-- <h1 class="text-center">Vigenere Cipher - Text Encrypt</h1>
                <p class="lead text-center">Welcome to our text encryption project</p> -->

                <form id="encryptionForm">
                    <div class="form-group">
                        <label for="plainText">Plain Text:</label>
                        <input type="text" class="form-control" id="plainText" placeholder="Enter text to encrypt">
                    </div>
                    <div class="form-group">
                        <label for="encryptionKey">Key:</label>
                        <input type="text" class="form-control" id="encryptionKey" placeholder="Enter an alphabetic key">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="encryptText()">Encrypt</button>
                    <div class="form-group mt-3">
                        <label for="encryptedText">Encrypted Text:</label>
                        <textarea class="form-control" id="encryptedText" rows="3" readonly></textarea>
                        <button type="button" class="btn btn-secondary mt-2" onclick="copyToClipboard('encryptedText')">Copy Encrypted Text</button>
                    </div>
                </form>
            </div>

            <!-- Right Part - -->
            <div class="col-lg-6">
                <form id="decryptionForm">
                    <div class="form-group">
                        <label for="encryptedTextRight">Encrypted Text:</label>
                        <input type="text" class="form-control" id="encryptedTextRight" placeholder="Enter text to decrypt">
                    </div>
                    <div class="form-group">
                        <label for="decryptionKey">Key:</label>
                        <input type="text" class="form-control" id="decryptionKey" placeholder="Enter an alphabetic key">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="decryptText()">Decrypt</button>
                    <div class="form-group mt-3">
                        <label for="decryptedText">Decrypted/Plain Text:</label>
                        <textarea class="form-control" id="decryptedText" rows="3" readonly></textarea>
                        <button type="button" class="btn btn-secondary mt-2" onclick="copyToClipboard('decryptedText')">Copy Decrypted/Plain Text</button>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        function goToMainPage() {
            window.location.href = 'index.php';
        }

        var alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

function cipher(shiftn){
    var i = 0;
    var cipher = new Array(26);
    for (i; i < 26; i++){
        var index = 0;
        if ((i + shiftn) > 25){
            index = (i + shiftn) % 26;
        }
        else {
            index = i + shiftn;
        }
        cipher[i] = alphabet[index];
    }
    return cipher;
}

function encipherChar(k, p){
    keyIndex = alphabet.indexOf(k);
    cipherAlpha = cipher(keyIndex);
    cipherChar = cipherAlpha[alphabet.indexOf(p)];
    return cipherChar;
}

function decipherChar(k, c){
    keyIndex = alphabet.indexOf(k);
    cipherAlpha = cipher(keyIndex);
    decipheredChar = alphabet[cipherAlpha.indexOf(c)];
    return decipheredChar;
}

function encipherMessage(plaintext, key){
    keyIdx = 0;
    var ciphertext = "";
    for (var i = 0; i < plaintext.length; i++){
        if(keyIdx > key.length-1)
            keyIdx = 0;
        keyChar = key[keyIdx];

        if (alphabet.indexOf(plaintext[i]) === -1) {
            ciphertext += plaintext[i];
        } else {
            cipherChar = encipherChar(keyChar, plaintext[i]);
            ciphertext = ciphertext + cipherChar;
        }

        keyIdx++;
    }
    return ciphertext;
}

function decipherMessage(ciphertext, key){
    keyIdx = 0;
    var plaintext = "";
    for(var i = 0; i < ciphertext.length; i++){
        if(keyIdx > key.length-1)
            keyIdx = 0;
        keyChar = key[keyIdx];

        if (alphabet.indexOf(ciphertext[i]) === -1) {
            plaintext += ciphertext[i];
        } else {
            plainChar = decipherChar(keyChar, ciphertext[i]);
            plaintext = plaintext + plainChar;
        }

        keyIdx++;
    }
    return plaintext;
}

function encryptText() {
    var plaintext = $("#plainText").val().toLowerCase().replace(/[0-9]/g, '');
    var key = $("#encryptionKey").val().toLowerCase().replace(/[0-9]/g, '');
    var ciphertext = encipherMessage(plaintext, key);
    $("#encryptedText").val(ciphertext);
}

function decryptText() {
    var ciphertext = $("#encryptedTextRight").val().toLowerCase().replace(/[0-9]/g, '');
    var key = $("#decryptionKey").val().toLowerCase().replace(/[0-9]/g, '');
    var plaintext = decipherMessage(ciphertext, key);
    $("#decryptedText").val(plaintext);
}

function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999); 
    document.execCommand("copy");
    alert("Copied to clipboard: " + copyText.value);
}


    </script>
</body>

</html>
