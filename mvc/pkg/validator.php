<?php

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validateFullName($fullName)
{
    return preg_match('/^[a-zA-Z\s]+$/', $fullName) && strpos($fullName, ' ') !== false;
}

function validatePhoneNumber($phoneNumber)
{
    return preg_match('/^0\d{9,11}$/', $phoneNumber);
}

function validatePassword($password)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

function validateNoSpecialChars($input)
{
    return preg_match('/^[\p{L}\p{N}\s!@$%&?*:\=[\]]+$/u', $input);
}
function validateDescription($input)
{
    if ($input === '') {
        return true;
    }

    return preg_match('/^[\p{L}\p{N}\s!@$%&?*:\=[\]]+$/u', $input);
}

function validateAddress($address)
{
    return preg_match('/^[0-9a-zA-Z\s,\.\/\-]+$/u', $address);
}
function sanitizeInput($input)
{
    // Thay thế các ký tự đặc biệt có thể gây ra SQL Injection
    $sanitized = preg_replace('/[\'"\\\%;\(\)~`\^<>\[\]\{\}\&\|\*]/', '', $input);

    // Trả về chuỗi đã được làm sạch
    return $sanitized;
}

function validateImage($file, $tempDir = '/tmp')
{
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
    $maxSize = 5 * 1024 * 1024; // 5 MB
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    // $tempFile = $tempDir . '/' . uniqid('image_', true) . '.' . $fileExtension;

    // Kiểm tra extension của file
    // $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        return "Phần mở rộng file không hợp lệ. Chỉ chấp nhận JPEG, JPG, PNG, và GIF.";
    }


    // Kiểm tra loại file và xác nhận file là ảnh thực sự
    $imageInfo = getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        return "File không phải là hình ảnh hợp lệ.";
    }

    $fileType = $imageInfo['mime'];
    if (!in_array($fileType, $allowedTypes)) {
        return "Loại file không hợp lệ. Chỉ chấp nhận JPEG, JPG, PNG, và GIF.";
    }

    // Kiểm tra kích thước file
    if ($file['size'] > $maxSize) {
        return "Kích thước file quá lớn. Kích thước tối đa là " . ($maxSize / 1024 / 1024) . " MB.";
    }

    // Kiểm tra xem file tạm thời có tồn tại không
    if (!file_exists($tempDir)) {
        if (!mkdir($tempDir, 0755, true)) {
            return "Không thể tạo thư mục tạm thời: $tempDir.";
        }
    }

    // Tạo file tạm thời để xử lý
    // $tempFile = $tempDir . '/' . uniqid('image_', true) . '.' . $fileExtension;
    // if (!move_uploaded_file($file['tmp_name'], $tempFile)) {
    //     return "Không thể di chuyển file tạm thời.";
    // }

    // // Kiểm tra mã độc bằng Hybrid Analysis API
    // $scanResult = scanFileWithVirusTotal($tempFile);
    // if (isset($scanResult['error'])) {
    //     return "Quét virus không thành công. Lỗi: " . $scanResult['error']['message'];
    // }

    // // Kiểm tra kết quả quét virus
    // if (isset($scanResult['scan_results']) && $scanResult['scan_results']['malicious'] > 0) {
    //     unlink($tempFile); // Xóa file tạm thời
    //     return "Tệp hình ảnh có thể chứa mã độc.";
    // }

    // // Xóa file tạm thời
    // unlink($tempFile);

    // Nếu không có lỗi, trả về null
    return null;
}
// Tạm thời chưa sử dụng được
function scanFileWithVirusTotal($filePath)
{
    $url = 'https://www.hybrid-analysis.com/api/scan/file';
    $apiKey = $_SESSION["SCAN_KEY"];
    $headers = [
        "Authorization: Bearer $apiKey",
        "Content-Type: multipart/form-data"
    ];

    $postData = [
        'file' => curl_file_create($filePath)
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // print_r($response);

    if ($httpCode != 200) {
        return ['error' => ['message' => 'Không thể kết nối với Hybrid Analysis API. Mã trạng thái HTTP: ' . $httpCode]];
    }

    $responseData = json_decode($response, true);

    // Kiểm tra kết quả phân tích từ Hybrid Analysis
    if (isset($responseData['scan_results']) && $responseData['scan_results']['malicious'] > 0) {
        return ['error' => ['message' => 'Tệp hình ảnh có thể chứa mã độc.']];
    }

    return $responseData;
}


// Validate các giá trị được gửi qua form
function validateForm($fieldsToValidate)
{
    $errors = [];

    $fields = [
        'full_name' => 'validateNoSpecialChars',
        'phone_number' => 'validatePhoneNumber',
        'email' => 'validateEmail',
        'password' => 'validatePassword',
        'address' => 'validateAddress',
        'description' => 'validateDescription',
        'account_name' => 'validateNoSpecialChars',
        'user_name' => 'validateNoSpecialChars',
        'contentType' => 'validateNoSpecialChars',
        'contentCategory' => 'validateNoSpecialChars',
        'title' => 'validateNoSpecialChars',
        'current_password' => 'validatePassword',
        'category_name' => 'validateNoSpecialChars',
        'category_description' => 'validateDescription',
        'category_name_update' => 'validateNoSpecialChars',
        'category_description_update' => 'validateDescription',
    ];


    foreach ($fieldsToValidate as $field) {
        if (isset($fields[$field]) && isset($_POST[$field])) {
            if (!call_user_func($fields[$field], $_POST[$field])) {
                $errors[] = "Invalid " . ucfirst($field);
            }
        }
    }
    return $errors;
}
?>