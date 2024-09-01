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
    return preg_match('/^0\d{9}$/', $phoneNumber);
}

function validatePassword($password)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

function validateNoSpecialChars($input)
{
    return preg_match('/^[\p{L}\p{N}\s!@$%&?*:\[\]]+$/u', $input);
}

function validateAddress($address)
{
    return preg_match('/^[0-9a-zA-Z\s,\.\/\-]+$/u', $address);
}
function validateID($id)
{
    return filter_var($id, FILTER_VALIDATE_INT) !== false;
}
function validateParentID($id)
{
    return filter_var($id, FILTER_VALIDATE_INT) !== false || $id == "";
}
function sanitizeInput($input)
{
    // Thay thế các ký tự đặc biệt có thể gây ra SQL Injection
    $sanitized = preg_replace('/[\'"\\\%;\(\)~`\^<>\[\]\{\}\&\|\*]/', '', $input);

    // Trả về chuỗi đã được làm sạch
    return $sanitized;
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
        'description' => 'validateNoSpecialChars',
        'account_name' => 'validateNoSpecialChars',
        'user_name' => 'validateNoSpecialChars',
        'contentType' => 'validateNoSpecialChars',
        'contentCategory' => 'validateNoSpecialChars',
        'title' => 'validateNoSpecialChars',
        'parent_comment_id' => 'validateParentID',
        'post_id' => 'validateID',
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