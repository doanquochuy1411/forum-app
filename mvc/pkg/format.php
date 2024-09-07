<?php
function timeAgo($datetime, $full = false)
{
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $output[] = $diff->$k . ' ' . $v;
        }
    }
    if (!$full)
        $output = array_slice($output, 0, 1);
    return $output ? implode(', ', $output) . ' trước' : 'vừa mới';
}
// Bỏ các hình trong bài viết tạo thành sort content
function stripImages($content)
{
    return preg_replace('/<img[^>]*>/i', '', $content);
}
// format thời gian
function formatVietnameseDate($dateString)
{
    $timestamp = strtotime($dateString);

    $formattedDate = 'Ngày ' . date('d', $timestamp) . ' tháng ' . date('m', $timestamp) . ', ' . date('Y', $timestamp);

    return $formattedDate;
}
?>