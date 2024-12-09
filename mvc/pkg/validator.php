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
    return preg_match('/^[\p{L}\p{N}\s!@$%&?,\-()*:\=[\]]+$/u', $input);
}

function validateDescription($input)
{
    if ($input === '') {
        return true;
    }

    return preg_match('/^[\p{L}\p{N}\s!@$%&?,\-()*:\=[\]]+$/u', $input);
}

function validateGender($input)
{
    if ($input != 'Nam' && $input != "Nữ") {
        return false;
    }

    return true;
}

function validateAddress($address)
{
    return preg_match('/^[0-9a-zA-Z\s,\.\/\-]+$/u', $address);
}
function sanitizeInputContent($input)
{
    $input = htmlspecialchars($input);
    $sanitized = preg_replace('/[\'"\\\%;\(\)~`\^<>\[\]\{\}\&\|\*]/', '', $input);

    return $sanitized;
}

function validateImage($file, $tempDir = '/tmp')
{
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg']; // Type file thật sự
    $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
    $maxSize = 2 * 1024 * 1024;
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    // Kiểm tra phần mở rộng
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        return "Phần mở rộng file không hợp lệ. Chỉ chấp nhận JPEG, JPG, PNG, và GIF.";
    }

    // getimagesize: 1 phần thư viện GD của PHP hỗ trợ xử lý hình ảnh
    // Kiểm tra nội dung thực tế của file
    $imageInfo = getimagesize($file['tmp_name']); // trả về false nếu không phải là file ảnh thật sự do không có chiều rộng và chiều cao,...
    if ($imageInfo === false) {
        return "File không phải là hình ảnh hợp lệ.";
    }

    $fileType = $imageInfo['mime'];
    if (!in_array($fileType, $allowedTypes)) {
        return "Loại file không hợp lệ. Chỉ chấp nhận JPEG, JPG, PNG, và GIF.";
    }

    if ($file['size'] > $maxSize) {
        return "Kích thước file quá lớn. Kích thước tối đa là " . ($maxSize / 1024 / 1024) . " MB.";
    }

    if (!file_exists($tempDir)) {
        if (!mkdir($tempDir, 0755, true)) {
            return "Không thể tạo thư mục tạm thời: $tempDir.";
        }
    }

    return null;
}

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

    if ($httpCode != 200) {
        return ['error' => ['message' => 'Không thể kết nối với Hybrid Analysis API. Mã trạng thái HTTP: ' . $httpCode]];
    }

    $responseData = json_decode($response, true);

    if (isset($responseData['scan_results']) && $responseData['scan_results']['malicious'] > 0) {
        return ['error' => ['message' => 'Tệp hình ảnh có thể chứa mã độc.']];
    }

    return $responseData;
}

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
        'content' => 'sanitizeInputQuill',
        'gender' => 'validateGender',
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

function sanitizeInputQuill($input)
{
    $disallowed_tags = [
        'script',
        'iframe',
        'object',
        'embed',
        'form',
        'input',
        'button',
        'textarea',
        'link',
        'style',
        'meta',
        'base',
        'canvas',
        'svg',
        'video',
        'audio',
        'source'
    ];

    foreach ($disallowed_tags as $tag) {
        if (stripos($input, '<' . $tag) !== false) {
            return false;
        }
    }

    return true;
}

?>