<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$life_time = $_ENV['SESSION_LIFE_TIME'] ?? 10800; // Mặc định là 3 tiếng
$time_out = $_ENV['SESSION_TIMEOUT'] ?? 1800; // Mặc định là 30 phút
$rate_limit = $_ENV['RATE_LIMIT'] ?? 100; // Mặc định là 100 request
$window = $_ENV['WINDOW'] ?? 60; // Mặc định là 60 giây
$BASE = "http://localhost/forum-app";

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
    global $BASE;
    if (isset($_SESSION['client_ip']) && $_SESSION['client_ip'] !== getClientIP()) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 42000, '/');
        header("Location: " . $BASE . "/errors/unauthorized");
        exit();
    }
}

function setSessionTimeout($lifetime = 86400)
{
    global $BASE;
    if (!isset($_SESSION['session_start_time'])) {
        $_SESSION['session_start_time'] = time();
    }

    if (time() - $_SESSION['session_start_time'] > $lifetime) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 42000, '/');
        header("Location: " . $BASE . "/login");
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
    global $BASE;
    if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 42000, '/');
        header("Location: " . $BASE . "/login");
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
    global $BASE;
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
        header("Location: " . $BASE . "/login");
        exit();
    }

    // Kiểm tra thời gian không hoạt động
    if ($currentTime - $_SESSION['last_activity_time'] > $idleTimeout) {
        session_unset();  // Xóa tất cả các biến session
        session_destroy(); // Hủy session
        setcookie(session_name(), '', time() - 42000, '/');
        header("Location: " . $BASE . "/login");
        exit();
    }

    // Cập nhật thời gian hoạt động cuối cùng
    $_SESSION['last_activity_time'] = $currentTime;
}

function setSessionMessage($status, $message)
{
    $_SESSION['action_status'] = $status;
    $_SESSION['title_message'] = $message;
}

function rateLimit($limit = 100, $window = 60)
{
    global $BASE;
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $key = md5($ip . $userAgent);

    if (!isset($_SESSION['rate_limit'][$key])) {
        $_SESSION['rate_limit'][$key] = [
            'count' => 1,
            'start_time' => time(),
        ];
    } else {
        $elapsedTime = time() - $_SESSION['rate_limit'][$key]['start_time'];

        if ($elapsedTime < $window) {
            if ($_SESSION['rate_limit'][$key]['count'] >= $limit) {
                $timeToReset = $window - $elapsedTime;

                header("X-RateLimit-Limit: $limit");
                header("X-RateLimit-Remaining: 0");
                header("X-RateLimit-Reset: $timeToReset");
                session_unset();
                session_destroy();
                header("Location: " . $BASE . "/errors");
                exit;
            } else {
                $_SESSION['rate_limit'][$key]['count']++;
            }
        } else {
            $_SESSION['rate_limit'][$key] = [
                'count' => 1,
                'start_time' => time(),
            ];
        }
    }

    $remaining = $limit - $_SESSION['rate_limit'][$key]['count'];
    $timeToReset = $window - (time() - $_SESSION['rate_limit'][$key]['start_time']);

    header("X-RateLimit-Limit: $limit");
    header("X-RateLimit-Remaining: $remaining");
    header("X-RateLimit-Reset: $timeToReset");
}




session_set_cookie_params([
    'lifetime' => 0,
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
rateLimit($rate_limit, $window);
?>