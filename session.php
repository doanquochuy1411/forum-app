<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$life_time = $_ENV['SESSION_LIFE_TIME'] ?? 10800; // Mặc định là 3 tiếng
$time_out = $_ENV['SESSION_TIMEOUT'] ?? 1800; // Mặc định là 30 phút


function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function setSessionIP()
{
    if (!isset($_SESSION['client_ip'])) {
        $_SESSION['client_ip'] = getClientIP();
    }
}

function verifySessionIP()
{
    if (isset($_SESSION['client_ip']) && $_SESSION['client_ip'] !== getClientIP()) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 42000, '/');
        setSessionMessage('warning', "Phiên làm việc không hợp lệ: IP đã thay đổi.");
        exit();
    }
}

function setSessionTimeout($lifetime = 86400)
{
    if (!isset($_SESSION['session_start_time'])) {
        $_SESSION['session_start_time'] = time();
    }

    if (time() - $_SESSION['session_start_time'] > $lifetime) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 42000, '/');
        setSessionMessage('info', "Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại!");
        exit();
    }
}

function setSessionUserAgent()
{
    if (!isset($_SESSION['user_agent'])) {
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    }
}

function verifySessionUserAgent()
{
    if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 42000, '/');
        setSessionMessage('error', "Phiên làm việc của bạn đang bị rò rỉ. Vui lòng đăng nhập lại!");
        exit();
    }
}

/**
 * Thiết lập thời gian tối đa và thời gian không hoạt động cho phiên làm việc.
 * @param int $maxLifetime Thời hạn tối đa của phiên (24 giờ).
 * @param int $idleTimeout Thời gian không hoạt động tối đa (30 phút).
 */
function manageSession($maxLifetime = 86400, $idleTimeout = 1800)
{
    $currentTime = time();

    if (!isset($_SESSION['session_start_time'])) {
        $_SESSION['session_start_time'] = $currentTime;
    }

    if (!isset($_SESSION['last_activity_time'])) {
        $_SESSION['last_activity_time'] = $currentTime; // Thời gian hoạt động cuối cùng
    }

    // Kiểm tra thời hạn tối đa
    if ($currentTime - $_SESSION['session_start_time'] > $maxLifetime) {
        session_unset();  // Xóa tất cả các biến session
        session_destroy(); // Hủy session
        setcookie(session_name(), '', time() - 42000, '/');
        // die("Phiên làm việc đã hết hạn (quá 24 giờ).");
        setSessionMessage('info', "Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại!");
        exit();
    }

    // Kiểm tra thời gian không hoạt động
    if ($currentTime - $_SESSION['last_activity_time'] > $idleTimeout) {
        session_unset();  // Xóa tất cả các biến session
        session_destroy(); // Hủy session
        setcookie(session_name(), '', time() - 42000, '/');
        setSessionMessage('info', "Phiên làm việc đã hết hạn do không hoạt động. Vui lòng đăng nhập lại!");
        exit();
    }

    // Cập nhật thời gian hoạt động cuối cùng
    $_SESSION['last_activity_time'] = $currentTime;
}

function setSessionMessage($status, $message)
{
    if (!isset($_SESSION['action_status'])) {
        $_SESSION['action_status'] = $status;
        $_SESSION['title_message'] = $message;
    }
}



session_set_cookie_params([
    'lifetime' => 0, // Session sẽ bị xóa khi trình duyệt đóng
    'path' => '/',
    'domain' => $_SERVER['SERVER_NAME'],
    'secure' => true,      // Chỉ gửi cookie qua HTTPS
    'httponly' => true     // Cookie không thể truy cập qua JavaScript
]);

session_name("forum-app");
session_start();

// Gọi các hàm bảo vệ session
setSessionIP();
verifySessionIP();
setSessionUserAgent();
verifySessionUserAgent();
setSessionTimeout($life_time);
manageSession($life_time, $time_out);
?>