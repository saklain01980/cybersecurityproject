var alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

function cipher(shiftn) {
    var i = 0;
    var cipher = new Array(26);
    for (i; i < 26; i++) {
        var index = 0;
        if ((i + shiftn) > 25) {
            index = (i + shiftn) % 26;
        } else {
            index = i + shiftn;
        }
        cipher[i] = alphabet[index];
    }
    return cipher;
}

function encipherChar(k, p) {
    keyIndex = alphabet.indexOf(k)
    cipherAlpha = cipher(keyIndex)
    cipherChar = cipherAlpha[alphabet.indexOf(p)]
    return cipherChar
}

function decipherChar(k, c) {
    keyIndex = alphabet.indexOf(k)
    cipherAlpha = cipher(keyIndex)
    decipheredChar = alphabet[cipherAlpha.indexOf(c)]
    return decipheredChar
}

function encipherMessage(plaintext, key) {
    keyIdx = 0
    var ciphertext = ""
    for (var i = 0; i < plaintext.length; i++) {
        if (keyIdx > key.length - 1)
            keyIdx = 0;
        keyChar = key[keyIdx]
        cipherChar = encipherChar(keyChar, plaintext[i])
        ciphertext = ciphertext + cipherChar
        keyIdx++
    }
    return ciphertext
}

function decipherMessage(ciphertext, key) {
    keyIdx = 0
    var plaintext = ""
    for (var i = 0; i < ciphertext.length; i++) {
        if (keyIdx > key.length - 1)
            keyIdx = 0;
        keyChar = key[keyIdx]
        plainChar = decipherChar(keyChar, ciphertext[i])
        plaintext = plaintext + plainChar
        keyIdx++
    }
    return plaintext
}

function vigenere() {
    plaintext = $("#plaintext").val().toLowerCase().replace(/\W/g, '').replace(/[0-9]/g, '')
    key = $("#key").val().toLowerCase().replace(/\W/g, '').replace(/[0-9]/g, '')
    ciphertext = encipherMessage(plaintext, key)
    $("#output").val(ciphertext)
}

function devigenere() {
    ciphertext = $("#ciphertext").val().toLowerCase().replace(/\W/g, '').replace(/[0-9]/g, '')
    key = $("#keycipher").val().toLowerCase().replace(/\W/g, '').replace(/[0-9]/g, '')
    plaintext = decipherMessage(ciphertext, key)
    $("#deoutput").val(plaintext)
}

function resetForms() {
    $("#cipherForm")[0].reset();
    $("#decipherForm")[0].reset();
}
