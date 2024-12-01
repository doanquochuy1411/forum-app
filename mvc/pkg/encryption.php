<?php
// Hàm để mã hóa
function encryptData($data)
{
    $cipher = "aes-256-cbc";
    $key = substr(hash('sha256', $_SESSION['Key'], true), 0, 32); // Tạo khóa 32 byte
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher)); // Tạo IV

    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    if ($encrypted === false) {
        die('Mã hóa không thành công!');
    }
    return base64_encode($encrypted . '::' . base64_encode($iv));
}

// Hàm để giải mã
function decryptData($encryptedData)
{
    try {
        $cipher = "aes-256-cbc";
        $key = substr(hash('sha256', $_SESSION['Key'], true), 0, 32); // Tạo khóa 32 byte từ khóa bí mật

        $data = base64_decode($encryptedData);
        list($encrypted, $iv) = explode('::', $data, 2);
        $iv = base64_decode($iv);

        if (strlen($iv) !== openssl_cipher_iv_length($cipher)) {
            throw new Exception('IV không đúng độ dài!');
        }

        $decrypted = openssl_decrypt($encrypted, $cipher, $key, 0, $iv);

        if ($decrypted === false) {
            throw new Exception('Giải mã không thành công!');
        }

        return $decrypted;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        echo "<script>history.back()</script>";
    }
}
?>